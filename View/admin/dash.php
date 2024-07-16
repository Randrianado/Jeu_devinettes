<?php
    require'../../Utils/auth.php';
    require '../../Utils/connexion.php';
    //Pagination
      $resultat=3;
      $page=isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    //Comptage isanle zavatra ao anaty bd
      $query=$conn->prepare("SELECT COUNT(*) FROM devinettes");
      $query->execute();
      $res1=$query->fetchColumn();

    //calcul offset
      $offset=($page - 1) * $resultat;
    //affiche les données
      $host=$conn->prepare("SELECT * FROM devinettes LIMIT :limit OFFSET :offset");
      $host->bindValue(':limit',$resultat,PDO::PARAM_INT);
      $host->bindValue(':offset',$offset,PDO::PARAM_INT);
      $host->execute();


      $totalPages=ceil($res1/$resultat);

    function recherche(){
      global $conn;
      extract($_POST);
      $host=$conn->prepare("SELECT * FROM devinettes WHERE id LIKE :id");
      $host->execute([
          "id"=>"%".$search."%"
      ]);
      $result=$host->fetchAll();
      return $result;
  }
  function AfficheNom($nom){
      global $conn;
      $host=$conn->prepare("SELECT pseudos FROM utilsateur WHERE pseudos=:pseudos");
      $host->execute([
            "pseudos"=>$nom
        ]);
        $result=$host->fetch();
        return $result;
  }
  if(!empty($_POST)){
      $result=recherche();
  }
  else{
    $result=$host->fetchAll();
  }
    $nom=AfficheNom($_GET["pseudos"]);
    fore();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/dashboard.css" rel="stylesheet">
    <style>
      .al{
        text-decoration: none;
        color:white;
        font-weight: bold;
      }
    </style>
    <script>
        function confirmDeletion(event,url){
            event.preventDefault();
            if (confirm("Voulez-vous vraiment supprimer cet article ?")) {
                window.location.href = url;
            }
        }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Dashboard</a>
      <form class="form-inline mt-2 mt-md-0 w-100" method="post">
        <input class="form-control ml-4 mr-sm-2 w-50" type="text" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="btn btn-primary" href="ajouter.php">Ajouter<span aria-hidden="true" class="font-52">&CirclePlus;</span></a>
          <a class="btn btn-success" href="../../Utils/SignOut.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <main role="main" class="container text-center mt-5">
          <h2>Listes des devinettes</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Nom</th>
                  <th>Reponses</th>
                  <th>Modifier</th>
                  <th>Supprimer</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $results):?>
                  <tr>
                    <td><?php echo $results["id"]?></td>
                    <td><?php echo $results["name"]?></td>
                    <td><?php echo $results["solution"]?></td>
                    <td><button class="btn btn-primary" ><a href="modifier.php?id=<?=$results["id"]?>" class="al">Modifier</a></button></td>
                    <td>
                      <a onclick="confirmDeletion(event,'supp.php?id=<?=$results['id']?>')" class="al btn btn-danger">Supprimer</a>
                    </td>
                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
            <?php if(!$result):?>
                  <p class="text-danger">Aucun resultat pour cette recherche</p>
            <?php else:?>
                    <div class="container text-center">
                          <ul class="pagination">
                            <?php for ($i=1; $i <=$totalPages ; $i++):?>
                              <li class="page-item">
                                  <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                              </li> 
                            <?php endfor?>
                          </ul> 
                    </div>
            <?php endif?>
          </div>
        </main>
        
  </body>
</html>
