<?php
class User extends Db_object{

  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'user_password', 'user_firstName', 'user_lastName');
  public $user_id;
  public $username;
  public $user_password;
  public $user_firstName;
  public $user_lastName;

  public static function verify_user($username, $password){
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND 	user_password = '{$password}' ";
    $sql .= "LIMIT 1 ";

    $the_result_array = self::find_by_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }


}

?>
