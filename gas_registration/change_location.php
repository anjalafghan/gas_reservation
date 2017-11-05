<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$customer_id=$_SESSION['customer_id'];
$first_name = $_SESSION['first'];
$last_name = $_SESSION['last'];

$add=$_POST["address"];


$address=htmlspecialchars($_POST["address"]);
  mysqli_query($connection,"UPDATE customer SET address = '$address' WHERE customer_id = $customer_id ");
 mysqli_query($connection,"UPDATE bookings SET address = '$address' WHERE first_name = '$first_name' AND last_name = '$last_name' ");

 echo "Location Changed Successfully";

 ?>
