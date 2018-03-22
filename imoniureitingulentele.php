<?php
// include database configuration file
include_once ("include/database.php");
$enterprises = $database->query("SELECT enterprises.id, enterprises.enterprise_name, COALESCE(SUM(dishes_orders.quantity),0) as count FROM dishes_orders
LEFT JOIN dishes ON dishes.id = dishes_orders.dishes_id
RIGHT JOIN enterprises ON enterprises.id = dishes.enterprise_id
GROUP BY enterprises.id order by count DESC");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>imoniu reitingų lentelė</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html;" charset=utf-8"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="DataTables/dataTables.bootstrap.min.css">
        <?php
        ?>
    </head>

    <body>
        <div class="container">
            <h1>Imonių reitingai pagal visų vartotojų dažniausiai užsakomas prekes</h1>
            <h4>Pateikiamos visos sistemoje užsiregistravusios įmonės</h4>
            <table class=" table table-striped table-bordered table-hover" id="mydata">
                <thead>
                    <tr>
                        <th>Užimama vieta reitinge</th>
                        <th>Firmos pavadinimas</th>
                        <th>Patiekalų skaičius</th>
                        <th>Patiekalų užsakymų skaičius</th>
                        <th>Populiariausias patiekalas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $vieta = 1;
                    if ($enterprises->num_rows > 0) {
                        while ($roworders = $enterprises->fetch_assoc()) {
                            echo '<tr><td>' . $vieta . '</td>';
                            echo '<td>' . $roworders["enterprise_name"] . ' </td>';
                            $countdishes = $database->getEnterpriseDishCout($roworders["id"]);
                            if ($countdishes->num_rows > 0) {
                                while ($rowcount = $countdishes->fetch_assoc()) {
                                    echo '<td>' . $rowcount["count"] . ' </td>';
                                }
                            }
                            echo '<td>' . $roworders["count"] . '</td>';
                            $bestDish = $database->getEnterpriseBestDish($roworders["id"]);
                            if ($bestDish->num_rows > 0) {
                                while ($rowdish = $bestDish->fetch_assoc()) {
                                    echo '<td>' . $rowdish["name"] . ', Visas kiekis:' . $rowdish["count"] . '</td>';
                                }
                            } else {
                                echo '<td>-</td>';
                            }
                            echo '</tr>';
                            $vieta++;
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