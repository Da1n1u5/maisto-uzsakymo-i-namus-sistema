<?php
if(!isset($_SESSION['userid'])){
    header("Location: patiekalai.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uzsakymas pavyko</title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Užsakymo būsena</h1>
    <p>Jūsų užsakymas sėkmingai patvirtintas ir vygdomas</p>
    <p>Savo užsakymus bei jų būseną galite peržiūrėti skiltyje 'Mano užsakymai'</p>
</div>
</body>
</html>
