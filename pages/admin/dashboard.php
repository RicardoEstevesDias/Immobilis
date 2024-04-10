<?php
    $title = "Tableau de bord";
    require "../partials/header.php";

    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    require "../components/navbar_admin.php";
?>

<div class="container">
    <?php require "../components/flash.php";?>
    <h1>Tableau de bord</h1>
    <div class="row gap-2 mb-2">
        <div class="col card">
            <div class="card-header">Bien immobilier</div>
            <div class="card-body">
                <img style="width: 100%" src="public/assets/biens_immo.jpg" alt="">
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="pages/admin/properties/create.php">Ajouter un bien</a>
                <a class="btn btn-info" href="pages/admin/properties/index.php">Voir les biens</a>
            </div>
        </div>

        <div class="col card">
            <div class="card-header">Type de bien immobilier</div>
            <div class="card-body">
                <img style="width: 100%" src="public/assets/type_immo.jpg" alt="">
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="pages/admin/propertyType/create.php">Ajouter un type</a>
                <a class="btn btn-info" href="pages/admin/propertyType/index.php">Voir les types</a>
            </div>
        </div>
    </div>

    <div class="row gap-2 mb-2">
        <div class="col card">
            <div class="card-header">Options immobilier</div>
            <div class="card-body">
                <img style="width: 100%" src="public/assets/option_immo.jpg" alt="">
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="pages/admin/Options/create.php">Ajouter un option</a>
                <a class="btn btn-info" href="pages/admin/Options/index.php">Voir les options</a>
            </div>
        </div>

        <div class="col card">
            <div class="card-header">Demande de contact</div>
            <div class="card-body">
                <img style="width: 100%; height: 400px" src="public/assets/contact.jpg" alt="">
            </div>
            <div class="card-footer">
                <a class="btn btn-info" href="pages/admin/contact/index.php">Voir les messages</a>
            </div>
        </div>
    </div>
</div>

<?php
    //require "../partials/footer.php"
?>