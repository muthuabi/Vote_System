<?php
    include_once('../connection/connection.php');
    class Vote
    {
        private $conn=null;
        private $table='votes';
        public $error=null;
        public function __construct($conn)
        {
            $this->conn=$conn;
        }
        public function createVote($can_id)
        {
            try
            {
            $incr=1;
            $qry="INSERT INTO {$this->table}(candidate_id,vote) VALUES(?,?);";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ii",$can_id,$incr);
            return $qry_prepare->execute();
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }

        }
        public function readCanidateVote($can_id)
        {
            try
            {
                $qry="SELECT * from {$this->table} where candidate_id=?";
                $qry_prepare=$this->conn->prepare($qry);
                $qry_prepare->bind_param("i",$can_id);
                $qry_prepare->execute();
                $res=$qry_prepare->get_result();
                return $res->fetch_assoc();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $this->$e=$e;
                return null;
            }
        }
        public function addVote($can_id)
        {
            try{
            if($this->readCanidateVote($can_id))
            {
                $qry="UPDATE {$this->table} SET vote=vote+1 where candidate_id=?";
                $qry_prepare=$this->conn->prepare($qry);
                $qry_prepare->bind_param("i",$can_id);
                $qry_prepare->execute();
                return $this->conn->affected_rows;
            }
            else
            {
                if(!$this->createVote($can_id))
                    throw new Exception('Some Error Occured in Vote Creation');
                return 1;
                
            }
            
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }

        }
    }
    $vote=new Vote($conn);
    // $start=microtime(true);
    // for($i=0;$i<350;$i++)
    // {
    //     $vote->addVote(73);
    //     $vote->addVote(74);
    //     $vote->addVote(84);
    //     $vote->addVote(82);
    //     $vote->addVote(81);
    //     $vote->addVote(73);
    //     $vote->addVote(74);
    //     $vote->addVote(84);
    //     $vote->addVote(82);
    //     $vote->addVote(81);
    //     $vote->addVote(75);
    //     $vote->addVote(76);
    //     $vote->addVote(77);
    //     $vote->addVote(80);
    //     $vote->addVote(79);
    //     $vote->addVote(78);
    //     $vote->addVote(83);
    // }
    // $end=microtime(true);
    // echo "The For loop time is ".($end-$start);

?>