<?php
    include 'database.php';
    $db = new Database;
    $conn = $db->getConnection();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Admin Product Insertion </title>
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
      <h1 id="Product_title">Insert Product</h1>
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
      <form action = "\ONLINE_SHOPPING_PORTAL\Add_Product.php" method = "post">
        <h4> Admin Product Insertion Form </h4>
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" name="pr_title" class="form-control" id="title_id">
        </div>
        <div class="mb-3">
            <label for="category"> Select Product Category :</label>
              <select name="pr_category" id="category_id">
                    <option value="1">Suits</option>
                    <option value="2">Shirts</option>
                    <option value="3">Trousers</option>
              </select>    
        </div>
        <div class="mb-3">
            <label for="fabric" class="form-label">Product Fabric Color</label>
            <input type="text" name="pr_fabric_color" class="form-control" id="fabric_color">
        </div>
        <div class="mb-3">
            <label for="fabric" class="form-label">Product Fabric Material</label>
            <input type="text" name="pr_fabric_material" class="form-control" id="fabric_material">
        </div>
        <div class="mb-3">
            <label for="available_quantity" class="form-label">Product Quantity</label>
            <input type="text" name="pr_quan" class="form-control" id="quan_id">
        </div>  
        <div class="mb-3">
            <label for="product_summary" class="form-label">Product Summary</label>
            <input type="text" name="pr_summary" class="form-control" id="summary_id">
        </div>
        <div class="mb-3">
            <label for="Product_Price" class="form-label">Product Price</label>
            <input type="text" name="pr_price" class="form-control" id="price_id">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label"> Product Image URL</label>
            <input class="form-control" name = "pr_image" type="text" id="img_id">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label"> Product Fabric Image URL</label>
            <input class="form-control" name = "pr_fimage" type="text" id="Fimg_id">
        </div>
        <button type="submit" name = "submit" value = "" class="btn btn-primary">Submit</button>
      </form>
    </div> 
    <?php
       if(isset($_POST['submit'])) {
        $Title = $_POST['pr_title'];
        $Category = $_POST['pr_category'];
        $Quantity = $_POST['pr_quan'];
        $Summary = $_POST['pr_summary'];
        $Cost = $_POST['pr_price'];
        $Image = $_POST['pr_image'];
        $FImage = $_POST['pr_fimage'];  
        $FMaterial = $_POST['pr_fabric_material'];
        $FColor = strtolower($_POST['pr_fabric_color']);
        
        $sql9 = "SELECT id FROM `colors` where name = '" . $_POST["pr_fabric_color"] . "'";
        if(!($conn->query($sql9)->fetch())){
           $sql10 = "INSERT INTO `colors` (`name`) VALUES ('$FColor')";
           $result_x = $conn->exec($sql10);
        }

        $sql6 = "SELECT id FROM `fabrics` where fabric_image = '" . $_POST["pr_fimage"] . "'";
        if(!($conn->query($sql6)->fetch())){
           $sql8 = "INSERT INTO `fabrics` (`fabric_image`, `color`, `material`, `created_at`, `updated_at`) VALUES ('$FImage',(SELECT id FROM colors WHERE name = '$FColor'),'$FMaterial',current_timestamp() , current_timestamp())";
           $result_f = $conn->exec($sql8);
        }

        $sql5 = "INSERT INTO `products` (`title`, `image`, `category_id`, `fabric_id`, `available_quantity`, `summary`, `price`, `created_at`, `updated_at`) VALUES ('$Title', '$Image', '$Category', (SELECT id FROM fabrics WHERE fabric_image = '$FImage'), '$Quantity', '$Summary', '$Cost', current_timestamp() , current_timestamp())";
        $result = $conn->exec($sql5);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> Product Inserted Successfully ! </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                </div>';
        } else{
              echo "The record was not inserted because of this error ---> " . mysqli_error($conn); 
        }         
      }   
   ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
