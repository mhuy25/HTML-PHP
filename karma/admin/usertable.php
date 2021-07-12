<?php
session_start();
if($_SESSION['role']!=1){
	
	header('Location: blank.php');
}
if(isset($_SESSION['error'])){
	$error=$_SESSION['error'];
}
else{
	$error=-1;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Karma</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="plugins/font-icon/css.css" rel="stylesheet" type="text/css">
    <link href="plugins/font-icon/icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
	<script src="plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("click","#bt_status",function(){
				if($(this).val()=="Available"){
					$("#ui_status").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#ui_status").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});
			$(document).on("click","#btn_status",function(){
				if($(this).val()=="Available"){
					$("#au_status").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#au_status").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});
			
			$("table#user tbody tr").click(function(){
				
				$.ajax({
					type:"post",
					url:"userinfo.php",
					data:{userid:$(this).attr("id")},
					success:function(data){
						$("#userInfo div.modal-body").html(data);
					}
				})
			})
		});
		/////CHECK UPLOAD USER
		function Check(){
			var testemail=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+\.\w{2,4}$/;
			var testphone=/^(08|09|03|07|05)\d{8}$/;
			var flag=true;
			$("form#ui input").each(function(){
					if($(this).val()==""){
						flag=false;
						alert("Please enter enough information");
						$(this).focus();
						return false;
					}
			});
			
			if(!testphone.test($("#ui_phone").val())){
				alert("Phone not avalid");
				$("#ui_phone").focus();
				flag=false;
			}
			if(!testemail.test($("#ui_email").val()))
				{
					alert("Email not avalid");
					$("#ui_email").focus();
					flag=false;
				}
			if(flag==true){
				flag=confirm("Do you Edit User ?");
			}
			else{
				return false;
			}
			if(flag==false){
				return flag;
			}
			$.ajax({
				type:"post",
				url:"edituser.php",
				data:{admin:1,userid:$("#ui_userid").val(),username:$("#ui_username").val(),
					  password:$("#ui_password").val(),firstname:$("#ui_firstname").val(),
					 lastname:$("#ui_lastname").val(),phone:$("#ui_phone").val(),
					 email:$("#ui_email").val(),role:$("#ui_role").val(),create:$("#ui_create").val(),
					 status:$("#ui_status").val()},
				success:function(data){
					if(data.indexOf("1")!=-1)
						{
							alert("Phone already exists");
						}
					if(data.indexOf("2")!=-1)
						{
							alert("Email already exists");
						}
					if(data==0)
						{
							alert("EDIT USER SUCCESSFULLY");
							window.location.reload();
						}
				}
				
			});
			
			return false;
		}
	///////CHECK ADD USER
		function checkAdd(){
			var testemail=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+\.\w{2,4}$/;
			var testphone=/^(08|09|03|07|05)\d{8}$/;
			var flag=true;
			$("form#ap input").each(function(){
					if($(this).val()==""){
						flag=false;
						alert("Please enter enough information");
						$(this).focus();
						return false;
					}
			});
			
			if(!testphone.test($("#au_phone").val())){
				alert("Phone not avalid");
				$("#au_phone").focus();
				flag=false;
			}
			if(!testemail.test($("#au_email").val()))
				{
					alert("Email not avalid");
					$("#au_email").focus();
					flag=false;
				}
			if(flag==true){
				flag=confirm("Do you add User ?");
			}
			else{
				return false;
			}
			if(flag==false){
				return flag;
			}
			$.ajax({
					type:"post",
					url:"adduser.php",
					data:{userid:$("#au_userid").val(),username:$("#au_username").val(),password:$("#au_password").val(),firstname:$("#au_firstname").val(),lastname:$("#au_lastname").val(),phone:$("#au_phone").val(),email:$("#au_email").val(),role:$("#au_role").val(),status:$("#au_status").val()},
					success:function(data)
					{
						alert(data);
						if(data.indexOf("1")!=-1)
						{
							alert("User ID already exists");		
						}
						if(data.indexOf("2")!=-1)
						{
							alert("User Name already exists");		
						}
						if(data.indexOf("3")!=-1)
						{
							alert("Phone already exists");		
						}
						if(data.indexOf("4")!=-1)
						{
							alert("Email already exists");		
						}
						if(data==0)
						{
							alert("ADD USER SUCCESSFULLY");	
							window.location.reload();
						}
					}
				});
			return false;
		}
		
	</script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php">ADMINB KARMA- MATERIAL DESIGN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo($_SESSION['nameLogin']); ?></div>
                    <div class="email"><?php echo($_SESSION['Email']) ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
					<li class="active">
                        <a href="usertable.php">
                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                    </li>
					<li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Manager</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="product-table.php">Products Table</a>
                            </li>
							<li>
                                <a href="orders-table.php">Orders Table</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="../index.php">
                            <i class="material-icons">update</i>
                            <span>Go to Karma Store</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 - 2020 <a href="javascript:void(0);">Admin - KarmaTeam Design</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header col-md-2">
                <h2>
                    <button type="button" class="btn bg-cyan btn-block btn-lg waves-effect" data-toggle='modal' data-target='#addUser'>Add User</button>
<!--                    <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>-->
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                USER TABLE
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="user" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
											<th>User ID</th>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
											<th>Role</th>
											<th>Status</th>
											<th>Created</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>User ID</th>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
											<th>Role</th>
											<th>Status</th>
											<th>Created</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										include_once("../connect.php");
										$results=mysqli_query($connect,"SELECT * FROM users WHERE Roleid= '2' OR Roleid= '3'");
										$str="";
										while($row=mysqli_fetch_assoc($results)){
											$str.='<tr id="'.$row["Userid"].'" data-toggle="modal" data-target="#userInfo">';
											$str.="<td>".$row['Userid']."</td>";
											$str.="<td>".$row['Username']."</td>";
											$str.="<td>".$row['Password']."</td>";
											$str.="<td>".$row['Firstname']."</td>";
											$str.="<td>".$row['Lastname']."</td>";
											$str.="<td>".$row['Phone']."</td>";
											$str.="<td>".$row['Email']."</td>";
											$rs=mysqli_query($connect,"SELECT * from role WHERE Roleid='".$row['Roleid']."'");
											$role=mysqli_fetch_assoc($rs);
											$str.="<td>".$role['Role']."</td>";
										
											if($row['Status']==1){
												$str.='<td><button type="button" class="btn btn-success waves-effect">Available</button></td>';
											}
											else{
												$str.='<td><button type="button" class="btn btn-danger waves-effect">Blocked</button></td>';
											}
											
											$str.="<td>".$row['Create']."</td>";
											$str.="</tr>";
										}
										echo $str;
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
					<!-- Cua so modal product info-->
					<div id="userInfo" class="modal fade" role="form">
						<div class="modal-dialog">

						<!-- Modal USER UPLOAD-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">User Info</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal">
									
									<div class="form-group">
										<label class="control-label col-md-5">User ID</label>	
										<div class="col-md-7">
											<input type="text" class="form-control" value="SM001" disabled/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">User Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="so mi" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Password</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="password" class="form-control" value="SM" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">First Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="black" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Last Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="13.5$" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Phone</label>	
										<div class="col-md-7">
											<input id="ui_phone" type="text" class="form-control" value="30" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Email</label>	
										<div class="col-md-7">
											<input id="ui_email" type="text" class="form-control" value="0" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Role</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="0" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Status</label>	
										<div class="col-md-7">
											<input id="pi_status" type="hidden" value="1">
											<button id="bt_status" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Created(yyyy/mm/dd)</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="2019-04-02" />	
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-offset-4 col-md-8">
        									<button type="submit" class="btn btn-info">Upload</button>
      									</div>
									</div>
										
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
			
			<!-- modal cua add USER -->
			<div id="addUser" class="modal fade" role="form">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div class="modal-title">Add User</div>
						</div>
						<div class="modal-body">
							<form id="ap" class="form-horizontal" onSubmit="return checkAdd()" method="post" enctype="multipart/form-data" action="adduser.php">
								
								<div class="form-group">
									<label class="control-label col-md-5">User ID</label>	
									<div class="col-md-7">
										<input id="au_userid" name="Userid" type="text"  class="form-control" value=""/>
										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">User Name</label>	
									<div class="col-md-7">
										<input id="au_username" name="Username" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Password</label>	
									<div class="col-md-7">
										<input id="au_password" name="Password" type="password" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">First Name</label>	
									<div class="col-md-7">
										<input id="au_firstname" name="Firstname" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Last Name</label>	
									<div class="col-md-7">
										<input id="au_lastname" name="Lastname" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Phone</label>	
									<div class="col-md-7">
										<input id="au_phone" name="Phone" type="number" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Email</label>	
									<div class="col-md-7">
										<input id="au_email" name="Email" type="email" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Role</label>	
									<div class="col-md-7">
										<select id="au_role" name="Role" class="form-control">
											<option value="1">Admin</option>
											<option value="2">Manager</option>
											<option value="3">User</option>			
										</select>
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-5">Status</label>	
									<div class="col-md-7">
										<input id="au_status" name="au_status" type="hidden" value="1" />
										<button id="btn_status" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-offset-4 col-md-8">
        								<button type="submit" class="btn btn-info">ADD</button>
      								</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
<!--    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
<!--	<script src="../../../js/jquery-3.3.1.min.js"></script>-->
</body>

</html>
