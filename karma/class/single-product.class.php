<?php
include('class/sanpham.class.php');
class ShopSingle extends SanPham{
	public $id;
	public function __construct($id){
		parent::__construct();
		$this->id=$id;
	}
	public function productdetails(){
		$sql="SELECT * From products WHERE STATUS=1 AND ID='$this->id'";	
		SanPham::select($sql);
		$str="";
		while($row=SanPham::fetch_array_table()){
			$str.='	<div class="product_image_area">
						<div class="container">
							<div class="row s_product_inner">
								<div class="col-lg-6">
				  	<div class="single-prd-item">
						<img class="img-fluid" src="'.$row["IMAGE"].'" alt="">
					</div>
				  </div>
				  <div class="col-lg-5 offset-lg-1">
				  	<div class="s_product_text">
						<h3>'.$row["NAME"].'</h3>
						<h2>$'.$row["PRICE"].'</h2>';
						if($row["SALE"]==1){
							$str.='<h6><strike>$'.$row["OLDPRICE"].'</strike></h6>';
							}
				$str.='<ul class="list">
							<li><a class="active"><span>Brand</span> : '.$row["BRAND"].'</a></li>
							<li><a class="active"><span>Availibility</span> : In Stock</a></li>
						</ul>
					<div class="product_count">
							<label for="qty">Quantity</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty ml-4">
							<button id="quantity-up" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button id="quantity-down" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="row list">
							<label for="size">Size</label>
							<div class="form-select col-lg-4 col-md-4 ml-5">
								<select class="list nice-select" id="sz">
  									<option class="option" value="37">37</option>
									<option class="option" value="38">38</option>
									<option class="option" value="39">39</option>
									<option class="option" value="40">40</option>
									<option class="option" value="41">41</option>
									<option class="option" value="42">42</option>
								</select>
							</div>
						</div>
						<div class="card_area d-flex align-items-center mt-3">
							<a id="addCart" title="'.$row["ID"].'" class="primary-btn" href="#">Add to Cart</a>
						</div>
					</div>
				  </div></div></div></div>
				  	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" id="test">
					<button class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" >Description</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
				<p>'.$row["INF"].'</p>
				</div>
			</div>
		</div>
	</section>';		
		};
		return($str);
	}
	public function close(){
		SanPham::close();
	}
}
?>