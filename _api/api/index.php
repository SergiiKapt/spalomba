<?php

require __DIR__.'/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$headers = array ();
foreach ($_SERVER as $name => $value)
{
    if (substr($name, 0, 5) == 'HTTP_')
    {
        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
    }
}
//var_dump('Authorization');
//var_dump($headers['Authorization']);die;
if($headers['Authorization'] != 1234){
//    var_dump($headers['Authorization']);die;
}
//var_dump(in_array('Authorization', $headers ));die;

use api\core\Route;

try {
    Route::dispatch();
}
catch (Exception $e) {
        echo json_encode(Array('error' => $e->getMessage()));
}
