
    <div class="container-fluid">
        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin
                        <small>Subheading</small>
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
