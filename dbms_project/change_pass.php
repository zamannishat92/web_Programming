<?php

session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
   ?>
    <html>
        <head>
            <title>Password Change</title>
            <style>
                
                input{
                    width:40%;
                    height: 5%;
                    border:1px:
                    border-radius:5px;
                    padding:8px 15px 8px 15px;
                    margin:10px 0px 15px 0px;
                    box-shadow:1px 1px 2px 1px grey;
                }
            </style>
        </head>
        <body>
        <center>
            <h2>PASSWORD CHANGE</h2>
            <form action="passChangeProcess.php" name="chngpwd" method="POST" onSubmit="return valid();" >
            <label for="opwd">Old Pass:</label>
            <input type="password" id="opwd" name="opwd">
            <br><br>
            <label for="npwd">New Pass:</label>
            <input type="password" id="npwd" name="npwd">
            <br><br>
            <label for="cpwd">Confirm Pass:</label>
            <input type="password" id="cpwd" name="cpwd">
            <br><br>
            <input type="submit" name="submit"value="Change password">
        </form>
    </center>
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