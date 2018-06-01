<?php 

            class Museum {

                public $id = "";
                public $museum_name = "";
                public $address = "";
                public $open_time = "";
                public $close_time = "";

                    function __construct($id, $museum_name, $address, $open_time, $close_time) {
                        $this->id = $id;
                        $this->museum_name = $museum_name;
                        $this->address = $address;
                        $this->open_time = $open_time;
                        $this->close_time = $close_time;                       
                    }
            }  

            class dbAccess {
                
                function getDatabase() {
                    $dsn = "mysql:dbname=glasgow_museums";
                    $username = "root";
                    $password = "123456";
                    $pdo = new PDO($dsn, $username, $password);

                    if(mysqli_connect_error()) {
                        //printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }

                    $sql= "SELECT id, museum_name, address, open_time, close_time FROM museums";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();  
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                    // $num = $stmt->rowCount();
                    // print_r($num);

                    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                    $root_element = "museums";
                    $xml         .= "<$root_element>";

                    $museumDetails = array();
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

                    //close the root element
                    $xml .= "</$root_element>";
                     
                    //send the xml header to the browser
                    header ("Content-Type:text/xml");
                   
                    echo $xml;                                    
                }  
            }

            $dbConnectionObject = new dbAccess();
            $dbConnectionObject->getDatabase();
        ?>