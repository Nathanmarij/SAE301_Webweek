<div id="myMenu_nav">
   <nav class="myApp-sidenav accordion myApp-sidenav-light">
      <div class="myApp-sidenav-menu">
         <div class="nav">
            <a class="nav-link" href="./">
               <div class="myApp-nav-link-icon"><i class="fas fa-table"></i></div>
               Tableau de bord 
            </a>

            <div class="myApp-sidenav-menu-heading  text-danger">Configurations</div>
            <a class="nav-link  text-danger" href="configuration.php" >
               <div class="myApp-nav-link-icon  text-danger"><i class="fas fa-question"></i></div>
               Faire configuration
            </a>

            <div class="myApp-sidenav-menu-heading">Menu</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
               <div class="myApp-nav-link-icon"><i class="fas fa-users"></i></div>
               Utilisateurs
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="users">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="ajouter_user.php">Ajouter utilisateur</a>
                  <a class="nav-link" href="liste_users.php">Liste utilisateurs</a>
                  <a class="nav-link" href="activer_compte_user.php">Activer compte utilisateur</a>
               </nav>
            </div>


            <a class="nav-link" href="liste_reservations.php" >
               <div class="myApp-nav-link-icon"><i class="fas fa-list"></i></div>
               Liste réservations
            </a>


            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#evenements" aria-expanded="false" aria-controls="evenements">
               <div class="myApp-nav-link-icon"><i class="fas fa-calendar-days"></i></div>
               Évènements
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="evenements">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="ajouter_events.php">Ajouter évènement</a>
                  <a class="nav-link" href="liste_events.php">Liste évènements</a>
               </nav>
            </div>


            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#avis" aria-expanded="false" aria-controls="avis">
               <div class="myApp-nav-link-icon"><i class="fas fa-comment"></i></div>
               Avis
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="avis">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="gestions_avis.php">Gestions avis</a>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin" aria-expanded="false" aria-controls="admin">
               <div class="myApp-nav-link-icon"><i class="fas fa-star"></i></div>
               Administrateurs
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="admin">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="liste_admins.php">Liste administrateurs</a>
                  <a class="nav-link" href="gestion_roles.php">Gestion rôles</a>
               </nav>
            </div>
         </div>
      </div>
      <div class="myApp-sidenav-footer">
         <div class="small">Dernière connexion:</div>
         10 Janvier 2024
      </div>
   </nav>
</div>