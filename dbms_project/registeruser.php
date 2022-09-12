<?php
/*
step 1: to receive the email and password data from register.php
step 2: to store the data within the database
step 3: if data store is successful then forward to login.php
        else forward to register.php
*/


if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if(   isset($_POST['myemail']) 
       && isset($_POST['mypass'])
       && !empty($_POST['myemail'])
       && !empty($_POST['mypass'])
    ){
        $email=$_POST['myemail'];
        $pass=$_POST['mypass'];
        
        
        
        ///store the data to database
        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $enc_password=md5($pass);
            if($email){
                $status = "Active now";
                $random_id = rand(time(),10000000);
            
            
            ///executing mysql query
            $signupquery="insert into user_info(email,password,status,unique_id) values('$email','$enc_password','$status',$random_id)";
            
            
            $conn->exec($signupquery);
            
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }
    }
        catch(PDOException $ex){
            ?>
                <script>location.assign("register.php");</script>
            <?php
        }
        
    }
    else{
        ///if email and password data is empty or not set
        /// register.php --> registeruser.php --> register.php
    ?>
        <script>location.assign("register.php");</script>
    <?php
        
    } 
}
else{
    //for other methods we will forward to register page (register.php)
    
    echo '<script>location.assign("register.php")</script>';
}


?>
