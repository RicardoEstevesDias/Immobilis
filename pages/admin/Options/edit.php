<?php 
    $title = "Modifier une option";
    require "../../partials/header.php";
    if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
        header("Location: /immobilis/pages/admin/login.php");
    }
    require "../../components/navbar_admin.php";
    require "../../../database/connexion.php";
    require "../../../database/Option.php";

    $pdo = Database::dbConnection();
    $Option = new Option($pdo);
    $id = intval(htmlentities($_GET["id"]));
    $o = $Option->findById($id);
?>


<main class="container p-4">
    <h1>Modifier l'option &#34;<?=$o["name"]?>&#34;</h1>

    <form action="pages/admin/Options/update.php" method="POST">
        <?php $value=$o["name"]; $name="name"; $label="Nom de l'option du bien"; require "../../components/input.php"?>
        <?php $value=$o["id"]; $name="id"; $type="hidden"; $label=""; require "../../components/input.php"?>
        <button class="btn btn-success">Modifier</button>
    </form>
</main>

<?php
    require "../../partials/footer.php";
?>