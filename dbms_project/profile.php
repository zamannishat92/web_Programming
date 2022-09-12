<?php

session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    if(isset($_GET['prodid']) && !empty($_GET['prodid'])){
        
        $_id=$_GET['prodid'];
        
    ///already logged in user
    
    ?>
        <!DOCTYPE html>

        <html>
            <head>
                <meta charset="utf-8">
                <title>Home</title>

                <link rel="stylesheet" href="style.css">
                <link rel="stylesheet" href="profile.css">
                
            </head>

            <body>
                
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
                                
                                     <!--profile section-->
                                    <center id="profile">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="profileImage">
                                                        <img src="<?php echo $row['imagepath'] ?>" width="300" height="300" alt="">
                                                        <div class="topText" >
                                                            <h1> <?php echo $row['First_name'] ?> 
                                                                 <?php echo $row['Last_name'] ?>
                                                            </h1><br>
                                                            <h3> <?php echo $row['profession'] ?></h3>
                                                        </div>
                                                    </div><br><br>
                                                    
                                                    <div class="profileContact">
                                                        <h2>Basic Information</h2>
                                                        <p><i class="fas fa-phone-alt"></i> <?php echo 'Name:' ?> 
                                                                                            <?php echo $row['First_name']?> 
                                                                                            <?php echo $row['Last_name'] ?></p>
                                                        <p> <i class="fas fa-envelope"></i> <?php echo 'Profession:' ?>
                                                                                            <?php echo $row['profession'] ?> </p>
                                                        <p> <i class="fas fa-map-marker-alt"></i> <?php echo 'Date of Birth:' ?> 
                                                                                                <?php echo $row['date_of_birth'] ?> </p>
                                                    </div>
                                                    <div class="profileContact">
                                                        <h2>Contact Information</h2>
                                                        <p><i class="fas fa-phone-alt"></i> <?php echo 'Phone:' ?>  
                                                                                            <?php echo $row['Phon_num'] ?> </p>
                                                        <p> <i class="fas fa-envelope"></i> <?php echo 'Email:' ?>
                                                                                            <?php echo $_SESSION['useremail']; ?> </p>
                                                        <p> <i class="fas fa-map-marker-alt"></i> <?php echo 'Address:' ?>  
                                                                                                  <?php echo $row['district'] ?>
                                                                                                  <?php echo $row['country'] ?></p>
                                                    </div>
                                                    
                                                    <input type="button" value="Upload Info" onclick="uploadfn()">
                                                    <input type="button" value="Update Profile" onclick="updatefn()">
                
                                                    <br>
                                                    <input type="button" value="Delete Info" onclick="deletefn(<?php echo $row['id'] ?>);">
                                                    <input type="button" value="Click to Logout" onclick="logoutfn();">
                                                    <input type="button" value="Change password" onclick="Passwordfn()">

                                                </div>
                                            </div>
                                        </div>
                                    
                                    </center>
                                  
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
               
                
                <script>
                    function logoutfn(){
                        location.assign('logout.php');   ///default GET method
                    }
                    
                    function uploadfn(){
                        location.assign('upload.php');
                    }
                    
                    function deletefn(pid){
                        ///for multiple values: file.php?varname=value&var1=value1
                        location.assign('delete.php?prodid='+pid);
                    }
                </script>
                
                
            </body>
        </html>

    <?php
    }
    else{
        ?>
           <script>location.assign("home.php");</script>
       <?php
   }

}
else{
     ?>
        <script>location.assign("login.php");</script>
    <?php
}


?>



