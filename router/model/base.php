<?php
  Class DB {
    public static $pdo = false;

    public static function mq($sql, $arr = []){
      if(!self::$pdo){
        self::$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=23chungbuk", "root", "", [
          19 => 2,
          3 => 2
        ]);
      }

      $q = self::$pdo->prepare($sql);
      $q->execute(is_array($arr) ? $arr : [$arr]);

      return $q;
    }

    public static function all($sql = "", $arr = []){
      $table = get_called_class();
      return self::mq("SELECT * FROM $table $sql", $arr)->fetchAll();
    }

    public static function find($sql, $arr = []){
      $table = get_called_class();
      return self::mq("SELECT * FROM $table WHERE $sql", $arr)->fetch();
    }

    public static function findAll($sql, $arr = []){
      $table = get_called_class();
      return self::mq("SELECT * FROM $table WHERE $sql", $arr)->fetchAll();
    }

    public static function insert($data){
      $table = get_called_class();

      $sql = implode(" = ?, ", array_keys($data))." = ?";

      self::mq("INSERT INTO $table SET $sql", array_values($data));

      return self::$pdo->lastinsertid();
    }

    public static function update($sql, $condition, $arr = []){
      $table = get_called_class();

      $condition = is_array($condition) ? $condition : [$condition];
      $update = implode(" = ?, ", array_keys($arr))." = ?";

      self::mq("UPDATE $table SET $update WHERE $sql", array_merge(array_values($arr), $condition));
    }


    public static function delete($sql, $arr = []){
      $table = get_called_class();

      self::mq("DELETE FROM $table WHERE $sql", $arr);
    }
  }

  class user extends DB {}
  class preview extends DB {}
  class reservation extends DB {}
?>