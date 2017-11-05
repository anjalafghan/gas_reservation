<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";
$username=$_SESSION['user'];
$password=$_SESSION['password'];

$customer_id=$_SESSION['customer_id'];
$first=$_SESSION['first'];
$last=$_SESSION['last'];
$address=$_SESSION['address'];
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$stmt = mysqli_query($connection,"SELECT * FROM bookings WHERE first_name = '$first' AND last_name = '$last' ");
while($row = $stmt->fetch_assoc()){
  $id = $row['booking_id'];
  $date = $row['date_of_request'];
  $status = $row['status'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>View Bookings</title>
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
  }

  .button.button-primary,
  button.button-primary,
  input[type="submit"].button-primary,
  input[type="reset"].button-primary,
  input[type="button"].button-primary {
    color: #FFF;
    background-color: #f03232;
    border-color: #f03232; }

</style>
</head>
<body>


<div class="container">
  <?php

  $sql = "SELECT * FROM bookings ";
  $result = $connection->query($sql);
  if ($result->num_rows >= 0) {
      while($row = $result->fetch_assoc()) {
  ?>
          <div class="container">
            <table class="u-full-width">
  <thead>
    <tr>
      <th>Booking ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Date Of Request</th>
      <th>Status</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody>
    <form class="" action="delete.php" method="post">


    <tr>
      <td><?php echo $row['booking_id']; ?></td>
      <td><?php echo $row['first_name']; ?></td>
      <td><?php echo $row['last_name']; ?></td>
      <td><?php echo $row['date_of_request']; ?></td>
      <td><?php echo $row['status']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><input class="button-primary"  onclick="submitForm()" type="submit"  name="" value=" Delete ">
        <input type="hidden" name="value"  id="value" value="<?php echo $row['booking_id']; ?>" >
        <input type="hidden" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>">
</td>
    </tr>
  </form>
  </tbody>
</table>
          </div>

  <?php

      }
  } else {
      echo "0 results";
  }

   ?>
</div>

<script type="text/javascript">
  submitForm(){

  }
</script>
</body>
</html>
