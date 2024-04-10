<?php 
session_start();
if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
    header("Location: /immobilis/pages/admin/login.php");
}
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: /immobilis/pages/admin/login.php");
};

if(!empty($_POST) && isset($_POST["id"])){
    $id = intval(htmlentities($_POST["id"]));
    require "../../../database/connexion.php";
    require "../../../database/Contact.php";

    $pdo = Database::dbConnection();
    $Contact = new Contact($pdo);

    $result = $Contact->deleteById($id);
    
    if($result){
        $_SESSION["success"] = "Le contact à été supprimé";
    }
    else{
        $_SESSION["error"] = "Erreur lors de la suppresion";
    }
    header("Location: /immobilis/pages/admin/contact/index.php");
}
?>
