<!DOCTYPE html>
<html lang='en'>

<?php
$title = 'Poster - Edit';
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

  $postId = empty($_GET['postId']) ? '' : $_GET['postId'];
  if (!$postId) {
    header('Location: /poster/');
  }

  $post = Post::findOne("id = $postId");
  if (!$post) {
    header('Location: /poster/');
  }

  $postTitle = empty($_POST['title']) ? '' : $_POST['title'];
  if ($postTitle) {
    $post->title = $postTitle;
  }

  $postUrl = empty($_POST['url']) ? '' : $_POST['url'];
  if ($postUrl) {
    $post->url = $postUrl;
  }

  $postContent = empty($_POST['content']) ? '' : $_POST['content'];
  if ($postContent) {
    $post->content = $postContent;
  }

  if (isset($_FILES['image'])) {
    $url = saveImage($errors);
    if ($url && empty($errors)) {
      unlink($_SERVER['DOCUMENT_ROOT'] . $post->url);
      $post->url = $url;
    }
  }

  $post->save();

  $title = $post->title;
  $url = $post->url;
  $content = $post->content;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: /poster/");
  }
  ?>

  <div class="container center">
    <h4 class="teal-text">Edit Post</h4>
    <!-- <div class="row">
    <img src="" alt="" class="col s12 m8 l6 xl5" style="height: 400px; border: 1px solid black;">
  </div> -->
    <div class="row">
      <form class="col s12" action="/poster/pages/edit/?postId=<?php echo $postId ?>" method="POST" enctype="multipart/form-data">
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
            <input required name="title" id="title" type="text" class="validate" value="<?php echo $title ?>">
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m10 xl8 offset-m1 offset-xl2">
            <textarea name="content" id="content" class="materialize-textarea"><?php echo $content ?></textarea>
          </div>
        </div>
        <button class="waves-effect waves-light btn"><i class='material-icons left'>save</i>Save</button>
        <a href="/poster/" class="waves-effect waves-light btn red"><i class='material-icons left'>cancel</i>Cancel</a>
      </form>
    </div>
</body>

</html>