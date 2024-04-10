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
    require "../../../database/Property.php";

    $pdo = Database::dbConnection();
    $Property = new Property($pdo);

    // Suppresion images 
    $images = json_decode($Property->selectImages($id)["images"]);
    foreach ($images as $i) {
        unlink("../../../public/" . $i);
    }
    $options_result = $Property->deletePropertiesOptionsById($id);
    $property_address_result = $Property->deletePropertyAndAddressById($id);

    if($options_result && $property_address_result){
        $_SESSION["success"] = "La propriété à été supprimé";
    }
    else{
        $_SESSION["error"] = "Erreur lors de la suppresion";
    }
    header("Location: /immobilis/pages/admin/properties/index.php");
    
}
?>
