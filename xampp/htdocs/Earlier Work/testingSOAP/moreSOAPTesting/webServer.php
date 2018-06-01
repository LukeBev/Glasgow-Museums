<?php
// model
class Museum {

    public $id = "";
    public $museum_name = "";
    public $address = "";
    public $open_time = "";
    public $close_time = "";
    public $description = "";       
}


if($_SERVER['REQUEST_METHOD'] == "GET") { 
	$museumGlaID = $_GET['id'];

	// create instance and set a book name
	$museum = new Museum();
	$museum->id = $museumGlaID;
}

// initialize SOAP client and call web service function
try {
	$wsdl = "http://localhost:180/testingSOAP/moreSOAPTesting/soapServer.php?wsdl";
	$client = new SoapClient($wsdl);
	$resp = $client->museumID($museum);

	// dump response var_dump($resp);
	echo $resp;
} catch (Exception $e) {
	echo $e;	
}


