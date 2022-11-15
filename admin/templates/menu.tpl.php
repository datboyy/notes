<!-- Header links -->
<div class="head-links">
  <?php
  if(isset($_GET['id']))
  {
  ?>
    <a href="index.php">Annuler les modifications</a>
  <?php
  }
  ?>
  <a href="../index.php">Accueil</a>

</div> <!-- /.head-links -->
<div class="admin-head-menu">
  <ul>
    <li>
      <a href="index.php" class="<?= MODULE == 'notes' ? 'active':'' ?>">Notes</a></li>
    <li>
      <a href="cheatsheets.php" class="<?= MODULE == 'cheatsheet' ? 'active':'' ?>">Cheatsheets</a>
    </li>
  </ul>
</div> <!-- /admin-head-menu -->
