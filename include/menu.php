<?php
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
    <!doctype html>
    <html lang="en">
        <head>
            <title>meniu</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        </head>
        <style type="text/css">
            .navbar-default {
                background-color: #ffdd62 !important;
                border-color: #ff62a9 !important;
            }
            .navbar-default .navbar-brand {
                color: #000000 !important;
            }
            .navbar-default .navbar-brand:hover,
            .navbar-default .navbar-brand:focus {
                color: #e9f4f4 !important;
            }
            .navbar-default .navbar-text {
                color: #000000 !important;
            }
            .navbar-default .navbar-nav > li > a {
                color: #000000 !important;
            }
            .navbar-default .navbar-nav > li > a:hover,
            .navbar-default .navbar-nav > li > a:focus {
                color: #e9f4f4 !important;
            }
            .navbar-default .navbar-nav > .active > a,
            .navbar-default .navbar-nav > .active > a:hover,
            .navbar-default .navbar-nav > .active > a:focus {
                color: #e9f4f4 !important;
                background-color: #ff62a9 !important;
            }
            .navbar-default .navbar-nav > .open > a,
            .navbar-default .navbar-nav > .open > a:hover,
            .navbar-default .navbar-nav > .open > a:focus {
                color: #e9f4f4 !important;
                background-color: #ff62a9 !important;
            }
            .navbar-default .navbar-toggle {
                border-color: #ff62a9 !important;
            }
            .navbar-default .navbar-toggle:hover,
            .navbar-default .navbar-toggle:focus {
                background-color: #ff62a9 !important;
            }
            .navbar-default .navbar-toggle .icon-bar {
                background-color: #000000 !important;
            }
            .navbar-default .navbar-collapse,
            .navbar-default .navbar-form {
                border-color: #000000 !important;
            }
            .navbar-default .navbar-link {
                color: #000000 !important;
            }
            .navbar-default .navbar-link:hover {
                color: #e9f4f4 !important;
            }

            @media (max-width: 767px) {
                .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                    color: #000000 !important;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                    color: #e9f4f4 !important;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                    color: #e9f4f4 !important;
                    background-color: #ff62a9 !important;
                }
            }
        </style>
        <body>
            <div>
                <img src="pictures/top.png" class="img-responsive" alt="Responsive image" id="top">
            </div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><?php echo "Prisijungęs vartotojas: <b>$session->username</b>"; ?></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li
                        <?php
                        if ($k = $_SERVER['REQUEST_URI'])
                            $pos = strrpos($k, "/");
                        if ($pos === false) {

                        }
                        $r = strlen($k) - 1;
                        $a = substr($k, $pos + 1, strlen($k) - 1);
                        if (strcmp($a, "index.php") == 0)
                            echo'class="active" ';
                        ?>
                            ><a href="index.php">Apie tinklapį</a></li>
                            <?php
                            $level = $session->userlevel;
                            if ($level == 1) {
                                ?>
                            <li
                            <?php
                            if (strcmp($a, "patiekalai.php") == 0)
                                echo'class="active" ';
                            ?>
                                ><a href="patiekalai.php">Patiekalai</a></li>
                            <li><a  href="uzsakymai.php">Mano užsakymai</a></li>
                            <li><a  href="imoniureitingai.php">Įmonių reitingai</a></li>
                            <li><a  href="klientoimoniureitingai.php">kliento Įmonių reitingai</a></li>
                            <?php
                        }

                        if ($level == 3) {
                            ?>
                            <li><a  href="patiekaloPridėjimas.php">Pridėti naują patiekalą</a></li>
                            <li><a  href="imonesivestipatiekalai.php">Peržiūrėti įvestus patiekalus</a></li>
                            <li><a  href="imonesuzsakymai.php">Užsakymų suvestinė</a></li>

                            <?php
                        }
                        if ($level == 9) {
                            ?>
                            <li><a href="adminperzuretivartotojus.php">Vartotojų atasakaita</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="process.php">Atsijungti</a></li>
                </div>
            </nav>
        </body>
    </html>
    <script>
        $(document).ready(function() {
            $(".dropdown-toggle").dropdown();
        });
    </script>
    <?php
}//Meniu baigtas




