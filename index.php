<?php

//HACKATHLONG API V0.1a

//error reporting
//error_reporting(E_ALL);
//ini_set('display_errors',TRUE);

//init headers
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	// return only the headers and not the content
	// only allow CORS if we're doing a GET - i.e. no saving for now.
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: X-Requested-With');
	}
	exit;
}
else {
	header('Access-Control-Allow-Origin: *');
}

require 'includes/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->contentType('application/json');

$app->post('reindeerservice', 'handler');

$app->run();

//post function - function: /reindeerservice
function handler($id) {
    $request = \Slim\Slim::getInstance()->request();

    $data = getenv('data');

    $payload_data = new stdClass();
    $payload_data->serviceName = $request->post('serviceName');
    $payload_data->payload->teamName = $request->post('$teamName');
    $payload_data->payload->reindeerName = $request->post('$reindeerName');
    $payload_data->payload->nameEmaiMap1 = $request->post('$nameEmaiMap1');
    $payload_data->payload->nameEmaiMap2 = $request->post('$nameEmaiMap2');

    echo json_encode($payload_data);

}

?>
