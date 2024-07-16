<?php
    require '../../Utils/connexion.php';
    $name=$solution=null;
    $test=false;
    $id=$_GET["id"];
    function ajout($name,$solution,$id){
        global $conn;
        $host=$conn->prepare("UPDATE devinettes SET name = :name, solution= :solution WHERE id = :id");
        $host->execute([
            "name"=>$name,
            "solution"=>$solution,
            "id"=>$id
        ]);
    }
    function Mod($id){
        global $conn;
        $host=$conn->prepare("SELECT * FROM devinettes WHERE id=?");
        $host->execute([$id]);
        $result=$host->fetch();
        return $result;
    }
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $name=$_POST["name"];
        $solution=$_POST["solution"];
        $test=true;
        if(empty($name) && empty($solution)){
            $test=false;
        }
        if($test){
            ajout($name,$solution,$id);
            header("Location:dash.php");
        }else{
            $test=false;
        }
    }
    $result=Mod($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Modification</title>
    <style>
        body{
            display: grid;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        form{
            height: 100%;
            box-shadow:10px 10px 10px 10px gray;
            width: 100%;
            display: grid;
            border-radius: 5px;
            padding: 10px;
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
        label{
            font-weight: bold;
            font-style: italic;
        }
        h3{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-style: italic;
            color: saddlebrown;
            text-decoration: underline;
            text-decoration-line: underline;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="container">
    <?php if(!$test):?>
        <div class="alert alert-danger text-center font-weight-bold">
            Erreur lors de la modification
        </div>
    <?php else: ?>
        <div class="alert alert-success text-center">
            Modification réussi
        </div>
    <?php endif?>
    <form method="post" class="form-signin">
        <h3 class=" font-weight-bold text-center mb-3">Modification d'un devinette</h3>
        <label for="name">Nom du devinettes*</label>
        <input type="text" name="name" id="name" value="<?=$result["name"]?>" class="mb-3">
        <label for="solution">Reponses</label>
        <input type="text" name="solution" value="<?=$result["solution"]?>" id="solution" class="mb-3">
        <button type="submit" class="btn btn-outline-success w-100">Modifier</button>
    </form>
</body>
</html>