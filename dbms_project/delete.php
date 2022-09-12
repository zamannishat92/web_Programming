<?php

session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    if(isset($_GET['prodid']) && !empty($_GET['prodid'])){
        
        $_id=$_GET['prodid'];
        
        
        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            ///mysql query string
            $mysqlquerystring="DELETE FROM user_info WHERE id=$_id";
            
            $conn->exec($mysqlquerystring);
            
            ?>
                <script>location.assign("home.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("home.php");</script>
            <?php
        }
        
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