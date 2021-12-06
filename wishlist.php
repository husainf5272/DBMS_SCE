<?php
    include "database.php";

    $db = new Database;
    $conn = $db->getConnection();

    $uid = $_COOKIE["uid"];

    if(isset($_POST["remove"])) {
        $sql = 'update wishlist set status="removed", updated_at=now() where user_id=' . $uid . ' and product_id=' . $_POST["remove"];
        $conn->exec($sql);
    } else if(isset($_POST["addcart"])) {
        $sql = 'delete from wishlist where user_id=' . $uid . ' and product_id=' . $_POST["addcart"];
        $conn->exec($sql);
        $sql = 'insert into cart (user_id, product_id, quantity, status, created_at) values (' . $uid . ',' . $_POST["addcart"] . ',1,"added",now());';
        $conn->exec($sql);
        header('Location: /dbms_sce/cart.php');
    }

    // $user_id = $_COOKIE["uid"];
    $sql = 'select wishlist.id, products.id as pid, products.image, title, material, price from wishlist, products, fabrics where wishlist.product_id=products.id and wishlist.user_id=1 and products.fabric_id=fabrics.id and status!="removed" order by wishlist.created_at desc;';
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
        <title>Wishlist</title>
    </head>
    <body>
        <link rel="stylesheet" href="wishlist.css" />
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
        <h1 id="Product_title" style="margin-left: 100px">Wishlist</h1>
    </header>
        <?php 
            if($data == []) {
                echo "No items in Wishlist.";
            } else {
                foreach($data as $d) {
                    $img = $d["image"];
                    $title = $d["title"];
                    $material = $d["material"];
                    $price = $d["price"];
                    echo '
                            <div class="wish">
                                <img style="width: 120px; height:160px;" src="' . $img . '" />
                                <p class="title"><b>' . $title . '</b></p>
                                <p class="fabric">Fabric by ' . $material . '</p>
                                <p class="price"><b>₹ ' . $price . '</b></p>
                                <form method="post" style="position:absolute; display: inline">
                                    <button name="remove" value="' . $d["pid"] . '" type="submit" style="position: absolute; margin-left: 630px; background-color: indianred; margin-top:50px">Remove</button>
                                    <button name="addcart" value="' . $d["pid"] . '" type="submit" style="margin-top: 90px; margin-left: 630px">Add to Cart</button>
                                </form>        
                            </div>
                    ';
                }
            }
        ?>

    </body>
</html>
