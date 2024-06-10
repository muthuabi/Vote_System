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
                        <span class="input-group-text">🎗</span>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" required name="password" id="password" class="form-control">
                        <span class="input-group-text">🔒</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark my-2 w-100" id="admin_login_btn" name="admin_login">Login</button>
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
                                  header("Location:dashboard.php");
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
</body>

</html>