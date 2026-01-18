<?php
require_once '../config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJSONResponse(false, 'Invalid request method');
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    $data = $_POST;
}

// Validate required fields
$required = ['name', 'username', 'email', 'phone', 'role', 'district', 'password'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        sendJSONResponse(false, "Field '$field' is required");
    }
}

$name = sanitizeInput($data['name']);
$username = sanitizeInput($data['username']);
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = sanitizeInput($data['phone']);
$role = sanitizeInput($data['role']);
$district = sanitizeInput($data['district']);
$password = $data['password'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendJSONResponse(false, 'Invalid email address');
}

// Validate role
$allowedRoles = ['volunteer', 'doctor', 'farmer', 'supporter'];
if (!in_array($role, $allowedRoles)) {
    sendJSONResponse(false, 'Invalid role');
}

// Validate password strength (minimum 6 characters)
if (strlen($password) < 6) {
    sendJSONResponse(false, 'Password must be at least 6 characters long');
}

try {
    $conn = getDBConnection();
} catch (Exception $e) {
    sendJSONResponse(false, 'Database connection failed. Please ensure MySQL is running and the database exists.');
}

// Check if username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
if (!$stmt) {
    $conn->close();
    sendJSONResponse(false, 'Database error: ' . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $stmt->close();
    $conn->close();
    sendJSONResponse(false, 'Username already exists');
}
$stmt->close();

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
if (!$stmt) {
    $conn->close();
    sendJSONResponse(false, 'Database error: ' . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    $stmt->close();
    $conn->close();
    sendJSONResponse(false, 'Email already exists');
}
$stmt->close();

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password, phone, role, district) VALUES (?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    $conn->close();
    sendJSONResponse(false, 'Database error: ' . $conn->error);
}
$stmt->bind_param("sssssss", $name, $username, $email, $hashedPassword, $phone, $role, $district);

if ($stmt->execute()) {
    $userId = $conn->insert_id;
    $stmt->close();
    $conn->close();
    
    // Auto-login user
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    
    sendJSONResponse(true, 'Registration successful', ['user_id' => $userId, 'username' => $username]);
} else {
    $error = $stmt->error;
    $stmt->close();
    $conn->close();
    sendJSONResponse(false, 'Registration failed: ' . $error);
}
?>
