<?php
	if(isset($_POST['userid']))
	{
		include_once("../connect.php");
		$id=$_POST['userid'];
		$result=mysqli_query($connect,"SELECT * FROM users where Userid='$id'");
		$user=mysqli_fetch_assoc($result);
		$rs = mysqli_query($connect,"SELECT * FROM role");
		
		//$role=mysqli_fetch_assoc($rs);
		$s="";
		$s.='<form id="ui" class="form-horizontal" action="edituser.php" onsubmit="return Check()" method="post" enctype="multipart/form-data">
									
									<div class="form-group">
										<label class="control-label col-md-5">User ID</label>	
										<div class="col-md-7">
											<input id="ui_userid" type="text" class="form-control" value="'.$user['Userid'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">User Name</label>	
										<div class="col-md-7">
											<input id="ui_username" type="text" class="form-control" value="'.$user['Username'].'" readonly/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Password</label>	
										<div class="col-md-7">
											<input id="ui_password" type="text" class="form-control" value="'.$user['Password'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">First Name</label>	
										<div class="col-md-7">
											<input id="ui_firstname" type="text" class="form-control" value="'.$user['Firstname'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Last Name</label>	
										<div class="col-md-7">
											<input id="ui_lastname" type="text" class="form-control" value="'.$user['Lastname'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Phone</label>	
										<div class="col-md-7">
											<input id="ui_phone" type="text" class="form-control" value="'.$user['Phone'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Email</label>	
										<div class="col-md-7">
											<input id="ui_email" type="text" class="form-control" value="'.$user['Email'].'" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Role</label>	
										<div class="col-md-7">';
					$s.='<select id="ui_role" class="form-control">';
		while($role=mysqli_fetch_assoc($rs))
		{
			if($user['Roleid']==$role['Roleid'])
			{
				$s.='<option value="'.$role['Roleid'].'" selected>'.$role['Role'].'</option>';
				
			}
			else
			{
				$s.='<option value="'.$role['Roleid'].'">'.$role['Role'].'</option>';
			}
		}
		$s.='</select>';
		$s.='</div>
			</div>';
							$s.='<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">';
		if($user['Status']==1)
		{
			$s.='<input id="ui_status" type="hidden" value="'.$user['Status'].'">
											<button id="bt_status" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
										</div>
									</div>';
		}
		else{
			$s.='<input id="ui_status" type="hidden" value="'.$user['Status'].'">
											<button id="bt_status" type="button" class="btn btn-danger waves-effect" value="Available">Block</button>
										</div>
									</div>';
		}										
			$s.= '<div class="form-group">
										<label class="control-label col-md-5">Created(yyyy/mm/dd)</label>	
										<div class="col-md-7">
											<input id="ui_create" type="text" class="form-control" value="'.$user['Create'].'" readonly/>	
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-offset-4 col-md-2">
        									<button type="submit" class="btn btn-info">Upload</button>
      									</div>
										<div class="col-md-offset-3 col-md-2">
        									<a href="delete2.php?id='.$user['Userid'].'" name="'.$user['Userid'].'" class="btn btn-danger">Delete</a>
      									</div>	
									</div>
										
									</form>';
		echo($s);
		
		mysqli_close($connect);
		
	}
?>