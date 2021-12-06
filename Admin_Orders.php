<?php
    include 'database.php';
    $db = new Database;
    $conn = $db->getConnection();
?>
<?php
    if(isset($_POST['cancel'])) {
      $sql16 = "UPDATE orders set status = 'cancelled' where id=" . $_POST['cancel'];
      $result = $conn->exec($sql16);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Order Cancelled Successfully ! </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                  </div>';
         } else{
            echo "The record status was not updated because of this error ---> " . mysqli_error($conn); 
          }
       }
     else if(isset($_POST['deliver'])) {
            $sql17 = "UPDATE orders set status = 'delivered' where id= " . $_POST['deliver'];
            $result_p = $conn->exec($sql17);
      }   
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Admin Order Updation </title>
  </head>
  <style>
        h1{
            color:black;
        }
        #box{
            border:2px solid black;
            /*padding-bottom:15%;*/
            padding-right:2%;
            display: inline-block;
            margin:1%;
            width:20%;
            background-color:white;
        }
        img{
            padding-bottom: 2%;
            margin-left: 2%;
            margin-top: 2%;
            margin-right: 2%;
        }
        #content{
            display: inline-block;
            width:100%;
            margin-left: 3%;
            margin-bottom: 9%;
        }
        h3{
            margin-left: 5%;
            display: inline-block;
        }
        #Add_cart,#Add_wishlist{
            /*margin-left: 25%;*/
            padding: 2%;
            border: 2px solid black;
            text-align: center;
            color:crimson;
            margin-top: 2%;
            background-color: lightblue;
            text-decoration: none;
        }
        span a:hover{
            color:black;
        }
        #Product_title,section{
            text-align:center;
            background-color:lightgrey;
        }
        section{
        }
        #prod_link{
            text-decoration:none;
            color:black;
        }
        li{
            margin-right:10px;
        }
        td{
          padding: 0.5%;
          border : 2px solid black;
          text-align: center;
        }
        table{
          text-align : center;
        }
    </style>

  <body class="container-fluid">
    <header class="jumbotron">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Shopify</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse row" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Wishlist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">cart</a>
          </li>
          <li class="nav-item offset-sm-9 col-sm-2" id="logout">
            <a class="nav-link" href="./login.php">Logout</a>
          </li>
        </ul>
    </div>
    </nav>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Products / Order Updation </li>
        </ol>
    </nav>
          <h1 id="Product_title">Update Orders</h1>
    </header>
    <div class="container mt-3">
      <style>
          body {
            text-align: center;
          } 
          form {
            display: inline-block;
          }
      </style>
       <table class = "row offset-sm-3 col-sm-6"> 
      <tr>
          <td>Order ID</td>
          <td>User Id</td>
          <td>Product Id</td>
          <td>Quantity</td>
          <td>Total</td>
          <td>Status</td>
          <td>Change Status</td>
          <td>created At </td>
          <td>Cancelled At </td>          
      </tr>
    <?php
      $sql15 = "SELECT id , user_id , product_id, quantity , total , status, created_at , cancelled_at FROM orders";
      $raw_results = $conn->query($sql15);
      foreach($raw_results as $row){
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['product_id']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td>".$row['total']."</td>";
        echo "<td>".$row['status']."</td>";
        if(($row['status']  == "cancelled") || ($row['status']  == "delivered")){
           echo "<td>" . "</td>";
        } else {
          echo "<td>
              <form method='post'>
              <button style = 'margin-bottom:10px' type='submit' name='deliver' value = '".$row['id']."'> Delivered </button>
              <button type='submit' name='cancel' value = '".$row['id']."'> Cancel Order </button> </form> </td> " ;
        }
        echo "<td>".$row['created_at']."</td>";
        echo "<td>".$row['cancelled_at']."</td></tr>";
      }
    ?>
   </table>        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

