<div class="container center">

  <h4 class="teal-text">Welcome <?php echo $_SESSION['user']->username ?> !</h4>
  <ul class="row">
    <?php
    require(dirname(__FILE__) . './helpers.php');

    $deleteId = empty($_POST['deleteId']) ? null : $_POST['deleteId'];
    if ($deleteId) {
      Post::deleteOne("id = $deleteId", $deleteId);
    }

    $userId = $_SESSION['user']->getId();
    $posts = Post::findMany("user_id = $userId");

    foreach ($posts as $post) {
      renderPost($post->getId(), $post->title, $post->url, $post->content, $post->createdAt);
    }

    ?>
    <div class="row"></div>
  </ul>

  <a href="/poster/pages/create/" class="btn-floating button-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elms = document.querySelectorAll('.materialboxed');
      var instances = M.Materialbox.init(elms);
    });
  </script>
</div>