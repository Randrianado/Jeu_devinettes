<?php
  require_once '../../Utils/connexion.php';
  session_start();
  $nom=$prenom=$email=$commentaire=null;
  $test=false;
  if($_SERVER["REQUEST_METHOD"]==="POST"){
    $nom=$_POST["nom"];
    $email=$_POST["email"];
    $prenom=$_POST["prenom"];
    $commentaire=$_POST["commentaire"];
    $test=true;
    if(empty($name) && empty($email) && empty($prenom) && empty($commentaire)){
      $test=false;
    }
    if($test){
      global $conn;
      $host=$conn->prepare("INSERT INTO commentaires(nom,prenom,email,commentaires) VALUES (:nom,:prenom,:email,:commentaires)");
      $host->execute([
        "nom"=>$nom,
        "prenom"=>$prenom,
        "email"=>$email,
        "commentaires"=>$commentaire
      ]);
      $nom=$prenom=$commentaire=$email=null;
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/form-validation.css" rel="stylesheet">
    <link href="../../assets/css/pricing.css" rel="stylesheet">
    <script>
        function validateForm() {
            var nom = document.getElementById('username').value;
            var prenom = document.getElementById('firstName').value;
            var email = document.getElementById('email').value;
            var comm = document.getElementById('commentaire').value;

            if (nom == "" || prenom == "" || email == "" || comm == "") {
                alert("Veuillez remplir tous les champs.");
            }
        }
    </script>
  </head>

  <body>
    <?php if($test):?>
      <script>
        setInterval(()=>{
          <div class="container text-center alert alert-success">
            Commentaire envoyé
          </div>
        },3000)
      </script>
    <?php endif ?>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
        <h5 class="text-light my-0 mr-md-auto font-weight-normal">Devinettes</h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-4 text-light" href="../../index.php">Accueil</a>
          <a class="p-4 text-light" href="#">Contact</a>
          <?php if(!$_SESSION['user']):?>
            <a class="btn btn-primary" href="../sign.php">Connexion</a>
          <?php else: ?>
            <a class="btn btn-danger" href="../../Utils/dec.php">Deconnexion</a>
          <?php endif ?>
        </nav>
    </div>
    <div class="container text-light">
      <div class="py-5 text-center">
        <h2>Formulaires de Contact</h2>
      </div>

      <div class="row cent">
        <div class="col-md-4 order-md-2 mb-4">
        </div>
        <div class="col-md-8 order-md-1">
          <form class="needs-validation" method="post" onsubmit="validateForm()">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName" class="text-weight-bold">Prenom*</label>
                <input type="text" class="form-control" name="prenom" id="firstName" placeholder="" value="<?=$prenom?>" >
              </div>
              <div class="mb-3">
              <label for="username" class="text-weight-bold">Nom</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" name="nom" id="username" placeholder="Username" value="<?=$nom?>">
              </div>
            </div>
            </div>

            <div class="mb-3">
              <label for="email" class="text-weight-bold">Email*</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?=$email?>">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="commentaire" class="text-weight-bold">Commentaires*</label>
              <textarea type="text" class="form form-control" id="commentaire" name="commentaire" placeholder="......." value="<?=$commentaire?>"></textarea>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block w-100 text-weight-bold" type="submit">Envoyer le commentaire</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
