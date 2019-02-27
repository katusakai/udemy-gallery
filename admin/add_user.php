<?php include("includes/header.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>
<?php 
if(isset($_POST['create'])){
    $user = new User();
    if($user){
        $user->username = $_POST['username'];
        $user->firstName = $_POST['firstName'];
        $user->lastName = $_POST['lastName'];
        $user->password = $_POST['password'];
        if(isset($_FILES['user_image'])){
           $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
        } else {
            $user->save();
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
                          CREATE USER
                          <small>Subheading</small>
                      </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">                            
                                <div class="col-md-6 col-md-offset-3">  
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
                                        <input name="username" class="form-control" type="text" placeholder="Enter your username here"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input name="firstName" class="form-control" type="text" placeholder="Enter your First Name here"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName">Last Name</label>
                                        <input name="lastName" class="form-control" type="text" placeholder="Enter your Last Name here"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" class="form-control" type="password" placeholder="Enter your Password here"> 
                                    </div>
                                    <div class="form-group">
                                        <input name="create" class="btn btn-primary pull-right" type="submit" value="Create"> 
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
