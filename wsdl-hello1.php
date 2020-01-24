<?
//https://www.codeproject.com/Articles/140189/PHP-NuSOAP-Tutorial
require_once("lib/nusoap.php");
date_default_timezone_set('Asia/Bangkok');
//Create a new soap server
$namespace = "http://localhost/xml-parse/wsdl-hello.php";
 
// create a new soap server
$server = new soap_server();
 
// configure our WSDL
$server->configureWSDL("HelloExample");
 
// set our namespace
$server->wsdl->schemaTargetNamespace = $namespace;
 
//Register a method that has parameters and return types
$server->register(
    // method name:
    'HelloWorld',
    // parameter list:
    array('name'=>'xsd:string'),
    // return value(s):
    array('return'=>'xsd:string'),
    // namespace:
    $namespace,
    // soapaction: (use default)
    false,
    // style: rpc or document
    'rpc',
    // use: encoded or literal
    'encoded',
    // description: documentation for the method
    'Simple Hello World Method');
 
function HelloWorld($name)
{
return "Hello, World! $name";
}
 
// Get our posted data if the service is being consumed
// otherwise leave this data blank.
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
// pass our posted data (or nothing) to the soap service
$server->service($POST_DATA);
exit();
?>