<?php
session_start();
echo session_id();

$_SESSION["lastPage"] = "03shoppingCartBrowse.php";

?>

<html>
<head>
<title>Shopping</title>
</head>
<body>
<h1>Browse</h1>

<form id="inventoryForm" action="03shoppingCartView.php" method="post">
<ul>
<li><span class="identifier">Bag of Gold</span>
    <label class="qty" for="bagOfGold">qty<label>
    <input type="number" id="bagOfGold" name="bagOfGoldQty" value="0" min="0" max="5"> 
    <span class="price">$2,000</span>
</li>
<li>
    <span class="identifier">Two-Headed Cobra</span>
    <label class="qty" for="twoHeadedCobra">qty<label>
    <input type="number" id="twoHeadedCobra" name="twoHeadedCobraQty" value="0" min="0" max="5"> 
    <span class="price">$700</span>
</li>
<li><span class="identifier">300 lb Bag of Bean Burritos</span>
    <label class="qty" for="burritos">qty<label>
    <input type="number" id="burritos" name="burritosQty" value="0" min="0" max="5">
    <span class="price">$200</span>
</li>
<li><span class="identifier">Life-size Statue of Andre the Giant made of Swiss Cheese</span>
    <label class="qty" for="statue">qty<label>
    <input type="number" id="statue" name="statueQty" value="0" min="0" max="5"> 
    <span class="price">$3,812</span>
</li>
<li><span class="identifier">Roll of Paper Towels</span>
    <label class="qty" for="paperTowels">qty<label>
    <input type="number" id="paperTowels" name="paperTowelsQty" value="0" min="0" max="5"> 
    <span class="price">$2</span>
</li>
<li class="disabled"><span class="identifier">Ark of the Covenant (Out of Stock)</span>
    <label class="qty" for="ark">qty<label>
    <input type="number" id="ark" min="0" max="5" value="0" disabled> 
    <span class="price">$2,000,000,000</span>
</li>
    
</ul>
<button type="submit">Add to Cart</button>
</form>

</body>
</html>