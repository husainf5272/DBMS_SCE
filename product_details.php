<?php

require 'database.php';
$db = new Database;
$conn = $db->getConnection();


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
        border:4px solid black;
        /*padding-bottom:15%;*/
        padding-right:2%;
        display: inline-block;
        margin:1%;
        width:20%;
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
        margin-left: 25%;
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
    #Product_title{
        text-align:center;
        background-color:grey;
    }
    section{
    }
    #bread{
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
    <li class="breadcrumb-item" ><a id="bread" href="./product.php">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Product_details</li>
    </ol>
    </nav>
        
    </header>
    <section>
                <?php
                $sql = "SELECT p.id,p.image,f.fabric_image,f.material,f.color,p.summary,p.title,c.name 
                from Products p inner join fabrics f on 
                f.id = p.fabric_id inner join colors c on f.color=c.id;";
                $result = $conn->query($sql);
                foreach($result as $row)
                {
                     if($row['id']==$_GET['pid'])
                     {
                         echo('
                         <div class="row">
                         <div class="col-sm-4">
                            <img src="'.$row['image'].'" alt="" class="img-fluid" width="250px">
                         </div>
                         <div class="col-sm-5">
                         <div><h3>'.$row['title'].'</h3>
                         </div>
                         <div></br></br>'.$row['summary'].'
                         </div>
                         </div>
                         <div class="col-sm-3 align-middle">
                         </br>
                         </br>
                         <form method="post">
                      <button class="btn-success" type="submit" name="cart" value="cart1"/ >Add to cart</button>
                      </br>
                      </br>
                      <button class="btn-success" type="submit" name="wishlist" value="wishlist1">Add to wishlist</button>
                      </form>
                         </div>
                         </div>
                         </br>
                         <div class="row">
                         <h3 class="offset-sm-3">About Fabric</h3>
                         </div>
                         </br>
                         <div class="row">
                         <div class="offset-sm-2 col-sm-2">
                            <img src="'.$row['fabric_image'].'" alt="" class="img-fluid" width="150px">
                         </div>
                         <div class="col-sm-3">
                         <h3>'.$row['material'].'</h3>
                         </br></br>color :  '.$row['name'].'
                        
                         </div>
                         </div>
                         ');
                     }
                }
                if(isset($_POST['cart']))
                {
           $sol1=$conn->prepare("INSERT into cart (user_id,product_id, quantity, created_at) values (:user_id,:product_id,1,now())");
           $sol1->bindParam(":user_id",$_COOKIE['uid']);
           $sol1->bindParam(":product_id",$x);
           $sol1->execute();
           
           }
           if(isset($_POST['wishlist']))
                {
           $sol1=$conn->prepare("INSERT into wishlist (user_id,product_id, created_at) values (:user_id,:product_id,now())");
           $sol1->bindParam(":user_id",$_COOKIE['uid']);
           $sol1->bindParam(":product_id",$x);
           $sol1->execute();
          
           }
                ?>
    </section>
</body>