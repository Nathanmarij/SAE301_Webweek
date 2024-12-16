<div id="layoutSidenav_nav">
   <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
         <div class="nav">
            <a class="nav-link" href="./">
               <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
               Tableau de bord 
            </a>
            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
               <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
               Utilisateurs
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="users" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
               
               <nav class="sb-sidenav-menu-nested nav accordion" id="users">
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gestionUsers" aria-expanded="false" aria-controls="gestionUsers">
                        Gestions Utilisateurs
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="gestionUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link" href="login.html">Ajouter utilisateur</a>
                           <a class="nav-link" href="liste_users.php">Liste utilisateurs</a>
                           <a class="nav-link" href="password.html">Activer compte utilisateur</a>
                        </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#events" aria-expanded="false" aria-controls="events">
                        Gestion Réservations
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="events" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link" href="401.html">Liste réservations</a>
                        </nav>
                  </div>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#evenements" aria-expanded="false" aria-controls="evenements">
               <div class="sb-nav-link-icon"><i class="fas fa-calendar-days"></i></div>
               Évènements
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="evenements" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="login.html">Ajouter évènement</a>
                  <a class="nav-link" href="register.html">Liste évènements</a>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#avis" aria-expanded="false" aria-controls="avis">
               <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
               Avis
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="avis" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="login.html">Gestions avis</a>
                  <a class="nav-link" href="register.html">Avis suspects</a>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin" aria-expanded="false" aria-controls="admin">
               <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
               Administrateurs
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="admin" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="login.html">Ajouter administrateur</a>
                  <a class="nav-link" href="register.html">Liste administrateurs</a>
                  <a class="nav-link" href="register.html">Gestion rôles</a>
               </nav>
            </div>
         </div>
      </div>
      <div class="sb-sidenav-footer">
         <div class="small">Dernière connexion:</div>
         10 Janvier 2024
      </div>
   </nav>
</div>