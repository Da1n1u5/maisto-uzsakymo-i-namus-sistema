<?php
// include database configuration file
include_once ("include/database.php");
$orders = $database->query("SELECT * FROM orders WHERE clients_id = '" . $_SESSION["username"] . "'");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ižsakymų lentelė</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html;" charset=utf-8"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="DataTables/dataTables.bootstrap.min.css">
        <?php
        ?>
    </head>
    <body>

        <div class="container">
            <h1>Užsakymų lentelė</h1>
            <table class=" table table-striped table-bordered table-hover" id="mydata">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Užsakymo aprašymas(Kiekis, kaina(Eur))</th>
                        <th>Suma(Eur)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($orders->num_rows > 0) {
                        while ($roworders = $orders->fetch_assoc()) {
                            echo '<tr><td>' . $roworders["date_modified"] . '</td>';
                            echo'<td>';
                            $dishesArray = $database->getSpecificOrderAllDishes($roworders["id"]);
                            if ($dishesArray->num_rows > 0) {
                                while ($row = $dishesArray->fetch_assoc()) {
                                    echo 'Patiekalas: ' . $row["name"] . '[](Kiekis:' . $row["quantity"] . ') <p></p>';
                                }
                            }
                            echo'</td>';
                            echo '<td>' . $roworders["price"] . '</td></tr>';
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