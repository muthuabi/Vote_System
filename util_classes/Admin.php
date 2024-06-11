<?php

    include_once("../connection/connection.php");
    class Admin
    {
        private $conn;
        private $table='admin';
        public $username='';
        public $password='';
        public $email='';
        public $error=null;
        public function __construct($conn)
        {
            $this->conn=$conn;
        }
        public function validate_admin($username,$password)
        {
            $password=base64_encode($password);

            try
            {
            $qry="Select * from {$this->table} where username=? and password=?";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ss",$username,$password);
            $qry_prepare->execute();
            $res=$qry_prepare->get_result();
            $data=$res->fetch_assoc();
            if($res->num_rows==0)
                throw new Exception('Not Valid');
            return $data;
            }
            catch(Exception $e)
            {
                $this->error=$e;
                return null;
            }

        }
        public function change_admin_password($new_pass,$username)
        {
            $new_pass=base64_encode($new_pass);
            try{
            $qry="UPDATE {$this->table} SET password=?  where username=?";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("ss",$new_pass,$username);
            $qry_prepare->execute();
            if(!$this->conn->affected_rows)
                return true;                
            }
            catch(Exception $e)
            {
                $this->error=$e;
                echo $e->getMessage();
                return null;
            }
        }
        public function insert_admin($username,$name,$password,$email,$role)
        {
            try
            {
            $qry="Insert Into {$this->table}(`username`,`name`,`password`,`email`,`role`) VALUES(?,?,?,?,?)";
            $qry_prepare=$this->conn->prepare($qry);
            $qry_prepare->bind_param("sssss",$username,$name,$password,$email,$role);
            return $qry_prepare->execute();
            }
            catch(Exception $e)
            {
                $this->error=$e;
                return null;
            }

        }

    }
    $admin=new Admin($conn);
    // $admin->change_admin_password('1234565','muthuabi');
?>