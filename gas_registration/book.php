<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";

$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$username=$_SESSION['user'];
$password=$_SESSION['password'];
$stmt = mysqli_query($connection,"SELECT user_id FROM user WHERE username = '$username' AND password = '$password'");
while($row = $stmt->fetch_assoc()){
  $user_id = $row['user_id'];
}

$new = mysqli_query($connection,"SELECT * FROM customer WHERE customer_id = $user_id");
while ($row = $new->fetch_assoc()) {
  $customer_id = $row['customer_id'];
  $first = $row['first_name'];
  $last = $row['last_name'];
  $address = $row['address'];

}
$_SESSION['customer_id']=$customer_id;
$_SESSION['first']=$first;
$_SESSION['last']=$last;
$_SESSION['address']=$address;

?>


<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Book Ticket</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">
<style media="screen">
@font-face {
    font-family: "Cursive_edit";
    src: url(/Adine.ttf) format("truetype");
}
.customfont{
  font-family: "Cursive_edit" ;
}
  body{
    background-color: #000;
color : white;
    }
  .container{
    color: #FF4431;
  }

</style>
</head>
<body>

<center>
  <p>
    <h5>gas reservation</h5>
  </p>
</center>

<form class="" action="book_gas.php" id="form" method="post">
  <div class="container">
    <div class="row">
    <div class="six columns">
      <label for="name">First Name</label>
      <input type="text" name="first_name" id="first_name" value="<?php echo $first ?>">
    </div>
    </div>
    <div class="row">
      <div class="six columns">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $last ?>">
      </div>
    </div>
    <div class="row">
      <div class="six columns">
        <label for="address">Address</label>
  <textarea class="u-full-width" placeholder="address" name="address" id="address" ><?php echo $address ?></textarea>
    </div>
    </div>

  <div class="row">
    <input class="button-primary" type="submit" form="form" value="Book Gas">
  </div>
  </div>
</form>

<script type="text/javascript">
submitForm(){
  document.getElementById('form').submit();
}

</script>
</body>
</html>
