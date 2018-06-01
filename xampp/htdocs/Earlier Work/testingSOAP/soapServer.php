<?php 
    
require_once('data.php');

// require wsdl file
// $wsdl = ;

$server = new SoapSever(null, $wsdl);

$server->setClass('dbAccess');

$server->handle();

?>