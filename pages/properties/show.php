<?php
$title = "Voir le bien";
require "../partials/header.php";
require "../components/navbar.php";

if(!empty($_GET) && isset($_GET["id"]))
    require "../../database/connexion.php";
    require "../../database/Property.php";

    $id = intval($_GET["id"]);
    $pdo = Database::dbConnection();
    $property = new Property($pdo);
    $p = json_decode($property->findById($id)["property"], true);
?>
<section>
  
<div class="container">
    <h1 class="text-center"><?=$p["title"]?></h1>
    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <?php foreach ($p['images'] as $index=>$image) :?>
        <div class="carousel-item <?=$index === 0 ? 'active' : ''?>">
            <img src="public/<?=$image?>" class="d-block w-100" alt="...">
        </div>
    <?php endforeach ;?>
   

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</section>
   
  <section>
    <h3>Informations</h3>
    <p>Prix: <?= $p["price"]?>€</p>
    <p>Type de bien: <?= $p["type"]?></p>
    <p>addresse: <?= $p["address"]["number"]?>, <?= $p["address"]["street"]?>, <?= $p["address"]["city"]?>, <?= $p["address"]["zipcode"]?></p>
    <p>Description: <?= $p["description"]?></p>
  </section>

  <section>
    <h3>Informations complementaires</h3>

    <?php if (isset($p["options"])):?>
        <p>Options:</p>
        <ul class="list-group">
            <?php foreach ($p["options"] as $opt):?>
                <li class="list-group-item"><?= $opt?></li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>

    <p>Surface: <?=$p["surface"]?></p>
    <p>Nombre de pièces: <?=$p["rooms"]?></p>
    <p>étage: <?=$p["floor"]?></p>
    <p>Nombre de chambres: <?=$p["bedrooms"]?></p>
    <p>Nombre de salles de bain: <?=$p["bathrooms"]?></p>
  </section>


<?php if(!(isset($_SESSION["connected"]) && $_SESSION["connected"] === true)): ?>
  <section>
    <h3 class="text-center">Nous contacter pour ce bien</h3>

    <form action="pages/properties/contact.php" method="post" class="w-50 mx-auto">
        <input type="hidden" name="property_id" value="<?=$p["id"]?>">
        <?php $label="Prénom"; $name="firstname";require "../components/Input.php"?>
        <?php $label="Nom"; $name="lastname";require "../components/Input.php"?>
        <?php $label="Email"; $name="email"; $type="email";require "../components/Input.php"?>
        <?php $label="Votre message"; $name="message"; $type="textarea"; require "../components/Input.php"?>
        <button class="btn btn-outline-primary">Envoyer</button>
    </form>
  </section>
<?php endif; ?>


</div>
</div>