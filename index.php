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
    $body = $request->getBody();
    $input = json_decode($body); 
    echo json_encode($body);

    //$data = getenv('data');
    $payload_data = new stdClass();
  //  $payload_data->serviceName = $request->post('serviceName');
    $payload_data->serviceName = 'placeholderserviceName';
    //$payload_data->serviceName = $request->getParsedBodyParam('serviceName');
    //$payload_data->payload->teamName = $request->post('teamName');
    //$payload_data->payload->reindeerName = $request->post('reindeerName');
    //$payload_data->payload->nameEmaiMap1 = $request->post('nameEmaiMap1');
    //$payload_data->payload->nameEmaiMap2 = $request->post('nameEmaiMap2');

    echo json_encode($payload_data);

    $dir = new DirectoryIterator("/etc/santas-config/..data/");
    foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $filename = $fileinfo->getFilename();
        var_dump($filename);
        echo (file_get_contents ( $filename ));
    }
}
    
}

?>
