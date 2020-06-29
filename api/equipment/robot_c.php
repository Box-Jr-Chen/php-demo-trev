<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Credentials: true');    
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
     Access-Control-Allow-Methods,Authorization,X-Requested-With');
     header('Access-Control-Expose-Headers: *');

     include_once '../../config/Database_pg.php';
     include_once '../../models/Robot.php';

     $database = new Database();
     $db = $database->connect();


     $Robot = new Robot($db);

     $data = json_decode(file_get_contents("php://input"));

     if(!isset($data->robotid) || empty($data->robotid))
     {
        print_r(json_encode(
            array('message'=> 'robotid error')
        ));exit;
     }
     if(!isset($data->axisstatus) || empty($data->axisstatus))
     {
        print_r(json_encode(
            array('message'=> 'axisstatus error')
        ));exit;
     }   

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