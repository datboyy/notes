<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css" integrity="sha512-aNH2ILn88yXgp/1dcFPt2/EkSNc03f9HBFX0rqX3Kw37+vjipi1pK3L9W08TZLhMg4Slk810sPLdJlNIjwygFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/view_note.css" />
  </head>
  <body>
    <div class="container-flex-column w-50">
      <div class="head-links">
        <a href="index.php">Retour</a>
      </div> <!-- /.header links -->
      <div class="container">
        <div class="container__view-title-container">
          <h1><?= htmlspecialchars($templateVars['note']['title']) ?></h1>
        </div> <!-- /.viex-title-container -->
        <div class="container__text-container">
          <div class="container__view-text-container">
            <?= $templateVars['note']['content'] ?>
          </div> <!-- /.view-article -->
        </div> <!-- /.text-container -->
      </div> <!-- /.container -->
    </div> <!-- /.container-flex-column -->
  </body>
</html>
