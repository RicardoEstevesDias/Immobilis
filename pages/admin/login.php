<?php
    $title = "Connexion Admin";
    require "../partials/header.php";
    require "../components/navbar.php"
?>

<div class="container">
    <?php require "../components/flash.php"?>
    <h1 class="text-center">Connexion Admin</h1>
    
    <form action="pages/admin/dologin.php" method="post">
        <?php $type="email"; $label="E-mail"; $name="email"; require "../components/input.php";
        $type="password"; $label="Mot-de-passe"; $name="password"; require "../components/input.php"; ?>
        <button type="submit" class="mt-2 btn btn-info">Connexion</button>
    </form>
</div>

<?php
    require "../partials/footer.php";
?>