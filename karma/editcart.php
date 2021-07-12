<?php
session_start();
if(isset($_POST['id']) && isset($_POST['size']) && isset($_POST['amount']) && $_POST['amount']!=""){
	$id=$_POST['id'];
	$size=$_POST['size'];
	$amount=$_POST['amount'];
	$chenhlech=($_SESSION[$id][$size]-$amount);
	$_SESSION[$id][$size]=$amount;
	$_SESSION['cart'][$id]=$_SESSION['cart'][$id]-($chenhlech);
	if($amount==0){
		unset($_SESSION[$id][$size]);
	};
	require_once('connect.php');
	$results=mysqli_query($connect,"SELECT * FROM products WHERE ID='$id'");
	$row=mysqli_fetch_assoc($results);
	echo $row["PRICE"]*$amount;
	mysqli_free_result($results);
	mysqli_close($connect);
	
}
?>