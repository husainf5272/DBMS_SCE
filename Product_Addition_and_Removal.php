<?php
    include 'database.php';
    $db = new Database;
    $conn = $db->getConnection();
?>

<?php
        if(isset($_POST['remove_id'])) {
          $sql3 = "UPDATE products set available_quantity=0 where id=" . $_POST["remove_id"];
          $result = $conn->exec($sql3);
          if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Product Removed Successfully ! </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                        </div>';
              } else{
                  echo "The record was not inserted because of this error ---> " . mysqli_error($conn); 
            }
         }
         else if(isset($_POST['quantity_incr'])){
            $sql12 = "UPDATE products set available_quantity = (select available_quantity from products where id = ". $_POST["plus_button"] . ") + " . $_POST['quantity_incr'] . " WHERE id = " . $_POST["plus_button"];
            $result_p = $conn->exec($sql12);
         }   
    ?>
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Admin Order Updation</title>
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
            <a class="nav-link" href="./Admin_Orders.php">Orders</a>
          </li>
          <li class="nav-item offset-sm-9 col-sm-2" id="logout">
            <a class="nav-link" href="./login.php">Logout</a>
          </li>
        </ul>
    </div>
    </nav>
      <h1 id="Product_title">Product Details</h1>
    </header>
    
   <table class = "row offset-sm-3 col-sm-6"> 
      <tr>
          <td>Product ID</td>
          <td>Product_title</td>
          <td>Product_Quantity</td>
          <td>Product_Price</td>
          <td>Product Removal</td>
          <td>Increment in Quantity</td>
      </tr>
    <?php
      $sql4 = "SELECT id , title , available_quantity , price FROM products";
      $raw_results = $conn->query($sql4);
      foreach($raw_results as $row){
        echo "<tr><td>".$row['id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['available_quantity']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td><form method = 'post'> <button type = 'submit' name='remove_id' value='".$row['id']."'> Remove </button> </form></td>";
        echo  "<td><form method = 'post'> <input style = 'display:inline; margin-right : 1%' type='number' name='quantity_incr' value='0'></input> <button name='plus_button' value = ".$row['id']." > + </button> </form></td></tr>";
      }
    ?>
   </table>
   <style>
       button{
         text-align: center;
      } 
   </style>
   <form action="Add_Product.php">
     </br>
     <button class = "row offset-sm-5 col-sm-1 btn-success" > 
       Add_Product
     </button>
    </form> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

