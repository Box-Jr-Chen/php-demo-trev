<?php
    class AGV{
        private $conn;
        private $table = 'equipment_pos';
    
    
        public $robotid;
        public $pos_x;
        public $pos_y;
        public $rotation;
        
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

            $query = 'CREATE OR REPLACE FUNCTION merge_db(key varchar, posx float, posy float, ro float) RETURNS VOID AS
            $$
            BEGIN
                    UPDATE '.$this->table.' SET pos_x = posx,pos_y = posy,rotation = ro WHERE robotid = key;
                    IF found THEN
                        RETURN;
                    END IF;
 
                    BEGIN
                        INSERT INTO '.$this->table.' (robotid,pos_x,pos_y,rotation) VALUES (key, posx,posy,ro);
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

                $query2 = 'SELECT merge_db(:robotid, :pos_x,:pos_y,:rotation);';
                $stmt2 = $this->conn->prepare($query2);

                $this->robotid = htmlspecialchars( strip_tags($this->robotid));
                $this->pos_x = htmlspecialchars( strip_tags($this->pos_x));
                $this->pos_y = htmlspecialchars( strip_tags($this->pos_y));
                $this->rotation = htmlspecialchars( strip_tags($this->rotation));
               $stmt2->bindParam(':robotid',$this->robotid);
               $stmt2->bindParam(':pos_x',$this->pos_x);
               $stmt2->bindParam(':pos_y',$this->pos_y);
               $stmt2->bindParam(':rotation',$this->rotation);
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