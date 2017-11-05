<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";

$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$username=$_POST["username"];
$password=$_POST["password"];
$_SESSION['user']= $username;
$_SESSION['password']= $password;
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
$result=mysqli_query($connection,"SELECT user_id FROM user WHERE username='$username' AND password='$password'");
$count=mysqli_num_rows($result);
if($count==1)
{
  header("Location: main.php");
die();
  echo "<h1>Login Successfull</h1>";

}
else {
  echo "<h1>Login Failure</h1>" ;
}

?>
