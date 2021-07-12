<?php
include_once("../connect.php");
$id = $_GET['id'];

$sql = "DELETE FROM users WHERE Userid = '$id'";

echo $sql;
mysqli_query($connect,$sql);
mysqli_close($connect);
header("Location:usertable.php");
?>