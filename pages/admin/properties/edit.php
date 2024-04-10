<?php
    $title = "Modifier une propriété";
    require "../../partials/header.php";
    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    require "../../components/navbar_admin.php";
    require "../../../database/connexion.php";
    require "../../../database/Property.php";
    require "../../../database/Option.php";
    require "../../../database/PropertyType.php";

    $pdo = Database::dbConnection();
    $property = new Property($pdo);
    $id = intval(htmlentities($_GET["id"]));
    $pro = json_decode($property->findById($id)["property"], true);
    
    $option = new Option($pdo);
    $propertyType = new PropertyType($pdo);
    $options = $option->findAll();
    $propertyTypes = $propertyType->findAll();
?>

<main class="container p-4">
    <h1>Modifier la propriété &#34;<?=$pro["title"]?>&#34;</h1>

    <form action="pages/admin/properties/update.php" method="POST">
        <div class="row">
            <div class="col">
                <?php $value=$pro["title"]; $name="name"; $label="Titre du bien"; require "../../components/input.php"?>
                <?php $value=$pro["price"]; $name="price"; $label="Prix";  $type="number"; require "../../components/Input.php"?>
                <?php $value=$pro["rooms"]; $name="rooms"; $label="Nombre de pièces";  $type="number"; require "../../components/Input.php"?>
                <?php $value=$pro["floor"]; $name="floor"; $label="Etage";  $type="number"; require "../../components/Input.php"?>
                <?php $value=$pro["bedrooms"]; $name="bedrooms"; $label="Nombre de chambres";  $type="number"; require "../../components/Input.php"?>
                <?php $value=$pro["bathrooms"]; $name="bathrooms"; $label="Nombre de salles de bains";  $type="number"; require "../../components/Input.php"?>
                <?php $name="images[]"; $type="file";  $multiple=true; $label="images (Ajouter de nouvelles images supprimera les anciennes!)"; $notrequired = true; require "../../components/Input.php"?>
                <?php $value=$pro["surface"]; $name="surface"; $type="number"; $label="Surface"; require "../../components/Input.php"?>

            </div>
            <div class="col">
                <?php $value=$pro["address"]["number"]; $name="number"; $type="number"; $label="Numero"; require "../../components/Input.php"?>
                <?php $value=$pro["address"]["street"]; $name="street"; $type="text"; $label="Rue"; require "../../components/Input.php"?>
                <?php $value=$pro["address"]["city"]; $name="city"; $type="text"; $label="Ville"; require "../../components/Input.php"?>
                <?php $value=$pro["address"]["zipcode"]; $name="zipcode"; $type="text"; $label="Code postal"; require "../../components/Input.php"?>
                <?php $value=$pro["description"]; $name="description"; $type="textarea"; $label="Description"; require "../../components/Input.php"?>
                <?php $name="type"; $multiple=false; $label="Type de bien"; $value=$propertyTypes; require "../../components/Select.php"?>
                <?php $name="options[]"; $multiple=true; $label="Options (Laisser en blanc si aucune modification)"; $value=$options; $notrequired = true; require "../../components/Select.php"?>

            </div>
        </div>
        <?php $value=$pro["id"]; $name="property_id"; $type="hidden"; $label=""; require "../../components/input.php"?>
        <button class="btn btn-success">Modifier</button>
    </form>
</main>



<?php
    require "../../partials/footer.php";
?>