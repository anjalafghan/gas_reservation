<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";

$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$username=$_SESSION['user'];
$password=$_SESSION['password'];

$customer_id=$_SESSION['customer_id'];
$first=$_SESSION['first'];
$last=$_SESSION['last'];
$address=$_SESSION['address'];
$result=mysqli_query($connection,"SELECT address FROM bookings WHERE first_name = '$first' AND last_name='$last' AND address='$address'");
$count=mysqli_num_rows($result);
if($count > 0){
  echo "Already Booked Gas";
}
else{
mysqli_query($connection,"INSERT INTO bookings (first_name,last_name,status,address) VALUES ('$first','$last','Successfully Booked Gas','$address')");

mysqli_query($connection,"UPDATE customer SET gas_booked = 'YES' WHERE customer_id = $customer_id");
echo "Gas Booked Successfully";
}
 ?>
