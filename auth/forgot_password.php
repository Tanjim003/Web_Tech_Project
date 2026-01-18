<?php
require_once '../config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJSONResponse(false, 'Invalid request method');
}

$email = filter_var($_POST['resetEmail'] ?? '', FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendJSONResponse(false, 'Invalid email address');
}

$conn = getDBConnection();

// Check if user exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Don't reveal if email exists for security
    $stmt->close();
    $conn->close();
    sendJSONResponse(true, 'If an account exists with this email, a password reset link has been sent.');
}

// Generate reset token
$token = generateToken();
$expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Store token
$stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE token = ?, expires_at = ?");
$stmt->bind_param("sssss", $email, $token, $expiresAt, $token, $expiresAt);
$stmt->execute();
$stmt->close();
$conn->close();

// In a real application, send email with reset link
// For now, we'll just return success
// $resetLink = "https://yoursite.com/reset_password.php?token=" . $token;
// mail($email, "Password Reset", "Click here to reset: " . $resetLink);

sendJSONResponse(true, 'If an account exists with this email, a password reset link has been sent.');
?>
