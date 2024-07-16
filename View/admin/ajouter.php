<?php
    require '../../Utils/connexion.php';
    $name=$solution=null;
    $test=false;
    function isNom($name){
        global $conn;
        $host=$conn->prepare("SELECT COUNT(*) FROM devinettes WHERE name=?");
        $host->execute([$name]);
        $result=$host->fetch()[0];
        return $result;
    }
    function ajout($name,$solution){
        global $conn;
        $host=$conn->prepare("INSERT INTO devinettes(name,solution) VALUES (:name,:solution)");
        $host->execute([
            "name"=>$name,
            "solution"=>$solution
        ]);
    }
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $name=$_POST["name"];
        $solution=$_POST["solution"];
        $test=true;
        if(isNom($name)){
            $reponse="Ce devinette est deja ajouté!";
            $test=false;
        }
        if(empty($name) && empty($solution)){
            $test=false;
        }
        if($test){
            ajout($name,$solution);
            header("Location:dash.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Ajout</title>
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
    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var solution = document.getElementById('solution').value;

            if (name == "" || solution == "") {
                alert("Veuillez remplir tous les champs.");
            }
        }
    </script>
</head>
<body class="container">
    <div class="container alert alert-danger text-center">
        <?=$reponse?>
    </div>
    <form method="post" class="form-signin" onsubmit="validateForm()">
        <h3 class=" font-weight-bold text-center mb-3">Ajout d'un devinette</h3>
        <label for="name">Nom du devinettes*</label>
        <input type="text" name="name" id="name" value="<?=$name?>" class="mb-3">
        <label for="solution">Reponses</label>
        <input type="text" name="solution" value="<?=$solution?>" id="solution" class="mb-3">
        <button type="submit" class="btn btn-outline-primary w-100">Ajouter</button>
    </form>
</body>
</html>
