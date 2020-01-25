<?php
session_start();
echo session_id();

//Cart Item class
include '03cartItemClass.php';

//initialize a cart item for each product - unless we have canceled
if ($_SESSION['lastPage'] != "03shoppingCartCheckout.php") {
    initializeWithPostData();
} else {
    initializeWithZeroQtys();
}

function initializeWithPostData(){
    $_SESSION['bagOfGold'] = new CartItem("Bag of Gold", strip_tags($_POST['bagOfGoldQty']), 2000);
    $_SESSION['twoHeadedCobra'] = new CartItem("Two Headed Cobra", strip_tags($_POST['twoHeadedCobraQty']), 700);
    $_SESSION['burritos'] = new CartItem("300 lb Bag of Bean Burritos", strip_tags($_POST['burritosQty']), 200);
    $_SESSION['statue'] = new CartItem("Life-size Statue of Andre the Giant made of Swiss Cheese", strip_tags($_POST['statueQty']), 3812);
    $_SESSION['paperTowels'] = new CartItem("Roll of Paper Towels", strip_tags($_POST["paperTowelsQty"]), 2);
    $_SESSION['ark'] = new CartItem("Ark of the Covenant", 0, 2000000000);
}

function initializeWithZeroQtys(){
    $_SESSION['bagOfGold'] = new CartItem("Bag of Gold", 0, 2000);
    $_SESSION['twoHeadedCobra'] = new CartItem("Two Headed Cobra", 0 , 700);
    $_SESSION['burritos'] = new CartItem("300 lb Bag of Bean Burritos", 0, 200);
    $_SESSION['statue'] = new CartItem("Life-size Statue of Andre the Giant made of Swiss Cheese", 0, 3812);
    $_SESSION['paperTowels'] = new CartItem("Roll of Paper Towels", 0, 2);
    $_SESSION['ark'] = new CartItem("Ark of the Covenant", 0, 2000000000);
}

$bagOfGold = $_SESSION['bagOfGold'];
$twoHeadedCobra = $_SESSION['twoHeadedCobra'];
$burrito = $_SESSION['burritos'];
$statue = $_SESSION['statue'];
$paperTowel = $_SESSION['paperTowels'];

?>

<html>
<head>
    <title>View Cart</title>
</head>
<body>
<h1>View Cart</h1>

<form id="viewCartForm" action="03shoppingCartCheckout.php" method="post">
<ul>
<li><span class="identifier">Bag of Gold</span>
    <label class="qty" for="bagOfGold">qty<label>
    <?php echo '<input type="number" id="bagOfGold" name="bagOfGoldQty" min="0" max="5" value="'.$bagOfGold->qty.'"disabled>'?>
    <span class="price">$2,000</span>
</li>
<li>
    <span class="identifier">Two-Headed Cobra</span>
    <label class="qty" for="twoHeadedCobra">qty<label>
    <?php echo '<input type="number" id="twoHeadedCobra" name="twoHeadedCobraQty" min="0" max="5" value="'.$twoHeadedCobra->qty.'"disabled>'?> 
    <span class="price">$700</span>
</li>
<li><span class="identifier">300 lb Bag of Bean Burritos</span>
    <label class="qty" for="burritos">qty<label>
    <?php echo '<input type="number" id="burritos" name="burritosQty" min="0" max="5" value="'.$burrito->qty.'"disabled>'?>
    <span class="price">$200</span>
</li>
<li><span class="identifier">Life-size Statue of Andre the Giant made of Swiss Cheese</span>
    <label class="qty" for="statue">qty<label>
    <?php echo '<input type="number" id="statue" name="statueQty" min="0" max="5" value="'.$statue->qty.'"disabled>'?> 
    <span class="price">$3,812</span>
</li>
<li><span class="identifier">Roll of Paper Towels</span>
    <label class="qty" for="paperTowels">qty<label>
    <?php echo '<input type="number" id="paperTowels" name="paperTowelsQty" min="0" max="5" value="'.$paperTowel->qty.'"disabled>'?> 
    <span class="price">$2</span>
</li>
<li class="disabled"><span class="identifier">Ark of the Covenant (Out of Stock)</span>
    <label class="qty" for="ark">qty<label>
    <input type="number" id="ark" min="0" max="5" value="0" disabled> 
    <span class="price">$2,000,000,000</span>
</li>
    
</ul>

<button type="submit">Check Out</button>
</form>
<form action="03shoppingCartBrowse.php" method="post">
            <button type="submit">Go Back</button>
        </form>
</body>
</html>