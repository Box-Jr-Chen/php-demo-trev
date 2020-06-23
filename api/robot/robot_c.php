<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
     Access-Control-Allow-Methods,Authorization,X-Requested-With');

     include_once '../../config/Database_pg.php';
     include_once '../../models/Robot.php';

     $database = new Database();
     $db = $database->connect();


     $Robot = new Robot($db);

     $data = json_decode(file_get_contents("php://input"));

      $Robot->robotid = $data->robotid;
      $Robot->axisstatus = $data->axisstatus;


         if($Robot->create_update())
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