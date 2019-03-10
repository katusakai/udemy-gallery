<?php
class User extends Db_object{

  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'password', 'firstName', 'lastName', 'user_image');
  public $id;
  public $username;
  public $password;
  public $firstName;
  public $lastName;
  public $user_image;

  public $upload_directory = "images/users";
  public $image_placeholder = "http://placehold.it/400x400&text=image";

  public function image_path_and_placeholder(){
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
  }

  public function delete_user(){       //deletes user and it's image file
    if($this->delete()){
      $target_path = SITE_ROOT . DS. 'admin' . DS . $this->image_path_and_placeholder();
      return unlink($target_path) ? true : false;
    } else {
      return false;
    }
  }

  public static function verify_user($username, $password){
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND 	password = '{$password}' ";
    $sql .= "LIMIT 1 ";

    $the_result_array = self::find_by_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  public function set_file($file){
    if((empty($file)) || !$file || !is_array($file)){
      $this->errors[] = "There was no file uploaded here";
      return false;
    } elseif ($file['error'] !=0){
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    } else {
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      return true;       //teacher did not include return statement
    }
  }

  public function upload_photo(){                 //creates or updates, depends if file is there
    if(!empty($this->errors)){
      return false;
    }
    if(empty($this->user_image) || empty($this->tmp_path)){
      $this->errors[] = "the file was not available";
      return false;
    }
    $target_path = SITE_ROOT . DS. 'admin'. DS . $this->upload_directory .DS . $this->user_image;
    if(file_exists($target_path)){
      $this->errors[] = "The file {$this->user_image} already exists";
      return false;
    }
    echo $target_path;
    if(move_uploaded_file($this->tmp_path, $target_path)){
      unset($this->tmp_path);
      return true;
     } else {
      $this->errors[] = "The file directory probably does not have permissions";
      return false;  
    }
    
  }

  public function ajax_save_user_image($user_image, $user_id){
    global $database;
    $this->user_image = $database->escape_string($user_image);
    $this->id         = $database->escape_string($user_id);
    $sql = "UPDATE " . static::$db_table . " SET ";
    $sql.= "user_image = '{$this->user_image}'" ;
    $sql.= "WHERE id = {$this->id}";
    $database->query($sql);
    return ($database->connection->affected_rows == 1) ? true : false;
  }

}
?>