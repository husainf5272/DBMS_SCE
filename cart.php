<?php
    include "database.php";

    $db = new Database;
    $conn = $db->getConnection();

    $uid = $_COOKIE["uid"];

    if(isset($_POST["plus"])) {
        $sql = 'update cart set quantity=(select quantity from cart where user_id=' . $uid . ' and product_id=' . $_POST["plus"] . ') +1 where user_id=' . $uid . ' and product_id=' . $_POST["plus"];
        $conn->exec($sql);
    } else if(isset($_POST["minus"])) {
        $sql = 'update cart set quantity=(select quantity from cart where user_id=' . $uid . ' and product_id=' . $_POST["minus"] . ') -1 where user_id=' . $uid . ' and product_id=' . $_POST["minus"] . ' and quantity > 1';
        $conn->exec($sql);
    } else if(isset($_POST["remove"])) {
        $sql = 'update cart set status="removed" where user_id=' . $uid . ' and product_id=' . $_POST["remove"];
        $conn->exec($sql);
    } else if(isset($_POST["order"])) {
        $sql = "call place_order($uid);";
        $conn->exec($sql);
        header("Location: orders.php");
    }

    $sql = 'select cart.id, products.id as pid, products.image, title, material, cart.quantity, price from cart, products, fabrics where cart.product_id=products.id and cart.user_id=1 and products.fabric_id=fabrics.id and status!="removed" order by cart.created_at desc;';
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
        <title>Cart</title>
    </head>
    <body>
        <link rel="stylesheet" href="cart.css" />
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
        <h1 id="Product_title" style="margin-left: 100px">Cart</h1>
    </header>
        <?php 
            if($data == []) {
                echo "<p style='margin-left: 100px'>No items in Cart.</p>";
            } else {
                echo '<div class="cart-prod">';
                foreach($data as $d) {
                    $img = $d["image"];
                    $title = $d["title"];
                    $material = $d["material"];
                    $quantity = $d["quantity"];
                    $price = $d["price"];
                    echo '
                        
                            <div class="wish">
                                <img style="width: 120px; height:160px;" src="' . $img . '" />
                                <p class="title"><b>' . $title . '</b></p>
                                <p class="fabric">Fabric by ' . $material . '</p>
                                <p class="quantity">Quantity: </p>
                                <form method="post" style="position: absolute; display: inline; margin-top: 90px; margin-left: 80px;">
                                    <button type="submit" name="minus" value="' . $d["pid"] . '">-</button>
                                    <input readonly type="text" value="' . $quantity . '" style="width: 2ch" />
                                    <button type="submit" name="plus" value="' . $d["pid"] . '">+</button>
                                </form>
                                <p class="price"><b>₹ ' . $price . '</b></p>
                                <form method="post" style="position: relative; display: inline; float: right;">
                                    <button class="button" type="submit" name="remove" value="' . $d["pid"] . '">Remove</button>
                                </form>
                            </div>
                        
                    ';
                }
                
                echo '
                </div>
                    <div class="bill" style="position: absolute">
                        <table>
                            <tr>
                                <th style="width:50px">Sr No</th>
                                <th style="width:80px">Price</th>
                                <th style="width:100px">Quantity</th>
                                <th style="width: 50px">Tax</th>
                                <th style="width:100px">Total</th>
                            </tr>
                    ';
                
                $i = 0;
                $total = 0;
                foreach($data as $d) {
                    $i++;
                    echo '
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $d["price"] . '</td>
                            <td>' . $d["quantity"] . '</td>
                            <td>' . $d["price"] * $d["quantity"] * 0.1 . '</td>
                            <td>' . $d["price"] * $d["quantity"] * 1.1 . '</td>
                        </tr>
                    ';
                    $total += $d["price"] * $d["quantity"] * 1.1;
                }
                echo '
                        <tr>
                            <td colspan="5" style="width:100%; height:50px; text-align:right"><b>Total: ₹ ' . $total . '</b></td>
                        </tr>
                        <tr>
                            <td colspan="5"><form method="post"><button name="order" value="" type="submit" style="width:100%">Place Order</button></form></td>
                        </tr>
                    </table>

                </div>';
            }
        ?>

    </body>
</html>
