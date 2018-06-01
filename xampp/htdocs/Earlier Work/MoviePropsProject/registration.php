<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">        
        <title>MovieProps</title> 
        <link rel="stylesheet" type="text/css" href="moviePropsStyles.css"> 
    </head>
    
    <body id="registration">        
        <table id="topBar">
            <tr>
                <td id="divHeadLeft">
                    <canvas id="myCanvas" width="200" height="200">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                    <script src="javascript/canvasLogo.js" type="text/javascript"></script>             
                </td> 
                <td id="divHeadRight">
                    <nav id="outer">
                        <a href="home.php"><div id="divHeadRightOne">Home</div></a>
                        <a href="about.html"><div id="divHeadRightTwo">About</div></a> 
                        <a href="products.aspx"><div id="divHeadRightThree">Products</div></a>
                        <a href="registration.html"><div id="divHeadRightFour">Registration</div></a>
                        <div id="divHeadRightFive"></div>
                        <a href="admin.php"><div id="divHeadRightSix">Admin</div></a>
                    </nav>                   
                </td>
            </tr>
        </table>

        <section id="regSection">
            <h3 id="regHeader">Thank you for regestering!</h3>
            <form id="regForm" action="registration.html" method="post" >   
                <input id="returnBtn" name="interestButton" type="submit" value="Return to recommend a friend">
                <div id="error"></div>
            </form>         

            <?php        

                $dsn = "mysql:dbname=movie_props";
                $username = "root";
                $password = "123456";
                $pdo = new PDO($dsn, $username, $password);

                $sql= "SELECT id, title, first_name, surname, email_address, newsletter FROM potential_customers";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(); 
                $total = $stmt->rowCount();
                
                if (isset($_POST['interestButton'])) {                        

                        $tmpTitle = $_POST['titles'];                  
                        $tmpFirstName = $_POST['firstName'];
                        $tmpSurname = $_POST['surname'];
                        $tmpEmailAddress = $_POST['emailAddress'];
                        
                        if (isset($_POST['newsletter'])) {     
                            $tmpNewsletter = "Yes";
                        } else {
                            $tmpNewsletter = "No";
                        }                       
                        
                          
                        if ($tmpTitle == "" || $tmpFirstName == "" || $tmpSurname == "" || $tmpEmailAddress == "") {
                           return;
                        } else {
                            $sql = "INSERT INTO potential_customers (id, title, first_name, surname, email_address, newsletter) VALUES ($total+1, '$tmpTitle', '$tmpFirstName', '$tmpSurname', '$tmpEmailAddress', '$tmpNewsletter')";
                            $pdo->exec($sql);  
                        }
                }
            ?>
        </section> 
    </body>
</html>