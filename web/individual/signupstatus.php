<?php

require("connectDB.php");
$db = get_db();

$id = htmlspecialchars($_POST["username"]);
$pass = htmlspecialchars($_POST["password"]);
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
$firstname = htmlspecialchars($_POST["firstname"]);
$lastname = htmlspecialchars($_POST["lastname"]);

try {
    $userNameAvailability = $db->prepare("SELECT COUNT(*) 
FROM user_account 
WHERE account_email =:id");
$userNameAvailability->bindValue(':id', $id, PDO::PARAM_STR);
$userNameAvailability->execute();

$userNameAvailable = $userNameAvailability->fetchColumn() == 0;

} catch (PDOException $ex) {
    echo "Error ex: ". $ex;
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>5 Videos Login</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <style>
        h1, h2, h3, label, button, input, form {
            padding: 10px 10px 10px 10px;
        }
    </style> -->
</head>
<div class="container">
<body>

<?php
//logic for insert

if ($userNameAvailable) {

    try {
        $addUserStatment = $db->prepare("INSERT INTO user_account (first_name, last_name, account_email, pass_hash)
        VALUES (:firstname , :lastname , :username , :pass)");
        $addUserStatment->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $addUserStatment->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $addUserStatment->bindValue(':username', $id, PDO::PARAM_STR);
        $addUserStatment->bindValue(':pass', $hashedPass, PDO::PARAM_STR);
        $addUserStatment->execute();

        header('Location: videoslogin.php');
} catch (PDOException $ex1) {
    echo "Error ex1: ". $ex1;
}

}
else {
    //user name unavailable -> go to signup page
    ?>
    <h2>Username <?php echo $id; ?> is already in use</h2>
    <h3><a href="signup.html">Return to signup page</a></h3>
    <?php
}



?>
</body>
</div>
</html>