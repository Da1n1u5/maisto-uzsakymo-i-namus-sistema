<?php
// include database configuration file
include_once ("include/database.php");
$name = $session->username;
$userinfo = $database->getUserInfo($name);
$enterpriseid = $userinfo["enterprise_id"];
$enterprises = $database->query("SELECT orders.date_created as uzsakymolaikas, clients.*, dishes.id as patiekaloid, dishes.name as patiekalovardas, dishes_orders.quantity FROM dishes_orders
LEFT JOIN orders ON dishes_orders.orders_id = orders.id
LEFT JOIN dishes ON dishes_orders.dishes_id = dishes.id
LEFT JOIN clients ON orders.clients_id = clients.username
WHERE dishes.enterprise_id ='$enterpriseid' ORDER BY orders.date_created DESC");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Čia pateikiami klintų užsakymai įmonei</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html;" charset=utf-8"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="DataTables/dataTables.bootstrap.min.css">
        <?php
        ?>
    </head>

    <body>
        <div class="container">
            <h1>Čia pateikiami klientų užsakymai įmonei</h1>
            <table class=" table table-striped table-bordered table-hover" id="mydata">
                <thead>
                    <tr>
                        <th>Užsakymo Data</th>
                        <th>Patiekalas</th>
                        <th>Kiekis(vienetais)</th>
                        <th>Pristatymo Adresas</th>
                        <th>Kontaktiniai duomenys(vardas, tel. nr)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($enterprises->num_rows > 0) {
                        while ($roworders = $enterprises->fetch_assoc()) {
                            echo '<tr><td>' . $roworders["uzsakymolaikas"] . '</td>';
                            echo '<td>' . $roworders["patiekalovardas"] . ' </td>';
                            echo '<td>' . $roworders["quantity"] . '</td>';
                            echo '<td>' . $roworders["address"] . ', ' . $roworders["city"] . ', ' . $roworders["mail_code"] . '</td>';
                            echo '<td>' . $roworders["name"] . '; (' . $roworders["telephone"] . ')</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="DataTables/dataTables.bootstrap.min.js"></script>
        <script src="DataTables/jquery.dataTables.min.js"></script>
        <script>
            $('#mydata').dataTable();
        </script>
        <script src="DataTables/jquery-3.2.1.min.js"></script>
        <script src="DataTables/bootstrap.min.js"></script>
    </body>
</html>