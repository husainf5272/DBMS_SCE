<?php
    include "database.php";

    $db = new Database;
    $conn = $db->getConnection();

    if(isset($_POST["remove"])) {
        $sql = 'update wishlist set status="removed", updated_at=now() where user_id=1 and product_id=' . $_POST["remove"];
        $conn->exec($sql);
    } else if(isset($_POST["addcart"])) {
        $sql = 'delete from wishlist where user_id=1 and product_id=' . $_POST["addcart"];
        $conn->exec($sql);
        $sql = 'insert into cart (user_id, product_id, quantity, status, created_at) values (1,' . $_POST["addcart"] . ',1,"added",now());';
        $conn->exec($sql);
        header('Location: /dbms_sce/cart.php');
    }

    // $user_id = $_COOKIE["uid"];
    $sql = 'select wishlist.id, products.id as pid, products.image, title, material, price from wishlist, products, fabrics where wishlist.product_id=products.id and wishlist.user_id=1 and products.fabric_id=fabrics.id and status!="removed" order by wishlist.created_at desc;';
    $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <title>Wishlist</title>
    </head>
    <body>
        <link rel="stylesheet" href="wishlist.css" />
        <h1 style="margin-left: 100px">Wishlist</h1>
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
