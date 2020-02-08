<?php
require ('connectDB.php');
$db = get_db();

$id = $_GET["id"];

$search_statement = $db->prepare('SELECT * FROM scriptures WHERE id=:id');
$search_statement->bindValue(':id', $id, PDO::PARAM_STR);
$search_statement->execute();
$row = $search_statement->fetch(PDO::FETCH_ASSOC);
$content = $row['content'];

function getTitle($row) {
    $book = $row['book'];
    $chapter = $row['chapter'];
    $verse = $row['verse'];
    return "$book $chapter:$verse";
}

$title = getTitle($row);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
</head>
<body>
    <h1><?= $title; ?></h1>
    <p><?= $content; ?></p>
</body>
</html>