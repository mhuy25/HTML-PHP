<?php
if(isset($_POST['catalogid'])){
	include_once('../ketnoi.php');
	$id=$_POST['catalogid'];
	$name=$_POST['catalogname'];
	$sql="INSERT INTO `catalog`(`CatalogID`, `CatalogName`) VALUES ('$id','$name') ";
	$error="";
	$rs=mysqli_query($connect,"SELECT * FROM  catalog WHERE CatalogID='	$id'");
	if(mysqli_num_rows($rs)>0){
		$error.=" 1";
	}
	$rs=mysqli_query($connect,"SELECT * FROM  catalog WHERE CatalogName='$name'");
	if(mysqli_num_rows($rs)>0){
		$error.=" 2";
	}
	if($error!=""){
		echo $error;
		return(false);
	}
	mysqli_query($connect,$sql);
	echo 0;
	mysqli_close($connect);
}
?>