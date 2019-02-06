<?php

class Database {

  public $connection;

  function __construct(){
    $this->open_db_connection();
  }

  public function open_db_connection(){
    // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);       //creating class mysqli (php defined class) inside class
    if($this->connection->connect_errno){  //using connect_ernor property of mysqli class
      die("<strong style='color:red'>Not connected to database</strong>" . $this->connection->connect_error);
    }
  }

  public function query($sql){
    // $result = mysqli_query($this->connection, $sql);
    $result = $this->connection->query($sql);   //using query method of mysqli class
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result){
    if(!$result) {
      // die("Query failed" . mysqli_error($this->connection));
      die("Query failed" . $this->connection->error); //using error property of mysqli class
    }
  }

  public function escape_string($string){
    // $escape_string = mysqli_real_escape_string($this->connection, $string);
    $escape_string = $this->connection->real_escape_string($string); //using real_escape_string method of mysqli class
    return $escape_string;
  }

  public function the_insert_id() {
    return $this->connection->insert_id;    //or return mysqli_insert_id($this->connection)
  }

}

$database = new Database();

 ?>
