<?php 
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

            class dbAccess {
                
                function getDatabase() {
                    $dsn = "mysql:dbname=glasgow_museums"; //glasgow_museums
                    $username = "root"; //root
                    $password = "123456"; //123456
                    $pdo = new PDO($dsn, $username, $password);

                    if(mysqli_connect_error()) {
                        printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }

                    // Checking that the HTTP Request method sent is GET, and obtaining data from URI.
                    if($_SERVER['REQUEST_METHOD'] == "GET") { 
                        $museumID = $_GET['id'];   

                        $sql= "SELECT id, museum_name, address, open_time, close_time, description FROM museums WHERE id=$museumID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();  
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Formatting data into XML, with increasing payload.
                    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                    $root_element = "museums";
                    $xml         .= "<$root_element>";

                    $museumDetails = array();
                    for ($p=0; $p<10000; $p++) {
	                    foreach ($rows as $item) {
	                        $xml .= "<museum>";
	                        foreach ($item as $key => $value) {
	                            $museumDetails[$key] = $value;

	                            $xml .= "<$key>"; 
	                
	                            $xml .= "$value";             
	                    
	                            $xml .= "</$key>";
	                        }
	                        $xml .= "</museum>"; 
	                    }
					}
                    //close the root element
                    $xml .= "</$root_element>";
                     
                    //send the xml header to the browser
                    header ("Content-Type:text/xml");
                   
                    echo $xml; 
                     
                    }                    
            
                }  
            }

            $dbConnectionObject = new dbAccess();
            $dbConnectionObject->getDatabase();
        ?>