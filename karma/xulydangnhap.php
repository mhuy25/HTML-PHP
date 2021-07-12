<?php
session_start();
include('connect.php');
$tk=$_POST['username'];
$mk=$_POST['password'];
$mk=md5($mk);
if(isset($_POST['logout']) && $_POST['logout']==1){
	unset($_SESSION['isLogin']);
	unset($_SESSION['nameLogin']);
	unset($_SESSION['role']);
	
	unset($_SESSION['firstname']);
	unset($_SESSION['lastname']);
	unset($_SESSION['username']);
	unset($_SESSION['Email']);
	unset($_SESSION['phone']);
	unset($_SESSION['userid']);
	
	return(false);
}
$result=mysqli_query($connect,"SELECT * FROM users WHERE Username='$tk' AND Password='$mk'");
if(mysqli_num_rows($result)==1){
	$_SESSION['isLogin']=1;
	$row=mysqli_fetch_assoc($result);
	$_SESSION['nameLogin']=$row["Firstname"]." ".$row["Lastname"];
	$_SESSION['role']=$row["Roleid"];
	$_SESSION['firstname']=$row["Firstname"];
	$_SESSION['lastname']=$row["Lastname"];
	$_SESSION['username']=$row["Username"];
	$_SESSION['Email']=$row["Email"];
	$_SESSION['phone']=$row["Phone"];
	$_SESSION['userid']=$row["Userid"];
	
	
	echo $row["Roleid"];
}else{
	$_SESSION['isLogin']=0;
	echo 0;
}
	
?>