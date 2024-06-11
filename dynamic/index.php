<?php
    session_start();
    if(isset($_SESSION['admin']) && !empty($_SESSION['admin']))
    {
        header("location:dashboard.php");
    }
    else
    {
        http_response_code(404);
        header("location:login.php");
    }
?>