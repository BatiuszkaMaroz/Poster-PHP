<?php
class Post extends Model {
  public $title;
  public $url;
  public $content;
  public $createdAt;
  public $updatedAt;
  protected $user_id;

  static protected $tableName = 'posts';

  private function __construct(
    $id,
    $title,
    $url,
    $content,
    $createdAt,
    $updatedAt,
    $user_id
  ) {
    parent::__construct($id, 'posts');

    $this->title = $title;
    $this->url = $url;
    $this->content = $content;
    $this->createdAt = $createdAt;
    $this->updatedAt = $updatedAt;
    $this->user_id = $user_id;
  }

  function save() {
    $query = "
      UPDATE posts
      SET
        title = '$this->title',
        url = '$this->url',
        content = '$this->content',
        updated_at = CURRENT_TIMESTAMP
      WHERE id = '$this->id'
    ";

    mysqli_query(Post::$db, $query);
    $this->fetchUpdated();
  }

  private function fetchUpdated() {
    $updated = Post::findOne("id = $this->id");

    // foreach ($updated as $key => $value) {
    //   echo $key;
    // }

    $this->title = $updated->title;
    $this->url = $updated->url;
    $this->content = $updated->content;
    $this->createdAt = $updated->createdAt;
    $this->updatedAt = $updated->updatedAt;
    $this->user_id = $updated->user_id;
  }


  static function insert($title, $url, $content, $user_id) {
    $query = "
      INSERT INTO posts(title, url, content, user_id)
      VALUES('$title', '$url', '$content', $user_id)
    ";

    mysqli_query(Post::$db, $query);
    $id = mysqli_insert_id(Post::$db);

    if ($id) {
      return Post::findOne("id = $id");
    } else {
      return null;
    }
  }

  static function parseRow($row) {
    $id = empty($row['id']) ? false : $row['id'];
    $title = empty($row['title']) ? false : $row['title'];
    $url = empty($row['url']) ? false : $row['url'];
    $content = empty($row['content']) ? false : $row['content'];
    $createdAt = empty($row['created_at']) ? false : $row['created_at'];
    $updatedAt = empty($row['updated_at']) ? false : $row['updated_at'];
    $user_id = empty($row['user_id']) ? false : $row['user_id'];
    if (!$id || !$title || !$url || !$user_id) {
      return null;
    }

    return new Post(
      $id,
      $title,
      $url,
      $content,
      $createdAt,
      $updatedAt,
      $user_id
    );
  }

  static function cleanup($id) {
    $post = Post::findOne("id = $id");
    $url = $post->url;
    unlink($_SERVER['DOCUMENT_ROOT'] . $url);
  }
}
