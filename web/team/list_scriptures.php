<?php

require("connectDB.php");
$db = get_db();

$scriptures = $db->prepare("SELECT id, book, chapter, verse, content FROM scriptures");
$scriptures->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Scripture Resources</title>
</head>
<body>
<h1>Scripture Resources</h1>
  <table>
    <?php
      foreach( $scriptures as $scripture ) {
        $scripture_id = $scripture['id'];
        $book = $scripture['book'];
        $chapter = $scripture['chapter'];
        $verse = $scripture['verse'];
        $content = $scripture['content'];
        ?>
        <p><a href="scripture_details.php?id=<?php echo $scripture_id; ?>"><?php echo $book . ' ' . $chapter . ':' . $verse; ?></a></p>
        <?php
      }
    ?>
  </table>

  <hr>
  
  <h2>Scripture Search</h2>
  
  <form action="search.php" method="POST">
    <label for="search">Search By Book</label>
    <input type="text" name="search" placeholder="John">

    <button type="submit">Search</button>
  </form>

</body>