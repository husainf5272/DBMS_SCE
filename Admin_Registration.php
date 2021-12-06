<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Admin Registration</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Username = $_POST['uname'];
        $Firstname = $_POST['fname'];
        $Middlename = $_POST['mname'];
        $Lastname = $_POST['lname'];
        $Mobilenumber = $_POST['monum'];
        $EmailAddress = $_POST['email'];
        $Password = $_POST['pass'];
        
        $servername = "localhost:3307";
        $password = "";
        $username = "root"; 
        $database = "online_shopping_db";
        $conn = mysqli_connect($servername , $username , $password , $database);
        if(!$conn){
            die("Sorry! We failed to connect : " . mysqli_connect_error());
        }else{
            //echo "Connection is Successfull !!";
            $sql = "INSERT INTO `admin` (`user_name`, `first_name`, `middle_name`, `last_name`, `mobile`, `email`, `password`, `registered_at`, `last_login`, `password_changed_at`) VALUES ('$Username', '$Firstname', '$Middlename', '$Lastname', '$Mobilenumber', '$EmailAddress', '$Password', current_timestamp(), current_timestamp(), current_timestamp())";
            $result = mysqli_query($conn , $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Data Entered Successfully ! </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                      </div>';
            } else{
                echo "The record was not inserted because of this error ---> " . mysqli_error($conn); 
            }
        }
      }  
    ?>
    <div class="container mt-3">
      <style>
          body {
            text-align: center;
          } 
          form {
            display: inline-block;
          }
      </style>  
      <form action = "\ONLINE_SHOPPING_PORTAL\Admin_Registration.php" method = "post">
        <h4> Admin Registration Form </h4>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="uname" class="form-control" id="uname_id">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">FirstName</label>
            <input type="text" name="fname" class="form-control" id="fname_id">
        </div>
        <div class="mb-3">
            <label for="middlename" class="form-label">MiddleName</label>
            <input type="text" name="mname" class="form-control" id="mname_id">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" name="lname" class="form-control" id="lname_id">
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input type="text" name="monum" class="form-control" id="monum_id">
        </div>  
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>