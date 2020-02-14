<?php


require("connectDB.php");
$db = get_db();

$id = htmlspecialchars($_POST["userid"]);
$videoNumber = htmlspecialchars($_POST["videonumber"]);
$videoLink = htmlspecialchars($_POST["videolink"]);

$doesVideoExistQuery = $db->prepare("SELECT COUNT(*)
FROM video_links
WHERE user_id =:id AND link =:videolink");
$doesVideoExistQuery->bindValue(':id', $id, PDO::PARAM_INT);
$doesVideoExistQuery->bindValue(':videolink', $videoLink, PDO::PARAM_STR);

$doesVideoExistQuery->execute();

if ($doesVideoExistQuery->fetchColumn() > 0) {
    //hard stop on preventing a duplicate link
    http_response_code(409);
    die();
}

//insert or update
$doesRankExistQuery = $db->prepare("SELECT COUNT(*)
FROM video_links
WHERE user_id =:id AND ranking =:videoNumber");
$doesRankExistQuery->bindValue(':id', $id, PDO::PARAM_INT);
$doesRankExistQuery->bindValue(':videonumber', $videoLink, PDO::PARAM_STR);

$doesRankExistQuery->execute();

if ($doesRankExistQuery->fetchColumn() > 0) {
    //update
    $updateLinkStatement = $db->prepare("UPDATE video_links
    SET link =:videolink
    WHERE user_id =:id AND ranking =:videoNumber");
    $updateLinkStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $updateLinkStatement->bindValue(':videonumber', $videoLink, PDO::PARAM_STR);
    $updateLinkStatement->bindValue(':videolink', $videoLink, PDO::PARAM_STR);

    $updateLinkStatement->execute();
    http_response_code(200);
    die();
}
else {
    //insert
    $insertLinkStatement = $db->prepare("INSERT INTO video_links (link, ranking, user_id)
    VALUES (:videolink , :videonumber , :id)");
    $insertLinkStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $insertLinkStatement->bindValue(':videonumber', $videoLink, PDO::PARAM_STR);
    $insertLinkStatement->bindValue(':videolink', $videoLink, PDO::PARAM_STR);

    $insertLinkStatement->execute();
    http_response_code(200);
    die();
}

?>