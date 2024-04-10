<?php 
$title = "Demandes de contact";
require "../../partials/header.php";
if($_SESSION["connected"] !== true || !isset($_SESSION["connected"])){
    header("Location: /immobilis/pages/admin/login.php");
}
require "../../components/navbar_admin.php";
require "../../../database/connexion.php";
require "../../../database/Contact.php";
$pdo = Database::dbConnection();
$contact = new Contact($pdo);
$contacts = $contact->findAll();
?>
<?php require "../../components/flash.php";?>
<br>
<h1 class="text-center">Demandes de contact</h1>
<br>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contacts as $c):?>
        <tr>
            <th scope="row"><?= $c["firstname"]?></th>
            <td><?= $c["lastname"]?></td>
            <td><?= $c["email"]?></td>
            <td><?= $c["message"]?></td>
            <td><a href="pages/properties/show.php?id=<?=$c["properties_id"]?>" class="btn btn-outline-success mb-1">Voir le bien</a>
                </br>
                <form action="pages/admin/contact/destroy.php" method="post">
                  <input type="hidden" value="<?=$c["id"]?>" name="id">
                  <button class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>

<?php
    require "../../partials/footer.php";
?>
