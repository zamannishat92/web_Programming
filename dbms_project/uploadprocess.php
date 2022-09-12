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
    3. store the file to web server file folder
    4. forward to home page
    */
    
    if(
            
            isset($_POST['Fname'])
        &&  isset($_POST['Lname'])
        &&  isset($_FILES['pimage'])
        &&  isset($_POST['pnum'])
        &&  isset($_POST['profession'])
        &&  isset($_POST['district'])
        &&  isset($_POST['country'])
        &&  isset($_POST['dob'])
        
        &&  !empty($_POST['Fname'])
        &&  !empty($_POST['Lname'])
        &&  !empty($_FILES['pimage'])
        &&  !empty($_POST['pnum'])
        &&  !empty($_POST['profession'])
        &&  !empty($_POST['district'])
        &&  !empty($_POST['country'])
        &&  !empty($_POST['dob'])
    ){
        /// print_r($_FILES['pimage']);
        
        $Fname=$_POST['Fname']; ///string value
        $Lname=$_POST['Lname'];
        $image=$_FILES['pimage'];///array object
        $phon_num=$_POST['pnum'];
        $profession=$_POST['profession'];
        $district=$_POST['district'];
        $country=$_POST['country'];
        $dob=$_POST['dob'];
        
        
        $image_name=$image['name'];
        $image_tmp_path=$image['tmp_name'];
        $to="image/$image_name";
        
        move_uploaded_file($image_tmp_path,$to);
           
        
        
        ///store the data to database
       
        try{
            ///$email=$_SESSION['useremail'];
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $mysqlquerystring="UPDATE user_info set First_name='$Fname',Last_name=' $Lname',imagepath='$to',Phon_num=$phon_num,profession='$profession',
            district='$district',country='$country',date_of_birth='$dob'  WHERE email='{$_SESSION['useremail']}'";
            
            $conn->exec($mysqlquerystring);

           
            ?>
                <script>location.assign("index.php");</script>
            <?php
           
            
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("upload.php");</script>
            <?php
        }
    }

    else{
        ?>
            <script>location.assign("upload.php");</script>
        <?php 
    }
    

}
else{
    ?>
        <script>location.assign("login.php");</script>
    <?php 
}

?>