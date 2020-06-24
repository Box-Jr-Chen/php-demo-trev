<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
     Access-Control-Allow-Methods,Authorization,X-Requested-With');

     include_once '../../config/Database_pg.php';
     include_once '../../models/AGV.php';

     $database = new Database();
     $db = $database->connect();


     $AGV = new AGV($db);

     $data = json_decode(file_get_contents("php://input"));

     if(!isset($data->robotid) || empty($data->robotid))
     {
        print_r(json_encode(
            array('message'=> 'robotid error')
        ));exit;
     }
     if(!isset($data->pos_x) )
     {
        print_r(json_encode(
            array('message'=> 'pos_x error')
        ));exit;
     }   
     if(!isset($data->pos_y) )
     {
        print_r(json_encode(
            array('message'=> 'pos_y error')
        ));exit;
     }   
     if(!isset($data->rotation) )
     {
        print_r(json_encode(
            array('message'=> 'rotation error')
        ));exit;
     }   



      $AGV->robotid = $data->robotid;
      $AGV->pos_x = $data->pos_x;
      $AGV->pos_y = $data->pos_y;
      $AGV->rotation = $data->rotation;

         if($AGV->create_update())
         {
             print_r(json_encode(
                 array('message'=> 'Robot Created')
             ));
         }else{
             print_r(json_encode(
                 array('message'=> 'Robot Not Created')
             ));
         }

?>