<?php
    class Robot{
        private $conn;
        private $table = 'equipment_robot_axis';
    
    
        public $robotid;
        public $axisstatus;
    
        public function __construct($db){
                $this->conn = $db;
        }
    
        //Get Users
        public function read(){
            //Create query
            $query = 'SELECT * FROM '.$this->equipment_robot_axis ;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    

            return $stmt;
        }
        public function create(){
            //Create query
            $query = 'INSERT INTO  '.
            $this->equipment_robot_axis.' 
            (robotid,axisstatus)
            VALUES 
            (:robotid,:axisstatus)
            ' ;
            $stmt = $this->conn->prepare($query);

            $this->robotid = htmlspecialchars( strip_tags($this->robotid));
            $this->axisstatus = htmlspecialchars( strip_tags($this->axisstatus));

            $stmt->bindParam(':robotid',$this->robotid);
            $stmt->bindParam(':axisstatus',$this->axisstatus);

            if($stmt->execute()){
                return true;
            }
            

            return false;
        }
    }

?>