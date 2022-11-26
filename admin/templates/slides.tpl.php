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
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/sidebar.css" />
    <link rel="stylesheet" href="../css/slides.css" />
    <script src="scripts/three_dots_menu.js"></script>
  </head>
  <body>
    <div class="container-flex">
      <div class="sidebar sidebar--admin">
        <div class="sidebar__slides">
          <div class="sidebar__slides__slide">
             1
          </div> <!-- /. sidebar_slides_slide -->
          <div class="sidebar__slides__slide sidebar__slides__slide--add">
             <a href="#" class="slide_add_button">+</slide>
          </div> <!-- /. sidebar_slides_slide -->
        </div> <!-- /. sidebar__slides -->
      </div> <!-- /.sidebar -->
      <div class="container-flex-column container-flex-column--admin w-50">
        <?php include('templates/menu.tpl.php'); ?>
        <div class="container">
          <div class="container__title d-flex">
            <h1>Slides</h1><i class="fa-solid fa-ellipsis"></i>
            <div class="admin-toggle-menu d-none">
              <ul>
                <!-- " Nouveau " three dots context menu item -->
                <li><a href="slides.php">Nouveau</a></li>
                <!-- " Ouvrir " three dots context menu item -->
                <li data-modal="open-slide-modal">Ouvrir</li>
                <!-- " Supprimer " three dots context menu item -->
                <?= isset($_GET['id']) ? '<li><a href=?id="' . intval($_GET['id']) . '&amp;delete="' . intval($_GET['id']) . '">Supprimer</a></li>':'' ?>
              </ul>
            </div> <!-- /.admin-toggle-menu -->
          </div> <!-- /.container__title -->
          <div class="container__text-container">
            <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis.</p>
            <?php
            if(!empty($templateVars['add_slide_success']))
            {
            ?>
              <div class="alert alert-success">La fiche a été enregistrée avec success</div> <!-- /.alert-success -->
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
                  <input type="submit" value="Yes, delete it !" /><a href="slides.php?id=<?= intval($_GET['id']) ?>">Retour</a>
                </form>
              </div> <!-- /.allert-success -->
            <?php
            }
            elseif(!empty($templateVars['delete_success']))
            {
            ?>
              <!-- Deletion confirmation message -->
              <div class="alert alert-success">The selected note has been removed.</div> <!-- .alert-succcess -->
            <?php
            }
            ?>

           <!-- Slideshow description -->
           <form method="POST" action="slides.php<?= isset($_GET['id']) ? '?id=' . intval($_GET['id']):''?>">

              <!-- Slide title -->
              <label for="title">Slide title :</label>
              <input type="text" name="title" id="title" placeholder="Give your note a title.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['title']
                                                                                                            :(!empty($_POST['title']) ? $_POST['title']:'') ?>">
              <!-- Slide tags -->
              <label for="title">Tags :</label>
              <input type="text" name="tags" id="tags" placeholder="Some tags separated with commas.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['tags']
                                                                                                                    :(!empty($_POST['tags']) ? $_POST['tags']:'') ?>">
              <input type="submit" class="btn" value="Submit" />
           </form>

         </div> <!-- /.container__text-container -->
        </div> <!-- /.container -->
       </div> <!-- ./container-flex-column -->
     </div> <!-- /.container-flex -->


    <!-- " Open " menu modal window  -->
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
      </div> <!-- /.modal-body -->
    </div> <!-- /.modal -->

    <!-- Créate or modify slide modal window -->
    <div class="modal modal--slide d-none" id="modal_slide">
      <div class="modal-title"><i class="fa-solid fa-square-full"></i>Edit slide <i class="fa-solid fa-xmark"></i></div>
      <div class="modal-body">
        <form>
            <!-- Slide content -->
            <textarea name="content" id="content" class="text-monospace" placeholder="Give your slide a content.." rows="15"><?=  (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['content']
                                                                                                                                   :(!empty($_POST['content']) ? $_POST['content']:'');
          ?></textarea>
            <input type="submit" value="Submit" class="btn btn--alt" />
        </form>
      </div> <!-- /.modal-body -->
    </div> <!-- /.modal -->

  </body>
</html>
