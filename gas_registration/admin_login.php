<?php
session_start();
$dbhost="localhost";
$dbuser="nikhil";
$dbpass="nikhil";
$dbname="gas_reservation";

$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$username=$_POST["username"];
$password=$_POST["password"];
$result=mysqli_query($connection,"SELECT admin_id FROM admin WHERE admin_username='$username' AND admin_password='$password'");
$count=mysqli_num_rows($result);
if($count==1)
{
  header("Location: admin_view.php");
die();
  echo "<h1>Login Successfull</h1>";

}
else {
  echo "<h1>Login Failure</h1>" ;
}

?>
