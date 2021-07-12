<?php
include('class/phantrang2.class.php');
if(isset($_GET['page']) && isset($_GET['brand'])){
	$page=$_GET['page'];
	$dk="";
	if($_GET['brand']!="" && $_GET['brand']!=" "){
		$brand=explode(" ",$_GET['brand']);
		$dk.="AND (";
		for($i=0;$i<count($brand);$i++){
			if($i==0){
				$dk.="BRAND= '$brand[$i]'";
			}
			else{
				$dk.="OR BRAND= '$brand[$i]'";
			}
		}
		$dk.=")";
	}
	if($_GET['color']!="" && $_GET['color']!=" "){
		$color=explode(" ",$_GET['color']);
		$dk.="AND (";
		for($i=0;$i<count($color);$i++){
			if($i==0){
				$dk.="COLOR= '$color[$i]'";
			}
			else{
				$dk.="OR COLOR='$color[$i]'";
			}
		}
		$dk.=")";
	}
	if($_GET['sale']!="" && $_GET['sale']!=" "){
		$sale=explode(" ",$_GET['sale']);
		$dk.="AND (";
		for($i=0;$i<count($sale);$i++){
			if($i==0){
				$dk.="SALE= '$sale[$i]'";
			}
			else{
				$dk.="OR SALE= '$sale[$i]'";
			}
		}
		$dk.=")";
	}
	if($_GET['price']!="" && $_GET['price']!=" "){
		$price=explode(" ",$_GET['price']);
		$dk.="AND (";
		$dk.="PRICE BETWEEN $price[0] AND $price[1]";
		$dk.=")";
	}
	if($_GET['key']!=""){
		$key=$_GET['key'];
		$dk.="AND (";
		$dk.="upper(NAME) like '%$key%' or upper(BRAND) like '%$key%' or upper(ID) like '%$key%' or upper(COLOR) like '%$key%'";
		$dk.=")";
	}
	if(($_GET['sort']!=" ") &&($_GET['sort']!=1)){
		$sort=(int)$_GET['sort'];
		if($sort!="" && $sort!="Relevance"){
			if($sort==2){$sort="NAME ASC";}
			if($sort==3) $sort="NAME DESC";
			if($sort==4) $sort='CAST(REPLACE(PRICE,".","") as INT) ASC ';
			if($sort==5) $sort='CAST(REPLACE(PRICE,".","") as INT) DESC ';
			$dk.=" ORDER BY $sort ";
		}
		else
			$dk.=" ORDER BY ID DESC ";
	}
	$phantrang=new PhanTrang($page,$dk);	//khoi tao doi tuong phan trang
	$dulieu=$phantrang->select_products();
	$link_pagination=$phantrang->nut_phantrang();
	echo $dulieu.$link_pagination;
}
?>