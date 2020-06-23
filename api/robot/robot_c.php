<?php 
    // header('Access-Control-Allow-Origin: *');
   //  header('Content-Type: application/json');
     include_once '../../config/Database_pg.php';
     include_once '../../models/Robot.php';

     $database = new Database();
     $db = $database->connect();


     $Robot = new Robot($db);

     $result = $Robot->read();

     $num = $result->rowCount();
    // //Check if any users
    // //if($num > 0){
         $posts_arr = array();
        $posts_arr['data'] = array();
        $posts_item =null;
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);


            $AXIS = json_decode($axisstatus, true);
           
            $axisArray = array();
           foreach($AXIS as $a)
           {
                array_push($axisArray,$a);
           } 

            $posts_item = array(
                'id' => $robotid,
                'axisstatus' => $axisArray
            );
            array_push($posts_arr['data'],$posts_item);
        }

        echo json_encode($posts_arr);

?>