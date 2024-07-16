<?php
        function Connected():bool{
            if(session_status()==PHP_SESSION_NONE){
                session_start();
            }
            return !empty($_SESSION["administrateur"]);
        }
        function fore(){
            if(!Connected()){
                header('Location:../index.php');
                exit();
            }
        }
?>