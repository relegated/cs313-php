<?php
session_start();

include '03cartItemClass.php';

$_SESSION["lastPage"] = "03shoppingCartCheckout.php";

?>

<html>
    <head>
        <title>Checkout</title>
    </head>
    <body>
        <h1>Checkout</h1>

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