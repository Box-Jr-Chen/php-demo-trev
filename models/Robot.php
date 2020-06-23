<?php
    class Robot{
        private $conn;
        private $table = 'public.equipment_robot_axis';
    
    
        public $ROBOTID;
        public $AXISSTATUS;
    
        public function __construct($db){
                $this->conn = $db;
        }
    
        //Get Users
        public function read(){
            //Create query
            $query = 'SELECT * FROM public.equipment_robot_axis' ;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    

            return $stmt;
        }
    }

?>