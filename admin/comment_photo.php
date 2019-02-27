<?php include("includes/header.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>
<?php 

if(empty($_GET['id']) || !Photo::find_by_id($_GET['id'])){
    redirect("photos.php");
} else {
    $photo = Photo::find_by_id($_GET['id']);
}

$comments = Comment::find_the_comments($photo->id);
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
                          Comments
                          <small>Subheading</small>
                      </h1>
                      <a href="add_user.php" class="btn btn-primary">Add User</a>
                      <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Id</th>
                                    <th>Photo</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                                 
                                foreach ($comments as $comment) {  
                            ?>                                          
                                    <tr>
                                    <td><?php echo $comment->id; ?></td>
                                    <td></td>
                                    <td><?php echo $comment->author; ?>
                                        <div class="action_links">
                                            <a href="delete_comment_photo.php?id=<?php echo $comment->id ; ?>">Delete</a>                                            
                                            <a href="">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $comment->body; ?></td>
                                    <td><?php echo $comment->date_created; ?></td>                                    
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
