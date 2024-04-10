<?php 
    $title = "Liste des propriétés";
    require "../../partials/header.php";
    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    require "../../components/navbar_admin.php";
    require "../../../database/connexion.php";
    require "../../../database/Property.php";
    $pdo = Database::dbConnection();
    $Property = new Property($pdo);
    $Properties = $Property->findAll();
?>

<main class="container p-4">
    <h1 class="text-center">Listing des propriétés</h1>
    <?php require "../../components/flash.php";?>
    <table class="table">
        <thead>
            <tr>
                <th>Biens</th>
                <th>Détails</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Properties as $o):?>
                <tr>
                    <td>
                        <div>
                            <?= $o["title"]."</br>"?>
                            <img src="<?='public/'.json_decode($o["images"])[0]?>" alt="img" height="200px">
                        </div>
                    </td>
                    <td>
                        <?= "Prix: ".$o["price"]." €</br>"?>
                        <?= "Surface(m²): ".$o["surface"]."</br>"?>
                        <?= "Piéces: ".$o["rooms"]?>
                    </td>
                    <td>
                        <a href="pages/admin/properties/edit.php?id=<?=$o["id"]?>" class="nav-link text-info">Modifier</a>
                        <form action="pages/admin/properties/destroy.php" method="post">
                            <input type="hidden" value="<?=$o["id"]?>" name="id" autofocus>
                            <button class="nav-link text-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>

<?php
    require "../../partials/footer.php";
?>
