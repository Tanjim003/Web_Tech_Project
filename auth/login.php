<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.php");
    exit();
}

$loginEmail = sanitizeInput($_POST['loginEmail']);
$password = $_POST['loginPassword'];
$rememberMe = isset($_POST['remember_me']);

$conn = getDBConnection();

// Try to find user by email or username
$stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $loginEmail, $loginEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    $_SESSION['login_error'] = 'Invalid email/username or password';
    header("Location: ../login.php");
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

// Verify password
if (!password_verify($password, $user['password'])) {
    $conn->close();
    $_SESSION['login_error'] = 'Invalid email/username or password';
    header("Location: ../login.php");
    exit();
}

// Login successful
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];

// Set remember me cookie if requested (7 days)
if ($rememberMe) {
    setcookie('remember_token', base64_encode($user['id'] . ':' . hash('sha256', $user['password'])), time() + (7 * 24 * 60 * 60), '/');
}

$conn->close();

// Redirect to dashboard or homepage
header("Location: ../index.php");
exit();
?>
