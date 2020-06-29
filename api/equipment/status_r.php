<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     include_once '../../config/Database_pg.php';
     include_once '../../models/STATUS_EQUIPMENT.php';

     $database = new Database();
     $db = $database->connect();


     $status = new STATUS($db);

     $result = $status->read();

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
                'equipid' => $equipid,
                'brand' => $brand,
                'devip' => $devip,
                'subid' => $subid,
                'opid' => $opid,
                'status' => $status,
                'mode' => $mode,
                'linkstatus' => $linkstatus,
                'palletno' => $palletno,
                'mission' => $mission,
                'palletsize' => $palletsize
            );
            array_push($posts_arr['data'],$posts_item);
        }

        print_r(json_encode($posts_arr));

?>