<?php
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
// redirect to home if cart is empty
if ($cart->total_items() <= 0) {
    header("Location: indeks.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;

// get customer details by session customer ID
$query = $database->query("SELECT * FROM clients WHERE username = '" . $_SESSION['username'] . "'");
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>atsiskaitymo operacijos atvaizdavimas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .container{width: 100%;padding: 50px;}
            .table{width: 65%;float: left;}
            .shipAddr{width: 30%;float: left;margin-left: 30px;}
            .footBtn{width: 95%;float: left;}
            .orderBtn {float: right;}
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Užsakymo peržiūra</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Patiekalas</th>
                        <th>Kaina</th>
                        <th>Kiekis</th>
                        <th>Suma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($cart->total_items() > 0) {
                        //get cart items from session
                        $cartItems = $cart->contents();
                        foreach ($cartItems as $item) {
                            ?>
                            <tr>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo '$' . $item["price"] . ' Eur'; ?></td>
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo '$' . $item["subtotal"] . ' Eur'; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td colspan="4"><p>Jūs neturite jokių patiekalų krepšelyje</p></td>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <?php if ($cart->total_items() > 0) { ?>
                            <td class="text-center"><strong>Visa suma <?php echo '$' . $cart->total() . ' Eur'; ?></strong></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
            <div class="shipAddr">
                <h4><strong>Kontaktiniai duomenys</strong></h4>
                <p><strong>Kliento vardas:</strong> <?php echo $custRow['name']; ?></p>
                <p><strong>Telefonas:</strong> <?php echo $custRow['telephone']; ?></p>
                <p><strong>Miestas:</strong> <?php echo $custRow['city']; ?></p>
                <p><strong>Adresas:</strong> <?php
                    echo $custRow['address'];
                    echo '; ';
                    echo $custRow['mail_code'];
                    ?></p>
            </div>
            <div class="footBtn">
                <a href="patiekalai.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Tęsti apsipirkimą</a>
                <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Patvirtinti užsakymą<i class="glyphicon glyphicon-menu-right"></i></a>
            </div>
        </div>
    </body>
</html>