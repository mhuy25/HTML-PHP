
	<?php
		$ketnoi['host']='localhost';
		$ketnoi['username']='root';
		$ketnoi['password']='';
		$ketnoi['dbname']='karma';
		$connect= mysqli_connect("{$ketnoi['host']}","{$ketnoi['username']}","{$ketnoi['password']}","{$ketnoi['dbname']}")
			or
			die("khong the ket noi database");
		mysqli_set_charset($connect,"utf8")or die("loi");
	?>