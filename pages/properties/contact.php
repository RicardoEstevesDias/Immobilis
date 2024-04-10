<?php
session_start();
$method = $_SERVER["REQUEST_METHOD"];
if($method !== "POST"){
    header("Location: /immobilis/index.php");
}

if(!empty($_POST) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['message'])){
    require "../../database/Property.php";
    require "../../database/connexion.php";
    $pdo = Database::dbConnection();
    $property =new Property($pdo);

    $firstname = htmlentities($_POST['firstname']);
    $lastname = htmlentities($_POST['lastname']);
    $email = htmlentities($_POST['email']);
    $message = htmlentities($_POST['message']);
    $properties_id = intval($_POST['property_id']);

    $success = $property->contact($firstname, $lastname, $email, $message, $properties_id);

    if ($success) {
        $_SESSION["success"] = "Votre message a bien été pris en compte";
        ini_set("smtp_port", 1025);
        ini_set("sendmail_from", "immobilis@noreply.com");
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        mail($email, "Demande de contact", "<h1>Votre message a bien été pris en compte.</h1>");
    } else {
        $_SESSION["error"] ="Erreur lors de l'envoi de votre demande";
    }
    
    header("Location: /immobilis/index.php");
    session_destroy();
}
