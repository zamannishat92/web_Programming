<?php
    session_start();
    include_once "config.php";
    $sql = mysqli_query($conn, "SELECT * FROM user_info WHERE email = '{$_SESSION['useremail']}'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
    $outgoing_id = $row['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM user_info WHERE NOT unique_id = {$outgoing_id}");
    $output = " ";

    if(mysqli_num_rows($sql) == 1){
        $output .= "No users are available to chat";
    }
    elseif(mysqli_num_rows($sql) > 0){
        include "data.php";
    }
    echo $output;
?>