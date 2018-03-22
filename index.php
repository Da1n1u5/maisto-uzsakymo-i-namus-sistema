<?php
include_once("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<style type="text/css">
    body{
     padding: 0 !important;
     margin: 0 !important;
    }
</style>
    </head>
    <body>              
            <?php
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/menu.php");
                ?>
                <div style="text-align: center;color:green">
                    <br><br>
                    <h1>Sveiki prisijungę prie IFS-5 studento Dainiaus Dovidonio it projekto prototipo</h1>
                </div><br>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            } else {
               echo '<div>';
               echo '<img src="pictures/top.png" class="img-responsive" alt="Responsive image" id="top">';
                echo '</div>';
                echo '<table class="center"><tr><td>';
                echo '</td></tr><tr><td>';
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                include("loginform1.php");
                echo " </td></tr> ";               
            }
            echo "<tr><td>";
            include("include/footer.php");
            echo "</td></tr>";
            echo '</table>';
            ?>
        

</body>
</html>