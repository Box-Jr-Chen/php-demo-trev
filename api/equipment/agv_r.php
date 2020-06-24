<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     include_once '../../config/Database_pg.php';
     include_once '../../models/AGV.php';

     $database = new Database();
     $db = $database->connect();


     $AGV = new AGV($db);

     $result = $AGV->read();

     $num = $result->rowCount();

        $posts_arr = array();
        $posts_arr['data'] = array();
        $posts_item =null;
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $posts_item = array(
                'id' => $robotid,
                'pos_x' => $pos_x,
                'pos_y' => $pos_y,
                'rotation' => $rotation,
            );
            array_push($posts_arr['data'],$posts_item);
        }

        print_r(json_encode($posts_arr));

?>