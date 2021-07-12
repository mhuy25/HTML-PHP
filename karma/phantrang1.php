<?php
include('class/phantrang1.class.php');
if(isset($_GET['page'])){
	$page=$_GET['page'];
	$dk="";
	if(isset($_GET['sale'])){
		$dk.=" and (SALE=1)";	
	}
	$phantrang=new PhanTrang($page,$dk);	//khoi tao doi tuong phan trang
	$dulieu=$phantrang->select_products();
	$link_pagination=$phantrang->nut_phantrang();
	echo $dulieu.$link_pagination;
}
?>