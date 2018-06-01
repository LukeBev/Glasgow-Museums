<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">        
        <title>MovieProps</title> 
        <link rel="stylesheet" type="text/css" href="moviePropsStyles.css"> 
    </head>
    
    <body id="products">        
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

        <script type="text/javascript">
            var itemLocation = 1;
            var propSrcString = "imgs/propCollection/00"+itemLocation+".jpg";
            var d = new Date();
            var n = d.getTime();
            

            function leftBtnClick() {
                if (itemLocation > 1) {
                    itemLocation = itemLocation - 1;
                    console.log(itemLocation);

                    if (itemLocation < 10) {
                        var newPropSrcString = "imgs/propCollection/00"+itemLocation+".jpg?" + n;
                    } else {
                        var newPropSrcString = "imgs/propCollection/0"+itemLocation+".jpg?" + n;
                    }
                    img.src = newPropSrcString;

                    getRequests();
                }
            }

            function rightBtnClick() {
                if (itemLocation < 12) {
                    itemLocation = itemLocation + 1;                
                    console.log(itemLocation); 

                    if (itemLocation < 10) {
                        var newPropSrcString = "imgs/propCollection/00"+itemLocation+".jpg?" + n;
                    } else {
                        var newPropSrcString = "imgs/propCollection/0"+itemLocation+".jpg?" + n;
                    }
                    img.src = newPropSrcString;
                    console.log(img.src); 

                    getRequests();
                }
            } 

            function getRequests() {                
                var reqMovieName = new XMLHttpRequest(); 
                if (itemLocation < 10) {
                    var movieString = "textFiles/prop00" + itemLocation + "/text1.txt?" + n;
                } else {
                    var movieString = "textFiles/prop0" + itemLocation + "/text1.txt?" + n;
                }
                reqMovieName.open("GET", movieString, true);
                reqMovieName.send();                            
                reqMovieName.onreadystatechange = function() { 
                    document.getElementById("propInfoOne").innerHTML = this.responseText;
                }

                var reqPropName = new XMLHttpRequest();
                if (itemLocation < 10) {
                    var propNameString = "textFiles/prop00" + itemLocation + "/text2.txt?" + n;
                } else {
                    var propNameString = "textFiles/prop0" + itemLocation + "/text2.txt?" + n;
                }
                reqPropName.open("GET", propNameString, true);
                reqPropName.send();                            
                reqPropName.onreadystatechange = function() { 
                    document.getElementById("propInfoTwo").innerHTML = this.responseText;
                }

                var reqDesc = new XMLHttpRequest(); 
                if (itemLocation < 10) {
                var descString = "textFiles/prop00" + itemLocation + "/text3.txt?" + n;
                } else {
                    var descString = "textFiles/prop0" + itemLocation + "/text3.txt?" + n;
                }
                reqDesc.open("GET", descString, true);
                reqDesc.send();                            
                reqDesc.onreadystatechange = function() { 
                    document.getElementById("propInfoThree").innerHTML = this.responseText;
                }

                var reqSpec = new XMLHttpRequest();
                if (itemLocation < 10) {
                var specString = "textFiles/prop00" + itemLocation + "/text4.txt?" + n;
                } else {
                    var specString = "textFiles/prop0" + itemLocation + "/text4.txt?" + n;
                }
                reqSpec.open("GET", specString, true);
                reqSpec.send();                            
                reqSpec.onreadystatechange = function() { 
                    document.getElementById("propInfoFour").innerHTML = this.responseText;
                }
            }           
        </script>

        <div id="productsMainSect">
            <div id="productsSectOne">
                <div id="propInfoOne"></div>
                <div id="propInfoTwo"></div>
                <div id="propInfoThree"></div>
                <div id="propInfoFour"></div>
            </div>
            <div id="productsSectTwo">
                <div id="propNav">
                    <button class="propBtn" id="propLeftBtn">&#60;</button>
                    <div id="propImage">
                        <script>  
                            var img = document.createElement("img");
                            img.src = propSrcString;
                            img.setAttribute("style", "width: 100%; height: 100%;");                 
                            document.getElementById("propImage").appendChild(img);

                            getRequests();
                        </script>
                    </div>
                    <button class="propBtn" id="propRightBtn">&#62;</button>
                </div>
            </div>
            <div id="productsSectThree"></div>

            <script type="text/javascript">
                document.getElementById("propLeftBtn").addEventListener("click", leftBtnClick, false);
                document.getElementById("propRightBtn").addEventListener("click", rightBtnClick, false);
            </script>

        </div> 
    </body>
</html>