<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

// model, which uses in web service functions as parameter
class Museum {

    public $id = "";
    public $museum_name = "";
    public $address = "";
    public $open_time = "";
    public $close_time = "";
    public $description = "";

        function __construct($id, $museum_name, $address, $open_time, $close_time, $description) {
            $this->id = $id;
            $this->museum_name = $museum_name;
            $this->address = $address;
            $this->open_time = $open_time;
            $this->close_time = $close_time; 
            $this->description = $description;                      
        }
}

/**
 * Determines published year of the book by name.
 * @param Book $book book instance with name set.
 * @return int published year of the book or 0 if not found.
 */
function museumID($museum) {
	$num = $museum->id;

	$dsn = "mysql:dbname=glasgow_museums"; //glasgow_museums
    $username = "root"; //root
    $password = "123456"; //123456
    $pdo = new PDO($dsn, $username, $password);

    if(mysqli_connect_error()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $sql= "SELECT id, museum_name, address, open_time, close_time, description FROM museums WHERE id=$num";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();     
 	
 	while($obj = $stmt->fetchObject()) {

    	$temp_museum = new Museum($obj->id, $obj->museum_name, $obj->address, $obj->open_time, $obj->close_time, $obj->description);

    	$museum_array[] = $temp_museum; 
	}
	
	$fred = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
                        
    $museum_data = json_encode($fred);
    
	// list of the books	
	// $glaMuseum=['id'=>$num,'museum_name'=>2012,'address'=>'bd'];

	// // search book by name	
	// if($glaMuseum['id']==$museum->id)
	// 	return $glaMuseum['id'] . $glaMuseum['museum_name'] . " : " . $glaMuseum['address']; // book found

	return '{"museums":[' . $museum_data . ']}'; // book not found
	return $fred; // book not found
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl",[
	'classmap'=>[
		'museum'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]);

// register available functions
$server->addFunction('museumID');

// start handling requests
$server->handle();



// keep for time-being, may need - as of now not required, could delete.
$wsdl = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
			"<wsdl:definitions name=\"Library\"" .
			                  "xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"" . 
			                  "targetNamespace=\"Library\"" . 
			                  "xmlns:soap=\"http://schemas.xmlsoap.org/wsdl/soap/\"" .
			                  "xmlns:tns=\"Library\"" .
			                  "xmlns:wsdl=\"http://schemas.xmlsoap.org/wsdl/\">" .

			    "<xsd:documentation></xsd:documentation>" .

			    "<wsdl:types>" .
			        "<xsd:schema xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" targetNamespace=\"Library\">" .
			            "<xsd:complexType name=\"book\">" .
			                "<xsd:sequence>" .
			                    "<xsd:element name=\"name\" type=\"xsd:string\"></xsd:element>" .
			                    "<xsd:element name=\"year\" type=\"tns:integer\"></xsd:element>" . 
			                "</xsd:sequence>" .
			            "</xsd:complexType>" .
			        "</xsd:schema>" .
			    "</wsdl:types>" .

			    "<wsdl:message name=\"bookYearRequest\">" .
			        "<wsdl:part name=\"book\" type=\"xsd:book\"></wsdl:part>" . 
			    "</wsdl:message>" .
			    "<wsdl:message name=\"bookYearResponse\">" .
			        "<wsdl:part name=\"year\" type=\"tns:integer\"></wsdl:part>" .
			    "</wsdl:message>" .

			    "<wsdl:portType name=\"Library\">" .
			        "<wsdl:operation name=\"bookYear\">" .
			            "<wsdl:input message=\"tns:bookYearRequest\"/>" .
			            "<wsdl:output message=\"tns:bookYearResponse\"/>" .
			        "</wsdl:operation>" .
			    "</wsdl:portType>" .

			    "<wsdl:binding name=\"Library\" type=\"tns:Library\">" .
			        "<soap:binding style=\"rpc\" transport=\"http://schemas.xmlsoap.org/soap/http\"/>" .
			        "<wsdl:operation name=\"bookYear\">" .
			            "<soap:operation soapAction=\"http://localhost:180/testingSOAP/moreSOAPTesting/soapServer.php\"/>" .
			            "<wsdl:input>" .
			                "<soap:body use=\"literal\" namespace=\"Library\"/>" .
			            "</wsdl:input>" .
			            "<wsdl:output>" .
			                "<soap:body use=\"literal\" namespace=\"Library\"/>" .
			            "</wsdl:output>" .
			        "</wsdl:operation>" .
			    "</wsdl:binding>" .

			    "<wsdl:service name=\"Library\">" .
			        "<wsdl:port binding=\"tns:Library\" name=\"BookLibrary\">" .
			            "<soap:address location=\"http://localhost:180/testingSOAP/moreSOAPTesting/soapServer.php\"/>" .
			        "</wsdl:port>" .
			    "</wsdl:service>" .

			"</wsdl:definitions>";
