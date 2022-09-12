<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="style1.css">
    </head>
    
    <body>
    <div class="login-form">
    <section class="form signup">
        <h2>Register</h2>
        <form action="registeruser.php" method="POST">
            <label for="myemail">Email</label>:
            <input type="email" id="myemail" name="myemail" placeholder="x@gmail.com">
            <br>
            <label for="mypass">Password</label>:
            <input type="password" id="mypass" name="mypass">
            <br>
            <div class="field button">
            <input type="submit" value="Click to Register">
            </div>
        </form>
    </section>
    </div>
    <!--<script src="javascript/signup.js"></script>-->
    </body>
</html>
