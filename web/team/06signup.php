<?php

require("connectDB.php");
$db = get_db();

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