
    <div class="container-fluid">
        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin
                        <small>Testing a lot</small>
                    </h1>

                    <?php
                    $users = User::find_all();
                    foreach ($users as $user) {
                      echo $user->id . "<br>";
                      echo $user->username . "<br>";
                      echo $user->password . "<br>";
                      echo $user->firstName . "<br>";
                      echo $user->lastName . "<br>";
                    }

                    // $one_user = User::find_by_id(1);
                    // echo $one_user->username;
                    // echo "<br>";
                    // $session->message("textas");
                    // echo $_SESSION['message'];

                    // echo "<hr>";
                    // $new_user = new User();
                    // $new_user->username = "mocai";
                    // $new_user->password = "asvisgigotas";
                    // $new_user->firstName = "Gintaras";
                    // $new_user->lastName = "Dabašinskas";
                //    $new_user->id= 22;
                //    $new_user->create();          //comment to avoid autocreating user
                  //  echo $new_user->update();
                    //echo $new_user->delete();
                    //$new_user->save();

                    $photos = Photo::find_all();
                    foreach ($photos as $photo) {
                      echo $photo->id . "<br>";
                      echo $photo->title . "<br>";
                      echo $photo->description. "<br>";
                      echo $photo->filename . "<br>";
                      echo $photo->type . "<br>";
                      echo $photo->size . "<br>";
                      echo "<hr>";
                    }

                    $new_photo = new Photo();
                    $new_photo->title = "Trečia nuotrauka";
                    $new_photo->description = "Dar vienas title skirtas nuotraukoms";
                    $new_photo->filename = "photo";
                    $new_photo->type = "jpg";
                    $new_photo->size = 38;
                    echo INCLUDES_PATH;
                  //  $new_photo->id = 3;
                  //  $new_photo->create();
                //    $new_photo->update();






                    ?>

                    <hr>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
