<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index </title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css-js/styles.css">
    <script src="../assets/bootstrap/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/css-js/script.js"></script>
    <script src="../assets/css-js/head_script.js"></script>
</head>

<body>
    <div class="container">
        <?php 
            session_start();
            if(!isset($_SESSION['user_select']))
            {
                if(isset($_POST['user_login']))
                {
                    $_SESSION['user_select']='Session Lost';
                    header("Location:cast_vote.php?shift=".base64_encode($_POST['shift'])."&vote_gender=".base64_encode($_POST['vote_gender']));
                } 
        ?>
        <div class="form-container">
            <form action="" method="post" id="user_login" class="login_form">
                <h2 class="text-center">User Login</h2>
                <div class="form-group">
                    <label for="username">Shift</label>
                    <select name="shift" id="shift" class='form-control'>
                        <option value='Shift-I'>Shift - I</option>
                        <option value='Shift-II'>Shift - II</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="password">Gender</label>
                    <select name="vote_gender" id="vote_gender" class="form-control">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select> 
                </div>
                <button type="submit" class="btn btn-dark my-2 w-100" id="user_login_btn" name="user_login">Login</button>
            </form>
        </div>
        <?php 
            }
            else
            {
                die('<center><b>Access Lost! Contact Admin</b></center>');
            }
        ?>
    </div>
</body>

</html>