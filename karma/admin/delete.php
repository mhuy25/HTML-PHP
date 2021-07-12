<?php
include_once("../connect.php");
$id = $_GET['id'];

$sql = "DELETE FROM products WHERE ID = '$id'";

echo $sql;
mysqli_query($connect,$sql);
mysqli_close($connect);
header("Location:product-table.php");
?>