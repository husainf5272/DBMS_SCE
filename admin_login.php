<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  <title>Login Page</title>
</head>

<body style="margin-top:10%;background-color:lightgrey" class="offset-sm-4 col-sm-4">
<div>
    <header class="jumbotron"></header>
</div>
  <center>
   <div class="card">
   <h3 class="card-header">Admin Login</h3>

   <form method="post">
    <table>
      <div class="card-body">
      <tr>
        <td>Username:</td>
        <td><input type="text" name="user" placeholder="   Enter username" required></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="user_pass" placeholder="   Enter Password" minlength = 6 maxlength = 14 required></td>
      </tr>
      
      <tr>
         <td>
         <button type="submit" name="submit" class="btn-success" value="Login">Admin login</button></td>
         <td><p>Not yet a Member? <a href="./Admin_Registration.php">Register</a></p></td>
      </tr>
</div>
<div class="card=footer">
</div>

    </table>
</form>
   </div>
  
  </center>
</body>
</html>

<?php

require 'database.php';
$db = new Database;
$conn = $db->getConnection();

$sql='SELECT email,password,id from Admin';
$res=$conn->query($sql);
$truth=false;

if(isset($_POST['submit']))
{
    foreach($res as $row)
    {
      if($row['username']==$_REQUEST['user'] && $row['password']==$_REQUEST['user_pass'])
      {
           $truth=true;
           $auid=$row['id'];
      }
    }
    if($truth==false)
    {
      echo("error");
    }
    else{
      echo("done");
      setcookie("auid",$uid, time()+3600 , '/', '' );
      header("Location: ./Product_Addition_and_removal.php");
      exit();
       
    }
}

?>