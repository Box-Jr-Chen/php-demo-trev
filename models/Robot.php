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
            $query = 'SELECT * FROM '.$this->table ;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    

            return $stmt;
        }
        public function create_update(){
            //Create query
                    //$query = 'INSERT INTO  '.$this->table.' (robotid,axisstatus) VALUES (:robotid,:axisstatus) ' ;
            //  $query = 'CREATE OR REPLACE FUNCTION upsert_robotaxis(key varchar, data  text) RETURNS VOID AS $$ 
            //             DECLARE 
            //             BEGIN 
            //                 UPDATE '.$this->table.' SET axisstatus = :axisstatus WHERE robotid = :robotid; 
            //                 IF NOT FOUND THEN 
            //                 INSERT INTO '.$this->table.' values (:robotid,:axisstatus); 
            //                 END IF; 
            //             END;
            //             $$ 
            //             LANGUAGE plpgsql;';


            $query = 'CREATE OR REPLACE FUNCTION increment(i integer) RETURNS VOID AS $$
            BEGIN
                    INSERT INTO '.$this->table.' values (:robotid,:axisstatus); 
            END;
            $$ LANGUAGE plpgsql;';

            $stmt = $this->conn->prepare($query);

             $this->robotid = htmlspecialchars( strip_tags($this->robotid));
             $this->axisstatus = htmlspecialchars( strip_tags($this->axisstatus));

             $stmt->bindParam(':robotid',$this->robotid);
             $stmt->bindParam(':axisstatus',$this->axisstatus);

          //  echo ($query);

             if($stmt->execute()){
                 return true;
             }
            

             return false;
        }
    }

?>