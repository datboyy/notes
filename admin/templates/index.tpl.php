<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css" />
  </head>
  <body>
    <?php include('templates/menu.tpl.php'); ?>
    <div class="container">
      <div class="title-container">
        <h1>Notes</h1>
        <i class="fa-regular fa-ellipsis"></i>
      </div> <!-- /.title-container --> 
      <div class="text-container">
        <p class="smlr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis, nisl venenatis rhoncus sagittis, tellus magna accumsan felis,
          et porta diam erat non ipsum. Integer eros libero, tristique sed sodales eu, luctus id sem.
        </p>
        <?php
        if(isset($templateVars['missing_datas']))
        {
        ?>
          <div class="alert alert-error">
            <p>
              Some required field have not been completed.
            </p>
          </div> <!--/.alert -->
        <?php
        }
        elseif(!empty($templateVars['save_note_success']))
        {
        ?>
          <div class="alert alert-success">
            <p>Your modifications have been saved.</p>
          </div>
        <?php
        }
        ?>
        <form method="POST">
          <?php
          if(isset($_GET['id']))
          {
          ?>
            <input type="hidden" name="id" value="<?= (int) $_GET['id'] ?>" />
          <?php
          }
          ?>
          <!--

                Notes editor

          -->
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
