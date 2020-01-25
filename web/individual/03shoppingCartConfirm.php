<?php
session_start();

include '03cartItemClass.php';

$address = strip_tags($_POST['address']);
$bagOfGold = $_SESSION['bagOfGold'];
$twoHeadedCobra = $_SESSION['twoHeadedCobra'];
$burrito = $_SESSION['burritos'];
$statue = $_SESSION['statue'];
$paperTowel = $_SESSION['paperTowels'];

?>

<html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <h1>Order Confirmation</h1>

        <p>The following items</p>
        <?php
            echo $bagOfGold->qty;
            echo " ".$bagOfGold->name."<br>";
            echo $twoHeadedCobra->qty;
            echo " ".$twoHeadedCobra->name."<br>";
            echo $burrito->qty;
            echo " ".$burrito->name."<br>";
            echo $statue->qty;
            echo " ".$statue->name."<br>";
            echo $paperTowel->qty;
            echo " ".$paperTowel->name."<br>";
        ?>
        <p>will be delivered to </p>
        <?php
            echo $address;
        ?>
    </body>
</html>