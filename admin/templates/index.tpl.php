<!DOCTYPE html>
<html>
  <head>
    <script src="https://kit.fontawesome.com/bf84b6c6d8.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/alerts.css" />
    <script src="scripts/three_dots_menu.js"></script>
  </head>
  <body>
    <div class="container-flex">
      <div class="container-flex-column container-flex-column--admin w-50">
        <?php include('templates/menu.tpl.php'); ?>
        <div class="container">
          <div class="container__title d-flex">
            <h1>Notes</h1><i class="fa-solid fa-ellipsis"></i>
            <div class="admin-toggle-menu d-none">
              <ul>
                <li><a href="index.php">Nouveau</a></li> <!-- " Nouveau " three dots context menu item -->
                <li data-modal="open-note-modal">Ouvrir</li> <!-- " Ouvrir " three dots context menu item -->
                <?= isset($_GET['id']) ? '<li><a href=?id=' . intval($_GET['id']) . '&amp;delete=' . intval($_GET['id']) . '>Supprimer</a></li>':'' ?> <!-- " Supprimer " three dots context menu item -->
              </ul>
            </div> <!-- /.admin-toggle-menu -->
          </div> <!-- /.container__title -->
          <div class="container__text-container">
            <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis.</p>

            <!-- Missing data error -->
            <?= isset($templateVars['missing_datas']) && !isset($_POST['delete']) ?
                  '<div class="alert alert--error"><p>Some required field have not been completed.</p></div>':'' ?> <!--/.alert -->

            <!-- Data saved success message  -->
            <?= !empty($templateVars['save_note_success']) ? '<div class="alert alert--success"><p>Your modifications have been saved.</p></div>':'' ?>
            <?php
            if(isset($_GET['delete']) && !isset($_POST['delete']))
            {
            ?>
              <!-- Deletion confirmation form -->
              <div class="alert alert--error">
                <form method="POST" action="index.php">
                  <input type="hidden" name="delete" value="<?= intval($_GET['delete']) ?>" />
                  <p>Etes vous s??r de vouloir supprimer cette note ?</p>
                  <input type="submit" class="btn" value="Oui, supprimer !" /> <a href="index.php?id=<?= intval($_GET['id']) ?>">Retour</a>
                </form>
              </div> <!-- /.allert-success -->
            <?php
            }
            ?>
            <!-- Deletion confirmation message -->
            <?= !empty($templateVars['delete_success']) ? '<div class="alert alert--success">The selected note has been removed.</div>':''; ?>

            <!-- Notes editor -->
            <form method="POST">
              <!-- An id field appears in UPDATE context -->
              <?= isset($_GET['id']) ? '<input type="hidden" name="slideshow_id" value="' .  intval($_GET['id']) . ' />"':'' ?>
              <!-- Note title -->
              <label for="title">Note title :</label>
              <input type="text" name="title" id="title" placeholder="Give your note a title.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['title']:(!empty($_POST['title']) ? $_POST['title']:'') ?>">
              <!-- Note tags -->
              <label for="title">Tags :</label>
              <input type="text" name="tags" id="tags" placeholder="Some tags separated with commas.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['tags']:(!empty($_POST['tags']) ? $_POST['tags']:'') ?>">
              <!-- Note content -->
              <label for="content">Content :</label>
              <textarea class="text-monospace" name="content" id="content" placeholder="Give your note a content.." rows="15"><?=  (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_note']['content']:(!empty($_POST['content']) ? $_POST['content']:'') ?></textarea>
              <!-- Submit button -->
              <input type="submit" value="Submit" class="btn" />
          </form>
        </div> <!-- /.text-container -->
      </div> <!-- /.container -->
    </div> <!-- /.container-flex-column -->
  </div> <!-- /.container-flex -->

  <!-- Modal windows -->
  <div class="modal d-none" id="open-note-modal">
    <div class="modal-title"><i class="fa-solid fa-folder"></i>Ouvrir<i class="fa-solid fa-xmark"></i></div> <!-- /.modal__title -->
    <div class="modal-body">
      <p>S??lectionnez la note que vous souhaitez ??diter.</p>
      <ul>
        <?php
        foreach($templateVars['notes_list'] as $note)
        { ?>
          <li>
            <span class="note_title"><a href="?id=<?= intval($note['id']) ?>"><?= htmlspecialchars($note['title']) ?></a></span>
              <div class="tags"><?php foreach(explode(',', $note['tags']) as $tag) { ?> <span class="tag"><?= ucfirst(trim(htmlspecialchars($tag))) ?></span> <?php } ?></div> <!-- tags -->
              <span class="note_date"><?= date('d/m/Y', $note['time']) ?></span>
            </li>
  <?php } ?>
        </ul>
      </div> <!-- /.modal-body -->
    </div> <!-- /.modal -->
  </body>
</html>
