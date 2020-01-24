<?php
//http://www.greenacorn-websolutions.com/php/working-with-nusoap.php
require_once "lib/nusoap.php";
date_default_timezone_set('Asia/Bangkok');
 
class food {
 
    public function getFood($type) {
        switch ($type) {
            case 'starter':
                return 'Soup';
                break;
            case 'Main':
                return 'Curry';
                break;
            case 'Desert':
                return 'Ice Cream';
                break;
            default:
                break;
        }
    }
}
 
$server = new soap_server();
$server->configureWSDL("foodservice", "http://www.greenacorn-websolutions.com/foodservice");
 
$server->register("food.getFood",
    array("type" => "xsd:string"),
    array("return" => "xsd:string"),
    "http://localhost/xml-parse/wsdl-food.php",
    "http://localhost/xml-parse/wsdl-food.php#getFood",
    "rpc",
    "encoded",
    "Get food by type");
 
@$server->service($HTTP_RAW_POST_DATA);
?>