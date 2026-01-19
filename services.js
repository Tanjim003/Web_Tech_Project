/*
 * before attaching event listeners.
 */
document.addEventListener('DOMContentLoaded', function() {

    // ==================================================
    // 1. OPEN MODAL LOGIC
    // ==================================================
    document.querySelectorAll('.service-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Get the ID of the modal from the button's 'data-target' attribute
            // Example: data-target="doctorForm" -> looks for element with id="doctorForm"
            const targetModal = document.getElementById(this.getAttribute('data-target'));
            
            if (targetModal) {
                // Show the modal
                targetModal.style.display = 'block';
                // Disable scrolling on the main page while modal is open
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // ==================================================
    // 2. CLOSE MODAL LOGIC (X BUTTON)
    // ==================================================
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            // Find the closest parent with class 'service-modal' and hide it
            this.closest('.service-modal').style.display = 'none';
            // Re-enable scrolling on the main page
            document.body.style.overflow = 'auto';
        });
    });

    // ==================================================
    // 3. CLOSE MODAL LOGIC (OUTSIDE CLICK)
    // ==================================================
    document.querySelectorAll('.service-modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            // Check if the user clicked the dark background (the modal itself)
            // and NOT the white content box inside it.
            if (e.target === this) {
                this.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });

    // ==================================================
    // 4. FORM SUBMISSION LOGIC (AJAX)
    // ==================================================
    document.querySelectorAll('.service-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Prevent the browser from refreshing the page
            e.preventDefault();
            
            // Get form elements
            const serviceType = this.getAttribute('data-service'); // e.g., "doctor", "donation"
            const submitBtn = this.querySelector('button[type="submit"]');
            const thankYou = this.querySelector('.thank-you-message');
            const originalText = submitBtn.textContent; // Save text to restore later ("Get Started")
            
            // --- A. Prepare Data ---
            const formData = {
                service_type: serviceType
            };
            
            // Loop through all inputs/selects and add them to formData object
            const inputs = this.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                // Only add fields that have a 'name' attribute and a value
                if (input.name && input.value) {
                    formData[input.name] = input.value;
                }
            });
            
            // --- B. UI Feedback (Loading State) ---
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            
            // Hide previous success messages if they exist
            if (thankYou) thankYou.style.display = 'none';
            
            // --- C. Send Data to Server (Fetch API) ---
            fetch('api/submit_service.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData) // Convert JS object to JSON string
            })
            .then(response => response.json()) // Parse the JSON response from PHP
            .then(data => {
                // --- D. Handle Success ---
                if (data.success) {
                    // Show success message inside the modal
                    if (thankYou) thankYou.style.display = 'block';
                    submitBtn.textContent = 'Submitted ✓';
                    
                    // Wait 3 seconds, then reset and close the modal automatically
                    setTimeout(() => {
                        this.reset(); // Clear form inputs
                        if (thankYou) thankYou.style.display = 'none'; // Hide success message
                        
                        // Restore button state
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                        
                        // Close the modal
                        this.closest('.service-modal').style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }, 3000);
                } else {
                    // --- E. Handle Server-Side Validation Error ---
                    alert(data.message || 'Submission failed. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            })
            .catch(error => {
                // --- F. Handle Network Error ---
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    });
});