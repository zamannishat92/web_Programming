<?php

session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
            <?php
                try{
                    ///PDO = PHP Data Object
                    $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
                    ///setting 1 environment variable
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    ///mysql query string
                    $mysqlquery="SELECT * FROM user_info WHERE email='{$_SESSION['useremail']}'";
                    
                    $returnobj=$conn->query($mysqlquery);
                    $returntable=$returnobj->fetchAll();
                    if($returnobj->rowCount()==0){
                       
                       echo 'No Values Found';
                      
                   }
                   
                   
                   else{
                       foreach($returntable as $row){
                           
                ?>
                <div class="content">
                    <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="<?php echo $row['imagepath'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['First_name'] . " " .$row['Last_name'] ?></span>
                        <p><?php echo 'Active now' ?></p>
                    </div>

                </div>
                <a href="logout.php" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to serach...">
                <button><i class=" fas fa-search "></i></button>
            </div>
            <div class="users-list">
            </div>
            
               
        </section>
    
    </div>
    
             
    <?php
            }

        }
    } 
                
     catch(PDOException $ex){
        ?>
            <script>location.assign("login.php");</script>
             <?php
        }
                
     ?>
     <script src="javascript/users.js"> </script>
    
</body>
</html>
<?php
    }
    else{
         ?>
            <script>location.assign("login.php");</script>
        <?php
    }
    
    
    ?>