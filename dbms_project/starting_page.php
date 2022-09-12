<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starting Page</title>
    
    <style>
        body{
            background-color: #6495ED;
	        background-size: cover;
            color: palevioletred;

            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 15px;
            font-weight: bold;

            line-height: 1.6em;
            margin: 0;
        }
        .div_1{
            background-color: white;
            text-align: center;
            font-size: 18px;
            border: 2px solid black;
            font-weight: bold;
            color: black;
            margin: 20px;
           
            
        }
        .container{
            width: 80%;
            margin:auto;

        }
        
        .div_2 a{
            float: left;
            width: 50%;
            background-color:white ;
            border: 1px solid black;
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
            border-radius: 10px;
            font-size: 18px;
            
        }
        a{
            text-decoration: none;
            color: black;
        }
        
        a:hover {
            background-color: black;
            color:white;
        }
        a:active{
            background-color: rgb(64, 22, 73);
            color:rgb(30, 33, 184);

        }
       
    </style>
</head>
<body>
    <div class="container">
        <div class="div_1">
        <h1>WELCOME TO OUR PROJECT</h1>
        <h2>TRADE BUILDER</h2>
        <h3>Grow your business</h3>
        </div>
        <div class="div_2">
            <a href="register.php">Sign Up</a>
            
            <a href="login.php">Log in</a>
        </div>
    </div>
    
</body>
</html>