<?php
    include "database.php";

    $db = new Database;
    $conn = $db->getConnection();

    if(isset($_POST["cancel"])) {
        $sql = 'update orders set status="cancelled", cancelled_at=now() where user_id=1 and product_id=' . $_POST["cancel"];
        $conn->exec($sql);
    }

    // $user_id = $_COOKIE["uid"];
    $sql = 'select orders.id, orders.product_id as pid, products.image, title, material, price, orders.quantity, orders.total, status from orders, products, fabrics where orders.product_id=products.id and orders.user_id=1 and products.fabric_id=fabrics.id order by orders.created_at desc;';
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <title>Orders</title>
    </head>
    <body>
        <link rel="stylesheet" href="orders.css" />
        <h1 style="margin-left: 100px">Orders</h1>
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
                            <img style="width: 98px; height:138px;" src="' . $img . '" />
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
