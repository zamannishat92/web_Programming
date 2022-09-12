<?php
    session_start();
    include_once "config.php";
    $sql = mysqli_query($conn, "SELECT * FROM user_info WHERE email = '{$_SESSION['useremail']}'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
    $outgoing_id = $row['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    $sql1 = mysqli_query($conn,"SELECT * FROM user_info WHERE First_name LIKE '%{$searchTerm}%' OR Last_name LIKE '%{$searchTerm}%'");
    if(mysqli_num_rows($sql1) > 0){
        include "data.php";
        //$output .= "user found related to your search term";
    }
    else{
        $output .= "No user found related to your search term";
    }
    echo $output;
?>