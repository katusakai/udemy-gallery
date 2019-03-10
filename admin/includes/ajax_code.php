<?php require("init.php");
if(isset($_POST['image_name'])){
    $user = new User();
    $user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);
    echo "Photo updated successfully";
}

if(isset($_POST['photo_id'])){
    Photo::display_sidebar_data($_POST['photo_id']);
}

?>