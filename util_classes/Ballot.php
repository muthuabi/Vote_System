<?php
    include_once('../connection/connection.php');
    class Ballot
    {
        private $conn=null;
        private $table1='candidates';
        private $table2='position';
        private $table3='votes';
        public $error=null;
        public function __construct($conn)
        {
            $this->conn=$conn;
        }
        public function showBallotAll()
        {
            try{
            $qry="SELECT c.name,p.post,v.vote FROM {$this->table1} as c inner join {$this->table2} as p on p.post_id=c.post_id left join {$this->table3} as v on c.candidate_id=v.candidate_id";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->execute();
            $res=$qry_prepare->get_result();
            $votes=[];
            while($result=$res->fetch_assoc())
            {
                $votes[]=$result;
            }
            return ['data'=>$votes,'num_rows'=>$res->num_rows];
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }

    }
    $ballot=new Ballot($conn);
    if(isset($_GET['BALLOT_ALL']))
    {
        echo json_encode($ballot->showBallotAll());
    }
?>