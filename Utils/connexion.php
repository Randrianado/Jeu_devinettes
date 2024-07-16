<?php
    try {
        $conn=new PDO("mysql:dbname=Devi_db;host=localhost","root","");
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
?>