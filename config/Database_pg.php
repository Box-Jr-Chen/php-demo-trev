<?php
    class Database {
        private $host = 'ec2-34-202-88-122.compute-1.amazonaws.com';
        private $username = 'qrfvrgwpdvfmfv';
        private $password = '902d7f43add539c25224eef0545ff82c72705c4aee42816d978ca52a4786bce2';
        private $db_name = 'dakgm7lcpvk9u';
        private $port = '5432';
        private $conn ;

        public function connect(){
            $this->conn = null;

            try
            {
                $this->conn = new PDO('pgsql:host='.$this->host.';port='.$this->port.';dbname='. $this->db_name.
                ';user='.$this->username.';password='.$this->password,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            }
            catch(PDOException $e)
            {
                 echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }
?>