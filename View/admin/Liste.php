<?php
    require'../../Utils/auth.php';
    require '../../Utils/connexion.php';
    function recherche(){
      global $conn;
      extract($_POST);
      $host=$conn->prepare("SELECT * FROM utilsateur WHERE pseudos LIKE :pseudos");
      $host->execute([
          "pseudos"=>"%".$search."%"
      ]);
      $result=$host->fetchAll();
      return $result;
  }
      $host=$conn->query("SELECT * FROM utilsateur");
  if(!empty($_POST)){
      $result=recherche();
  }
  else{
    $result=$host->fetchAll();
  }
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
                  <th>Role</th>
                  <th>Supprimer</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $results):?>
                  <tr>
                    <td><?php echo $results["id"]?></td>
                    <td><?php echo $results["pseudos"]?></td>
                    <td><?php echo $results["role"]?></td>
                    <td>
                      <a onclick="confirmDeletion(event,'supp.php?id=<?=$results['id']?>')" class="al btn btn-danger">Supprimer</a>
                    </td>
                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
            <?php if(!$result):?>
                  <p class="text-danger">Aucun resultat pour cette recherche</p>
            <?php endif?>
          </div>
        </main>
        
  </body>
</html>
