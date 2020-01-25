<?php
session_start();
echo session_id();

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
            echo "<p>".$bagOfGold->qty." ".$bagOfGold->name."</p>";
            echo "<p>".$twoHeadedCobra->qty." ".$twoHeadedCobra->name."</p>";
            echo "<p>".$burrito->qty." ".$burrito->name."</p>";
            echo "<p>".$statue->qty." ".$statue->name."</p>";
            echo "<p>".$paperTowel->qty." ".$paperTowel->name."</p>";
        ?>
        <p>will be delivered to </p>
        <?php
            echo $address;
        ?>
    </body>
</html>