<?php
class User extends Model {
  public $username;
  private $password;

  static protected  $tableName = 'users';

  private function __construct($id, $username, $password) {
    parent::__construct($id, "users");

    $this->username = $username;
    $this->password = $password;
  }

  function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_BCRYPT);
  }

  function verifyPassword($password) {
    return password_verify($password, $this->password);
  }

  function save() {
    $query = "
      UPDATE users
      SET username = '$this->username', password = '$this->password'
      WHERE id = '$this->id'
    ";

    mysqli_query(static::$db, $query);
    $this->fetchUpdated();
  }

  private function fetchUpdated() {
    $updatedUser = static::findOne("id = $this->id");

    $this->username = $updatedUser->username;
    $this->password = $updatedUser->password;
  }

  static function insert($username, $password) {
    $encoded = password_hash($password, PASSWORD_BCRYPT);
    $query = "
      INSERT INTO users(username, password)
      VALUES('$username', '$encoded')
    ";

    mysqli_query(static::$db, $query);
    $id = mysqli_insert_id(static::$db);

    if ($id) {
      return static::findOne("id = $id");
    } else {
      return null;
    }
  }

  static function parseRow($row) {
    $id = empty($row['id']) ? false : $row['id'];
    $username = empty($row['username']) ? false : $row['username'];
    $password = empty($row['password']) ? false : $row['password'];
    if (!$id || !$username || !$password) {
      return null;
    }

    return new User($id, $username, $password);
  }
}
