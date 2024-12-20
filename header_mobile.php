<header>
    <nav class="navbar navbar-expand-lg navbar-dark container" style="background-color: #121D3F;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand ms-auto" href="index.php" title="Accueil">
            <img src="img/logo-reserv.png" alt="Logo Conservatoire" width="150" height="auto"
                class="d-inline-block align-top">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto align-self-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" title="accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="event.php" title="Evénements">Evénements</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" title="Mes réservations"  href="<?= $href2 ?>">Mes réservations</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" title="Compte"  href="<?= $href ?>"><svg
                            xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg></a>
                </li>
            </ul> 
        </div>
    </nav>
</header>