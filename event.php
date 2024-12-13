<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Je me connecte - Conservatoire de l'Agglomération du Puy-en-Velay</title>
      <meta name="description" content=""/>
      <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
      <!-- Lien vers la feuille de style Bootstrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <!-- Lien vers le fichier CSS personnalisé -->
      <link href="assets/css/style.css" rel="stylesheet">
   </head>
   <body>

      <?php 
         include("header.php"); 
         ?>
      <div class="container my-5">
         <h1 class="text-center mb-4 fw-bold">Les évènements</h1>
         <div class="d-flex justify-content-center mb-4">
            <a href="#" class="btn btn-link active text-uppercase text-danger fw-bold me-3">Musique</a>
            <a href="#" class="btn btn-link text-uppercase text-dark me-3">Théatre</a>
            <a href="#" class="btn btn-link text-uppercase text-warning">Danse</a>
         </div>
         <div class="row g-4 m-auto align-items-center">
            <?php for ($i=0; $i<6; $i++): ?>
               <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                  <a href="#">
                     <div class="card-new">
                        <div class="card-entete">
                           <div class="event" style="background-image: url('assets/images/events/credit-Charlyne-Azzalin4-compresse-298x346.jpg'); " width="100%">
                              <span class="entertainment">Catégorie</span>
                           </div>
                        </div>
                        <div class="card-n-body">
                           <div class="title"> Titre </div>
                           <div class="details">
                              <span class="">
                                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/46557/Time.svg" />
                                 <div class="date">19 Septembre 2024 - 10h00  </div>
                              </span>
                              <span>
                                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/46557/Pin.svg" />
                                 <div class="location">Le Puy-en-velay</div>
                              </span>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            <?php endfor; ?>
         </div>
      </div>
      
      <div>
         <h2>Musique</h2>
         <h2>Théatre</h2>
         <h2>Danse</h2>
      </div>
      <div>
         <?php
            for ($i=0; $i<6; $i++){
            ?>
         <div>
            <p>Date</p>
            <h3>Titre</h3>
            <div>
               <p>00H00</p>
               <h4>Adresse</h4>
            </div>
         </div>
         <?php
            }
            ?>
      </div>
      <?php 
         include("footer.html");
         ?>
   </body>
</html>