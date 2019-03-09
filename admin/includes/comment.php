<?php
class Comment extends Db_object{

  protected static $db_table = "comments";
  protected static $db_table_fields = array('photo_id', 'author', 'body', 'date_created', 'date_updated');
  public $id;
  public $photo_id;
  public $author;
  public $body;
  public $date_created;
  public $date_updated;

  public static function create_comment($photo_id, $author, $body){
    if(!empty($photo_id) && !empty($author) && !empty($body)){
      $comment = new Comment();
      $comment->photo_id = (int)$photo_id;
      $comment->author   = $author;
      $comment->body     = $body;
      $comment->date_created = date("Y-m-d H:i:s");
      return $comment;
    } else {
      return false;
    }
  }

  public static function find_the_comments($photo_id = 0){
    global $database;
  $sql = "SELECT * FROM " . self::$db_table;
  $sql.= " WHERE photo_id = " . $database->escape_string($photo_id);
  $sql.= " ORDER BY date_created ASC";

  return self::find_by_query($sql);
  }
}
?>
