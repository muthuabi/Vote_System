<?php
include_once('../connection/connection.php');
// Utitlity Class to Manipulae table 'position';
class Position
{
    private $conn;
    private $table = 'position';
    public $post_id = null;
    public $post = null;
    public $description = '';
    public $shift = null;
    public $error=null;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function readAll()
    {
        try {
            $qry = "Select * from {$this->table}";
            $res = $this->conn->query($qry);
            $position = [];
            while ($result = $res->fetch_assoc()) {
                $position[] = $result;
            }
            return ['data' => $position, 'num_rows' => $res->num_rows];
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->error=$e;
            return null;
        }
    }
    public function readShiftAll($shift)
    {
        try {
            $qry = "Select * from {$this->table} where post_shift=?";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("s",$shift);
            $qry_prepare->execute();
            $res=$qry_prepare->get_result();
            $position = [];
            while ($result = $res->fetch_assoc()) {
                $position[] = $result;
            }
            return ['data' => $position, 'num_rows' => $res->num_rows];
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->error=$e;
            return null;
        }
    }
    public function readShiftGenderAll($shift,$gender)
    {
        try {
            $qry = "Select * from {$this->table} where (post_shift=? or post_shift='Both') and (who_can_vote=? or who_can_vote='MF'); ";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ss",$shift,$gender);
            $qry_prepare->execute();
            $res=$qry_prepare->get_result();
            $position = [];
            while ($result = $res->fetch_assoc()) {
                $position[] = $result;
            }
            return ['data' => $position, 'num_rows' => $res->num_rows];
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->error=$e;
            return null;
        }
    }
    public function readOne($id)
    {
        try {
            $qry = "SELECT * From {$this->table} where post_id=?";
            $qry_prepare = $this->conn->prepare($qry);
            $qry_prepare->bind_param("i", $id);
            $qry_prepare->execute();
            $res = $qry_prepare->get_result();
            return $res->fetch_assoc();
        } catch (Exception $e) {
            $this->error=$e;
            echo $e->getMessage();
            return null;
        }
    }
    public function insert()
    {

        try {
            if ($this->shift != 'Shift-I' && $this->shift != 'Shift-II') {
                throw new Exception('Shift Shoulde be either 1 or 2');
            }
            $qry = "INSERT INTO {$this->table} (`post`,`description`,`post_shift`) VALUES (?,?,?)";
            $qry_prepare = $this->conn->prepare($qry);
            $qry_prepare->bind_param("sss", $this->post, $this->description, $this->shift);
            return $qry_prepare->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->error=$e;
            return null;
        }
    }
    public function deleteOne($id)
    {
        try {
            $qry = "DELETE FROM {$this->table} where post_id=?";
            $qry_prepare = $this->conn->prepare($qry);
            $qry_prepare->bind_param("i", $id);
            $qry_prepare->execute();
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->error=$e;
            return 0;
        }
    }
    public function deleteAll()
    {
        try {
            $qry = "DELETE FROM {$this->table}";
            $qry_prepare = $this->conn->prepare($qry);
            $qry_prepare->execute();
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            $this->error=$e;
            echo $e->getMessage();
            return 0;
        }
    }
    public function update($id)
    {
        try {
            if ($this->shift != 'Shift-I' && $this->shift != 'Shift-II') {
                throw new Exception('Shift Shoulde be either 1 or 2');
            }
            $qry = "UPDATE {$this->table} SET `post`=?,`description`=?,`post_shift`=? where post_id=?";
            $qry_prepare = $this->conn->prepare($qry);
            $qry_prepare->bind_param("sssi", $this->post, $this->description, $this->shift, $id);
            $qry_prepare->execute();
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            $this->error=$e;
            echo $e->getMessage();
            return 0;
        }
    }
}
$pos = new Position($conn);
// print_r($pos->readAll());
