<div id="myMenu_nav">
   <nav class="myApp-sidenav accordion myApp-sidenav-light">
      <div class="myApp-sidenav-menu">
         <div class="nav">
            <a class="nav-link" href="./">
               <div class="myApp-nav-link-icon"><i class="fas fa-table"></i></div>
               Tableau de bord 
            </a>
            <div class="myApp-sidenav-menu-heading">Menu</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
               <div class="myApp-nav-link-icon"><i class="fas fa-users"></i></div>
               Utilisateurs
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="users">
               
               <nav class="myApp-sidenav-menu-nested nav accordion" id="users">
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gestionUsers" aria-expanded="false" aria-controls="gestionUsers">
                        Gestions Utilisateurs
                        <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="gestionUsers">
                        <nav class="myApp-sidenav-menu-nested nav">
                           <a class="nav-link" href="#">Ajouter utilisateur</a>
                           <a class="nav-link" href="liste_users.php">Liste utilisateurs</a>
                           <a class="nav-link" href="#">Activer compte utilisateur</a>
                        </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#events" aria-expanded="false" aria-controls="events">
                        Gestion Réservations
                        <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="events">
                        <nav class="myApp-sidenav-menu-nested nav">
                           <a class="nav-link" href="#">Liste réservations</a>
                        </nav>
                  </div>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#evenements" aria-expanded="false" aria-controls="evenements">
               <div class="myApp-nav-link-icon"><i class="fas fa-calendar-days"></i></div>
               Évènements
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="evenements">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="#">Ajouter évènement</a>
                  <a class="nav-link" href="#">Liste évènements</a>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#avis" aria-expanded="false" aria-controls="avis">
               <div class="myApp-nav-link-icon"><i class="fas fa-comment"></i></div>
               Avis
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="avis">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="#">Gestions avis</a>
                  <a class="nav-link" href="#">Avis suspects</a>
               </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#admin" aria-expanded="false" aria-controls="admin">
               <div class="myApp-nav-link-icon"><i class="fas fa-star"></i></div>
               Administrateurs
               <div class="myApp-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="admin">
               <nav class="myApp-sidenav-menu-nested nav">
                  <a class="nav-link" href="#">Ajouter administrateur</a>
                  <a class="nav-link" href="#">Liste administrateurs</a>
                  <a class="nav-link" href="#">Gestion rôles</a>
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