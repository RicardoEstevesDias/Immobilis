<?php
    $title = "Immobilis votre agent immobilier";
    require "pages/partials/header.php";
    require "pages/components/navbar.php";
    require "database/connexion.php";
    require "database/Admin.php";
    $pdo = Database::dbConnection();
    $admin = new Admin($pdo);
    if(count($admin->getAdmins()) === 0){
        $admin->createAdmin();
        
    };
    ?>
<?php
    require "database/Property.php";
    $property = new Property($pdo);
    $properties = $property->findAll();
?>


<div class="container">
    <?php require "pages/components/flash.php";?>
    <h1 class="text-center">Nos biens immobiliers</h1>

    <div class="d-flex flex-wrap gap-5 justify-content-center my-5">
        <?php foreach ($properties as $p):?>
            <div class="card" style="width: 20rem">
                <img src="public/<?= json_decode($p['images'])[0]?>" alt="">
                <div class="card-body">
                    <h2><?= $p["title"]?></h2>
                    <span class="badge bg-secondary"><?= $p["price"]?>€</span>
                    <span class="badge bg-secondary"><?= $p["name"]?></span>
                    <span class="badge bg-secondary"><?= $p["city"]?></span>
                </div>
                <div class="card-footer">
                    <a href="pages/properties/show.php?id=<?=$p["id"]?>" class="btn btn-outline-success">Voir le bien</a>
                </div>
            </div>
        <?php endforeach;?>
    </div>

</div>

<?php
    require "./pages/partials/footer.php";
?>