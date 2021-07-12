<?php
session_start();
if(($_SESSION['role']!=1) && ($_SESSION['role']!=2)){
	
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
					$("#pi_status").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#pi_status").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});
			$(document).on("click","#bt_sale",function(){
				if($(this).val()=="Available"){
					$("#pi_sale").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#pi_sale").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});			
			$(document).on("click","#btn_status",function(){
				if($(this).val()=="Available"){
					$("#ap_status").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#ap_status").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});
			$(document).on("click","#btn_sale",function(){
				if($(this).val()=="Available"){
					$("#ap_sale").val("0");
					$(this).removeClass("btn-success");
					$(this).addClass("btn-danger");
					$(this).html("Block");
					$(this).val("Block");
					return false;
				}
				if($(this).val()=="Block"){
					$("#ap_sale").val("1");
					$(this).removeClass("btn-danger");
					$(this).addClass("btn-success");
					$(this).html("Available");
					$(this).val("Available");
					return false;
				}
			});			
			
			$("table#products tbody tr").click(function(){
				$.ajax({
					type:"post",
					url:"productinfo.php",
					data:{id:$(this).attr("id")},
					success:function(data){
						$("#productInfo div.modal-body").html(data);
					}
				})
			})
		});
		function Check(){
			var testprice=/([0-1000].[0-9]|[0-9])/;
			var flag=true;
			$("form#pi input").each(function(){
				if($(this).attr("id")!=$("form#pi input#pi_image").attr("id")){
					if($(this).val()==""){
						flag=false;
					}
				}
			});
			if(!testprice.test($("#pi_price").val())){
				alert("Price not avalid");
				$("#pi_price").focus();
				flag=false;
			}
			if((!testprice.test($("#pi_oldprice").val())) && ($("#pi_oldprice").val()!=0) ){
				alert("Old Price not avalid");
				$("#pi_oldprice").focus();
				flag=false;
			}			
			if(flag==true){
				flag=confirm("Do you edit product ?");
			}
			else{
				alert("nhap day du thong tin");
			}
			return flag;
		}
		function checkAdd(){
			var testprice=/([0-1000].[0-9]|[0-9])/;
			var flag=true;
			if(!testprice.test($("#ap_price").val())){
				alert("Price not avalid");
				$("#ap_price").focus();
				flag=false;
			}
			if((!testprice.test($("#ap_oldprice").val())) && ($("#ap_oldprice").val()!=0) ){
				alert("Old Price not avalid");
				$("#ap_oldprice").focus();
				flag=false;
			}				
			if(flag==true){
				flag=confirm("Do you add product ?");
			}
			else{
				alert("nhap day du thong tin");
				return false;
			}
			
			return flag;
		}
		$(document).on("change","#pi_image",function(){
			var dinhdang=$(this).val().substring($(this).val().length-3,$(this).val().length);
			dinhdang=dinhdang.toLowerCase();
			if(dinhdang=="jpg" || dinhdang=="png" || dinhdang=="gif" || dinhdang=="tif" || dinhdang=="bmp"){
				$("#pi_imageshow").attr("src","../../karma/img/"+$(this).val().substring(12));
			}
			else{
				alert("file image not avalid");
				return false;
			}
		});
		$(document).on("change","#ap_image",function(){
			var dinhdang=$(this).val().substring($(this).val().length-3,$(this).val().length);
			dinhdang=dinhdang.toLowerCase();
			if(dinhdang=="jpg" || dinhdang=="png" || dinhdang=="gif" || dinhdang=="tif" || dinhdang=="bmp"){
				$("#ap_imageshow").attr("src","../../karma/img/"+$(this).val().substring(12));
			}
			else{
				alert("file image not avalid");
				return false;
			}
			
		});
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
                <a class="navbar-brand" href="index.php">ADMINB KARMA - MATERIAL DESIGN</a>
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
					<li>
                        <a href="usertable.php">
                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                    </li>
					<li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Manager</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="product-table.php">Products Table</a>
                            </li>
							<li>
                                <a href="orders-table.php">Orders Table</a>
                            </li>
                        </ul>
						<li>
                        <a href="../index.php">
                            <i class="material-icons">update</i>
                            <span>Go to Karma Store</span>
                        </a>
                    </li>
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
                    <button type="button" class="btn bg-cyan btn-block btn-lg waves-effect" data-toggle='modal' data-target='#addProduct'>Add Product</button>
<!--                    <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>-->
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PRODUCTS TABLE
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="products" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
											<th>ID</th>
                                            <th>NAME</th>
                                            <th>BRAND</th>
                                            <th>COLOR</th>
                                            <th>PRICE</th>
                                            <th>SALE</th>
											<th>OLDPRICE</th>
											<th>INF</th>
											<th>CREATED</th>											
											<th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>ID</th>
                                            <th>NAME</th>
                                            <th>BRAND</th>
                                            <th>COLOR</th>
                                            <th>PRICE</th>
                                            <th>SALE</th>
											<th>OLDPRICE</th>
											<th>INF</th>
											<th>CREATED</th>
											<th>STATUS</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										include_once("../connect.php");
										$results=mysqli_query($connect,"SELECT * FROM products");
										$str="";
										while($row=mysqli_fetch_assoc($results)){
											$str.='<tr id="'.$row["ID"].'" data-toggle="modal" data-target="#productInfo">';
											$str.="<td>".$row['ID']."</td>";
											$str.="<td>".$row['NAME']."</td>";
											$str.="<td>".$row['BRAND']."</td>";
											$str.="<td>".$row['COLOR']."</td>";
											$str.="<td>".$row['PRICE']."</td>";
											$str.="<td>".$row['SALE']."</td>";
											$str.="<td>".$row['OLDPRICE']."</td>";
											$str.="<td>".$row['INF']."</td>";
											$str.="<td>".$row['CREATED']."</td>";
											if($row['STATUS']==1){
												$str.='<td><button type="button" class="btn btn-success waves-effect">Available</button></td>';
											}
											else{
												$str.='<td><button type="button" class="btn btn-danger waves-effect">Blocked</button></td>';
											}
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
					<div id="productInfo" class="modal fade" role="form">
						<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Product Info</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-md-5">Image</label>	
										<div class="col-md-7">
											<img src="../images/ao khoac/AK01.jpg" alt="" height="100px">
											<input type="file" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product ID</label>	
										<div class="col-md-7">
											<input type="text" class="form-control" value="SM001" disabled/>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Product Name</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="so mi" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Catalog ID</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="SM" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Color</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="black" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Price</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="13.5$" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">Amount</label>	
										<div class="col-md-7">
											<input id="pi_productname" type="text" class="form-control" value="30" />	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">AmountBuy</label>	
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
			
			<!-- modal cua add product -->
			<div id="addProduct" class="modal fade" role="form">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div class="modal-title">Add Product</div>
						</div>
						<div class="modal-body">
							<form id="ap" class="form-horizontal" onSubmit="return checkAdd()" method="post" enctype="multipart/form-data" action="addproduct.php">
								<div class="form-group">
									<label class="control-label col-md-5">Image</label>	
									<div class="col-md-7">
										<img id="ap_imageshow" src="" alt="Image" height="100px">
										<input id="ap_image" name="ap_image" type="file" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Product ID</label>	
									<div class="col-md-7">
										<input id="ap_productid" name="ap_productid" type="text"  class="form-control" value=""/>
										
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Product Name</label>	
									<div class="col-md-7">
										<input id="ap_productname" name="ap_productname" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Brand</label>	
									<div class="col-md-7">
										<input id="ap_brand" name="ap_brand" type="text" class="form-control" value="" />	
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-5">Color</label>	
									<div class="col-md-7">
										<input id="ap_color" name="ap_color" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Price</label>	
									<div class="col-md-7">
										<input id="ap_price" name="ap_price" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Sale</label>	
									<div class="col-md-7">
										<input id="ap_sale" name="ap_sale" type="hidden" value="1" />
										<button id="btn_sale" type="button" class="btn btn-success waves-effect" value="Available">Available</button>
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-5">Old Price (if not sale type 0)</label>	
									<div class="col-md-7">
										<input id="ap_oldprice" name="ap_oldprice" type="text" class="form-control" value="" />	
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-5">Information</label>	
									<div class="col-md-7">
										<input id="ap_inf" name="ap_inf" type="text" class="form-control" value="" />	
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-5">Status</label>	
									<div class="col-md-7">
										<input id="ap_status" name="ap_status" type="hidden" value="1" />
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
