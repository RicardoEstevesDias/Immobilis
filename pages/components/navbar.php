
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Immobilis</a>
    <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"] === true): ?>
      <a class="nav-link text-primary" href="pages/admin/dashboard.php">Dashboard</a>
    <?php else: ?>
      <a class="nav-link text-primary" href="pages/admin/login.php">Administration</a>
    <?php endif; ?>

  </div>
</nav>
