<?php
    class User{
        private $conn;
        private $table = 'EQUIPMENT_ROBOT_AXIS';
    
    
        public $ROBOTID;
        public $AXISSTATUS;
    
        public function __construct($db){
                $this->conn = $db;
        }
    
        //Get Users
        public function read(){
            //Create query
            $query = 'SELECT * FROM dbo.[EQUIPMENT_ROBOT_AXIS]' ;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    

            return $stmt;
        }
    }

?>