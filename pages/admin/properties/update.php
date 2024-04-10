<?php
session_start();
if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
    header("Location: /immobilis/pages/admin/login.php");
}
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: /immobilis/pages/admin/login.php");
};

var_dump($_POST);
die;

if(!empty($_POST)/* && 
isset($_POST["id"]) &&
isset($_POST["name"]) &&
isset($_POST["price"]) &&
isset($_POST["rooms"]) &&
isset($_POST["floor"]) &&
isset($_POST["bedrooms"]) &&
isset($_POST["bathrooms"]) &&
isset($_POST["surface"]) &&
isset($_POST["description"]) &&
isset($_POST["type"]) &&
isset($_POST["number"]) &&
isset($_POST["city"]) &&
isset($_POST["street"]) &&
isset($_POST["zipcode"])*/)
{
    $id = intval(htmlentities($_POST["property_id"]));
    $title = htmlentities($_POST["name"]);
    $price = htmlentities($_POST["price"]);
    $rooms = htmlentities($_POST["rooms"]);
    $floor = htmlentities($_POST["name"]);
    $bedrooms = htmlentities($_POST["bedrooms"]);
    $bathrooms = htmlentities($_POST["bathrooms"]);
    $surface = htmlentities($_POST["surface"]);
    $description = htmlentities($_POST["description"]);
    $type = htmlentities($_POST["type"]);
    $number = htmlentities($_POST["number"]);
    $city = htmlentities($_POST["city"]);
    $street = htmlentities($_POST["street"]);
    $zipcode = htmlentities($_POST["zipcode"]);
    $options = $_POST["options"];
    $images = $_POST["images"];
    

    require "../../../database/connexion.php";
    require "../../../database/Property.php";
    require  "../../../database/Address.php";
    require  "../../../database/PropertyOption.php";
     
    $pdo = Database::dbConnection();
    $Property = new Property($pdo);
    $address = new Address($pdo);
    $propertyOption = new PropertyOption($pdo);

    if ($options){
        $Property->deletePropertiesOptionsById($id);
        $optionsIds = [];
        foreach ($_POST["options"] as $o) {
            array_push($optionsIds, intval($o));
        }
        $propertyOption->store($id, $optionsIds);
    }

    if ($images) {

        $image_del = json_decode($Property->selectImages($id)["images"]);
        foreach ($image_del as $i) {
            unlink("../../../public/" . $i);
        }

        $fileNames = $_FILES["images"]["name"];
        $tmpNames = $_FILES["images"]["tmp_name"];
        $documentRoot = $_SERVER["DOCUMENT_ROOT"];
        for ($i = 0; $i < count($fileNames); $i++) {
            $fileName =  uniqid() . basename( $fileNames[$i] );
            $filePath = "storage/property/$fileName";
            array_push($images, $filePath);
            move_uploaded_file($tmpNames[$i], "$documentRoot/immobilis/public/$filePath");
        }
        $Property->updateImages($id, json_encode($images));

    }

    $address->update($id, $street, $city, $zipcode, $number);

    $result = $Property->update( $title,
                                    $price,
                                    $surface,
                                    $rooms,
                                    $floor,
                                    $bedrooms,
                                    $bathrooms,
                                    $description,
                                    $typeId,
                                    $addressId);
   
    if($result){
        $_SESSION["success"] = "La propriété à été mise à jour";
    }
    else{
        $_SESSION["error"] = "Erreur de la mise à jour";
    }
    header("Location: /immobilis/pages/admin/properties/index.php");
}
?>