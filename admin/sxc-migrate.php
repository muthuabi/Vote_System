<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Canditate</title>
   
</head>

<body>
    <header>
        <?php
        include_once("includes/navbar.php");
        ?>
    </header>
    <style>
          
        </style>
    <main class="content-wrapper">
        <div class="container">
    <?php 
    include_once("includes/confirm_modal.php");
    include_once("../util_classes/Admin.php");
    if(isset($_POST['migrate']))
    {
        try
        {
            if($admin->migrate_table())
            {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <buton type='button'  class='btn-close' data-bs-dismiss='alert'> </buton>
               Table Migrated</div>";
            }
            else
                throw new Exception('Table Migration Failed');

        }
        catch(Exception $e)
        {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <buton type='button'  class='btn-close' data-bs-dismiss='alert'> </buton>
        {$e->getMessage()}</div>";
        }
    }
    ?>
    <form action='' method='post' style='height:70vh' class="d-flex w-100 justify-content-center align-items-center">
            <button type='submit' name='migrate' value='migrate' class="vote_btn btn btn-lg btn-primary">Migrate</button>
    </form>

</div> 
    </main>

</body>
<script>
</script>

</html>