<!-- JavaScript -->
<script src="<?php echo SITE_URL; ?>assets/js/main.js"></script>
<script src="<?php echo SITE_URL; ?>assets/js/forms.js"></script>

<!-- Optional: Include only on pages that need it -->
<?php if ($current_page == 'contact' || $current_page == 'demo' || $current_page == 'register'): ?>
<script>
// Form validation scripts
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide flash messages
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 300);
        }, 5000);
    });

    // Mobile menu toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (navToggle) {
        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('nav-open');
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.user-dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });

    // User dropdown toggle
    const userBtn = document.querySelector('.user-btn');
    if (userBtn) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = userBtn.closest('.user-dropdown').querySelector('.dropdown-menu');
            dropdown.classList.toggle('show');
        });
    }
});
</script>
<?php endif; ?>

<!-- Analytics (optional) -->
<script>
// You can add Google Analytics or other tracking here
// Example:
// (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
// (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
// m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
// })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
// ga('create', 'UA-XXXXX-Y', 'auto');
// ga('send', 'pageview');
</script>