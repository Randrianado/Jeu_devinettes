<?php
    require '../../Utils/connexion.php';
    function supprimer(){
        global $conn;
        $id=(int)$_GET['id'];
        $host=$conn->prepare("DELETE FROM devinettes WHERE id=?");
        $host->execute([$id]);
    }
    supprimer();
    header("Location:dash.php");
?>