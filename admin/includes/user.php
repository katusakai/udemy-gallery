<?php
class User{

  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'user_password', 'user_firstName', 'user_lastName');
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
    return self::find_this_query("SELECT * FROM " . self::$db_table);
  }

  public static function find_user_by_id($id){
    global $database;
    $the_result_array = self::find_this_query("SELECT * FROM " . self::$db_table . " WHERE user_id = {$id} LIMIT 1");
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

  protected function properties(){
    global $database;
  //  return get_object_vars($this);      //returns array with EVERY property of current object
  ##### below returns array with properties listed only from database table fields (except autoincrements)####
    $properties = array();
    foreach (self::$db_table_fields  as $db_field) {
      if(property_exists($this, $db_field)){
        $properties[$db_field] = $database->escape_string($this->$db_field);
      }
    }
    return $properties;
  }
##teacher used this, but we dont
  // protected function clean_properties(){
  //   global $database;
  //   $clean_properties = array();
  //   foreach ($this->properties() as $key => $value) {
  //     $clean_properties[$key] = $database->escape_string($value);
  //   }
  // }

  public function save(){                   //use this method if you are not sure create or update
    return isset($this->user_id) ? $this->update() : $this->create();
  }

  public function create(){
    global $database;
    $properties = $this->properties();

    $sql = "INSERT INTO " . self::$db_table . " ";
    $sql .= "(" . implode(", ", array_keys($properties)) . ")";           //replaces and does auto $sql .= "(username, user_password, user_firstName, user_lastName) ";
    $sql .= "VALUES ('";
    $sql .= implode("', '", array_values($properties));                   //replaces and does auto     // $sql .= $database->escape_string($this->username) ."','"; and etc.
    $sql .= "')";
    if($database->query($sql)){
      $this->user_id = $database->the_insert_id();
      echo "Pavyko. Sukurtas profilis $this->username ir profilio id yra $this->user_id";
      return true;
    } else {
      return false;
    }
  }

  public function update(){
    global $database;
    $properties = $this->properties();

    $sql = "UPDATE " . self::$db_table . " SET ";
    foreach ($properties as $key => $value) {          //loops through all array to set values
      $sql .= "{$key}= '{$value}', ";
      if(!next($properties)){                          //differs last line of loop because of SQL syntax
        $sql .= "{$key}= '{$value}' ";
      }
    }
    $sql .= " WHERE user_id= " . $database->escape_string($this->user_id);
    $database->query($sql);
    return ($database->connection->affected_rows == 1) ? true : false;
  }

  public function delete(){
    global $database;
    $sql = "DELETE FROM " . self::$db_table . " WHERE user_id={$database->escape_string($this->user_id)} LIMIT 1";
    $database->query($sql);
    return ($database->connection->affected_rows == 1) ? true : false;
  }


}

?>
