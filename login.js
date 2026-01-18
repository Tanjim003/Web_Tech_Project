// login.js - Login Page Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('loginPassword');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }
    
    // Show login error if present
    const loginError = document.getElementById('loginError');
    const loginForm = document.getElementById('loginForm');
    
    // Forgot password modal
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const forgotPasswordModal = document.getElementById('forgotPasswordModal');
    const closeModal = document.querySelector('#forgotPasswordModal .close');
    
    if (forgotPasswordLink && forgotPasswordModal) {
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            forgotPasswordModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (closeModal) {
        closeModal.addEventListener('click', function() {
            forgotPasswordModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
    
    // Close modal when clicking outside
    if (forgotPasswordModal) {
        window.addEventListener('click', function(e) {
            if (e.target === forgotPasswordModal) {
                forgotPasswordModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    // Forgot password form submission
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    const resetError = document.getElementById('resetError');
    const resetSuccess = document.getElementById('resetSuccess');
    
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            if (resetError) resetError.style.display = 'none';
            if (resetSuccess) resetSuccess.style.display = 'none';
            
            const formData = new FormData(this);
            
            fetch('auth/forgot_password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (resetSuccess) {
                        resetSuccess.textContent = data.message;
                        resetSuccess.style.display = 'block';
                    }
                    this.style.display = 'none';
                } else {
                    if (resetError) {
                        resetError.textContent = data.message;
                        resetError.style.display = 'block';
                    }
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (resetError) {
                    resetError.textContent = 'An error occurred. Please try again.';
                    resetError.style.display = 'block';
                }
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    }
    
    // Sign up link
    const signUpLink = document.getElementById('signUpLink');
    if (signUpLink) {
        signUpLink.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'index.php#signupModal';
        });
    }
});
