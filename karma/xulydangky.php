<?php
include_once('connect.php');
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$username=$_POST['username'];
$password=$_POST['password'];
$error="";
$result=mysqli_query($connect,"SELECT * FROM users WHERE Email='$email'");
if(mysqli_num_rows($result)>0){
	$error.=" 1";
}
mysqli_free_result($result);
$result=mysqli_query($connect,"SELECT * FROM users WHERE Phone='$phone'");
if(mysqli_num_rows($result)>0){
	$error.=" 2";
}
mysqli_free_result($result);
$result=mysqli_query($connect,"SELECT * FROM users WHERE Username='$username'");
if(mysqli_num_rows($result)>0){
	$error.=" 3";
}
if($error!=""){
	echo trim($error);	//tra ve loi neu co
	return(false);		// co loi se return 
}
$password=md5($password);
$rs=mysqli_query($connect,"SELECT * FROM users");
$userid="USER0".(mysqli_num_rows($rs)+1); //khoi tao id
date_default_timezone_set("Asia/Ho_Chi_Minh"); //set thoi gian
$date=date('Y-m-d'); //lay ngay thang
$sql="INSERT INTO `users` (`Userid`, `Username`, `Password`, `Firstname`, `Lastname`, `Phone`, `Email`, `Roleid`, `Create`, `Status`) VALUES ('$userid', '$username', '$password', '$firstname', '$lastname', '$phone', '$email', '3', '$date', '1');";
mysqli_query($connect,$sql) or die("khong duoc"); // insert len mysql
mysqli_close($connect);
echo 0;
?>