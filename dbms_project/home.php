<?php

session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
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
                ///$email=$_SESSION['useremail'];
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
                                     
                                    <section >
                                    
                                                        <div class="topText" >

                                                            <h1> 
                                                            <?php 
                                                                echo $_SESSION['useremail']; 
                                                            ?>
                                                            <br><br>
                                                            <?php echo $row['First_name'] ?> 
                                                                 <?php echo $row['Last_name'] ?>
                                                            </h1>
                                                            <h3> <?php echo $row['profession'] ?></h3>
                                                        </div>
                                                    </div><br><br>
                                                    
                                                    
                                                    <input type="button" value="Upload Info" onclick="uploadfn()"><br><br>
                                                    <input type="button" value="Profile" onclick="profilefn(<?php echo $row['id'] ?>)"><br><br>
                                                    <input type="button" value="Update Profile" onclick="updatefn()"><br><br>
                                                    <input type="button" value="Chat" onclick="chatfn()"><br><br>
                                                    <input type="button" value="Delete Info" onclick="deletefn(<?php echo $row['id'] ?>);"><br><br>
                                                    <input type="button" value="Click to Logout" onclick="logoutfn();"><br><br>
                                                    <input type="button" value="Change password" onclick="Passwordfn()"><br><br>

                                                    
                                    </section>
                                
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
                    function updatefn(){
                        location.assign('EditProfile.php');   ///default GET method
                    }
                    
                    function uploadfn(){
                        location.assign('upload.php');
                    }
                    function chatfn(){
                        location.assign('user.php');
                    }
                    
                    
                    function deletefn(pid){
                        ///for multiple values: file.php?varname=value&var1=value1
                        location.assign('delete.php?prodid='+pid);
                    }
                    
                    function profilefn(pid){
                    
                        location.assign('profile.php?prodid='+pid);
                    }
                    function Passwordfn(){
                        location.assign('change_pass.php');
                    }
                </script>
                
                
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


