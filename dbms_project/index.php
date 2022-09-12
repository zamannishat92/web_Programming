<?php

session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in user
    
    ?>

<?php
    include("functions.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Home</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
                
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  
          
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">TRADE BUILDER</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications 
                <?php
                $query = "SELECT * from notifications where status = 'unread' order by date DESC";
                if(count(fetchAll($query))>0){
                ?>
                <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
              <?php
                }
                    ?>
              </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <?php
                $query = "SELECT * from notifications order by date DESC";
                 if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
                ?>
              <a style ="
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" href="view.php?id=<?php echo $i['id'] ?>">
                <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php 

                if($i['type']=='comment'){
                    echo "Someone commented on your post.";
                }else if($i['type']=='like'){
                    echo ucfirst($i['name'])." liked your post.";
                }

                  ?>
                </a>
              <div class="dropdown-divider"></div>
                <?php
                     }
                 }else{
                     echo "No Records yet.";
                 }
                     ?>
            </div>
          </li>
        </ul>
          <?php 

          if(isset($_POST['submit'])){
              $message = $_POST['message'];
              $query ="INSERT INTO notifications (`id`, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '', 'comment', '$message', 'unread', CURRENT_TIMESTAMP)";
              if(performQuery($query)){
                  header("location:index.php");
              }
          }

          ?>
        <form method="post" class="form-inline my-2 my-lg-0">
          <input name="message"class="form-control mr-sm-2" type="text" placeholder="Comment" required>
          <button name="submit" class="btn btn-outline-success my-2 my-sm-0" type="submit">Submit</button>
        </form> 
          <?php

          if(isset($_POST['like'])){
              $name = $_POST['name'];
              $query ="INSERT INTO notifications (id, `name`, `type`, `message`, `status`, `date`) VALUES (NULL, '$name', 'like', '', 'unread', CURRENT_TIMESTAMP)";
              if(performQuery($query)){
                  header("location:index.php");
              }
          }

          ?>
        <form method="post" class="form-inline my-2 my-lg-0">
          <input name="name" class="form-control mr-sm-2" type="text" placeholder="Name" required>
          <button name="like" class="btn btn-outline-success my-2 my-sm-0" type="submit">Like  </button>
        </form>
      </div>
    </nav><br><br><br>

    <?php 
                ///$email=$_SESSION['useremail'];
                    try{
                       
                         ///PDO = PHP Data Object
                         $conn=new PDO("mysql:host=localhost:3306;dbname=dbms_project;","root","");
                         ///setting 1 environment variable
                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                         ///mysql query string
                         $mysqlquery="SELECT * FROM user_info WHERE email='{$_SESSION['useremail']}'";
                         
                         $returnobj=$conn->query($mysqlquery);
                         $returntable=$returnobj->fetchAll();
                         if($returnobj->rowCount()==0){
                            
                            echo 'No Values Found';
                           
                        }
                        
                        else{
                            foreach($returntable as $row){
            

                               
                                
                                ?>
                                     <!--profile section-->
                                     
                                    <section >
                                                            <h1> 
                                                            <?php echo $row['First_name'] ?> 
                                                                 <?php echo $row['Last_name'] ?>
                                                            </h1>
                                                            <h3> <?php echo $row['profession'] ?></h3>
                                                            
                                                        
                                                    </div><br><br>
                                                    
                                                    <div class="grid">
                                                    <input type="button" value="Build Info" onclick="uploadfn()"><br><br>
                                                    <input type="button" value="Profile" onclick="profilefn(<?php echo $row['id'] ?>)"><br><br>
                                                    <input type="button" value="Update Profile" onclick="updatefn()"><br><br>
                                                    <input type="button" value="Chat" onclick="chatfn()"><br><br>
                                                    <input type="button" value="Delete Info" onclick="deletefn(<?php echo $row['id'] ?>);"><br><br>
                                                    <input type="button" value="Click to Logout" onclick="logoutfn();"><br><br>
                                                    <input type="button" value="Change password" onclick="Passwordfn()"><br><br>
                                                    </div>
                                                    
                                    </section>
                                
                                    <?php
                            

                        }
                    }
                    } 
                
                    catch(PDOException $ex){
                        ?>
                        <script>location.assign("login.php");</script>
                    <?php
                    }
                
                    ?>
               
                
                <script>
                    function logoutfn(){
                        location.assign('logout.php');   ///default GET method
                    }
                    function updatefn(){
                        location.assign('EditProfile.php');   ///default GET method
                    }
                    
                    function uploadfn(){
                        location.assign('upload.php');
                    }
                    function chatfn(){
                        location.assign('user.php');
                    }
                    
                    
                    function deletefn(pid){
                        ///for multiple values: file.php?varname=value&var1=value1
                        location.assign('delete.php?prodid='+pid);
                    }
                    
                    function profilefn(pid){
                    
                        location.assign('profile.php?prodid='+pid);
                    }
                    function Passwordfn(){
                        location.assign('change_pass.php');
                    }
                </script>
                

    

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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