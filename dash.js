document.addEventListener('DOMContentLoaded', function() {
  // Get all elements
  const modal = document.getElementById('signupModal');
  const signupBtn = document.getElementById('signUpBtn');
  const closeBtn = document.querySelector('#signupModal .close');
  const signupForm = document.getElementById('signupForm');
  const successMessage = document.getElementById('successMessage');
  
  if (!modal || !signupForm) return; // Exit if elements don't exist (user already logged in)
  
  // Form input fields
  const nameInput = document.getElementById('name');
  const usernameInput = document.getElementById('username');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const passwordInput = document.getElementById('password');
  const roleSelect = document.getElementById('role');
  const districtSelect = document.getElementById('district');
  const errorDiv = document.getElementById('signupError');
  const togglePasswordBtn = document.getElementById('togglePasswordSignup');
  
  // Toggle password visibility
  if (togglePasswordBtn && passwordInput) {
    togglePasswordBtn.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // Toggle eye icon
      const icon = this.querySelector('i');
      if (icon) {
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
      }
    });
  }
  
  // Success message elements
  const successName = document.getElementById('successName');
  const successUsername = document.getElementById('successUsername');
  const successRole = document.getElementById('successRole');
  const successDistrict = document.getElementById('successDistrict');
  const continueBtn = document.getElementById('continueBtn');
  const modalCloseBtn = document.getElementById('closeBtn');

  // Reset form and show it
  function resetForm() {
    signupForm.style.display = 'block';
    successMessage.style.display = 'none';
    if (errorDiv) errorDiv.style.display = 'none';
    signupForm.reset();
  }

  // Function to open modal
  function openSignupModal() {
    if (modal) {
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden';
      resetForm();
    }
  }

  // Open modal from Sign Up button
  if (signupBtn) {
    signupBtn.addEventListener('click', function(e) {
      e.preventDefault();
      openSignupModal();
    });
  }

  // Open modal from Join Us button (in header and hamburger menu)
  const joinBtn = document.getElementById('joinBtn');
  if (joinBtn) {
    joinBtn.addEventListener('click', function(e) {
      e.preventDefault();
      openSignupModal();
      // Close mobile menu if open
      const nav = document.querySelector('nav');
      const overlay = document.querySelector('.mobile-menu-overlay');
      const hamburger = document.querySelector('.hamburger');
      if (nav && overlay && hamburger) {
        nav.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('mobile-menu-open');
        const icon = hamburger.querySelector('i');
        if (icon) {
          icon.classList.remove('fa-times');
          icon.classList.add('fa-bars');
        }
      }
    });
  }

  // Close modal
  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
  }

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
  
  window.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
  });

  // Form submission
  signupForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Hide error
    if (errorDiv) errorDiv.style.display = 'none';
    
    // Get form values
    const formData = {
      name: nameInput.value.trim(),
      username: usernameInput.value.trim(),
      email: emailInput.value.trim(),
      phone: phoneInput.value.trim(),
      password: passwordInput.value,
      role: roleSelect.value,
      district: districtSelect.value
    };

    // Client-side validation
    if (formData.password.length < 6) {
      showError('Password must be at least 6 characters long');
      return;
    }

    // Disable submit button
    const submitBtn = signupForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Registering...';

    // Send to server
    fetch('auth/register.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        // Update success message
        if (successName) successName.textContent = formData.name;
        if (successUsername) successUsername.textContent = formData.username;
        if (successRole) successRole.textContent = formData.role;
        if (successDistrict) successDistrict.textContent = formData.district;
        
        // Hide form, show success
        signupForm.style.display = 'none';
        if (successMessage) successMessage.style.display = 'block';
      } else {
        showError(data.message || 'Registration failed. Please try again.');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showError('An error occurred. Please check your connection and try again. If the problem persists, make sure the database is set up correctly.');
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    });
  });

  function showError(message) {
    if (errorDiv) {
      errorDiv.textContent = message;
      errorDiv.style.display = 'block';
    } else {
      alert(message);
    }
  }

  // Continue button action
  if (continueBtn) {
    continueBtn.addEventListener('click', function() {
      window.location.reload(); // Reload to show logged-in state
    });
  }
});
