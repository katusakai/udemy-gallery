<?php include("includes/init.php"); ?>
<?php  !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>

<?php 
if(empty($_GET['id'])){
  redirect("users.php");
}
$user = User::find_by_id($_GET['id']);
if($user){
  $session->message("The user {$user->username} has been deleted");
  $user->delete_user();  
  redirect("users.php");
}

?>