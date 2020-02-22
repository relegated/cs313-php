<?php
    $invalidLogin = $_GET['invalid'];
    if (is_null($invalidLogin)) {
        $invalidLogin = false;
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
        h1, label, button, input, form {
            padding: 10px 10px 10px 10px;
        }
    </style> -->
</head>

<body>
    <div class="container">
    <h1><?php if ($invalidLogin == true) { echo 'Invalid '; }?>Login</h1>
    <form action="userpage.php" method="POST">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:  </label>
        <input type="password" id="password" name="password"><br>
        <button type="submit">Sign In</button>
    </form>

    <form action="signup.html">
        <button type="submit">Create Account</button>
    </form>
    </div>
</body>

</html>