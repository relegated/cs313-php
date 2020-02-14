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
        $displayNameQuery = $db->prepare("SELECT concat(first_name, ' ', last_name) AS fullname
        FROM user_account 
        WHERE account_email =:id");
        $displayNameQuery->bindValue(':id', $id, PDO::PARAM_STR);
        $displayNameQuery->execute();
    
        $displayNameArray = $displayNameQuery->fetchAll(PDO::FETCH_ASSOC);
        $displayName = "";
        foreach ($displayNameArray as $name) {
            $displayName = $name['fullname'];
        }
    
        
    } catch (PDOException $ex1) {
        echo "Error ex1: " . $ex1;
    }

   try {
    $videos = $db->prepare("SELECT vl.ranking, vl.link 
    FROM video_links AS vl
    LEFT JOIN user_account AS ua 
    ON vl.user_id = ua.user_id
    WHERE ua.account_email =:id
    ORDER BY vl.ranking;");
    $videos->bindValue(':id', $id, PDO::PARAM_STR);

    $videos->execute();

    $rows = $videos->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $ex2) {
       echo "Error ex2: ". $ex2;
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
        <tr> <td>
        <?php
        echo $ranking . ':'; ?></td>
         <td><a href="<?php echo $link; ?>"><?php echo $link; ?></a></td>
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
    header('Location: videoslogin.php?invalid=true');
}

?>