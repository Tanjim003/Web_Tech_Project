document.addEventListener('DOMContentLoaded', function() {
    // Open modals when service buttons are clicked
    document.querySelectorAll('.service-btn').forEach(button => {
        button.addEventListener('click', function() {
            const targetModal = document.getElementById(this.getAttribute('data-target'));
            if (targetModal) {
                targetModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Close modals when X is clicked
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.service-modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    // Close modals when clicking outside
    document.querySelectorAll('.service-modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });

    // Handle form submissions
    document.querySelectorAll('.service-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const serviceType = this.getAttribute('data-service');
            const submitBtn = this.querySelector('button[type="submit"]');
            const thankYou = this.querySelector('.thank-you-message');
            const originalText = submitBtn.textContent;
            
            // Collect form data
            const formData = {
                service_type: serviceType
            };
            
            // Get all form inputs
            const inputs = this.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.name && input.value) {
                    formData[input.name] = input.value;
                }
            });
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            
            // Hide previous messages
            if (thankYou) thankYou.style.display = 'none';
            
            // Send to server
            fetch('api/submit_service.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show thank you message
                    if (thankYou) thankYou.style.display = 'block';
                    submitBtn.textContent = 'Submitted ✓';
                    
                    // Reset form and close modal after 3 seconds
                    setTimeout(() => {
                        this.reset();
                        if (thankYou) thankYou.style.display = 'none';
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                        this.closest('.service-modal').style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }, 3000);
                } else {
                    alert(data.message || 'Submission failed. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    });
});
