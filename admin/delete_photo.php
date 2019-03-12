<?php include("includes/init.php"); ?>
<?php  !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>

<?php 
if(empty($_GET['id'])){
  redirect("photos.php");
}
$photo = Photo::find_by_id($_GET['id']);
if($photo){
  $session->message("The photo with id {$photo->id} has been deleted");
  $photo->delete_photo();  
  redirect("photos.php");
}

?>