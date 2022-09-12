<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style1.css">
    </head>
    
    <body>
        <div class="login-form">
        <h2>Login</h2>
        <form action="loginprocess.php" method="POST">
            <label for="myemail">Email</label>:
            <input type="email" id="myemail" name="myemail" placeholder="x@gmail.com">
            <br>
            <label for="mypass">Password</label>:
            <input type="password" id="mypass" name="mypass">
            <br>
            <input type="submit" value="Click to Login">
        </form>
        </div>
    </body>
</html>
