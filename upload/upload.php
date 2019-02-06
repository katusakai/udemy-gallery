<?php
if(isset($_POST['submit'])){

$upload_errors = array(
  UPLOAD_ERR_OK => "There is no error",
  UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_file_size directive",
  UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
  UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
  UPLOAD_ERR_NO_FILE => "No file was uploaded",
  UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
  UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
  UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
);

$temp_name = $_FILES['file_upload']['tmp_name'];
$temp_file = $_FILES['file_upload']['name'];
$directory = "uploads";

if(move_uploaded_file($temp_name, $directory . "/" . $temp_file)){
  $the_message = "File was uploaded sucessfully";
} else {
  $the_error = $_FILES['file_upload']['error'];
  $the_message = $upload_errors[$the_error];
};

}
 ?>


   <form class="form-control" action="" method="post" enctype="multipart/form-data">
     <input class="form-control" type="file" name="file_upload">
     <br>
     <input class="form-control" type="submit" name="submit">
     <h3>
      <?php
      if(isset($the_message)){
        echo $the_message;
      } ?>
    </h3>
   </form>
