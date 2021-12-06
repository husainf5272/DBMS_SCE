<?php
    include "database.php";

    $db = new Database;
    $conn = $db->getConnection();

    $uid = $_COOKIE["uid"];

    if(isset($_POST["cancel"])) {
        $sql = 'update orders set status="cancelled", cancelled_at=now() where user_id=' . $uid . ' and product_id=' . $_POST["cancel"];
        $conn->exec($sql);
    }

    // $user_id = $_COOKIE["uid"];
    $sql = 'select orders.id, orders.product_id as pid, products.image, title, material, price, orders.quantity, orders.total, status from orders, products, fabrics where orders.product_id=products.id and orders.user_id=' . $uid . ' and products.fabric_id=fabrics.id order by orders.created_at desc;';
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
        <title>Orders</title>
    </head>
    <body>
        <link rel="stylesheet" href="orders.css" />
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
        <h1 id="Product_title" style="margin-left: 100px">Orders</h1>
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
                            <p class="quantity" style="position: absolute; display:inline; margin-top: 90px; margin-left: 10px">Quantity: ' . $d["quantity"] . '</p>
                            <p class="price"><b>₹ ' . $d["total"] . '</b></p>
                    ';
                    if($d["status"] == "delivered") {
                        echo '
                            <p class="delivered">' . strtoupper($d["status"]) . '</p>
                        </div>
                        ';
                    } else if($d["status"] == "in process") {
                        echo '
                            <p class="status">' . strtoupper($d["status"]) . '</p>
                            <form method="post" class="formcancel">
                                <button name="cancel" value="' . $d["pid"] . '" class="cancel" type="submit">Cancel Order</button>
                            </form>
                        </div>
                        ';
                    } else if($d["status"] == "cancelled") {
                        echo '
                            <p class="cancelled">' . strtoupper($d["status"]) . '</p>
                        </div>
                        ';
                    }
                }
            }
        ?>

    </body>
</html>
