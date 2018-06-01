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
 * Determines set of museum data to be retrieved.
 * @param $museum, museum instance with id set.
 * @return Formatted JSON data.
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
       
    // Formatting JSON data.                 
    $museumObjectPackage = '{"museums":[';                    
    $museum_data = json_encode($museum_array[0], JSON_PRETTY_PRINT);  
    $museumObjectPackage = $museumObjectPackage . $museum_data . ']}';

    return $museumObjectPackage;
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl",[
	'classmap'=>[
		'museum'=>'Museum', // 'museum' complex type in WSDL file mapped to the Museum PHP class
	]
]);

// register available functions
$server->addFunction('museumID');

// start handling requests
$server->handle();