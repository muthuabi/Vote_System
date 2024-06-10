<?php

    session_start();
    if(isset($_SESSION['admin']) && !empty($_SESSION['admin']))
    {
        header("location:dashboard.php");
    }
    else
    {
        header("location:login.php");
    }
?>