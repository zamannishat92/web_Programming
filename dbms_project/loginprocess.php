<?php
/*
    1. collect the data from login.php page
    2. encrypt the collected password
    3. match the collected data with the database data
    4. if match found, we will forward to the home page
    5. if no match found, we will forward to login page
*/

if($_SERVER['REQUEST_METHOD']=="POST"){
    //we will process here
    
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
            
            ///checking from the database
            $myquerystring="SELECT * FROM user_info WHERE email='$email' AND password='$enc_password'";
            
            $returnobj = $conn->query($myquerystring);   ///the return objects is a PDOStatement object
            
            
            if($returnobj->rowCount()==1){
                
                session_start();
                $_SESSION['useremail']=$email; ///global variable
                
                
                ?>
                    <script>location.assign("index.php");</script>
                <?php
            }
            else{
                ?>
                    <script>location.assign("login.php");</script>
                <?php
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
    ?>
        <script>location.assign("login.php");</script>
    <?php
        
    } 
    
}
else{
    //we won't process
    ?>
        <script>location.assign('login.php')</script>
    <?php
    
}


?>