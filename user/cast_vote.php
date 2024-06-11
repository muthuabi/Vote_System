<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Vote</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
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
            if (isset($_POST['rechoose'])) {
                session_destroy();
                header('location:index.php');
            }
            try {

                $valid_gender = ['M', 'F'];
                $valid_shift = ['Shift-I', 'Shift-II'];
                if (!isset($_SESSION['user_select'])) {
                    $_SESSION['user_select'] = 'Session_Over';
                }
                if (isset($_GET['shift']) && !empty(trim($_GET['shift'])) && in_array(trim(base64_decode($_GET['shift'])), $valid_shift)) {
                    $shift = base64_decode($_GET['shift']);
                } else {
                    throw new Exception('Invalid Shift Paramater');
                }
                if (isset($_GET['vote_gender']) && !empty(trim($_GET['vote_gender'])) && in_array(trim(base64_decode($_GET['vote_gender'])), $valid_gender)) {
                    $vote_gender = base64_decode($_GET['vote_gender']);
                } else {
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
                echo "<form method='post' style='width:fit-content;position:fixed;top:0;'><button type='submit' class='btn btn-secondary opacity-hover'  name='rechoose'>rechoose</button></form>";
                
            ?>
        </header>
        
        <main class="d-flex flex-column  justify-content-center align-items-center  w-100  ">
        <?php
            if (isset($_POST['add_vote'])) {
                    try {
                        if (!$vote->addVote($_POST['candidate_id']))
                            throw new Exception('Some Error has Occured');
                        $_SESSION[$_POST['post_name']] = ['candidate_id' => $_POST['candidate_id'], 'candidate_name' => $_POST['candidate_name'], 'candidate_regno' => $_POST['regno']];
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
                for ($i = 0; $i < count($post_array); $i++) {
                    $post_id_name[] = ['post_id' => $post_array[$i]['post_id'], 'post' => $post_array[$i]['post'], 'post_shift' => $post_array[$i]['post_shift']];
                }
                echo "<br>";

                if (!isset($_SESSION['init'])) { //Problem Here!
                    for ($i = 0; $i < count($post_array); $i++) {
                        $_SESSION[$post_array[$i]['post']] = 'Not_Voted';
                    }
                    $_SESSION['init'] = 'init';
                }

                $voted = false;
                for ($i = 0; $i < count($post_id_name); $i++) {
                    $voted = true;

                    if (isset($_SESSION[$post_id_name[$i]['post']]) && $_SESSION[$post_id_name[$i]['post']] == 'Not_Voted') {
                        $voted = false;
                        echo "<h2 class='p-2 text-uppercase '>{$post_id_name[$i]['post']} - "; 
                        echo ($post_id_name[$i]['post_shift']=='Both')?'(Shift I & II)':$post_id_name[$i]['post_shift'];
                        echo"</h2>";
                        $post_id = $post_id_name[$i]['post_id'];
                        if ($res = $can->readAllbyPost($post_id)) {

                            $candidates = $res['data'];
                            echo "<div class='candidates-container'>";
                            for ($j = 0; $j < count($candidates); $j++) {
                                echo "<form class='card candidate-card' action='' method='post' id='can{$candidates[$j]['candidate_id']}' style='width: 350px'>
                                <div class='card-img-container'>
                                <img src='{$candidates[$j]['image_url']}' class='card-img-top' alt=''>
                                </div>
                                <div class='card-body '>
                                <h5 class='card-title d-flex align-items-center gap-1' id='candidate_name'>{$candidates[$j]['name']}</h5>
                                <b class='card-text' id='candidate_regno'>{$candidates[$j]['regno']}</b>
                                </div>
                                <ul class='list-group list-group-flush'>
                                <li class='list-group-item' id='candidate_course'>{$candidates[$j]['course']}</li>
                                <button class='btn btn-success' type='submit' name='add_vote'>Vote</button>
                                </ul>
                                <input type='hidden' name='candidate_name' value='{$candidates[$j]['name']}' />
                                <input type='hidden' name='regno' value='{$candidates[$j]['regno']}' />
                                <input type='hidden' name='candidate_id' value='{$candidates[$j]['candidate_id']}'/>
                                <input type='hidden' name='post_name' value='{$post_id_name[$i]['post']}'/>
                               
                            </form>";
                            }
                            echo "<div>";
                        } else {
                            echo "No Candidates Available";
                        }
                        break;
                    }
                }
                echo "";
                if ($voted) {
                    // echo "<center>";
                    // echo "You Voted for <br/>";
                    // // print_r($_SESSION);
                    // 
                    // echo "<center>";
                    echo "<div class='modal fade result-modal' style='display:block;z-index:10000;opacity:100%'  data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='responsemodalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered '>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                <h3 class='modal-title'>Thank You for Voting!</h3>
                               
                                </div>
                                <div class='modal-body d-flex flex-column align-items-center'>
                                    <span id='icon' style='font-size:70px'>&#9432;</span>
                                    <table style='width:fit-content'>
                                        ";
                                    foreach ($_SESSION as $key => $value) {
                                                if ($key == "user_select" || $key == "init")
                                                    continue;
                                                echo "<tr><th style='text-align:left'>{$key}</th><td style='width:20px'></td><td>{$value['candidate_name']} ({$value['candidate_regno']})</td></tr>";
                                            }
                                    echo "</table>
                                    
                                </div>
                                <div class='modal-footer d-flex justify-content-center'>
                                    <b>SXC VOTE SYSTEM</b>
                                </div>
                            </div>
                            </div>
                        </div>";
                    session_destroy();
                    header("Refresh:3");
                }
            } catch (Exception $e) {
                die("<center><b>{$e->getMessage()}</b><br>
            <form method='post'><button type='submit' class='btn btn-secondary opacity-hover' name='rechoose'>rechoose</button></form>
            </center>");
            }

        ?>
        </main>
    </div>
</body>

</html>