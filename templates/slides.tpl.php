<!DOCTYPE html>
<html>
  <head>
    <script src="https://kit.fontawesome.com/bf84b6c6d8.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/main.css" />
    <script src="scripts/three_dots_menu.js"></script>

  </head>
  <body>
    <div class="slide-container">
      <div class="slide">
        <h1><?= $templateVars['slide']['title'] ?></h1>
        <div class="slide-content">
          <?= $templateVars['slide']['content']; ?>
        </div> <!-- /.slide-content -->
      </div> <!-- /.slide -->
      <div class="slide-bottom">
        <div class="tags">
          <?php
          foreach(explode(',', $templateVars['slide']['tags']) as $tag)
          {
          ?>
            <span class="tag"><?= ctype_upper($tag) ? htmlspecialchars(trim($tag)):ucfirst(htmlspecialchars(trim($tag))) ?></span>
          <?php
          }
          ?>
          <a href="slides.php?=last=<?= $templateVars['slide']['id'] ?>" class="cta">Suivant</a>
        </div>
      </div>
    </div> <!-- /.slide-container -->
  </body>
</html>
