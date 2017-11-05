<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";
$customer_id =
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$val=$_POST['value'];
$fname=$_POST['first_name'];

mysqli_query($connection,"DELETE FROM bookings WHERE booking_id = $val");
mysqli_query($connection,"UPDATE customer SET gas_booked = 'No' WHERE first_name = '$fname'");
header('Location: admin_view.php');
 ?>
