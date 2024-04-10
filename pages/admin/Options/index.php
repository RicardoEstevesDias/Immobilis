<?php 
    $title = "Liste des options de bien";
    require "../../partials/header.php";
    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    require "../../components/navbar_admin.php";
    require "../../../database/connexion.php";
    require "../../../database/Option.php";
    $pdo = Database::dbConnection();
    $Option = new Option($pdo);
    $Options = $Option->findAll();
?>

<main class="container p-4">
    <h1 class="text-center">Listing des options de bien</h1>
    <?php require "../../components/flash.php";?>
        <table class="table">
            <thead>
                <tr>
                    <th>Option du bien</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Options as $o):?>
                    <tr>
                        <td><?= $o["name"]?></td>
                        <td>
                            <a href="pages/admin/Options/edit.php?id=<?=$o["id"]?>" class="nav-link text-info">Modifier</a>
                            <form action="pages/admin/Options/destroy.php" method="post">
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