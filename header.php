<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$href = isset($_SESSION['id_users']) ? 'compteUtilisateur.php' : 'connexion_compte.php';
$href2 = isset($_SESSION['id_users']) ? 'reservation_aVenir.php' : 'connexion_compte.php';
?>
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