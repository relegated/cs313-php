<?php
$name = $_POST['name'];
$email = $_POST['email'];
$comments = $_POST['comments'];
$major = $_POST['major'];
$input_continents = $_POST['continents'];
$continents = ['NA' => 'North America', 'SA' => 'South America', 'EU' => 'Europe', 'AS' => 'Asia', 'AU' => 'Australia', 'AF' => 'Africa', 'AN' => 'Antarctica'];
​
echo '<p>Your name is ' . $name . '</p>';
echo '<p>Your email is <a href="mailto:' . $email . '">' . $email . '</a></p>';
echo '<p>Comments: ' . $comments . '</p>';
echo '<p>Major: ' . $major . '</p>';
​
echo '<p>Continents I have been to: </p>';
echo '<ul>';
foreach ( $input_continents as $continent ) {
  if (array_key_exists($continent, $continents)) {
  ?>
  <li><?php echo $continents[$continent]; ?> </li>
  <?php
  }
}
echo '</ul>';