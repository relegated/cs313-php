<?php
require ('connectDB.php');
$db = get_db();

$search = $_POST["search"];

$search_statement = $db->prepare('SELECT * FROM scriptures WHERE book=:book');
$search_statement->bindValue(':book', $search, PDO::PARAM_STR);
$search_statement->execute();
$rows = $search_statement->fetchAll(PDO::FETCH_ASSOC);
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
      $scripture_id = $search_result['id'];
      $book = $search_result['book'];
      $chapter = $search_result['chapter'];
      $verse = $search_result['verse'];
  ?>
    <a href="scripture_details.php?id=<?php echo $scripture_id; ?>"><?php echo $book . $chapter . ':' . $verse; ?></a><br>
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