<?php
session_start();

include '03cartItemClass.php';

$address = strip_tags($_POST['address']);
$bagOfGold = unserialize($_SESSION['bagOfGold']);
$twoHeadedCobra = unserialize($_SESSION['twoHeadedCobra']);
$burrito = unserialize($_SESSION['burritos']);
$statue = unserialize($_SESSION['statue']);
$paperTowel = unserialize($_SESSION['paperTowels']);
$grandTotal = $bagOfGold->total + $twoHeadedCobra->total + $burrito->total + $statue->total + $paperTowel->total;


?>

<html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <h1>Order Confirmation</h1>

        <p>The following items</p>
        <?php
            echo "<p>".$bagOfGold->qty."x ".$bagOfGold->name."</p>";
            echo "<p>".$twoHeadedCobra->qty."x ".$twoHeadedCobra->name."</p>";
            echo "<p>".$burrito->qty."x ".$burrito->name."</p>";
            echo "<p>".$statue->qty."x ".$statue->name."</p>";
            echo "<p>".$paperTowel->qty."x ".$paperTowel->name."</p>";
        ?>
        <p>will be delivered to </p>
        <?php
            echo $address;
            setlocale(LC_MONETARY, 'en_US.UTF-8');
            echo "<p>The grand total was ".money_format("%.2n", floatval($grandTotal))." </p>" ?>
    </body>
</html>