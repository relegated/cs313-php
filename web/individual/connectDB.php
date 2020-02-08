<?php
function get_db()
{

   // default Heroku Postgres configuration URL
   $dbUrl = getenv('DATABASE_URL');


   $dbopts = parse_url($dbUrl);

   $dbHost = $dbopts["host"];
   $dbPort = $dbopts["port"];
   $dbUser = $dbopts["user"];
   $dbPassword = $dbopts["pass"];
   $dbName = ltrim($dbopts["path"], '/');

   try {
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $ex) {
      print "<p>error: " . $ex->getMessage() . "</p>\n\n";
      die();
   }
      
   return $db;
}?>
