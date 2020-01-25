<?php
session_start();

$_SESSION["lastPage"] = "03shoppingCartBrowse.php";

?>

<html>
<head>
<title>Shopping</title>
<link rel="stylesheet" type="text/css" href="03shoppingCartStyle.css">
</head>
<body>
<h1>Browse</h1>

<form id="inventoryForm" action="03shoppingCartView.php" method="post">
<table>
<tr>
    <th>Item</th>
    <th>Image</th>
    <th>Quantity</th>
    <th>Price Per Unit</th>
</tr>
<tr><td class="identifier">Bag of Gold</td>
    <td><img src="../images/bagOfGold.png" alt="Bag of Gold"></td>
    <td><label class="qty" for="bagOfGold">qty<label></td>
    <td><input type="number" id="bagOfGold" name="bagOfGoldQty" value="0" min="0" max="5"></td>
    <td class="price">$2,000</td>
</tr>
<tr>
    <td class="identifier">Two-Headed Cobra</td>
    <td><img src="../images/twoHeadedCobra.png" alt="Two-headed Cobra"></td>
    <td><label class="qty" for="twoHeadedCobra">qty<label></td>
    <td><input type="number" id="twoHeadedCobra" name="twoHeadedCobraQty" value="0" min="0" max="5"> </td>
    <td class="price">$700</td>
</tr>
<tr><td class="identifier">300 lb Bag of Bean Burritos</td>
    <td><img src="../images/burritos.png" alt="Burritos"></td>
    <td><label class="qty" for="burritos">qty<label></td>
    <td><input type="number" id="burritos" name="burritosQty" value="0" min="0" max="5"></td>
    <td class="price">$200</td>
</tr>
<tr><td class="identifier">Life-size Statue of Andre the Giant made of Swiss Cheese</td>
    <td><img src="../images/statue.png" alt="Statue"></td>
    <td><label class="qty" for="statue">qty<label></td>
    <td><input type="number" id="statue" name="statueQty" value="0" min="0" max="5"> </td>
    <td class="price">$3,812</td>
</tr>
<tr><td class="identifier">Roll of Paper Towels</td>
    <td><img src="../images/paperTowels.png" alt="Paper Towels"></td>
    <td><label class="qty" for="paperTowels">qty<label></td>
    <td><input type="number" id="paperTowels" name="paperTowelsQty" value="0" min="0" max="5"> </td>
    <td class="price">$2</td>
</tr>
<tr class="disabled"><td class="identifier">Ark of the Covenant (Out of Stock)</td>
    <td><img src="../images/ark.png" alt="Ark of the Covenant"></td>
    <td><label class="qty" for="ark">qty<label></td>
    <td><input type="number" id="ark" min="0" max="5" value="0" disabled> </td>
    <td class="price">$2,000,000,000</td>
</tr>
    
</table>
<button type="submit">Add to Cart</button>
</form>

</body>
</html>