<?php
require_once "migration.php";
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     body{
        background-color:brown;
    }
    h2{
        text-align: center;
        color:aliceblue;
        font-size: 70px;
    }
    form{
        background-color: wheat;
    }
    .form{
        margin-left: 450px;
    }
    input{
        height:20px;
    }
</style>
<body>

<?php

   
if(isset($_POST["login"]))  
{  
     if(empty($_POST["email"]) || empty($_POST["password"]))  
     {  
          $message = '<label>All fields are required</label>';  
     }  
     else  
     { 
          $query = "SELECT * FROM user WHERE email = :email AND password = :password";  
          $statement = $db->prepare($query);  
          $statement->execute(  
               array(  
                    'email'     =>     $_POST["email"],  
                    'password'     =>     $_POST["password"]  
               )  
          );  
          $count = $statement->rowCount();  
          if($count > 0)  
          {  
               $_SESSION["email"] = $_POST["email"];  
               $_SESSION["password"] = $_POST['password'];
               header("location:profile.php");  
          }  
          else  
          {  
               $message = '<label>Wrong Data</label>';  
          }  
     }  
 
}  


?>  


    <div>
        <h2>Log In</h2>
    </div>
        
    <form method="POST" action="">
    
        <div class="form">
        <label for="email">Email</label>
    <input type="text" name="email" id="mail" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="pw" required>
    <input type="submit" name="login" value="Log In" onclick="doValidate()"><br>
    <a href="index.php">Back</a>
        </div>
    </form>

<script >

function doValidate() {
    console.log('Validating...');
    try {
        email=document.getElementById('mail');
        pw = document.getElementById('pw').value;
        console.log("Validating pw="+pw);
        if (pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
            
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}
</script>
    </body>
</html>