<?php
include 'dbConfig.php';
$Email=$_REQUEST['Email'];
$query = "DELETE FROM adminUser WHERE Email='".$Email."'"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: dashboard.php"); 
?>