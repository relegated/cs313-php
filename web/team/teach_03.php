<?php
$majors = [
  'cs' => 'Computer Science',
  'wd' => 'Web Design and Development',
  'cit' => 'Computer Information Technology',
  'ce' => 'Computer Engineering'
]
?>
<!DOCTYPE html>
<html lang="en">
​
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!--For jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--For Bootstrap-->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>Teach 03: PHP Form Handling</title>
</head>
​
<body>
  <div class="container">
    <div class="row center">
      <form action="form_03.php" method="post">
        <label for="name">Name</label><br />
        <input id="name" name="name" type="text" placeholder="Enter your Name" /><br />
​
        <label for="email">Email</label><br />
        <input id="email" name="email" type="text" placeholder="Enter your e-mail address" /><br />
​
        <label for="comments">Comments</label><br />
        <textarea name="comments" id="comments" cols="30" rows="10" placeholder="Enter your comments here"></textarea><br />
​
        <label for="radio">Major</label><br>
        <?php
        foreach ($majors as $key => $major) {
        ?>
          <input type="radio" name="major" value="<?php echo $major; ?>" /><?php echo $major; ?><br />
        <?php
        }
        ?>
​
        <label for="checkbox">Where have you been?</label><br>
        <input type="checkbox" name="continents[]" value="NA"> I have been to North America<br>
        <input type="checkbox" name="continents[]" value="SA"> I have been to South America<br>
        <input type="checkbox" name="continents[]" value="EU"> I have been to Europe<br>
        <input type="checkbox" name="continents[]" value="AS"> I have been to Asia<br>
        <input type="checkbox" name="continents[]" value="AF"> I have been to Africa<br>
        <input type="checkbox" name="continents[]" value="AU"> I have been to Australia<br>
        <input type="checkbox" name="continents[]" value="AN"> I have been to Antarctica<br>
​
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
​
</html>