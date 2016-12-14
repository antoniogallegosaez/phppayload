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
 //   var_dump ($data);
   // echo json_encode($data);

    $payload_data = new stdClass();
    $payload_data->payload[] = new stdClass();
    //$payload_data->serviceName = $request->post('serviceName');
    $payload_data->serviceName = $data->serviceName;
    //$payload_data->payload->teamName = $data->payload[0]->teamName;
    //$payload_data->payload->reindeerName = $data->payload[0]->reindeerName;
    //$payload_data->payload->nameEmaiMap = $data->payload[0]->nameEmaiMap;
    
   // var_dump ($data->payload[0]);
  //  echo json_encode($payload_data);
    //var_dump ($payload_data);

    $reindeers = array($data->payload[0]->reindeerName);
    
    $dir = new DirectoryIterator("/etc/santas-config/..data/");
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot()) {
          $filename = $fileinfo->getFilename();
          $reindeers[] = file_get_contents ( "/etc/santas-config/..data/" . $filename );
      }
    }
    natcasesort ($reindeers);
    
   //this is supposed to add one object to the payload array for each reindeer
    foreach ($reindeers as $key => $reindeer) {
        //var_dump ($key);
        //var_dump ($reindeer);
        $payload_data->payload[$key] = new stdClass();
        $payload_data->payload[$key]->teamName = $data->payload[0]->teamName;
        $payload_data->payload[$key]->reindeerName = $reindeer;
        $payload_data->payload[$key]->nameEmaiMap = $data->payload[0]->nameEmaiMap;
       // var_dump ($payload_data);
    }
 // var_dump ($payload_data);
  echo json_encode($payload_data);
    //todo send post request to proxy service

    $url = 'http://proxy-api:8080';
$post_data = json_encode($payload_data);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);
    
}



?>
