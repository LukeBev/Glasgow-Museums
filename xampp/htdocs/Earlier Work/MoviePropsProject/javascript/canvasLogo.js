var x = 25;
var boolFlag = true;
var colourSet;

// Find current page to decide a colour set for Logo
switch (document.location.pathname) {
    case "/MoviePropsProject/home.php":
        colourSet = 1;
        break;
    case "/MoviePropsProject/about.html":       
        colourSet = 2;
        break;
    case "/MoviePropsProject/products.aspx":
        colourSet = 3;
        break;
    case "/MoviePropsProject/registration.html":
        colourSet = 4;
        break;
    case "/MoviePropsProject/registration.php":
        colourSet = 4;
        break;
    case "/MoviePropsProject/admin.php":
        colourSet = 5;
        break;
    default: 
        colourSet = 1;        
}
    

function clock(){

    // Get Context                   
    var c = document.getElementById("myCanvas");   
    var ctx = c.getContext("2d"); 

    // Colour Gradient for Logo Background/Spotlight Effect
    var my_gradient=ctx.createRadialGradient(x, 25, 20, 150, 75, 180);
    my_gradient.addColorStop(0, "white");
    my_gradient.addColorStop(0.2, "grey");
    my_gradient.addColorStop(0.4, "black");
    my_gradient.addColorStop(1, "black");
    ctx.fillStyle = my_gradient;
    ctx.fillRect(0,0,200,200);

    // Setting boundaries for spotlight radius to change direction
    if(x<=175 && boolFlag == true){ 
        x=x+1;
        if(x==174){
            boolFlag = false;
        }
    }
    if(x>=25 && boolFlag == false){
        x=x-1;
        if(x==26){
            boolFlag = true;
        }
    }

    // Start creation of drawing, set line attributes  
    ctx.strokeStyle = "#2c2c2c";
    ctx.lineWidth = 5;
    ctx.lineJoin = "round";
    ctx.lineCap = "square";

    // Drawing Letter "M"
    ctx.beginPath();
    ctx.moveTo(10, 120);
    ctx.lineTo(10, 20);
    ctx.lineTo(40, 20);
    ctx.lineTo(60, 45);
    ctx.lineTo(80, 20);
    ctx.lineTo(110, 20);
    ctx.lineTo(110, 120);
    ctx.lineTo(80, 120);
    ctx.lineTo(80, 70);
    ctx.lineTo(60, 85);
    ctx.lineTo(40, 70);
    ctx.lineTo(40, 120);
    ctx.lineTo(10, 120);

     // Drawing Letter "P"
    ctx.moveTo(110, 70);
    ctx.lineTo(130, 70);
    ctx.bezierCurveTo(200, 70, 200, 140, 130, 140);
    ctx.lineTo(130, 190);
    ctx.lineTo(100, 190);
    ctx.lineTo(100, 120);
    ctx.lineTo(110, 120);
    ctx.lineTo(110, 70);
    ctx.closePath();  
    
    var my_letter_gradient = ctx.createLinearGradient(0,0,200,200);

    // Apply selected colour set to the Logo
    switch(colourSet) {
        case 1: 
            my_letter_gradient.addColorStop(0,"red");
            my_letter_gradient.addColorStop(0.2,"orange");
            my_letter_gradient.addColorStop(0.4,"yellow");                      
            my_letter_gradient.addColorStop(0.6,"orange");
            my_letter_gradient.addColorStop(1,"red");
            break;
        case 2: 
            my_letter_gradient.addColorStop(0,"blue");
            my_letter_gradient.addColorStop(0.2,"dodgerblue");
            my_letter_gradient.addColorStop(0.4,"aqua");                      
            my_letter_gradient.addColorStop(0.6,"dodgerblue");
            my_letter_gradient.addColorStop(1,"blue");
            break;
        case 3: 
            my_letter_gradient.addColorStop(0,"forestgreen");
            my_letter_gradient.addColorStop(0.2,"limegreen");
            my_letter_gradient.addColorStop(0.4,"greenyellow");                      
            my_letter_gradient.addColorStop(0.6,"limegreen");
            my_letter_gradient.addColorStop(1,"forestgreen");
            break;
        case 4: 
            my_letter_gradient.addColorStop(0,"indigo");
            my_letter_gradient.addColorStop(0.2,"mediumpurple");
            my_letter_gradient.addColorStop(0.4,"orchid");                      
            my_letter_gradient.addColorStop(0.6,"mediumpurple");
            my_letter_gradient.addColorStop(1,"indigo");
            break;
        case 5: 
            my_letter_gradient.addColorStop(0,"navy");
            my_letter_gradient.addColorStop(0.2,"slateblue");
            my_letter_gradient.addColorStop(0.4,"turquoise");                      
            my_letter_gradient.addColorStop(0.6,"slateblue");
            my_letter_gradient.addColorStop(1,"navy");
            break;
    }

    ctx.fillStyle = my_letter_gradient;
    ctx.fill();

    // Apply All - Draw to Canvas
    ctx.stroke(); 

    window.requestAnimationFrame(clock);
}
window.requestAnimationFrame(clock);