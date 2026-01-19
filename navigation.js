/**
 * ==============================================
 * 1. Active Page Highlighter
 * Automatic styling for the navigation link that 
 * matches the current URL.
 * ==============================================
 */
function highlightCurrentPage() {
    // Get the current filename (e.g., 'services.php') from the URL
    const currentPage = window.location.pathname.split('/').pop();
    
    // Loop through all nav links to find the match
    document.querySelectorAll('nav a').forEach(link => {
        // If link matches current page, add the CSS class for underlining/bolding
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
}

/**
 * ==============================================
 * 2. Main Navigation Initialization
 * Handles Mobile Menu (Hamburger), Overlay, and Resize events
 * ==============================================
 */
function initNavigation() {
    console.log("Navigation script loaded");

    // Select DOM elements
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const loginBtn = document.getElementById('loginBtn'); 

    // Only run if these elements actually exist on the page
    if (hamburger && nav && overlay) {
        
        // --- A. Hamburger Click Event (Toggle Menu) ---
        hamburger.addEventListener('click', function() {
            // Slide menu in/out
            nav.classList.toggle('active');
            // Show/hide dark background overlay
            overlay.classList.toggle('active');
            // Prevent body scrolling when menu is open
            document.body.classList.toggle('mobile-menu-open');
            
            // Icon Swap: Change 3 bars (fa-bars) to an X (fa-times)
            const icon = hamburger.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
        
        // --- B. Close Menu when clicking outside (Overlay) ---
        overlay.addEventListener('click', function() {
            nav.classList.remove('active');
            this.classList.remove('active');
            document.body.classList.remove('mobile-menu-open');
            
            // Reset icon back to hamburger bars
            hamburger.querySelector('i').classList.remove('fa-times');
            hamburger.querySelector('i').classList.add('fa-bars');
        });
        
        // --- C. Close Menu when a link is clicked ---
        // (Improves UX so the menu doesn't stay open after navigation)
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function() {
                nav.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('mobile-menu-open');
                
                // Reset icon
                hamburger.querySelector('i').classList.remove('fa-times');
                hamburger.querySelector('i').classList.add('fa-bars');
            });
        });
        
        // --- D. Reset on Window Resize ---
        // If user stretches window to desktop size while mobile menu is open, force close it.
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                nav.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('mobile-menu-open');
                
                // Reset icon
                hamburger.querySelector('i').classList.remove('fa-times');
                hamburger.querySelector('i').classList.add('fa-bars');
            }
        });
    }
    
    // --- E. Login Button Redirect ---
    if (loginBtn) {
        loginBtn.addEventListener('click', function() {
            window.location.href = 'login.html';
        });
    }
}

// Run the script once the HTML structure is fully loaded
document.addEventListener('DOMContentLoaded', initNavigation);