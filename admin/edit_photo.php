<?php include("includes/header.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>
<?php if(empty($_GET['id'])){
    redirect("photos.php");
} else {
    $photo = Photo::find_by_id($_GET['id']);
    if(isset($_POST['update'])){
        if($photo){
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alternate_text = $_POST['alternate_text'];
			$photo->description = $_POST['description'];
			$photo->save();
		}    
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
                          PHOTOS
                          <small>Subheading</small>
                      </h1>
                        <form action="" method="post">
                            <div class="form-group">                            
                                <div class="col-md-8">                                    
                                    <div class="form-group">
                                        <input name="title" class="form-control" type="text" placeholder="Title" value="<?php echo $photo->title;?>"> 
                                    </div>
                                    <div class="form-group">
                                        <a class="thumbnail" href="<?php echo $photo->picture_path();?>"><img class="form-group" width="200" src="<?php echo $photo->picture_path();?>" alt="<?php echo $photo->alternate_text;?>"></a>
                                    </div>    
                                    <div class="form-group">
                                        <label for="caption">Caption</label>
                                        <input name="caption" class="form-control" type="text" value="<?php echo $photo->caption;?>"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alternate Text</label>
                                        <input name="alternate_text" class="form-control" type="text" value="<?php echo $photo->alternate_text;?>"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" class="form-control" name="" id="editor" cols="30" rows="10"><?php echo $photo->description;?>
										</textarea> 
                                    </div>                                    
                                </div>                                    
                                <div class="col-md-4" >
                                    <div class="photo-info-box">
                                        <div class="info-box-header">
                                        <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                        </div>
                                        <div class="inside">
                                            <div class="box-inner">
                                                <p class="text">
                                                <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                                </p>
                                                <p class="text ">
                                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                                </p>
                                                <p class="text">
                                                    Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                                </p>
                                                <p class="text">
                                                File Type: <span class="data">JPG</span>
                                                </p>
                                                <p class="text">
                                                File Size: <span class="data"><?php echo $photo->size; ?> bytes</span>
                                                </p>
                                            </div>
                                            <div class="info-box-footer clearfix">
                                                <div class="info-box-delete pull-left">
                                                    <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                                </div>
                                                <div class="info-box-update pull-right ">
                                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                                </div>   
                                            </div>
                                        </div>          
                                    </div>
                                </div>
                            </div>                                                        
                        </form>

                  </div>
              </div>
              <!-- /.row -->
      </div>
      <!-- /.container-fluid -->



</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>
