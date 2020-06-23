<?php
    class Database {
        private $host = 'E9539-01-PC';
        private $db_name = 'A38_DB';
        private $username = 'e10809';
        private $password = 'e10809';
        private $conn ;

        public function connect(){
            $this->conn = null;

            try
            {
                $this->conn = new PDO('sqlsrv:Server='.$this->host.';Database='. $this->db_name,
                $this->username,$this->password);
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