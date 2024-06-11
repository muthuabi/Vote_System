<?php 
 session_start();
 if(isset($_SESSION['admin']) && !empty($_SESSION['admin']) && $_SESSION['role']='admin')
 {
    if((isset($_GET['username']) && !empty(trim($_GET['username']))) && (isset($_GET['name']) && !empty(trim($_GET['name']))) && (isset($_GET['email']) && !empty(trim($_GET['email']))) && (isset($_GET['password']) && !empty(trim($_GET['password']))) && (isset($_GET['role']) && !empty(trim($_GET['role']))) )
    {
        $username=$_GET['username'];
        $password=$_GET['password'];
        $name=$_GET['name'];
        $email=$_GET['email'];
        $role=$_GET['role'];
        include_once('../util_classes/Admin.php');
        if($admin->insert_admin($username,$name,base64_encode($password),$email,$role))
        {
            echo "Admin Created";
        }
    }
}
else
{
    header('HTTP/1.1 403 Access Forbidden');
    http_response_code(403);
    echo "<center><b>Access Forbidden<br>
        <a href='login.php'class='btn btn-link opacity-hover'>Login to Access</a>
    </b></center>";
    exit();
}
?>