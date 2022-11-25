<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
  </head>
  <body>
    <div class="container-flex">
      <!-- Sidebar -->
      <div class="sidebar">
        <?php require('templates/profile.tpl.php'); ?>
        <div class="tags-cloud">
          <h2>Nuage de tags</h2>
          <div class="tags">
            <?php
            foreach($templateVars['tags_list'] as $tag)
            {
              $activeClass = !empty($_GET['tag']) && $_GET['tag'] == $tag ? 'active':'';
            ?>
              <span class="tag <?= $activeClass ?>"><a href="?tag=<?= htmlspecialchars($tag) ?>"><?= htmlspecialchars($tag) ?></a></span>
            <?php
            }
            ?>
          </div>
        </div> <!-- /.tags-cloud -->
      </div> <!-- /.sidebar -->
      <div class="container-flex-column w-50">
        <!-- Header links -->
        <div class="head-links">
          <?php
          if(isset($_GET['tag']))
          {
          ?>
            <a href="index.php">Précédent</a>
          <?php
          }
          ?>
          <a href="admin/">Editeur</a>
        </div> <!-- /.header links -->
        <div class="container">
          <h1>Notes</h1>
          <div class="container__text-container">
            <p class="text-secondary">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis.
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
                  <?php
                  foreach($note['tags'] as $k => $tag)
                  {
                    ?>
                        <span class="tag">
                          <a href="?tag=<?= htmlspecialchars(ucfirst($tag)) ?>"><?= htmlspecialchars(ucfirst($tag)) ?></a>
                        </span>
                    <?php
                  }
                  ?>
                </li>
                <?php
              }
              ?>
            </ul>
          </div> <!-- /.text-container -->
        </div> <!-- /.container -->
        <p class="btm-note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis,
          tellus magna accumsan felis, et porta diam erat non ipsum. Integer eros libero.</p>
      </div> <!-- /.container-flex-column -->
    </div> <!-- ./container-flex -->
  </body>
</html>
