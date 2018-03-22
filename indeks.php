<?php
// include database configuration file
include_once ("include/database.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>patiekalu pirkimas</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html;" charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />

        <style>
            .container{padding: 25px;}
            .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
            .filter{width: 100%;text-align: left;display: block;font-size: 22px;}
            .cancel{width: 100%;text-align: left;display: block;font-size: 22px; color: tomato}
            .item:hover{background-color: #ffdd62;}
            .filtering{background-color: #ffdd62 !important;}
        </style>
        <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".item").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        <script>
            $(function() {
                $(".item").click(function() {
                    $(this).toggleClass("filtering");
                });
            });
        </script>
        <script>
            $(function() {
                $(".filter").click(function() {
                    if ($(".item").hasClass('filtering')) {
                        $(".item").hide();
                        $(".filtering").show();
                    }
                });
            });
        </script>
        <script>
            $(function() {
                $(".cancel").click(function() {
                    $(".item").removeClass('filtering');
                    $(".item").show();
                });
            });
        </script>

    </head>
    <body>

        <div class="container">
            <a href="krepselis.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i>Peržiūrėti krepšelį</a>
            <div class="row">
                <div class="col-sm-3">
                    <a  class="filter" title="filter" ><i class="glyphicon glyphicon glyphicon-search"></i>Filtruoti pažymėtus</a>
                </div>
                <div class="col-sm-3">
                    <a  class="cancel" title="cancelfilter" ><i class="glyphicon glyphicon glyphicon-remove"></i>Nuimti filtrą</a>
                </div>
            </div>

            <h1>Žemiau pateikiami patiekalai</h1>
            <input class="form-control" id="myInput" type="text" placeholder="Irašykite ieškomo patiekalo vardą norėdami filtruoti">
            <p></p>
            <div id="products" class="row list-group">
                <?php
                //get rows query
                $query = $database->query("SELECT * FROM dishes ORDER BY id DESC");
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        ?>
                        <div class="item col-lg-4" >
                            <div class="thumbnail">
                                <div class="caption">
                                    <?php
                                    if ($row['image'] != "") {
                                        echo '<img  width="325" height="244" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Chania">';
                                    } else {
                                        echo '<img  width="325" height="244" src="https://i5.walmartimages.com/asr/f752abb3-1b49-4f99-b68a-7c4d77b45b40_1.39d6c524f6033c7c58bd073db1b99786.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF" alt="Chania">';
                                    }
                                    ?>
                                    <h3 class="list-group-item-heading"><?php echo $row["name"]; ?></h3>

                                    <?php
                                    $qDishesProducts = $database->query("SELECT dishes_products.weight as weight, products.name as name  FROM dishes_products, products WHERE dishes_products.product_ID = products.id AND dishes_products.dish_ID = '" . $row["id"] . "'");
                                    ?>
                                    <h5 class="list-group-item-text">Sudėtis: <?php
                                        while ($rDishesProducts = $qDishesProducts->fetch_assoc()) {
                                            echo $rDishesProducts["name"];
                                            echo " ";
                                            echo $rDishesProducts["weight"];
                                            echo "gr.; ";
                                        }
                                        ?>
                                    </h5>
                                    <h5 id="procijos" class="list-group-item-text">Porcijos:
                                        <?php
                                        echo '' . $row["servings"] . '';
                                        ?>
                                    </h5>
                                    <h5 id="tipas" class="list-group-item-text">Patiekalo tipas:
                                        <?php
                                        echo '' . $row["type"] . '';
                                        ?>
                                    </h5>
                                    <h5 class="list-group-item-text">Įpakavimas:
                                        <?php
                                        echo '' . $row["wraping"] . '';
                                        ?>
                                    </h5>
                                    <h5 class="list-group-item-text"></h5>
                                    <?php
                                    $qEnterprise = $database->query("SELECT * FROM enterprises where id = '" . $row["enterprise_id"] . "'");
                                    $rEnterprise = $qEnterprise->fetch_assoc();
                                    ?>
                                    <p class="list-group-item-text">Firma: <?php echo $rEnterprise["enterprise_name"]; ?></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="lead"><?php echo '€' . $row["price"] . ' EUR'; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">Pridėti į krepšelį</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p>Sistemoje nėra pridėta patiekalų :(</p>
                <?php } ?>
            </div>
        </div>
    </body>
</html>