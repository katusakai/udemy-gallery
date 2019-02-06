
    <div class="container-fluid">
        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin
                        <small>Testing a lot</small>
                    </h1>

                    <?php
                    $users = User::find_all_users();
                    foreach ($users as $user) {
                      echo $user->user_id . "<br>";
                      echo $user->username . "<br>";
                      echo $user->user_password . "<br>";
                      echo $user->user_firstName . "<br>";
                      echo $user->user_lastName . "<br>";
                    }

                    $one_user = User::find_user_by_id(1);
                    echo $one_user->username;
                    echo "<br>";
                    $session->message("textas");
                    echo $_SESSION['message'];

                    echo "<hr>";
                    $new_user = new User();
                    $new_user->username = "galis";
                    $new_user->user_password = "asgotas";
                    $new_user->user_firstName = "Galintas";
                    $new_user->user_lastName = "Dabašinskas";
                    $new_user->user_id = 7;
                    //$new_user->create();          //comment to avoid autocreating user
                    echo $new_user->update();
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
