<?php

session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
   
    ///show upload page here
    
    ?>
    <html>
        <head>
            <title>Upload Info</title>
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
            <h2>BUILD PROFILE</h2>
            <form action="uploadprocess.php" method="POST" enctype="multipart/form-data">
            <label for="Fname">FirstName:</label>
            <input type="text" id="Fname" name="Fname">
            <br><br>
            <label for="Lname">LastName:</label>
            <input type="text" id="Lname" name="Lname">
            <br><br>
            <label for="pimage">Image:</label>
            <input type="file" id="pimage" name="pimage">
            <br><br>
            <label for="pnum">Phone num:</label>
            <input type="text" id="pnum" name="pnum">
            <br><br>
            <label for="profession">Profession:</label>
            <input type="text" id="profession" name="profession">
            <br><br>
            <label for="district">District:</label>
            <input type="text" id="district" name="district">
            <br><br>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country">
            <br><br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <br><br>
            <input type="submit" name="upload"value="Upload">
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