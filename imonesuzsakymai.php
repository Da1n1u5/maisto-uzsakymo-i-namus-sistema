<?php
include('include/session.php');
if ($session->logged_in && $session->userlevel == 3) {
    ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
            <title>pateikiami užsakymai įmonei peržiūrėti</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                    </td></tr>
                <tr><td>
                        <?php
                        include("include/menu.php");
                        include("imonesuzsakymailentele.php")
                        ?>
                <tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis
} else {
    header("Location: index.php");
}
?>
