<?php

	class Museum {

	    public $id = "";
	    public $museum_name = "";
	    public $address = "";
	    public $open_time = "";
	    public $close_time = "";
	    public $description = "";       
	}

	// Checking that the HTTP Request method sent is GET, and obtaining data from URI.
	if($_SERVER['REQUEST_METHOD'] == "GET") { 
		$museumGlaID = $_GET['id'];

		// create instance and set a museum id
		$museum = new Museum();
		$museum->id = $museumGlaID;
	}

	// initialize SOAP client and call web service function
	try {
		$wsdl = "http://localhost:180/AppLoadTestingNoMediaSoap(Json+Xml)/Load_NoMedia_xml_SOAP/soapServer.php?wsdl";
		$client = new SoapClient($wsdl);
		$resp = $client->museumID($museum);

		header ("Content-Type:text/xml");
		echo $resp;
		
	} catch (Exception $e) {
		echo $e;	
	}

?>