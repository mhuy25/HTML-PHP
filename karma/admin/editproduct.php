<?php
if(isset($_FILES['pi_image'])){
	if($_FILES['pi_image']['error']>0){
		echo "file bi loi";
		$image="";
	}
	else{
		move_uploaded_file($_FILES['pi_image']['tmp_name'],'../img/'.$_FILES['pi_image']['name']);
		$image='img/'.$_FILES['pi_image']['name'];
	}
}
if(isset($_POST['pi_productid']) && isset($_POST['pi_productname'])){
	include("../connect.php");
	$id=$_POST['pi_productid'];
	$name=$_POST['pi_productname'];
	$brand=$_POST['pi_brand'];
	$color=$_POST['pi_color'];
	$price=$_POST['pi_price'];
	$sale=$_POST['pi_sale'];
	$oldprice=$_POST['pi_oldprice'];
	$inf=$_POST['pi_inf'];
	$status=$_POST['pi_status'];
	$sql="UPDATE `products` SET `NAME`='$name',`BRAND`='$brand',`COLOR`='$color',`PRICE`='$price',`SALE`='$sale',`OLDPRICE`='$oldprice',`INF`='$inf',`STATUS`='$status' WHERE ID='$id'";
	if($image!=""){
		$sql="UPDATE `products` SET `NAME`='$name',`BRAND`='$brand',`COLOR`='$color',`PRICE`='$price',`SALE`='$sale',`OLDPRICE`='$oldprice',`INF`='$inf',`STATUS`='$status',`IMAGE`='$image' WHERE ID='$id'";
	}
	echo $sql;
	mysqli_query($connect,$sql);
	mysqli_close($connect);
	header("Location:product-table.php");
	
}

?>
