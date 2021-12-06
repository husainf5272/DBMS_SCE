
<?php
require 'database.php';
$db = new Database;
$conn = $db->getConnection();

    if(isset($_POST['cart']))
    {
        $sql = 'select id from cart where user_id=' . $_COOKIE['uid'] . ' and product_id=' . $_POST["cart"];
        if($conn->query($sql)->fetch()) {
            $sql = 'update cart set status="added", updated_at=now() where user_id=' . $_COOKIE['uid'] . ' and product_id=' . $_POST["cart"];
            echo $sql;
            $conn->exec($sql);
        } else {
            $sol1=$conn->prepare('INSERT into cart (user_id,product_id, quantity, status, created_at) values (:user_id,:product_id,1, "added",now())');
            echo $sql;
            $sol1->bindParam(":user_id",$_COOKIE['uid']);
            $sol1->bindParam(":product_id",$_POST["cart"]);
            $sol1->execute();
        }
        header("Location: cart.php");
    }
    if(isset($_POST['wishlist']))
    {
        $sql = 'select id from wishlist where user_id=' . $_COOKIE['uid'] . ' and product_id=' . $_POST["cart"] . ' and status="removed"';
        if($conn->query($sql)->fetch()) {
            $sql = 'update wishlist set status="added", updated_at=now() where user_id=' . $_COOKIE['uid'] . ' and product_id=' . $_POST["cart"];
            $conn->exec($sql);
        } else {
            $sol1=$conn->prepare('INSERT into wishlist (user_id,product_id, status, created_at) values (:user_id,:product_id, "added",now())');
            $sol1->bindParam(":user_id",$_COOKIE['uid']);
            $sol1->bindParam(":product_id",$_POST["wishlist"]);
            $sol1->execute();
        }
        header("Location: dbms_sce/wishlist.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <title>Products</title>
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
    
    
</style>

<body class="container-fluid">
    <header class="jumbotron">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Shopify</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse row" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="product.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="wishlist.php">Wishlist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Orders</a>
      </li>
      <li class="nav-item offset-sm-9 col-sm-2" id="logout">
        <a class="nav-link" href="./login.php">Logout</a>
      </li>

    </ul>
    </div>
   </nav>
        <h1 id="Product_title">Products</h1>
    </header>
    <section>
    <?php
     $sql = "SELECT p.image,price,c.name,f.material,p.title,p.available_quantity,p.id
     from Products p inner join categories c on
     p.category_id = c.id inner join fabrics f on 
     f.id = p.fabric_id where p.available_quantity>0 ;";
     $result = $conn->query($sql);
     foreach($result as $row)
     {
         $x=$row['id'];
         echo('<div id="box">
                  <img src="'.$row['image'].'" alt="" class="img-fluid" width="250px">
                  <h3><a href="./product_details.php?pid='.$row['id'].'" id="prod_link">'.$row['title'].'</a></h3>
                  <span id="content">
                     </br>
                     <span id="cat">Category: '
                     .
                     $row['name']
                     .
                     '</span>
                 </br>
                 <span id="fab">fabric: '.$row['material'].'</span>
             </br>
             price: Rs.'.$row['price'].'
             </br>
             quantity: '.$row['available_quantity'].'
             </br>
             </br>
                     <form method="post">
                      <button class="btn-success" type="submit" name="cart" value="'.$x.'" >Add to cart</button>
                      </br>
                      </br>
                      <button class="btn-success" type="submit" name="wishlist" value="'.$x.'">Add to wishlist</button>
                      </form>
                  </span>
             </div>');

         }
         

?>
    </section>
    
</body>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>

