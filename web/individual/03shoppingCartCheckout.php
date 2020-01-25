<?php
session_start();

include '03cartItemClass.php';

$_SESSION["lastPage"] = "03shoppingCartCheckout.php";

?>

<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="03shoppingCartStyle.css">
    </head>
    <body>
    <h1>Critical Purchasing Inc.</h1>
        <h2>Checkout</h2>

        <form action="03shoppingCartConfirm.php" method="post">
            <p>Enter Address:</p>
            <p><textarea name="address" id="address" cols="30" rows="10" placeholder="Enter your address here"></textarea><p>
            <button type="submit">Confirm</button>
        </form>
        <form action="03shoppingCartBrowse.php" method="post">
            <button type="submit">Clear Cart</button>
        </form>
    </body>
</html>