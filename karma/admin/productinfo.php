<?php
$id=$_POST['id'];
include_once("../connect.php");
$result=mysqli_query($connect,"SELECT * FROM products WHERE ID='$id'");
$row=mysqli_fetch_assoc($result);
$str="";
$str.='<form id="pi" class="form-horizontal" action="editproduct.php" onsubmit="return Check()" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="control-label col-md-5">Image</label>	
										<div class="col-md-7">
											<img id="pi_imageshow" src="../'.$row["IMAGE"].'" alt="Image Error" height="100px">
											<input id="pi_image" name="pi_image" type="file" class="form-control" value="'.$row["IMAGE"].'"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product ID</label>	
										<div class="col-md-7">
											<input id="pi_productid" name="pi_productid" type="text" class="form-control" value="'.$row['ID'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" name="pi_productname" type="text" class="form-control" value="'.$row['NAME'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Brand</label>	
										<div class="col-md-7">
											<input id="pi_brand" name="pi_brand" type="text" class="form-control" value="'.$row['BRAND'].'" />	
										</div>
									</div>';
						     $str.='<div class="form-group">
										<label class="control-label col-md-5">Color</label>	
										<div class="col-md-7">
											<input id="pi_color" name="pi_color" type="text" class="form-control" value="'.$row['COLOR'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Price ($)</label>	
										<div class="col-md-7">
											<input id="pi_price" name="pi_price" type="text" class="form-control" value="'.$row['PRICE'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Sale</label>	
										<div class="col-md-7">';
if($row['SALE']==1){
	$str.='<input id="pi_sale" name="pi_sale" type="hidden" value="1">
											<button id="bt_sale" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
										</div>
									</div>';
}
else{
	$str.='<input id="pi_sale" name="pi_sale" type="hidden" value="0">
											<button id="bt_sale" type="button" class="btn btn-danger waves-effect" value="Block">Block</button>
										</div>
									</div>';
}
									$str.='<div class="form-group">
										<label class="control-label col-md-5">Old price (if not sale type 0)</label>	
										<div class="col-md-7">
											<input id="pi_oldprice" name="pi_oldprice" type="text" class="form-control" value="'.$row['OLDPRICE'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Information</label>	
										<div class="col-md-7">
											<input id="pi_inf" name="pi_inf" type="text" class="form-control" value="'.$row['INF'].'" />	
										</div>
									</div>									
									<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">';
if($row['STATUS']==1){
	$str.='<input id="pi_status" name="pi_status" type="hidden" value="1">
											<button id="bt_status" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
										</div>
									</div>';
}
else{
	$str.='<input id="pi_status" name="pi_status" type="hidden" value="0">
											<button id="bt_status" type="button" class="btn btn-danger waves-effect" value="Block">Block</button>
										</div>
									</div>';
}										
					$str.=	'<div class="form-group">
										<label class="control-label col-md-5">Created(yyyy/mm/dd)</label>	
										<div class="col-md-7">
											<input id="pi_created" name="pi_created" type="text" class="form-control" value="'.$row['CREATED'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-offset-4 col-md-2">
        									<button type="submit" class="btn btn-info">Upload</button>
      									</div>
										<div class="col-md-offset-3 col-md-2">
        									<a href="delete.php?id='.$row['ID'].'" name="'.$row['ID'].'" class="btn btn-danger">Delete</a>
      									</div>	
									</div>									
									</form>';
echo $str;
mysqli_close($connect);

?>