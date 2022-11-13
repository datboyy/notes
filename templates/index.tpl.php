<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="tags-cloud">
        <h2>Nuage de tags</h2>
        <div class="tags">
          <span class="tag"><a href="#">Général</a></span>
          <span class="tag"><a href="#">Base de données</a></span>
          <span class="tag"><a href="#">CSS</a></span>
          <span class="tag"><a href="#">HTML</a></span>
          <span class="tag"><a href="#">Méthodologie</a></span>
          <span class="tag"><a href="#">Article</a></span>
          <span class="tag"><a href="#">Trucs et astuces</a></span>
        </div>
      </div> <!-- /.tags-cloud -->
    </div> <!-- /.sidebar -->
    <!-- Header links -->
    <div class="head-links">
      <a href="admin/">Editeur</a>
    </div> <!-- /.header links -->
    <?php require('templates/profile.tpl.php'); ?>
    <div class="container">
      <h1>Notes</h1>
      <div class="text-container">
        <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis, tellus magna accumsan felis,
          et porta diam erat non ipsum. Integer eros libero, tristique sed sodales eu, luctus id sem.
        </p>
        <ul class="notes-list">
          <?php
          foreach($templateVars['notes_list'] as $note)
          {
          ?>
            <li>
              <a href="?id=<?= (int) $note['id']?>">
                <?= htmlspecialchars($note['title']) ?>
              </a>
            </li>
          <?php
          }
          ?>
          <li>
            <a href="#">Trucs et astuces divers</a>
            <span class="tag">
              <a href="#">Général</a>
            </span>
          </li>
        </ul>
      </div> <!-- /.text-container -->
    </div> <!-- /.container -->
    <p class="btm-note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis,
      tellus magna accumsan felis, et porta diam erat non ipsum. Integer eros libero.</p>
  </body>
</html>