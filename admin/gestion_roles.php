<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Gestion des rôles et permissions - Espace Administrateur</title>
   <meta name="description" content=""/>
   <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
   <link href="../assets/css/styles_admin.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
   <?php include('includes/nav.php'); ?>
   <div id="mySidebar">
      <?php include('includes/menu.php'); ?>
      <div id="myContenu">
         <main>
            <div class="container-fluid px-4">
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Gestion des rôles et permissions</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Administrateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Gérer rôles et permissions</li>
               </ol>

               <div class="row mb-3">
                  <div class="col-8">
                     <h3>Attribuer un rôle</h3>
                     <select id="liste-users" class="form-select mb-2"></select>
                     <select id="liste-roles" class="form-select mb-2"></select>
                     <button id="attribuer-role" class="btn btn-success bg-primary">Attribuer le rôle</button>
                     <div id="message-role"></div>
                  </div>
               </div>

               <div id="message-role"></div>


               <div class=" mt-5">
                  <div class="col-md-12">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                                 <th>Nom du rôle</th>
                                 <th>Permissions</th>
                           </tr>
                        </thead>
                        <tbody id="permissions-container"></tbody>
                     </table>
                  </div>
               </div>

            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

   <!-- Mustache Templates -->
   <script id="template-permissions" type="text/template">
      {{#roles}}
      <tr>
         <td>{{nom_role}}</td>
         <td>
            {{#permissions}}
            <span class="badge bg-secondary">{{nom_permission}}</span>
            {{/permissions}}
         </td>
      </tr>
      {{/roles}}
   </script>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="../assets/JS/mustache.min.js"></script>
   <script src="../assets/JS/script_roles.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
