<?php
    class Robot{
        private $conn;
        private $table = 'equipment_robot_axis';
    
    
        public $ROBOTID;
        public $AXISSTATUS;
    
        public function __construct($db){
                $this->conn = $db;
        }
    
        //Get Users
        public function read(){
            //Create query
            $query = 'SELECT * FROM equipment_robot_axis' ;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    

            return $stmt;
        }
    }

?>