<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">		
        <title>MovieProps</title> 
        <link rel="stylesheet" type="text/css" href="moviePropsStyles.css"> 
    </head>
    <body id="home">  
        <audio id="audio" autoplay="" loop="">
            <source src="audio/AmbientBeat.wav" type="audio/wav">   
            Your browser does not support the HTML5 Audio element.
        </audio>

        <script type="text/javascript">
            var sound = document.getElementById("audio");
            sound.volume = 0.2;
        </script>

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
 
        <p id="result"></p>       
        
        <script> 
            function start() {

                <?php
                    $url = "http://webdev.student.uws.ac.uk/movie-trivia.php";
                    $json = file_get_contents($url);
                    $json_data = json_decode($json);                        
               
                    echo 
                        "document.getElementById(\"result\").innerHTML = \"".$json_data->{'movie-trivia'}."\";";
                 ?>
            }

            window.addEventListener( "load", start, false );
        </script> 
    </body>  
</html>