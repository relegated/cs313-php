<?php

require("connectDB.php");
$db = get_db();

$id = $_POST["user_id"];

$videos = $db->prepare("SELECT ua.first_name, ua.last_name, vl.ranking, vl.link 
FROM video_links AS vl
LEFT JOIN user_account AS ua 
ON vl.user_id = ua.user_id
WHERE ua.user_id =:id;");
$videos->bindValue(':id', $id, PDO::PARAM_STR);

$videos->execute();

$rows = $videos->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search results</title>
</head>
<body>
  <h1>Search Results</h1>
  
  <?php 
  if ($rows) {
    foreach( $rows as $search_result ) {
      $first_name = $search_result['first_name'];
      $last_name = $search_result['last_name'];
      $ranking = $search_result['ranking'];
      $link = $search_result['link'];
  
     echo $first_name . " " . $last_name . " " . $ranking . ':' ?> <a href="<?php echo $link; ?>"><?php echo $link; ?></a><br>
  <?php 
    }
  } else {
    ?>
    <p>No results found.</p>
    <?php 
  }
  ?>
</body>
</html>