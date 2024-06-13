<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src='../assets/bootstrap/js/jquery.min.js'></script>
    <script src='../assets/bootstrap/js/bootstrap.bundle.min.js'></script>
    <link rel="stylesheet" href="../assets/css-js/styles.css">
    <script src="../assets/css-js/script.js"></script>
    <script src="../assets/css-js/head_script.js"></script>
</head>

<body>
<header class="persistent-navbar d-flex flex-column align-items-center">
        <nav class="sxc-header">
            <img src="../assets/images/other_images/logo2.png" class="sxc-header-icon" alt="">
            <h5>St. Xavier's College (Autonomous), Palayamkottai - 627002</h5>
        </nav>
        <nav class="sxc-council-header">
            <h5>Students Council Election 2024-25</h5>
        </nav>
    </header>
    <div class="container">
        <?php
        include_once('../util_classes/Admin.php');
        session_start();
        if (isset($_SESSION['admin']))
            session_destroy();
        ?>
        <div class="form-container">
            <form action="" method="post" id="admin_login" class="login_form">
                <h2 class="text-center">Admin Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" name="username" required id="username" class="form-control">
                        <span class="input-group-text"><img src="../assets/icons/user-icon.svg" class="svg-icon" /></span>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" required name="password" id="password" class="form-control">
                        <span class="input-group-text"><img src="../assets/icons/password-lock.svg" class="svg-icon" /></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark my-2 w-100 vote_btn" id="admin_login_btn" name="admin_login">Login</button>
                <?php
                      if(isset($_POST['admin_login']))
                      {
                          try
                          {
                              $user=$_POST['username'];
                              $pass=$_POST['password'];
                              if($validate_result=$admin->validate_admin($user,$pass))
                              {
                                  $_SESSION['admin']=$validate_result['username'];
                                  $_SESSION['admin_name']=$validate_result['name'];
                                  $_SESSION['admin_email']=$validate_result['email'];
                                 echo  $_SESSION['admin_role']=$validate_result['role'];
                                 if($_SESSION['admin_role']=='father')
                                 {
                                        header("Location:../dynamic/dashboard.php");
                                 }
                                 else
                                 {
                                  header("Location:dashboard.php");
                                 }
                              }
                              else
                              {
                                throw new Exception('Invalid Credentials');
                              }
                              
                          }
                          catch(Exception $e)
                          {
                            echo "  <div class='alert alert-success alert-dismissible ' role='alert'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <b>{$e->getMessage()}</b>
                </div>";
                          }
              
                      }
                ?>
              
            </form>
        </div>
    </div>
    <footer>
            <div class="footer-head">
                <b>Designed & Maintained by SXC Web Team | © 2022 St. Xavier's College. All rights reserved.</b><a class="nav-link text-white" href="../index.php"><b>Home</b></a>
            </div>
    </footer>
</body>

</html>