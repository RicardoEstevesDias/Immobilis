<?php 
    session_start();
    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        header("Location: /immobilis/pages/admin/login.php");
    };
    if(!empty($_POST) && isset($_POST["name"])){
        require "../../../database/connexion.php";
        require "../../../database/Option.php";
        $pdo = Database::dbConnection();
        $Options = new Option($pdo);
        $name = htmlentities($_POST["name"]);
        $result = $Options->store($name);
        if($result) {
            $_SESSION["success"] = "L'option du bien à été ajouté";
        }
        else{
            $_SESSION["error"] = "Erreur lors de l'ajout";
        }
        header("Location: /immobilis/pages/admin/Options/create.php");
    }
?>