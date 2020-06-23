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


            $query = 'CREATE OR REPLACE FUNCTION merge_db(key varchar, data TEXT) RETURNS VOID AS
            $$
            BEGIN
                    UPDATE '.$this->table.' SET axisstatus = data WHERE robotid = key;
                    IF found THEN
                        RETURN;
                    END IF;
 
                    BEGIN
                        INSERT INTO '.$this->table.' (robotid,axisstatus) VALUES (key, data);
                        RETURN;
                    EXCEPTION WHEN unique_violation THEN

                    END;
            END;
            $$
            LANGUAGE plpgsql;';
            //SELECT merge_db(:robotid, :axisstatus);';

            $stmt = $this->conn->prepare($query);


          //  echo ($query);

             if($stmt->execute()){

                $query2 = 'SELECT merge_db(:robotid, :axisstatus);';
                $stmt2 = $this->conn->prepare($query2);

                $this->robotid = htmlspecialchars( strip_tags($this->robotid));
                $this->axisstatus = htmlspecialchars( strip_tags($this->axisstatus));
   
               $stmt2->bindParam(':robotid',$this->robotid);
               $stmt2->bindParam(':axisstatus',$this->axisstatus);

                if( $stmt2->execute())
                {
                    return true;
                }


                 return false;
             }
            

             return false;
        }
    }

?>