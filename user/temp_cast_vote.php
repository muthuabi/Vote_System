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
            $_SESSION['shift'] = 'Shift-I';
            $_SESSION['voter_gender'] = 'M';
            $voter_gender = $_SESSION['voter_gender'];
            $shift = $_SESSION['shift'];

            include_once("../util_classes/Position.php");
            include_once("../util_classes/Candidates.php");
            try {
                if ($data = $pos->readShiftGenderAll($shift, $voter_gender)) {
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
            //print_r($post_array);
            if (isset($_POST['add_vote'])) {

                print_r($_POST);
                $_SESSION[$_POST['post_name']]=$_POST['candidate_id'];
            }
             for ($i = 0; $i < count($post_array); $i++) {
                    $post_id_name[] = ['post_id' => $post_array[$i]['post_id'], 'post' => $post_array[$i]['post']];
                }
            if (!isset($_SESSION['init'])) {
                for ($i = 0; $i < count($post_array); $i++) {
                    $_SESSION[$post_array[$i]['post']] = 'Not_Voted';
                }
                $_SESSION['init'] = 'init';
            }
            print_r($_SESSION);
            echo "<form action='' method='post'>";
            for ($i = 0; $i < count($post_id_name); $i++) {
                if (isset($_SESSION[$post_id_name[$i]['post']]) && $_SESSION[$post_id_name[$i]['post']]=='Not_Voted') {
                    echo "<h2>{$post_id_name[$i]['post']}</h2>";
                    $post_id=$post_id_name[$i]['post_id'];
                    if($res=$can->readAllbyPost($post_id))
                    {
                        $candidates=$res['data'];
                        echo "<table class='table'>";
                        for($j=0;$j<count($candidates);$j++)
                        {
                            echo "<tr><td>{$candidates[$j]['name']}</td><td>{$candidates[$j]['regno']}</td><td>{$candidates[$j]['course']}</td><td><input type='hidden' name='candidate_id' value='{$candidates[$j]['candidate_id']}'/><input type='hidden' name='post_name' value='{$post_id_name[$i]['post']}'/><button class='btn btn-success' type='submit' name='add_vote'>Vote</button></td></tr>";
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
            echo "</form>";
            ?>
        </main>
    </div>
</body>

</html>