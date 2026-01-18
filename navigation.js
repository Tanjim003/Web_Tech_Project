// Navigation functionality
function highlightCurrentPage() {
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('nav a').forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
}

function initNavigation() {
    console.log("Navigation script loaded");
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const loginBtn = document.getElementById('loginBtn'); // Add this line
    
    if (hamburger && nav && overlay) {
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('mobile-menu-open');
            
            // Toggle icon
            const icon = hamburger.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
        
        // Close menu when clicking overlay
        overlay.addEventListener('click', function() {
            nav.classList.remove('active');
            this.classList.remove('active');
            document.body.classList.remove('mobile-menu-open');
            hamburger.querySelector('i').classList.remove('fa-times');
            hamburger.querySelector('i').classList.add('fa-bars');
        });
        
        // Close menu when clicking links
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function() {
                nav.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('mobile-menu-open');
                hamburger.querySelector('i').classList.remove('fa-times');
                hamburger.querySelector('i').classList.add('fa-bars');
            });
        });
        
        // Close on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                nav.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('mobile-menu-open');
                hamburger.querySelector('i').classList.remove('fa-times');
                hamburger.querySelector('i').classList.add('fa-bars');
            }
        });
    }
    
    // Add login button functionality
    if (loginBtn) {
        loginBtn.addEventListener('click', function() {
            window.location.href = 'login.html';
        });
    }
}

document.addEventListener('DOMContentLoaded', initNavigation);