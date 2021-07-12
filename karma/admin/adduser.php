<?php
	if(isset($_POST['userid']))
	{
	 	include_once("../connect.php");
		$userid=$_POST['userid'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$role=$_POST['role'];
		$status=$_POST['status'];
		$error="";
		$password=md5($password);
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=date('Y-m-d');
		
		$result=mysqli_query($connect,"SELECT * FROM users WHERE Userid='$userid'");
		
		if($row=mysqli_num_rows($result)>0)
		{
			$error.=" 1";
		}
		mysqli_free_result($result);
		$result=mysqli_query($connect,"SELECT * FROM users WHERE Username='$username'");
		if($row=mysqli_num_rows($result)>0)
		{
			$error.=" 2";
		}
		mysqli_free_result($result);
		$result=mysqli_query($connect,"SELECT * FROM users WHERE Phone='$phone'");
		if($row=mysqli_num_rows($result)>0)
		{
			$error.=" 3";
		}
		mysqli_free_result($result);
		$result=mysqli_query($connect,"SELECT * FROM users WHERE Email='$email'");
		if($row=mysqli_num_rows($result)>0)
		{
			$error.=" 4";
		}
		mysqli_free_result($result);
		if($error!="")
		{
			echo($error);
			return false;
		}
		
		$query=mysqli_query($connect,"INSERT INTO `users`(`Userid`, `Username`, `Password`, `Firstname`, `Lastname`, `Phone`, `Email`, `Roleid`, `Create`, `Status`) VALUES ('$userid','$username','$password','$firstname','$lastname','$phone','$email','$role','$date','$status') ");
		echo(0);
		mysqli_close($connect);
	}
?>