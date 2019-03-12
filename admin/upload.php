<?php include("includes/header.php"); ?>
<?php  !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>

<?php 
$message = "";
if(isset($_FILES['file'])){
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);
    if($photo->save()){
        $message = "Photo uploaded Successfully";
    } else {
        $message = join("<br>", $photo->errors);
    }
}

?>




        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
<?php include("includes/top_nav.php") ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php") ?>
            <!-- /.navbar-collapse -->
        </nav>

<div id="page-wrapper">

      <div class="container-fluid">
          <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          UPLOAD
                          <small>Subheading</small>
                      </h1>
                        <div class="row">
                            <div class="col-md-6">
                            <?php echo $message; ?>
                            <form action="" method="post" enctype="multipart/form-data" >
                                <!-- <div class="form-group">
                                    <input class="form-control" type="text" name="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="description" placeholder="Description">
                                </div> -->

                                <!-- <div class="form-group">
                                    <div class="input-group input-file" name="file_upload">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-choose" name="file_upload" type="button">Choose</button>
                                        </span>
                                        <input type="text" class="form-control" placeholder='Choose a file...' />
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-reset" type="button">Reset</button>
                                        </span>
                                    </div>
                                </div>                         -->
                                <div class="hidden form-group">
                                    <input type="file" name="file">
                                </div>
                                <!-- <input class="btn btn-primary" type="submit" name="submit"> -->
                                </form> 
                            </div>  
                        </div>    <!-- End of Row --> 
                        <div class="row">
                            <div class="col-lg-12">
                            <form action="upload.php" class="dropzone">

                            </form>
                            </div>
                        </div>               
                        
                  </div>
              </div>
              <!-- /.row -->
      </div>
      <!-- /.container-fluid -->



</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>

