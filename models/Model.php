<?php
abstract class Model {
  protected $id;
  protected $__tableName;

  static protected  $tableName;
  static public $db;

  function __construct($id, $tableName) {
    $this->id = $id;
    $this->__tableName = $tableName;
  }

  public function getId() {
    return $this->id;
  }

  abstract static function parseRow($row);
  static function cleanup($id) {
    return;
  }

  static function findOne($where) {
    $tableName = static::$tableName;
    $query = "
      SELECT * FROM $tableName
      WHERE $where
      LIMIT 1
    ";

    $result = mysqli_query(static::$db, $query);
    if (!$result) {
      return null;
    }

    $row = mysqli_fetch_assoc($result);
    if (!$row) {
      return null;
    }

    return static::parseRow($row);
  }

  static function findMany($where) {
    $tableName = static::$tableName;
    $query = "
      SELECT * FROM $tableName
      WHERE $where
    ";

    $result = mysqli_query(static::$db, $query);
    if (!$result) {
      return null;
    }

    $resultArray = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $parsed = static::parseRow($row);
      array_push($resultArray, $parsed);
    }

    return $resultArray;
  }

  static function deleteOne($where, $id) {
    $tableName = static::$tableName;
    $query = "
      DELETE FROM $tableName
      WHERE $where
    ";

    static::cleanup($id);
    mysqli_query(static::$db, $query);
  }
}
