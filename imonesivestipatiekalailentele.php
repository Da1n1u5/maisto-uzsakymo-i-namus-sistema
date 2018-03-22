<?php
// include database configuration file
include_once ("include/database.php");
$name = $session->username;
$userinfo = $database->getUserInfo($name);
$enterpriseid = $userinfo["enterprise_id"];
$enterprises = $database->query("SELECT * FROM dishes WHERE
dishes.enterprise_id = '$enterpriseid'");
$enteprisInfo = $database->getenterprisInfo($enterpriseid);
$enterpriseName = $enteprisInfo["enterprise_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Čia pateikiami sistemoje esančių įmonės patiekalų informacija</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html;" charset=utf-8"/>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="DataTables/dataTables.bootstrap.min.css">
        <?php
        ?>
    </head>

    <body>
        <div class="container">
            <h1>Sistemoje esančių įmonės"<?php echo '' . $enterpriseName . ''; ?>" įvestų paiekalų ataskaita</h1>
            <table class=" table table-striped table-bordered table-hover" id="mydata">
                <thead>
                    <tr>
                        <th>Patiekalo įvedimo data</th>
                        <th>Patiekalas pavadinimas</th>
                        <th>Patiekalo tipas</th>
                        <th>Porcijų kiekis</th>
                        <th>Supakavimas</th>
                        <th>Kaina(Eur)</th>
                        <th>Produktai</th>
                        <th>Nuotrauka</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($enterprises->num_rows > 0) {
                        while ($roworders = $enterprises->fetch_assoc()) {
                            echo '<tr><td>' . $roworders["date_added"] . '</td>';
                            echo '<td>' . $roworders["name"] . ' </td>';
                            echo '<td>' . $roworders["type"] . ' </td>';
                            echo '<td>' . $roworders["servings"] . '</td>';
                            echo '<td>' . $roworders["wraping"] . '</td>';
                            echo '<td>' . $roworders["price"] . '</td>';
                            $dishID = $roworders["id"];
                            $results = $database->getDIshProductsOfEnterprise($dishID);
                            if ($results->num_rows > 0) {
                                echo '<td>';
                                while ($r = $results->fetch_assoc()) {
                                    echo '' . $r["produktas"] . ' ' . $r["svoris"] . 'g.; ';
                                }
                                echo '</td>';
                            } else {
                                echo '<td></td>';
                            }
                            echo '<td><img  width="100" height="100" src="data:image/jpeg;base64,' . base64_encode($roworders['image']) . '" alt="Chania"></td>';
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