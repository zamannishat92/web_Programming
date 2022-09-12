<?php
    $conn = mysqli_connect("localhost", "root", "","dbms_project");
    if(!$conn){
        echo "Database connected" . mysqli_connect_error();
    }
    
?>