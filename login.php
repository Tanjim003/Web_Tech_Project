<?php
require_once 'config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$pageTitle = 'Login';
$additionalCSS = ['login.css'];
$additionalJS = ['login.js'];
include 'includes/header.php';
?>

<section class="login-section">
    <div class="login-container">
        <div class="login-card">
            <h2>Member Login</h2>
            <p>Access your E-Welfare Bangladesh account</p>
            
            <form id="loginForm" action="auth/login.php" method="POST">
                <div class="form-group">
                    <label for="loginEmail">Email or Username</label>
                    <input type="text" id="loginEmail" name="loginEmail" required>
                    <i class="fas fa-user input-icon"></i>
                </div>
                
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="loginPassword" required>
                    <i class="fas fa-lock input-icon"></i>
                    <span class="toggle-password" id="togglePassword">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember_me"> Remember me
                    </label>
                    <a href="#" id="forgotPasswordLink">Forgot password?</a>
                </div>
                
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div id="loginError" class="error-message" style="display: block;"><?php echo htmlspecialchars($_SESSION['login_error']); unset($_SESSION['login_error']); ?></div>
                <?php else: ?>
                    <div id="loginError" class="error-message" style="display: none;"></div>
                <?php endif; ?>
                
                <button type="submit" class="primary-btn">Login</button>
                
                <div class="login-divider">
                    <span>or continue with</span>
                </div>
                
                <div class="social-login">
                    <button type="button" class="social-btn google-btn">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn facebook-btn">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </button>
                </div>
                
                <p class="register-link">Don't have an account? <a href="index.php#signupModal" id="signUpLink">Sign up</a></p>
            </form>
        </div>
        
        <div class="login-image">
            <img src="https://images.unsplash.com/photo-1573497491765-dccce02b29df?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Community volunteers">
        </div>
    </div>
</section>

<!-- Forgot Password Modal -->
<div id="forgotPasswordModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Reset Your Password</h2>
        <p>Enter your email address and we'll send you a link to reset your password.</p>
        
        <form id="forgotPasswordForm" action="auth/forgot_password.php" method="POST">
            <div class="form-group">
                <label for="resetEmail">Email Address</label>
                <input type="email" id="resetEmail" name="resetEmail" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>
            
            <div id="resetError" class="error-message" style="display: none;"></div>
            <div id="resetSuccess" class="success-message" style="display: none;"></div>
            
            <button type="submit" class="primary-btn">Send Reset Link</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
