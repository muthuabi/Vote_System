<?php
$academic_year=date('Y').'-'.((int)date('y')+1);
class Connection
{
    private $db_host='localhost';
    private $db_user='';
    private $db_password='';
    private $db_dbase='sxc_election';
    protected $conn;
    public function __construct()
    {
        try{
		$this->db_user=base64_decode("bXV0aHVhYmk=");
		$this->db_password=base64_decode("TXV0aHUqMTIz");
        $this->conn=new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_dbase);
        if($this->conn->connect_error)
            throw new Exception('Database Connection Failed');
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            die('Database Connection Failed');
        }

    }
    public function initConnection()
    {
        return $this->conn;
    }
    public function closeConnection()
    {
        $this->conn->close();
        return $this->conn;
    }

}
$db=new Connection();
$conn=$db->initConnection();
define('ROOT_DIR','SXC_VOTE_SYSTEM/');
?>