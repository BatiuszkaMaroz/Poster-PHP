<!DOCTYPE html>
<html lang="en">

<?php
$title = "Poster - Create Post";
require('../../includes/head.php');
require('../../utils/tinymce.php');
?>

<body>
  <?php
  require('../../utils/middlewares.php');
  require('../../utils/requireAuth.php');
  require('../../utils/fileStorage.php');
  require('../../includes/nav.php');

  $errors = [];

  $title = empty($_POST['title']) ? false : $_POST['title'];
  $content = empty($_POST['content']) ? '' : $_POST['content'];
  $userId = $_SESSION['user']->getId();

  if ($title && $userId) {
    $url = saveImage($errors);

    if ($url && empty($errors)) {
      Post::insert($title, $url, $content, $userId);
      header("Location: /poster/");
    }
  }
  ?>

  <div class="container center">
    <h4 class="teal-text">Create Post</h4>
    <div class="row file__preview">
      <img class="input-field col s12 m10 xl8 offset-m1 offset-xl2">
    </div>
    <div class=" row">
      <form class="col s12" action="/poster/pages/create/" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12 m10 xl8 offset-m1 offset-xl2">
            <label class="waves-effect waves-light btn white-text create__label--file" for="image">
              <i class='material-icons left'>cloud_upload</i>
              Upload Image
            </label>
            <input required class="create__input--file" accept=".jpg,.jpeg,.png,.gif" type="file" name="image" id="image">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m10 xl8 offset-m1 offset-xl2">
            <label for="title">Title</label>
            <input required name="title" id="title" type="text" class="validate">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m10 xl8 offset-m1 offset-xl2">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
          </div>
        </div>
        <button class="waves-effect waves-light btn"><i class='material-icons left'>add_circle</i>Add Post</button>
      </form>
    </div>

    <?php
    function renderChip($content) {
      echo "
      <div class='chip'>
        $content
      </div>
    ";
    }

    foreach ($errors as $error) {
      renderChip($error);
    }
    ?>

    <script>
      const filePreview = document.querySelector('.file__preview img');
      const fileInput = document.querySelector(".create__input--file");
      fileInput.addEventListener('change', (e) => {
        const {
          target
        } = e;

        if (target.files && target.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            filePreview.src = e.target.result;
          }

          reader.readAsDataURL(target.files[0]); // convert to base64 string
        }
      })
    </script>
  </div>
</body>

</html>