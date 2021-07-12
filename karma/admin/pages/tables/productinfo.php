<?php
$id=$_POST['id'];
include_once("../../../ketnoi.php");
$result=mysqli_query($connect,"SELECT * FROM products WHERE ProductID='$id'");
$row=mysqli_fetch_assoc($result);
$str="";
$str.='<form id="pi" class="form-horizontal" action="editproduct" onsubmit="return Check()" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="control-label col-md-5">Image</label>	
										<div class="col-md-7">
											<img src="../../../'.$row["Image"].'" alt="" height="100px">
											<input id="pi_image" type="file" class="form-control" value="1"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product ID</label>	
										<div class="col-md-7">
											<input id="pi_productid" type="text" class="form-control" value="'.$row['ProductID'].'" disabled/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="'.$row['ProductName'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Catalog ID</label>	
										<div class="col-md-7">
											<input id="pi_catalogid" type="text" class="form-control" value="'.$row['CatalogID'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Color</label>	
										<div class="col-md-7">
											<input id="pi_color" type="text" class="form-control" value="'.$row['Color'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Price</label>	
										<div class="col-md-7">
											<input id="pi_price" type="text" class="form-control" value="'.$row['Price'].'$" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Amount</label>	
										<div class="col-md-7">
											<input id="pi_amount" type="text" class="form-control" value="'.$row['Amount'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">AmountBuy</label>	
										<div class="col-md-7">
											<input id="pi_amountbuy" type="text" class="form-control" value="'.$row['AmountBuy'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">';
if($row['Status']==1){
	$str.='<input id="pi_status" type="hidden" value="1">
											<button id="bt_status" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
										</div>
									</div>';
}
else{
	$str.='<input id="pi_status" type="hidden" value="0">
											<button id="bt_status" type="button" class="btn btn-danger waves-effect" value="Block">Block</button>
										</div>
									</div>';
}
											
					$str.=	'<div class="form-group">
										<label class="control-label col-md-5">Created(yyyy/mm/dd)</label>	
										<div class="col-md-7">
											<input id="pi_created" type="text" class="form-control" value="'.$row['Created'].'" />	
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-offset-4 col-md-8">
        									<button type="submit" class="btn btn-info">Upload</button>
      									</div>
									</div>
										
									</form>';
echo $str;
mysqli_close($connect);

?>