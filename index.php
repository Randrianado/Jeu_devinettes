<?php
    require 'Utils/connexion.php';
      session_start();
    function search(){
      global $conn;
      extract($_POST);
      $query=$conn->prepare("SELECT * FROM devinettes WHERE id LIKE :id");
      $query->execute([
        "id"=>"%".$search."%"
      ]);
      $result=$query->fetchAll();
      return $result;
    }
      global $conn;
      $resultat=3;
      $host=$conn->prepare("select count(*) from devinettes");
      $host->execute();
      $total=$host->fetchColumn();
      $page=isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $offset=($page - 1) * $resultat;
      $sql="SELECT * FROM devinettes LIMIT :limit OFFSET :offset";
      $host=$conn->prepare($sql);
      $host->bindValue(':limit',$resultat,PDO::PARAM_INT);
      $host->bindValue(':offset',$offset,PDO::PARAM_INT);
      $host->execute();
      $total_pages=ceil($total/$resultat);
    if(!empty($_POST)){
      $results=search();
    }else{
      $results=$host->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/pricing.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/page.css">
    <style>
      .tery{
          display: none;
      }
  </style>
  </head>
<body class="text-center" >
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
      <h5 class="text-light my-0 mr-md-auto font-weight-normal">Devinettes</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-4 text-light" href="#">Accueil</a>
        <a class="p-4 text-light" href="View/client/check.php">Contact</a>
        <?php if(!$_SESSION['user']):?>
          <a class="btn btn-primary" href="View/sign.php">Connexion</a>
        <?php else: ?>
          <a class="btn btn-danger" href="Utils/dec.php">Deconnexion</a>
        <?php endif ?>
      </nav>
      <form class="form-inline mt-2 mt-md-0" method="post">
        <input class="form-control mr-sm-2" type="text" placeholder="Rechercher...." aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>
    </div>
    <main role="main">

        <section class="jumbotron text-center kk text-light">
          <div class="container">
            <h1 class="jumbotron-heading">Devinettes Niveau debutant</h1>
            <p class="lead text-light">Petit Jeu de Devinettes pour distraire les jeuunes</p>
            <p>
              <a href="?page=1" class="btn btn-primary my-2">Premier Contenu</a>
              <a href="?page=2" class="btn btn-secondary my-2">Deuxieme contenu</a>
            </p>
          </div>
        </section>
        <div class="album py-5 bg-light" id="mere">
          <div class="container">
            <div class="row">
            <?php foreach($results as $res):?>
                <div class="col-md-4">
                  <div class="card mb-4 box-shadow">
                    <div class="card-body">
                      <p class="jj">Devinettes <?php echo $res["id"]?></p>
                      <p class="card-text"><?php echo $res["name"]?>.Qui suis je?</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <?php if(!$_SESSION["user"]):?>
                          <div>
                            <p class="text-danger">Connectez-Vous pour Repondre aux devinettes</p></br>
                          </div>
                        <?php else:?>
                          <form action="" method="post">
                            <div class="btn-group">
                              <input type="text" id="inputEmail" class="form-control" name="reponse" placeholder="Repondre...." required>
                              <button type="submit" class="btn btn-primary hh  w-100">Repondre</button>
                            </div>
                          </form>
                        <?php endif?>
                     </div>
                    </div>
                  </div>
                </div>
                <?php if($_POST["reponse"]==$res["solution"]):?>
                  <div class="modal- text-center cent" tabindex="-1" id="hsd" > 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <h5 class="modal-title">Devinettes Card</h5> 
                                <button type="button" class="btn btn-secondary" id="bb" aria-hidden="true" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                            </div> 
                            <div class="modal-body text-center par"> 
                                <img alt="Sary" src="Images/sary3.gif" class="img-thumbnail h-3 kj">
                                <p class="jj">Vous avez Trouver la bonne Reponse</p> 
                            </div> 
                        </div> 
                    </div> 
                  </div>
                <?php endif?>
            <?php endforeach ?>
            <?php if(!$results):?>
                  <div class="text-center">
                    <p class="text-danger">Aucun resultat pour cette recherche</p>
                  </div>
            <?php else:?>
              <div class="container">
                <nav aria-label="..." class="Niv" > 
                    <ul class="pagination">
                      <?php for ($i=1; $i <=$total_pages ; $i++):?> 
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                        </li> 
                      <?php endfor ?>
                    </ul> 
                </nav>
              </div>
            <?php endif?>
            </div>
          </div>
        </div>
      </main>
      <script>
        const btn=document.querySelector('#bb');
        const par=document.querySelector('#hsd');
        btn.addEventListener('click',()=>{
            par.classList.add('tery');
        })
    </script>
</body>
</html>