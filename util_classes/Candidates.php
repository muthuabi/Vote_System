<?php 
    include_once('../connection/connection.php');
    // Utitlity Class to Manipulae table 'candidates';
    class Candidate
    {
        private $conn;
        private $table='candidates';
        private $file_target;
        public $candidate_id=null;
        public $regno=null;
        public $name='';
        public $course='';
        public $year=3;
        public $post_id=null;
        public $vote_count=0;
        public $image_url=null;
        public $shift=null;
        public $error=null;
        public function __construct($conn)
        {
            $this->file_target="../assets/images/candidate_images/".date('Y')."/";
            $this->conn=$conn;
        }
        public function readAll()
        {
            try{
            $qry="Select * from {$this->table}";
            $res=$this->conn->query($qry);
            $position=[];
            while($result=$res->fetch_assoc())
            {
                $position[]=$result;
            }
            return ['data'=>$position,'num_rows'=>$res->num_rows];
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
        public function readAllbyPost($id)
        {
            try{
            $qry="Select * from {$this->table} where post_id=?";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("i",$id);
            $qry_prepare->execute();
            $res=$qry_prepare->get_result();
            $position=[];
            while($result=$res->fetch_assoc())
            {
                $position[]=$result;
            }
            return ['data'=>$position,'num_rows'=>$res->num_rows];
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
        public function readOne($id)
        {
            try
            {
                $qry="SELECT * From {$this->table} where candidate_id=?";
                $qry_prepare=$this->conn->prepare($qry);
                $qry_prepare->bind_param("i",$id);
                $qry_prepare->execute();
                $res=$qry_prepare->get_result();
                return $res->fetch_assoc();
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
        public function fileUpload($file)
        {
            try
            {
            $target=$this->file_target;
            if(!file_exists($target))
                mkdir($target,0777);
            $fname=$target.$file['name'];
            if(move_uploaded_file($file['tmp_name'],$fname))
            {
                $this->image_url=$fname;
                return $this->image_url;
            }
            }
            catch(Exception $e)
            {
                $this->error=$e;
                return null;
            }
        }
        public function fileDelete($image_delete_url)
        {
            try{
            if(file_exists($image_delete_url))
            {
                unlink($image_delete_url);
                return true;
            }
            else 
            {
                throw new Exception('File Deletion Failed');
            }
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        public function fileUpdate($file)
        {
            try
            {
            $target=$this->file_target;
            $fname=$target.$file['name'];
            $this->fileDelete($fname);
            if(move_uploaded_file($file['tmp_name'],$fname))
            {
                $this->image_url=$fname;
                return $this->image_url;
            }
            }
            catch(Exception $e)
            {
                $this->error=$e;
                return null;
            }

        }
        public function insert()
        {
           
            try
            {
            if($this->shift!='Shift-I' && $this->shift!='Shift-II')
            {
                throw new Exception('Shift Shoulde be either 1 or 2');
            }
            $qry="INSERT INTO {$this->table} (`regno`,`name`,`shift`,`course`,`year`,`post_id`,`vote_count`,`image_url`) VALUES (?,?,?,?,?,?,?,?)";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ssssiiis",$this->regno,$this->name,$this->shift,$this->course,$this->year,$this->post_id,$this->vote_count,$this->image_url);
            return $qry_prepare->execute();
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
        public function deleteOne($id)
        {
            try
            {
                if($val=$this->readOne($id))
                    $url=$val['image_url'];
                $qry="DELETE FROM {$this->table} where candidate_id=?";
                $qry_prepare=$this->conn->prepare($qry);
                $qry_prepare->bind_param("i",$id);
                $qry_prepare->execute();
                $this->fileDelete($url);
                $this->error=null;
                return $this->conn->affected_rows;
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return 0;
            }
        }
        public function deleteAll()
        {
            try
            {
                $qry="DELETE FROM {$this->table}";
                $qry_prepare=$this->conn->prepare($qry);
                $qry_prepare->execute();
                return $this->conn->affected_rows;
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return 0;
            }
        }
        public function update($id)
        {
            try{
            $qry="UPDATE {$this->table} SET `regno`=?,`name`=?,`shift`=?,`course`=?,`year`=?,`post_id`=?,`vote_count`=?,`image_url`=? where candidate_id=?";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ssssiiisi",$this->regno,$this->name,$this->shift,$this->course,$this->year,$this->post_id,$this->vote_count,$this->image_url,$id);
            $qry_prepare->execute();
            $this->error=null;
            return $this->conn->affected_rows;
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
    }
    $can=new Candidate($conn);
    // print_r($candidate->readAll());
    // $candidate->regno='21UCS108';
    // $candidate->name="Krishnan M";
    // $candidate->course='BSC CS';
    // $candidate->year=1;
    // $candidate->post_id=11;
    // $candidate->vote_count=0;
    // $candidate->image_url="htpps:";
    // $candidate->shift='1';
    // echo $candidate->deleteOne(2);
?>