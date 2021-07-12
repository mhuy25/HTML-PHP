<?php
include('class/single-product.class.php');

if(isset($_GET['ID'])){
	
	$id=$_GET['ID'];
	$data=new ShopSingle($id);
	$details=$data->productdetails();
	echo $details;
}
else{
	echo("Khong Tim Thay San Pham");
}
?>