<?php

session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    
    ///perform upload process here
    
    /*
    1. collect the data
    2. store the data to database
    3. forward to home page
    */
    
    if(
            
            isset($_POST['opwd'])
        &&  isset($_POST['npwd'])
        &&  isset($_POST['cpwd'])
        
        &&  !empty($_POST['opwd'])
        &&  !empty($_POST['npwd'])
        &&  !empty($_POST['cpwd'])
    ){
        /// print_r($_FILES['pimage']);
        
         ///string value
        $opwd=$_POST['opwd'];
        $npwd = $_POST['npwd'];
        $cpwd = $_POST['cpwd'];

          ///store the data to database
          try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $oenc_password=md5($opwd);
            $nenc_password=md5($npwd);
            $cenc_password=md5($cpwd);

            $mysqlquery = "SELECT email,password FROM user_info WHERE email = '{$_SESSION['useremail']}' AND password =
            '$oenc_password'";
            $returnobj = $conn->query($mysqlquery); 
            $returntable=$returnobj->fetchAll();
                         if($returnobj->rowCount() == 0){
                           // echo "Password does't change ";
                            
                            
                        }
                        else{
                            foreach($returntable as $row){
                            $con = "UPDATE user_info SET password = '$nenc_password' WHERE email = '{$_SESSION['useremail']}'";
                            $conn->exec($con);
                            echo "Password change successfully";
                            ?>
                                <script>location.assign("index.php");</script>
                            <?php
                                
                            }    
                        }
                                  
    }

        catch(PDOException $ex){
            ?>
                <script>location.assign("login.php");</script>
                
            <?php
           
        }
        
    }
    else{
        ///if email and password data is empty or not set
        /// register.php --> registeruser.php --> register.php
    ?>
        <script>location.assign("login.php");</script>
    <?php
        
    } 
}
else{
    //for other methods we will forward to register page (register.php)
    ?>
    echo '<script>location.assign("login.php")</script>';
    <?php
}


?>
