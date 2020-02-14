<?php

require("connectDB.php");
$db = get_db();

$id = htmlspecialchars($_POST["username"]);
$pass = htmlspecialchars($_POST["password"]);

try {
    $signInValidation = $db->prepare("SELECT COUNT(*) 
FROM user_account 
WHERE account_email =:id AND pass_hash =:pass");
$signInValidation->bindValue(':id', $id, PDO::PARAM_STR);
$signInValidation->bindValue(':pass', $pass, PDO::PARAM_STR);
$signInValidation->execute();

$signInValidated = $signInValidation->fetchColumn() > 0;

} catch (PDOException $ex) {
    echo "Error ex: ". $ex;
    
}


if ($signInValidated) {
    //logic to display results
    try {
        $displayNameQuery = $db->prepare("SELECT concat(first_name, ' ', last_name) 
        FROM user_account 
        WHERE account_email =:id");
        $displayNameQuery->bindValue(':id', $id, PDO::PARAM_STR);
        $displayNameQuery->execute();
    
        $displayName = $displayNameQuery->fetchAll(PDO::FETCH_ASSOC);
    
        $videos = $db->prepare("SELECT vl.ranking, vl.link 
        FROM video_links AS vl
        LEFT JOIN user_account AS ua 
        ON vl.user_id = ua.user_id
        WHERE ua.user_id =:id
        ORDER BY vl.ranking;");
        $videos->bindValue(':id', $id, PDO::PARAM_STR);
    
        $videos->execute();
    
        $rows = $videos->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex1) {
        echo "Error ex1: " . $ex1;
    }

   

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo 'Top 5 Videos For ' . $displayName; ?></title>
        <style>
            tr, th, td {
                padding: 10px;
            }
            h1, label, button, input, form {
            padding: 10px 10px 10px 10px;
        }
        </style>
    </head>
    <body>
    <h1><?php echo 'Top 5 Videos For ' . $displayName; ?></h1>
    
    <?php 
    if ($rows) {
        ?>
        <table>
            <tr>
                <th>Rank</th>
                <th>Link</th>
            </tr>
        <?php
        foreach( $rows as $search_result ) {
        $ranking = $search_result['ranking'];
        $link = $search_result['link'];
        ?>
        <tr>
        <?php
        echo $ranking . ':'; ?> <a href="<?php echo $link; ?>"><?php echo $link; ?></a><br>
        </tr>
    <?php 
        }
        ?>
        </table>
        <?php

    } else {
        ?>
        <p>No results found.</p>
        <?php 
    }
    ?>
    </body>
    </html>

    <?php
}
else {
    header('Location: videoslogin.html?invalid=true');
}

?>