<?php 
$id=$_POST['id'];
include_once("../connect.php");
$result=mysqli_query($connect,"SELECT * FROM orders WHERE Orderid='$id'");
$row=mysqli_fetch_assoc($result);
$rs=mysqli_query($connect,"SELECT * FROM orderdetail WHERE Orderid='$id'");
$str="";
$str='<form class="form-horizontal" method="post" action="orders-table.php">
									<div class="form-group">
										<label class="control-label col-md-5">Order ID</label>	
										<div class="col-md-7">
											<input name="oi_orderid" type="text" class="form-control" value="'.$row['OrderID'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">User ID</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['UserID'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">City</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['City'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Address</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Address'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Email</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Email'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Phone</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Phone'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Total</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Total'].'" readonly/>	
										</div>
									</div>';
if($row['Status']==1){
	$str.='<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">
											<input id="oi_status" name="oi_status" type="hidden" value="1">
											<button id="bt_status" type="button" class="btn btn-danger waves-effect" value="Unconfimred">Unconfimred</button>
										</div>
									</div>';
}
if($row['Status']==2){
	$str.='<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">
											<input id="oi_status" name="oi_status" type="hidden" value="2">
											<button id="bt_status" type="button" class="btn btn-warning waves-effect" value="Confimred">Confimred</button>
										</div>
									</div>';
}
if($row['Status']==3){
	$str.='<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">
											<input id="oi_status" name="oi_status" type="hidden" value="3">
											<button id="bt_status" type="button" class="btn btn-success waves-effect" value="Success">Success</button>
										</div>
									</div>';
}
							$str.='<div class="form-group">
										<label class="control-label col-md-5">Created(yyyy/mm/dd)</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Created'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Notes</label>	
										<div class="col-md-7">
											<input  type="text" class="form-control" value="'.$row['Notes'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<table class="col-md-5 col-md-offset-3">
											<thead>
												<th class="col-md-1">Product ID</th>
												<th class="col-md-1">Price</th>
												<th class="col-md-1">Size</th>
												<th class="col-md-1">Amount</th>
												<th class="col-md-1">Total</th>
											</thead>
											<tbody>';
while($detail=mysqli_fetch_assoc($rs)){
										$str.='<tr>
													<td>'.$detail['ProductID'].'</td>
													<td>'.$detail['Price'].'</td>
													<td>'.$detail['Size'].'</td>
													<td>'.$detail['Amount'].'</td>
													<td>'.$detail['Total'].'</td>
												</tr>';
}
							
								$str.= ' 	</tbody>
										</table>
									</div>
								
									
									<div class="form-group">
										<div class="col-md-offset-4 col-md-8">
        									<button type="submit" class="btn btn-info">Upload</button>
      									</div>
									</div>
										
									</form>';
echo $str;
?>