<?php 
    include_once('../util_classes/Admin.php');
    if($admin->insert_admin('krishnan','Muthukrishnan',base64_encode('12345'),'muthukrish@gmail.com'))
    {
        echo "Admin Created";
    }
?>