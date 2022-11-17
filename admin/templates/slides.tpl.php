<!DOCTYPE html>
<html>
  <head>
    <script src="https://kit.fontawesome.com/bf84b6c6d8.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/main.css" />
  </head>
  <body>
    <?php include('templates/menu.tpl.php'); ?>
    <div class="container">
      <div class="title-container">
        <h1>Slides</h1>
        <i class="fa-solid fa-ellipsis"></i>
        <div class="admin-toggle-menu d-none">
          <ul>
            <li><a href="index.php">Nouveau</a></li>
            <li data-modal="open-slide-modal">Ouvrir</li>
            <?php
            if(isset($_GET['id']))
            {
            ?>
              <li>
                <a href="?id=<?= intval($_GET['id']) ?>&amp;delete=<?= intval($_GET['id']) ?>">
                  Supprimer
                </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div> <!-- /.title-container -->
      <div class="text-container">
        <?php
        if(!empty($templateVars['add_cheatsheet_success']))
        {
        ?>
          <div class="alert alert-success">
            La fiche a été enregistrée avec success
          </div> <!-- /.alert-success -->
        <?php
        }
        ?>
        <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis, tellus magna accumsan felis,
          et porta diam erat non ipsum. Integer eros libero, tristique sed sodales eu, luctus id sem.
        </p>
        <!--
              Cheatsheet edition form
        -->
        <form method="POST">
          <?php
          if(isset($_GET['id']))
          {
          ?>
            <input type="hidden" name="id" value="<?= (int) $_GET['id'] ?>" />
          <?php
          }
          ?>
          <!-- Note title -->
          <label for="title">Note title :</label>
          <input type="text" name="title" id="title" placeholder="Give your note a title.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['title']
                                                                                                        :(!empty($_POST['title']) ? $_POST['title']:'') ?>">
          <!-- Note tags -->
          <label for="title">Tags :</label>
          <input type="text" name="tags" id="tags" placeholder="Some tags separated with commas.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['tags']
                                                                                                                :(!empty($_POST['tags']) ? $_POST['tags']:'') ?>">
          <!-- Note content -->
          <label for="content">Content :</label>
          <textarea name="content" id="content" placeholder="Give your note a content.." rows="15"><?=  (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['content']
                                                                                                          :(!empty($_POST['content']) ? $_POST['content']:'')
        ?></textarea>
          <!-- Submit button -->
          <div class="editor-buttons">
            <input type="submit" value="Submit" />
          </div>
        </form>
      </div> <!-- /.text-container -->
    </div> <!-- /.container -->
  </body>
</html>
