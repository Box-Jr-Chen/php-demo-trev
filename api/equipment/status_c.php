<?php 
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Credentials: true');    
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
     Access-Control-Allow-Methods,Authorization,X-Requested-With');
     header('Access-Control-Expose-Headers: *');

     include_once '../../config/Database_pg.php';
     include_once '../../models/STATUS_EQUIPMENT.php';

     $database = new Database();
     $db = $database->connect();


     $status = new STATUS($db);

     $data = json_decode(file_get_contents("php://input"));

     if(!isset($data->equipid) || empty($data->equipid))
     {
        print_r(json_encode(
            array('message'=> 'equipid error')
        ));exit;
     }
     if(!isset($data->brand) || empty($data->brand))
     {
        print_r(json_encode(
            array('message'=> 'brand error')
        ));exit;
     }   
     if(!isset($data->devip))
     {
        print_r(json_encode(
            array('message'=> 'devip error')
        ));exit;
     }
     if(!isset($data->subid))
     {
        print_r(json_encode(
            array('message'=> 'subid error')
        ));exit;
     }  
     if(!isset($data->opid))
     {
        print_r(json_encode(
            array('message'=> 'opid error')
        ));exit;
     }
     if(!isset($data->status))
     {
        print_r(json_encode(
            array('message'=> 'status error')
        ));exit;
     }  
     if(!isset($data->mode))
     {
        print_r(json_encode(
            array('message'=> 'mode error')
        ));exit;
     }
     if(!isset($data->linkstatus))
     {
        print_r(json_encode(
            array('message'=> 'linkstatus error')
        ));exit;
     }  
     if(!isset($data->palletno))
     {
        print_r(json_encode(
            array('message'=> 'palletno error')
        ));exit;
     }
     if(!isset($data->mission))
     {
        print_r(json_encode(
            array('message'=> 'mission error')
        ));exit;
     }  
     if(!isset($data->palletsize))
     {
        print_r(json_encode(
            array('message'=> 'palletsize error')
        ));exit;
     }
 

      $Robot->equipid = $data->equipid;
      $Robot->brand = $data->brand;
      $Robot->devip = $data->devip;
      $Robot->subid = $data->subid;
      $Robot->opid = $data->opid;
      $Robot->status = $data->status;
      $Robot->mode = $data->mode;
      $Robot->linkstatus = $data->linkstatus;
      $Robot->palletno = $data->palletno;
      $Robot->mission = $data->mission;
      $Robot->palletsize = $data->palletsize;

         if($Robot->create_update())
         {
             print_r(json_encode(
                 array('message'=> 'Status Created')
             ));
         }else{
             print_r(json_encode(
                 array('message'=> 'Status Not Created')
             ));
         }

?>