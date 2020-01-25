<?php
session_start();

include '03cartItemClass.php';

$address = strip_tags($_POST['address']);
$bagOfGold = unserialize($_SESSION['bagOfGold']);
$twoHeadedCobra = unserialize($_SESSION['twoHeadedCobra']);
$burrito = unserialize($_SESSION['burritos']);
$statue = unserialize($_SESSION['statue']);
$paperTowel = unserialize($_SESSION['paperTowels']);

?>

<html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <h1>Order Confirmation</h1>

        <p>The following items</p>
        <?php
            echo "<p>".$bagOfGold->qty." ".$bagOfGold->name."</p>";
            echo "<p>".$twoHeadedCobra->qty." ".$twoHeadedCobra->name."</p>";
            echo "<p>".$burrito->qty." ".$burrito->name."</p>";
            echo "<p>".$statue->qty." ".$statue->name."</p>";
            echo "<p>".$paperTowel->qty." ".$paperTowel->name."</p>";
            print_r($_SESSION);
        ?>
        <p>will be delivered to </p>
        <?php
            echo $address;
        ?>
    </body>
</html>