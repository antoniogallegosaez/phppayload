<?php

//HACKATHLONG API V0.1a

//error reporting
//error_reporting(E_ALL);
//ini_set('display_errors',TRUE);

//init headers
header('Access-Control-Allow-Origin: *');

require 'includes/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->contentType('application/json');


$app->get('/test', 'test');
$app->post('/reindeerservice', 'handler');

$app->run();

function test() {

    echo "test2";
}

//post function - function: /reindeerservice
function handler() {
    $request = \Slim\Slim::getInstance()->request();


    $data = json_decode($request->getBody());
    var_dump ($data);
   // echo json_encode($data);

    $payload_data = new stdClass();
    $payload_data->payload = new stdClass();

    //$payload_data->serviceName = $request->post('serviceName');
    $payload_data->serviceName = $data->serviceName;
    $payload_data->payload->teamName = $data->payload[0]->teamName;
    //$payload_data->payload->reindeerName = $data->payload->reindeerName;
    //$payload_data->payload->nameEmaiMap1 = $data->payload->nameEmaiMap1;
    //$payload_data->payload->nameEmaiMap2 = $data->payload->nameEmaiMap2;
    

    echo json_encode($payload_data);

    $reindeers = array();
    
    $dir = new DirectoryIterator("/etc/santas-config/..data/");
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot()) {
          $filename = $fileinfo->getFilename();
          $reindeers[] = file_get_contents ( "/etc/santas-config/..data/" . $filename );
      }
    }
    sort ($reindeers);
    var_dump ($reindeers);
   
}

?>
