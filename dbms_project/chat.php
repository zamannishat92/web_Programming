<?php

session_start();

if(
    
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
     
){
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
                include_once "php/config.php";
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = mysqli_query($conn, "SELECT * FROM user_info WHERE unique_id = {$id}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
               
                ?>
                
                    <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="<?php echo $row['imagepath'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['First_name'] . " " .$row['Last_name'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>

                
            </header>
            
            <div class="chat-box">
                
                


            </div>
            <?php
                include_once "php/config.php";
                $sql = mysqli_query($conn, "SELECT * FROM user_info WHERE email = '{$_SESSION['useremail']}'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
               
                ?>
            <form action="#" class="typing-area" autocomplete="off" >
                <input type=" text" name="outgoing_id" value="<?php echo $row['unique_id']; ?>" hidden >
                <input type="text" name="incoming_id" value="<?php echo $id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
            
        </section>
    
    </div>
   
    <script src="javascript/chat.js"></script>
    
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