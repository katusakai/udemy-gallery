<?php include("includes/init.php"); ?>
<?php  !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>

<?php 
if(empty($_GET['id'])){
  redirect("comment_photo.php");
}
$comment = Comment::find_by_id($_GET['id']);
if($comment){
  $comment->delete();
  redirect("comment_photo.php?id={$comment->photo_id}");
}

?>