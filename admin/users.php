<?php include("includes/header.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>
<?php $users = User::find_all(); ?>
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
                          USERS
                      </h1>     
                      <?php if($message != ""){
                        echo "<p class='bg-success'> {$message}</p>";
                    }?>                 
                      <div class="col-md-12 ">                          
                      <a href="add_user.php" class="btn btn-primary">Add User</a>
                        <table class="table-responsive table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                                 
                                foreach ($users as $user) {  
                            ?>                                          
                                    <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class='user_image' src="<?php echo $user->image_path_and_placeholder(); ?>" alt="<?php echo $user->username; ?>"></td>
                                    <td><?php echo $user->username; ?>
                                        <div class="action_links">
                                            <a href="delete_user.php?id=<?php echo $user->id ; ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id ; ?>">Edit</a>
                                            <a href="">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->firstName; ?></td>
                                    <td><?php echo $user->lastName; ?></td>                                    
                                    <tr>
                            <?php        
                                }
                                
                            ?>

                            </tbody>
                        </table> <!--End of Table-->
                      </div>

                  </div>
              </div>
              <!-- /.row -->
      </div>
      <!-- /.container-fluid -->



</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>
