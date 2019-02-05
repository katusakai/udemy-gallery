<?php
class User{

  public $user_id;
  public $username;
  public $user_password;
  public $user_firstName;
  public $user_lastName;

#####MAIN METHOD FOR GETTING QUERIES#########
  public static function find_this_query($sql){
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();
    while($row = mysqli_fetch_array($result_set)){
      $the_object_array[] = self::instantiation($row);
    }
    return $the_object_array;
  }
  ###############################################


  public static function verify_user($username, $password){
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND 	user_password = '{$password}' ";
    $sql .= "LIMIT 1 ";

    $the_result_array = self::find_this_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }


  public static function find_all_users(){
    return self::find_this_query("SELECT * FROM users");
  }

  public static function find_user_by_id($id){
    global $database;
    $the_result_array = self::find_this_query("SELECT * FROM users WHERE user_id = {$id} LIMIT 1");
    return !empty($the_result_array) ? array_shift($the_result_array) : false;    //ternary if
  }

  public static function instantiation($the_record){           //assings query array values to object properties
    $the_object = new self;                                    //creates object inside itself class
    // $the_object->user_id = $the_record['user_id'];                  //does magic of OOP abyss
    // $the_object->username = $the_record['username'];
    // $the_object->user_password = $the_record['user_password'];
    // $the_object->user_firstName = $the_record['user_firstName'];
    // $the_object->user_lastName = $the_record['user_lastName'];
    foreach ($the_record as $the_attribute => $value) {           //we replace every line of assigning with loop
      if($the_object->has_the_attribute($the_attribute)){
        $the_object->$the_attribute = $value;
      }
    }
    return $the_object;
  }

  private function has_the_attribute($the_attribute){
    $object_properties = get_object_vars($this);
    return array_key_exists($the_attribute, $object_properties);
  }


}

?>
