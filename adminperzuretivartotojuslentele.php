
<?php
// include database configuration file
include_once ("include/database.php");
$name = $session->username;
$userinfo = $database->getUserInfo($name);
$clients = $database->query("SELECT * FROM clients");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
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
                        <th>Prisiregistavimo data</th>
                        <th>Prisijungimo vardas</th>
                        <th>Vardas Pavardė</th>
                        <th>Telefonas</th>
                        <th>E-paštas</th>
                        <th>Adresas</th>
                        <th>Miestas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($clients->num_rows > 0) {
                        while ($roworders = $clients->fetch_assoc()) {
                            echo '<tr><td>' . $roworders["date_registered"] . '</td>';
                            echo '<td>' . $roworders["username"] . ' </td>';
                            echo '<td>' . $roworders["name"] . ' ' . $roworders["surname"] . '</td>';
                            echo '<td>' . $roworders["telephone"] . ' </td>';
                            echo '<td>' . $roworders["e_mail"] . ' </td>';
                            echo '<td>' . $roworders["address"] . ', ' . $roworders["mail_code"] . '</td>';
                            echo '<td>' . $roworders["city"] . ' </td>';
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