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
        <link rel="stylesheet" type="text/css" href="03shoppingCartStyle.css">
    </head>
    <body>
    <h1>Critical Purchasing Inc.</h1>
        <h2>Order Confirmation - Thank you for your purchase!</h2>

        <p>The following items</p>
        <ul>
        <?php
            echo "<li>".$bagOfGold->qty."x ".$bagOfGold->name."</li>";
            echo "<li>".$twoHeadedCobra->qty."x ".$twoHeadedCobra->name."</li>";
            echo "<li>".$burrito->qty."x ".$burrito->name."</li>";
            echo "<li>".$statue->qty."x ".$statue->name."</li>";
            echo "<li>".$paperTowel->qty."x ".$paperTowel->name."</li>";
            echo "<li>0x Ark of the Covenant</li>";
        ?>
        </ul>
        <br><p>will be delivered to </p><br><br>
        <?php
            echo $address;
            setlocale(LC_MONETARY, 'en_US.UTF-8');
            echo "<p>The grand total was ".money_format("%.2n", floatval($grandTotal))." </p>" ?>
    </body>
</html>