<?php
   require'../Utils/connexion.php';
   $pseudos=$passe=null;
   $test=false;
function isPseudos($pseudos){
    global $conn;
    $query=$conn->prepare("SELECT COUNT(*) FROM utilsateur WHERE pseudos=?");
    $query->execute([$pseudos]);
    $result=$query->fetch()[0];
    return $result;
}

   if($_SERVER["REQUEST_METHOD"]==="POST"){
      $pseudos=$_POST["pseudos"];
      $passe=$_POST["passe"];
      $test=true;
      if(isPseudos($pseudos)){
        $test=false;
    }
    if(empty($pseudos) && empty($passe)){
        $test=false;
    }
    if($test){
        global $conn;
        // $hashedPassword = password_hash($passe,PASSWORD_DEFAULT);
        $query=$conn->prepare("INSERT INTO utilsateur(pseudos,passe,role) VALUES (:pseudos,:passe,'client')");
        $query->execute([
        "pseudos"=>$pseudos,
        "passe"=>$passe
        ]);
        session_start();
        $_SESSION["user"]=1;
        header("Location: ../index.php");
      }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inscription</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/pricing.css" rel="stylesheet">
    <script>
        function validateForm() {
            var name = document.getElementById('inputEmail').value;
            var solution = document.getElementById('inputPassword').value;

            if (name == "" || solution == "") {
                alert("Veuillez remplir tous les champs.");
            }
        }
    </script>
<style>
   /* body{
            display: grid;
            align-items: center;
            justify-content: center;
        } */
  h1{
    border-bottom: 2px solid black;
  }
  form{
    text-align: center;
    margin-top: 50px;
    height: 50%;
    width: 40%;
    margin-left: 35%;
    display: grid;
    border-radius: 5px;
    padding: 10px;
    color:black;
    background-color:white;
  }
  input{
    border: 2px solid gray;border: 2px solid gray;
    width: 100%;
    border-radius: 5px 0px;
    height: 40px;
    margin-bottom: 5px;
    padding: 5px;
    font-weight: bold;
    color: saddlebrown;
}
</style>
  </head>
  <body>
    <header>
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
          <h5 class="my-0 text-light mr-md-auto font-weight-normal">Devinettes</h5>
          <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-4 text-light" href="../index.php">Accueil</a>
            <a class="p-4 text-light" href="client/check.php">Contact</a>
            <a class="btn btn-success" href="sign.php">Connexion</a>
          </nav>
      </div>
    </header>
    <?php if(isPseudos($pseudos)):?>
        <div class="container alert alert-danger text-center">
              Ce Pseudos n' est plus disponible
        </div>
    <?php endif?>
    <form class="form-signin" method="post" onsubmit="validateForm()">
      <h1 class="h3 mb-3 font-weight-bold">Inscription</h1>
      <label for="inputEmail" class="sr-only">Pseudos*</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Pseudos" name="pseudos" autofocus>
      <label for="inputPassword" class="sr-only">Password*</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" name="passe" >
      <button class="btn btn-outline-primary font-weight-bold w-100 h-50" type="submit">S'inscrire</button>
    </form>
  </body>
</html>
