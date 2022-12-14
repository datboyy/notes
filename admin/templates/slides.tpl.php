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
    <link rel="stylesheet" href="../css/alerts.css" />
    <script src="scripts/three_dots_menu.js"></script>
    <script src="scripts/slideshows.js"></script>
  </head>
  <body>
    <div class="container-flex">
      <div class="sidebar sidebar--admin">
        <div class="sidebar__slides">
          <div class="sidebar__slides_overflow_container">
            <!-- @TODO : Load existing slides if exists from the database -->
            <?php
            if(!empty($templateVars['selected_slideshow']))
            {
              $c = 1;
              foreach($templateVars['selected_slideshow']['slides'] as $slide)
              { ?>
                <div class="sidebar__slides__slide" data-slide-id="<?= intval($slide['id']) ?>">
                  <?= $c ?>
                </div> <!-- /. sidebar_slides_slide -->
          <?php
                $c++;
              }
            }
            else
            {
            ?>
              <!-- Empty slideshow, display an empty slide -->
              <div class="sidebar__slides__slide" data-slide-id="1">
                 1
              </div> <!-- /. sidebar_slides_slide -->
            <?php
            }
            ?>
            <div class="sidebar__slides__slide sidebar__slides__slide--add">
               <a href="#" class="slide_add_button">+</slide>
            </div> <!-- /. sidebar_slides_slide -->
          </div> <!-- /. sidebar__slides -->
        </div> <!-- /.sidebar__slides__overflow_container -->
      </div> <!-- /.sidebar -->
      <div class="container-flex-column container-flex-column--admin w-50">
        <?php include('templates/menu.tpl.php'); ?>
        <div class="container">
          <div class="container__title d-flex">
            <h1>Slideshows</h1><i class="fa-solid fa-ellipsis"></i>
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
              <div class="alert alert--success">La fiche a ??t?? enregistr??e avec success</div> <!-- /.alert-success -->
            <?php
            }
            elseif(isset($_GET['delete']) && !isset($_POST['delete']))
            {
            ?>
              <!-- Deletion confirmation form -->
              <div class="alert alert--error">
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
              <div class="alert alert--success">The selected note has been removed.</div> <!-- .alert-succcess -->
            <?php
            }
            ?>

           <!-- Slideshow description -->
           <form method="POST" name="slideshow_form" action="slides.php<?= isset($_GET['id']) ? '?id=' . intval($_GET['id']):''?>">
              <!-- Slide id -->
              <?= isset($_GET['id']) ? '<input type="hidden" name="id" value="' . intval($_GET['id']) . '"':'' ?>
              <!-- Slide title -->
              <label for="title">Title :</label>
              <input type="text" name="title" id="title" placeholder="Give your slideshow a title.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slideshow']['title']:(!empty($_POST['title']) ? $_POST['title']:'') ?>">
              <!-- Slide tags -->
              <label for="title">Tags :</label>
              <input type="text" name="tags" id="tags" placeholder="Some tags separated with commas.." value="<?= (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slideshow']['tags']:(!empty($_POST['tags']) ? $_POST['tags']:'') ?>">
              <!-- Possible slides from database -->
              <?php
              if(!empty($templateVars['selected_slideshow']))
              {
                foreach($templateVars['selected_slideshow']['slides'] as $slide)
                {
              ?>
                  <!-- @TODO : HTMLPurifier to prevent XSS -->
                  <textarea name="slide_<?= intval($slide['id']) ?>" class="d-none" data-slide-id="<?= $slide['id'] ?>"><?= $slide['content'] ?></textarea>
          <?php }
              } ?>
              <input type="submit" name="slideshow_submit" class="btn" value="Submit" />
           </form>
         </div> <!-- /.container__text-container -->
        </div> <!-- /.container -->
       </div> <!-- ./container-flex-column -->
     </div> <!-- /.container-flex -->


    <!-- " Open " menu modal window  -->
    <div class="modal d-none" id="open-slide-modal">
      <div class="modal-title"><i class="fa-solid fa-folder"></i>Ouvrir <i class="fa-solid fa-xmark"></i> </div> <!-- /.modal__title -->
      <div class="modal-body">
        <p>S??lectionnez le diaporama que vous souhaitez ??diter.</p>
        <ul>
          <?php
          if(!empty($templateVars['slideshows_list']))
          {
          ?>
            <li><span class="slide_title">S??l??ctionnez un diaporama</span></li>
          <?php
            foreach($templateVars['slideshows_list'] as $slideshow)
            { ?>
              <li>
                <span class="slide_title"><a href="?id=<?= intval($slideshow['id']) ?>"><?= htmlspecialchars($slideshow['title']) ?></a></span>
                <div class="tags">
                  <?php foreach(explode(',', $slideshow['tags']) as $tag) { ?><span class="tag"><?= ctype_upper($tag) ? htmlspecialchars(trim($tag)):ucfirst(trim(htmlspecialchars($tag))) ?></span><?php } ?>
                </div> <!-- tags -->
                <span class="slide_date"><?= date('d/m/Y', $slideshow['timestamp']) ?></span>
              </li>
            <?php
            }
          }
          else
          { ?>
            <div class="alert alert--info">
              <p>Il n'y a pas de diaporama ?? afficher, utilisez l'interface d??di??e pour cr??er votre premier diaporama !</p>
            </div>
    <?php } ?>
        </ul>
      </div> <!-- /.modal-body -->
    </div> <!-- /.modal -->

    <!-- Cr??ate or modify slide modal window -->
    <div class="modal modal--slide d-none" id="modal_slide">
      <div class="modal-title"><i class="fa-solid fa-square-full"></i>Edit slide <i class="fa-solid fa-xmark"></i></div>
      <div class="modal-body">
        <form>
            <!-- Slide content -->
            <textarea name="content" data-slide-id="" id="content" class="text-monospace" placeholder="Give your slide a content.." rows="15"><?=  (isset($_GET['id']) && empty($_POST)) ? $templateVars['selected_slide']['content']:(!empty($_POST['content']) ? $_POST['content']:'');?></textarea>
            <input type="submit" value="Submit" class="btn btn--alt" />
        </form>
      </div> <!-- /.modal-body -->
    </div> <!-- /.modal -->

  </body>
</html>
