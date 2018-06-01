<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">        
        <title>MovieProps</title> 
        <link rel="stylesheet" type="text/css" href="moviePropsStyles.css"> 
    </head>
    
    <body id="admin">        
        <table id="topBar">
            <tr>
                <td id="divHeadLeft">
                    <canvas id="myCanvas" width="200" height="200">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    <script src="javascript/canvasLogo.js" type="text/javascript"></script>             
                </td> 
                <td id="divHeadRight">
                    <div id="outer">
                        <a href="home.php"><div id="divHeadRightOne">Home</div></a>
                        <a href="about.html"><div id="divHeadRightTwo">About</div></a> 
                        <a href="products.aspx"><div id="divHeadRightThree">Products</div></a>
                        <a href="registration.html"><div id="divHeadRightFour">Registration</div></a>
                        <div id="divHeadRightFive"></div>
                        <a href="admin.php"><div id="divHeadRightSix">Admin</div></a>
                    </div>                   
                </td>
            </tr>
        </table> 


        <?php 
            
            class adminPage {
                
                function getDatabase() {
                    $dsn = "mysql:dbname=movie_props";
                    $username = "root";
                    $password = "123456";
                    $pdo = new PDO($dsn, $username, $password);

                    $sql= "SELECT id, title, first_name, surname, email_address, newsletter FROM potential_customers";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();   

                    $pos = 1;

                    echo "<div id=\"dataSection\">";
                    echo "<form method=\"post\">";   
                    echo "<table id=\"customerTable\">";  
                    echo "<tr>
                                <td class=\"adminTableHeader\">ID</td>
                                <td class=\"adminTableHeader\">Title</td>
                                <td class=\"adminTableHeader\">First Name</td>
                                <td class=\"adminTableHeader\">Surname</td>
                                <td class=\"adminTableHeader\">Email</td>
                                <td class=\"adminTableHeader\">Newletter</td>
                                <td class=\"adminTableHeader\"></td>
                            </tr>";   
                        foreach ( $result as $row ) { 
                        
                            $id = $row["id"];
                            $title = $row["title"];
                            $first_name = $row["first_name"];
                            $surname = $row["surname"];
                            $email_address = $row["email_address"];
                            $newsletter = $row["newsletter"];
                            
                            echo   
                                "<tr>" .                                                               
                                "<td><div class=\"userContentDiv\">" . $id . "</div></td>" .  
                                "<td><div class=\"userContentDiv\">". $title . "</div></td>" .           
                                "<td><div class=\"userContentDiv\">" . $first_name . "</div></td>" . 
                                "<td><div class=\"userContentDiv\">" . $surname . "</div></td>".
                                "<td><div class=\"userContentDiv\"><a class=\"mailLink\" href=\"mailto:$email_address?Subject=Weekly%20Newsletter&body=Hello%20fellow%20movie%20enthusiast!%0D%0A%0D%0AWelcome%20to%20the%20Movie%20Props%20Weekly%20newsletter.%0D%0A%0D%0AWe%20have%20recently%20aquired%20new%20props%20for%20you%20to%20browse,%20check%20them%20out%20today%20for%20limited%20time%20discounts!%0D%0A%0D%0AKind%20Regards,%0D%0A%0D%0ALuke%20Beveridge%0D%0AMovie%20Props%20Founder\" target=\"_top\">$email_address</a></div></td>" .
                                "<td><div class=\"userContentDiv\">" . $newsletter . "</div></td>" .
                                "<td><input class=\"removeButton\" name=\"removeButton$pos\" type=\"submit\" value=\"Delete Record\"></td></tr>";
                                $pos++;
                        }
                        echo "</table>";
                        echo "</form>";
                        echo "</div>";                   
                }

                function removeUser() {                
                    $dsn = "mysql:dbname=movie_props";
                    $username = "root";
                    $password = "123456";
                    $pdo = new PDO($dsn, $username, $password);

                    $sql= "SELECT id, title, first_name, surname, email_address, newsletter FROM potential_customers";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $total = $stmt->rowCount();
                    $result = $stmt->fetchAll();                   

                    $flag = 0;
                    $num = 1;

                    foreach ( $result as $row ) {                          
                        if (isset($_POST['removeButton' . $num])) {
                            $flag = 1;

                            $id_pos = $num;

                            $conn = new PDO($dsn, $username, $password);    
                            $sql = "DELETE FROM potential_customers WHERE id = $num";
                            $conn->exec($sql);  

                            for ($k = $num; $k <= $total; $k++) { 
                                $sql = "UPDATE potential_customers SET id = $id_pos WHERE id=$id_pos+1";
                                $conn->exec($sql);  
                                $id_pos++;
                            }
                        }
                        $num++;
                    }

                    $tmp_id = 1;
                    foreach ($result as $row ) {
                        $sqlUpdate = "UPDATE potential_customers SET id = 'tmp_id'";
                        $tmp_id++;
                    }

                    if ($flag == 1) {                           
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }


            }

            $adminPageObject = new adminPage();
            $adminPageObject->getDatabase();
            $adminPageObject->removeUser();
        ?>

    </body>
</html>