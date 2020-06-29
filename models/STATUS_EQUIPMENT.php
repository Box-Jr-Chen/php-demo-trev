<?php
    class STATUS{
        private $conn;
        private $table = 'equipment';
    
    
        public $equipid;
        public $brand;
        public $devip;
        public $subid;
        public $opid;
        public $status;
        public $mode;
        public $linkstatus;
        public $palletno;
        public $mission;
        public $palletsize;

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

            $query = 'CREATE OR REPLACE FUNCTION merge_db(key varchar,brand_c varchar,devip_c varchar,subid_c varchar,opid_c varchar,status_c integer,mode_c integer,linkstatus_c integer,palletno_c varchar,mission_c varchar,palletsize_c varchar) RETURNS VOID AS
            $$
            BEGIN
                    UPDATE '.$this->table.' SET brand =brand_c,devip=devip_c,subid=subid_c,opid=opid_c,status=status_c,mode=mode_c,linkstatus=linkstatus_c,palletno=palletno_c,mission=mission_c,palletsize=palletsize_c  WHERE equipid = key;
                    IF found THEN
                        RETURN;
                    END IF;
 
                    BEGIN
                        INSERT INTO '.$this->table.' (equipid,brand,devip,subid,opid,status,mode,linkstatus,palletno,mission,palletsize) VALUES (key, brand_c,devip_c,subid_c,opid_c,status_c,mode_c,linkstatus_c,palletno_c,mission_c,palletsize_c);
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

                $query2 = 'SELECT merge_db(:equipid,:brand,:devip,:subid,:opid,:status_c,:mode,:linkstatus,:palletno,:mission,:palletsize);';
                $stmt2 = $this->conn->prepare($query2);

                $this->equipid = htmlspecialchars( strip_tags($this->equipid));
                $this->brand = htmlspecialchars( strip_tags($this->brand));
                $this->devip = htmlspecialchars( strip_tags($this->devip));
                $this->subid = htmlspecialchars( strip_tags($this->subid));
                $this->opid = htmlspecialchars( strip_tags($this->opid));
                $this->status = htmlspecialchars( strip_tags($this->status));
                $this->mode = htmlspecialchars( strip_tags($this->mode));
                $this->linkstatus = htmlspecialchars( strip_tags($this->linkstatus));
                $this->palletno = htmlspecialchars( strip_tags($this->palletno));
                $this->mission = htmlspecialchars( strip_tags($this->mission));
                $this->palletsize = htmlspecialchars( strip_tags($this->palletsize));
               $stmt2->bindParam(':equipid',$this->equipid);
               $stmt2->bindParam(':brand',$this->brand);
               $stmt2->bindParam(':devip',$this->devip);
               $stmt2->bindParam(':subid',$this->subid);
               $stmt2->bindParam(':opid',$this->opid);
               $stmt2->bindParam(':status_c',$this->status);
               $stmt2->bindParam(':mode',$this->mode);
               $stmt2->bindParam(':linkstatus',$this->linkstatus);
               $stmt2->bindParam(':palletno',$this->palletno);
               $stmt2->bindParam(':mission',$this->mission);
               $stmt2->bindParam(':palletsize',$this->palletsize);
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