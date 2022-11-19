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
    <script src="scripts/three_dots_menu.js"></script>

  </head>
  <body>
    <?php include('templates/menu.tpl.php'); ?>
    <div class="container">
      <div class="title-container">
        <h1>Slides</h1>
        <i class="fa-solid fa-ellipsis"></i>
        <div class="admin-toggle-menu d-none">
          <ul>
            <li><a href="slides.php">Nouveau</a></li>
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
        <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis, tellus magna accumsan felis,
          et porta diam erat non ipsum. Integer eros libero, tristique sed sodales eu, luctus id sem.
        </p>
        <?php
        if(!empty($templateVars['add_slide_success']))
        {
        ?>
          <div class="alert alert-success">
            La fiche a été enregistrée avec success
          </div> <!-- /.alert-success -->
        <?php
        }
        elseif(isset($_GET['delete']) && !isset($_POST['delete']))
        {
        ?>
          <!-- Deletion confirmation form -->
          <div class="alert alert-error">
            <form method="POST" action="slides.php">
              <input type="hidden" name="delete" value="<?= intval($_GET['delete']) ?>" />
              Are you sure you want to delete this note ?
              <input type="submit" value="Yes, delete it !" />
              <a href="slides.php?id=<?= intval($_GET['id']) ?>">Retour</a>
            </form>
          </div> <!-- /.allert-success -->
        <?php
        }
        elseif(!empty($templateVars['delete_success']))
        {
        ?>
          <!-- Deletion confirmation message -->
          <div class="alert alert-success">
            The selected note has been removed.
          </div> <!-- .alert-succcess -->
        <?php
        }
        ?>
        <!--
              Cheatsheet edition form
        -->
        <form method="POST" action="slides.php<?= isset($_GET['id']) ? '?id=' . intval($_GET['id']):''?>">
          <?php
          if(isset($_GET['id']))
          {
          ?>
            <input type="hidden" name="id" value="<?= intval($_GET['id']) ?>" />
          <?php
          }
          ?>
          <!-- Note title -->
          <label for="title">Note title :</label>
          <input type="text" name="title" id="title" placeholder="Give your note a title.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['title']
                                                                                                        :(!empty($_POST['title']) ? $_POST['title']:'') ?>">
          <!-- Note tags -->
          <label for="title">Tags :</label>
          <input type="text" name="tags" id="tags" placeholder="Some tags separated with commas.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['tags']
                                                                                                                :(!empty($_POST['tags']) ? $_POST['tags']:'') ?>">
          <!-- Note content -->
          <label for="content">Content :</label>
          <textarea name="content" id="content" class="text-monospace" placeholder="Give your note a content.." rows="15"><?=  (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['content']
                                                                                                                                 :(!empty($_POST['content']) ? $_POST['content']:'')
        ?></textarea>
          <!-- Submit button -->
          <div class="editor-buttons">
            <input type="submit" value="Submit" />
          </div>
        </form>
      </div> <!-- /.text-container -->
    </div> <!-- /.container -->
    <!--

          Modal windows

    -->
    <div class="modal d-none" id="open-slide-modal">
      <div class="modal-title">
        <i class="fa-solid fa-folder"></i>Ouvrir
        <i class="fa-solid fa-xmark"></i>
      </div> <!-- /.modal__title -->
      <div class="modal-body">
        <p>Sélectionnez la note que vous souhaitez éditer.</p>
        <ul>
          <?php
          foreach($templateVars['slides_list'] as $note)
          {
          ?>
            <li>
              <span class="slide_title">
                  <a href="?id=<?= intval($note['id']) ?>"><?= htmlspecialchars($note['title']) ?></a>
              </span>
              <div class="tags">
                <?php
                foreach(explode(',', $note['tags']) as $tag)
                {
                ?>
                  <span class="tag"><?= ctype_upper($tag) ? htmlspecialchars(trim($tag)):ucfirst(trim(htmlspecialchars($tag))) ?></span>
                <?php
                }
                ?>
              </div> <!-- tags -->
              <span class="slide_date">
                  <?= date('d/m/Y', $note['timestamp']) ?>
              </span>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div> <!-- /.modal -->
  </body>
</html>
