<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>
<?php 
if(empty($_GET['id'])){
    redirect("users.php");
}
$user = User::find_by_id($_GET['id']);

if(isset($_POST['update'])){
    if($user){
        $user->username = $_POST['username'];
        $user->firstName = $_POST['firstName'];
        $user->lastName = $_POST['lastName'];
        if(!empty($_POST['password'])){
            $user->password = $_POST['password'];;
        }        
        if(isset($_FILES['user_image'])){
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            redirect("users.php");
            $session->message("The user has been updated");
          //  redirect("edit_user.php?id{$user->id}");
         } else {
            $user->save();
            redirect("users.php");
            $session->message("The user has been updated");
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
                          EDIT USER
                          <small>Subheading</small>
                      </h1>
                        <div class="col-md-6"> 
                            <div class="form-group">  
                                <a href="#" data-toggle="modal" data-target="#photo-library">
                                    <img id="user_photo" class='img-responsive' src="<?php echo $user->image_path_and_placeholder() ; ?>" alt="">
                                </a>
                            </div>   
                        </div>  
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <div class="input-group input-file" name="user_image">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-choose" name="file_upload" type="button">Choose</button>
                                        </span>
                                        <input type="text" class="form-control" placeholder='Choose a file...' />
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-reset" type="button">Reset</button>
                                        </span>
                                    </div>
                                </div>                                   
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name="username" class="form-control" type="text" value="<?php echo $user->username?>"> 
                                </div>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input name="firstName" class="form-control" type="text" value="<?php echo $user->firstName?>"> 
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input name="lastName" class="form-control" type="text" value="<?php echo $user->lastName?>"> 
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name="password" class="form-control" type="password"> 
                                </div>
                                <div class="form-group">
                                    <input name="update" class="btn btn-primary pull-right" type="submit" value="Update"> 
                                    <a class="btn btn-danger pull-left" id="user-id" href="delete_user.php?id=<?php echo $user->id ?>">
                                    DELETE
                                    </a>
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