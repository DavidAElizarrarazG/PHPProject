<?php
// footer.php — Close layout, include JS
?>
        </main>
    </div><!-- /.app-layout -->

    <script src="walkthrough.js"></script>
    <script>
    // Mobile nav drawer toggle
    function toggleMobileMenu() {
        var drawer   = document.getElementById('mobileDrawer');
        var hamburger = document.getElementById('hamburger');
        var overlay  = document.getElementById('sidebarOverlay');
        var isOpen   = drawer.classList.contains('open');

        if (isOpen) {
            drawer.classList.remove('open');
            hamburger.classList.remove('active');
            overlay.classList.remove('active');
            overlay.style.display = '';
        } else {
            overlay.style.display = 'block';
            // allow display:block to render, then animate
            requestAnimationFrame(function() {
                drawer.classList.add('open');
                hamburger.classList.add('active');
                overlay.classList.add('active');
            });
        }
    }

    // Old alias kept for any references in page scripts
    function toggleSidebar() { toggleMobileMenu(); }

    // Close on nav click (mobile)
    document.querySelectorAll('.mobile-drawer a').forEach(function(a) {
        a.addEventListener('click', function() {
            if (window.innerWidth <= 900) toggleMobileMenu();
        });
    });

    // Replay tour from nav button
    function replayTour() {
        if (typeof window._tourSteps !== 'undefined') {
            startTour(window._tourSteps, true);
        }
    }

    // Auto-start tour on page load (if steps are defined)
    window.addEventListener('load', function() {
        setTimeout(function() {
            if (typeof window._tourSteps !== 'undefined') {
                startTour(window._tourSteps, false);
            }
        }, 800);
    });
    </script>
</body>
</html>
