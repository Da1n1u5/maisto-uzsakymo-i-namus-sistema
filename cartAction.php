<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;
include_once ("include/database.php");
// include database configuration file
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productid = $_REQUEST['id'];
        // get product details
        $query = $database->query("SELECT * FROM dishes WHERE id = ".$productid);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id'],
            'date_added' => $row['date_added'],
            'name' => $row['name'],
            'price' => $row['price'],
            'servings' => $row['servings'],
            'enterprise_id' => $row['enterprise_id'],
            'type' => $row['type'],
            'wraping' => $row['wraping'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'krepselis.php':'indeks.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: krepselis.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 
            && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database 
        $q="INSERT INTO orders (clients_id, price, date_created, date_modified) VALUES ('".$_SESSION['username']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
        $insertOrder = $database->query($q);       
        if($insertOrder){
            	
 
            $orderID = mysqli_insert_id($database->connection);
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO dishes_orders (dishes_id, orders_id, quantity) VALUES ('".$item['id']."', '".$orderID."', '".$item['qty']."');";
            }
            // insert order items into database
            
            $insertOrderItems = $database->connection->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: uzsakymopatvirtinimas.php");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: indeks.php");
    }
}else{
    header("Location: indeks.php");
}