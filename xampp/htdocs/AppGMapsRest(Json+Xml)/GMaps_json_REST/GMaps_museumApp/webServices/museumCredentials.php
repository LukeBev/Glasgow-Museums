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

                        $count = 0;                        
                        while($obj = $stmt->fetchObject()){                   

                            $temp_museum = new Museum($obj->id, $obj->museum_name, $obj->address, $obj->open_time, $obj->close_time, $obj->description);

                            $museum_array[] = $temp_museum; 
                            $count++;                 
                        }

                        // Formatting data into JSON.
                        echo '{"museums":[';
                 

                        for ($i=0; $i<$count; $i++) { 
                            $museum_data = json_encode($museum_array[$i], JSON_PRETTY_PRINT);
                            echo $museum_data;
                            if($i != $count=0) {
                                echo ",";                            
                            }                                           
                        } 
                
                    echo ']}';
                     
                    }                    
            
                }  
            }

            $dbConnectionObject = new dbAccess();
            $dbConnectionObject->getDatabase();
        ?>