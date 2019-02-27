<?php include("includes/header.php"); ?>
<?php !$session->is_signed_in() ? redirect("login.php") : false  //if not signed in- redirects  ?>

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
                      <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Id</th>
                                    <th>File Name</th>
                                    <th>Title</th>
                                    <th>Size</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $photos = Photo::find_all();
                                foreach ($photos as $photo) {  
                                    $comment_count = count(Comment::find_the_comments($photo->id));    
                                                                  
                                    echo "<tr>";
                                    echo "
                                    <td><img class='admin-photo-thumbnail' src='" . $photo->picture_path() ."'>
                                    <div class='action_links'>
                                    <a href='delete_photo.php?id=" . $photo->id . "'>Delete</a>
                                    <a href='edit_photo.php?id=" . $photo->id . "'>Edit</a>
                                    <a href='../photo.php?id={$photo->id}'>View</a>                                    
                                    </div>
                                    </td>";
                                    echo "<td>" . $photo->id . "</td>";
                                    echo "<td>" . $photo->filename . "</td>";
                                    echo "<td>" . $photo->title . "</td>";
                                    echo "<td>" . $photo->size . " bytes</td>";     
                                    echo "<td><a href='comment_photo.php?id={$photo->id}'>View comments({$comment_count})</a></td>";                               
                                    echo "<tr>";
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
