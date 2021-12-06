<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  <title>Register</title>
</head>
<style>
        #submit{
            color:
        }
  </style>
<body  style="margin-top:10%;background-color:lightgrey" class="offset-sm-4 col-sm-4">
  <center>
  <div class="card">
  <h3 class="card-header">Register</h3>

  <form class="card-body" action="" method="post">
      <table>
      <tr>
          <td>First name:</td>
          <td><input type="text" name="fname" placeholder="   Enter first name" required></td>
        </tr>
        <tr>
          <td>middle name:</td>
          <td><input type="text" name="mname" placeholder="   Enter middle name" required></td>
        </tr>
        <tr>
          <td>last name:</td>
          <td><input type="text" name="lname" placeholder="   Enter last name" required></td>
        </tr>
      <tr>
          <td>Email:</td>
          <td><input type="email" name="mail" placeholder="   Enter Email" required></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="user_pass" placeholder="   Enter Password" minlength = 6 maxlength = 14 required></td>
        </tr>
        

        <tr>
          <td>Phone:</td>
          <td>
            <input type="number" name="mob_digits" placeholder = "   optional" pattern = "\d*" minlength = 8 maxlenght = 14  >
          </td>
        </tr>
        <tr>
           <td>
           <button type="submit" name="submit" class="btn-success" id="submit">Admin login</button><</td>
           <td><p>Already a user? <a href="login.php">Login Here</a></p></td>
        </tr>

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

if(isset($_POST['submit'])){
$first_name=$_REQUEST['fname'];
$middle_name=$_REQUEST['mname'];
$last_name=$_REQUEST['lname'];
$mobile=$_REQUEST['mob_digits'];
$email=$_REQUEST['mail'];
$password=$_REQUEST['user_pass'];
$sql=$conn->prepare("INSERT into user (first_name, middle_name, last_name, mobile, email, password, registered_at) 
values (:first_name, :middle_name, :last_name, :mobile, :email, :password,now())");
$sql->bindParam(":first_name",$first_name);
$sql->bindParam(":middle_name",$middle_name);
$sql->bindParam(":last_name",$last_name);
$sql->bindParam(":mobile",$mobile);
$sql->bindParam(":email",$email);
$sql->bindParam(":password",$password);
$sql->execute();

}

?>