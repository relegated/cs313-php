<?php
session_start();

//Cart Item class
include '03cartItemClass.php';

//initialize a cart item for each product - unless we have canceled
$bagOfGold = new CartItem("Bag of Gold", 0, 2000);
$twoHeadedCobra = new CartItem("Two Headed Cobra", 0 , 700);
$burrito = new CartItem("300 lb Bag of Bean Burritos", 0, 200);
$statue = new CartItem("Life-size Statue of Andre the Giant made of Swiss Cheese", 0, 3812);
$paperTowel = new CartItem("Roll of Paper Towels", 0, 2);
$ark = new CartItem("Ark of the Covenant", 0, 2000000000);

if ($_SESSION['lastPage'] != "03shoppingCartCheckout.php") {
    initializeWithPostData();
} 

function initializeWithPostData(){
    global $bagOfGold, $twoHeadedCobra, $burrito, $statue, $paperTowel;
    $bagOfGold = new CartItem("Bag of Gold", strip_tags($_POST['bagOfGoldQty']), 2000);
    $twoHeadedCobra = new CartItem("Two Headed Cobra", strip_tags($_POST['twoHeadedCobraQty']), 700);
    $burrito = new CartItem("300 lb Bag of Bean Burritos", strip_tags($_POST['burritosQty']), 200);
    $statue = new CartItem("Life-size Statue of Andre the Giant made of Swiss Cheese", strip_tags($_POST['statueQty']), 3812);
    $paperTowel = new CartItem("Roll of Paper Towels", strip_tags($_POST["paperTowelsQty"]), 2);
    
}

$_SESSION['bagOfGold'] = serialize($bagOfGold);
$_SESSION['twoHeadedCobra']  = serialize($twoHeadedCobra);
$_SESSION['burritos'] = serialize($burrito);
$_SESSION['statue'] = serialize($statue);
$_SESSION['paperTowels'] = serialize($paperTowel);
$_SESSION['ark'] = serialize($ark);

setlocale(LC_MONETARY, 'en_US.UTF-8');

?>

<html>
<head>
    <title>View Cart</title>
    <link rel="stylesheet" type="text/css" href="03shoppingCartStyle.css">
</head>
<body>
<h1>Critical Purchasing Inc.</h1>
<h2>View Cart</h2>

<form id="viewCartForm" action="03shoppingCartCheckout.php" method="post">
<ul>
<li><span class="identifier">Bag of Gold</span>
    <span><img src="../images/bagOfGold.png" alt="Bag of Gold" height="50" width="50"></span>
    <label class="qty" for="bagOfGold">qty<label>
    <?php echo '<input type="number" id="bagOfGold" name="bagOfGoldQty" min="0" max="5" value="'.$bagOfGold->qty.'"disabled>'?>
    <span class="price">/unit: $2,000</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($bagOfGold->total)).'</span>'?>
</li>
<li>
    <span class="identifier">Two-Headed Cobra</span>
        <span><img src="../images/twoHeadedCobra.png" alt="Two-headed Cobra" height="50" width="50"></span>
    <label class="qty" for="twoHeadedCobra">qty<label>
    <?php echo '<input type="number" id="twoHeadedCobra" name="twoHeadedCobraQty" min="0" max="5" value="'.$twoHeadedCobra->qty.'"disabled>'?> 
    <span class="price">/unit: $700</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($twoHeadedCobra->total)).'</span>'?>
</li>
<li><span class="identifier">300 lb Bag of Bean Burritos</span>
    <span><img src="../images/burritos.png" alt="Burritos" height="50" width="50"></span>
    <label class="qty" for="burritos">qty<label>
    <?php echo '<input type="number" id="burritos" name="burritosQty" min="0" max="5" value="'.$burrito->qty.'"disabled>'?>
    <span class="price">/unit: $200</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($burrito->total)).'</span>'?>
</li>
<li><span class="identifier">Life-size Statue of Andre the Giant made of Swiss Cheese</span>
    <span><img src="../images/statue.png" alt="Life-size Statue of Andre the Giant made of Swiss Cheese" height="50" width="50"></span>
    <label class="qty" for="statue">qty<label>
    <?php echo '<input type="number" id="statue" name="statueQty" min="0" max="5" value="'.$statue->qty.'"disabled>'?> 
    <span class="price">/unit: $3,812</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($statue->total)).'</span>'?>
</li>
<li><span class="identifier">Roll of Paper Towels</span>
    <span><img src="../images/paperTowels.png" alt="Roll of Paper Towels" height="50" width="50"></span>
    <label class="qty" for="paperTowels">qty<label>
    <?php echo '<input type="number" id="paperTowels" name="paperTowelsQty" min="0" max="5" value="'.$paperTowel->qty.'"disabled>'?> 
    <span class="price">/unit: $2</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($paperTowel->total)).'</span>'?>
</li>
<li class="disabled"><span class="identifier">Ark of the Covenant (Out of Stock)</span>
    <span><img src="../images/ark.png" alt="Ark of the Covenant" height="50" width="50"></span>
    <label class="qty" for="ark">qty<label>
    <input type="number" id="ark" min="0" max="5" value="0" disabled> 
    <span class="price">/unit: $2,000,000,000</span>
    <?php echo '<span class="total"> Total: '.money_format("%.2n", floatval($ark->total)).'</span>'?>
</li>
    
</ul>

<button type="submit">Check Out</button>
</form>
<form action="03shoppingCartBrowse.php" method="post">
            <button type="submit">Go Back</button>
        </form>
</body>
</html>