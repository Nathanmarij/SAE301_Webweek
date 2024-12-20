<header>
    <div class="mobile-header" id="mobile-header">
        <?php include 'header_mobile.php'; ?>
    </div>
    <div class="desktop-header" id="desktop-header">
        <?php include 'header_desktop.php'; ?>
    </div>
    <script>
        function checkScreenSize() {
            var screenWidth = window.innerWidth;

            if (screenWidth < 768) {
                document.getElementById('mobile-header').style.display = 'block';
                document.getElementById('desktop-header').style.display = 'none';
            } else {
                document.getElementById('mobile-header').style.display = 'none';
                document.getElementById('desktop-header').style.display = 'block';
            }
        }
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);
    </script>

</header>