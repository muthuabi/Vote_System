<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Vote</title>
    <link  rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css-js/styles.css">
    <script src="../assets/bootstrap/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/css-js/script.js"></script>
    <script src="../assets/css-js/head_script.js"></script>

</head>

<body>
    <div class="container">
        <header>
            <?php
            session_start();
            if(isset($_POST['rechoose']))
            {
                    session_destroy();
                    header('location:index.php');
            }
            try
            {
            
            $valid_gender=['M','F'];
            $valid_shift=['Shift-I','Shift-II'];
            if(!isset($_SESSION['user_select']))
            {
                $_SESSION['user_select']='Session_Over';
            }
            if(isset($_GET['shift']) && !empty(trim($_GET['shift'])) && in_array(trim(base64_decode($_GET['shift'])), $valid_shift))
            {
                $shift = base64_decode($_GET['shift']);
            }
            else
            {
                throw new Exception('Invalid Shift Paramater');   
            }
            if(isset($_GET['vote_gender']) && !empty(trim($_GET['vote_gender'])) && in_array(trim(base64_decode($_GET['vote_gender'])), $valid_gender))
            {
                 $vote_gender = base64_decode($_GET['vote_gender']);
            }
            else
            {
                throw new Exception('Invalid Gender Paramater');   
            }
            include_once("../util_classes/Position.php");
            include_once("../util_classes/Candidates.php");
            include_once("../util_classes/Vote.php");
            try {
                if ($data = $pos->readShiftGenderAll($shift, $vote_gender)) {
                    $post_array = $data['data'];
                } else
                    throw new Exception('No Positions Found');
            } catch (Exception $e) {
                die($e->getMessage());
            }
            ?>
        </header>
        
        <main>
    
            <?php
    
        
            echo "<form method='post'><button type='submit' class='btn btn-secondary' name='rechoose'>rechoose</button></form>";
            if (isset($_POST['add_vote'])) {
                try{
                if(!$vote->addVote($_POST['candidate_id']))
                    throw new Exception('Some Error has Occured');
                $_SESSION[$_POST['post_name']]=['candidate_id'=>$_POST['candidate_id'],'candidate_name'=>$_POST['candidate_name'],'candidate_regno'=>$_POST['regno']];
                }
                catch(Exception $e)
                {
                    die($e->getMessage());
                }
            }
             for ($i = 0; $i < count($post_array); $i++) {
                    $post_id_name[] = ['post_id' => $post_array[$i]['post_id'], 'post' => $post_array[$i]['post'],'post_shift'=>$post_array[$i]['post_shift']];
                }
                echo "<br>";
            
            if (!isset($_SESSION['init'])) 
            { //Problem Here!
                for ($i = 0; $i < count($post_array); $i++) {
                    $_SESSION[$post_array[$i]['post']] = 'Not_Voted';
                }
                $_SESSION['init'] = 'init';
            }
          
            $voted=false;
            for ($i = 0; $i < count($post_id_name); $i++) {
                $voted=true;
              
                if (isset($_SESSION[$post_id_name[$i]['post']]) && $_SESSION[$post_id_name[$i]['post']]=='Not_Voted') {
                    $voted=false;
                    echo "<h2>{$post_id_name[$i]['post']} - {$post_id_name[$i]['post_shift']}</h2>";
                    $post_id=$post_id_name[$i]['post_id'];
                    if($res=$can->readAllbyPost($post_id))
                    {
                        
                        $candidates=$res['data'];
                        echo "<table class='table'>";
                        for($j=0;$j<count($candidates);$j++)
                        {
                            echo "<tr><form action='' method='post'><td>{$candidates[$j]['candidate_id']}</td><td>{$candidates[$j]['name']} <input type='hidden' name='candidate_name' value='{$candidates[$j]['name']}' /></td><td>{$candidates[$j]['regno']} <input type='hidden' name='regno' value='{$candidates[$j]['regno']}' /></td><td>{$candidates[$j]['course']}</td><td><input type='hidden' name='candidate_id' value='{$candidates[$j]['candidate_id']}'/><input type='hidden' name='post_name' value='{$post_id_name[$i]['post']}'/><button class='btn btn-success' type='submit' name='add_vote'>Vote</button></td></form></tr>";
                        }
                        echo "<table>";
                    }
                    else
                    {
                        echo "No Candidates Available";
                    }
                    break;
                }
            }
            echo "";
            if($voted)
            {
                echo "<center>";
                echo "You Voted for <br/>";
                // print_r($_SESSION);
                foreach($_SESSION as $key=>$value)
                {
                    if($key=="user_select" || $key== "init")
                        continue;
                    echo "{$key} - {$value['candidate_name']} ({$value['candidate_regno']}) <br/>";
                }
                echo "<center>";
                session_destroy();
                header("Refresh:3");
            }
        }
        catch(Exception $e)
        {
            die("<center><b>{$e->getMessage()}</b><br>
            <form method='post'><button type='submit' class='btn btn-secondary' name='rechoose'>rechoose</button></form>
            </center>");
        }
          
            ?>
        </main>
    </div>
</body>

</html>