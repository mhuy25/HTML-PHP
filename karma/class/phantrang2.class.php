<?php
include('class/sanpham.class.php');
class PhanTrang extends SanPham{
	public $start;		//vi tri bat dau
	public $limit=6;	//so san pham 1 trang
	public $total;		//tong so trang
	public $next;		//button next;
	public $back;		//button back
	public $page_current;	//trang hien tai
	public $page;		//lay page ben file phantrang.php 
	public $dk="";			//dieu kien where
	function __construct($page=null,$dk=""){
		parent::__construct();
		$this->dk=$dk;
		if($page!=null){
			$this->page=$page;
			$this->getPage();	//goi ham getPage()
		}
	}
	function getPage(){
		if($this->page!=1){
			$this->start=($this->page-1)*$this->limit;
			$this->page_current=$this->page;
		}
		else{
			$this->start=$this->page-1;
			$this->page_current=$this->page;
		}
		
	}
	function totalRow(){
		$sql="SELECT * FROM products WHERE STATUS=1 $this->dk";
		SanPham::select($sql);
		if(SanPham::select_count()>0){
			$this->total=ceil(SanPham::select_count()/$this->limit);
			return($this->total);
		}
	}
	function select_products(){
		$sql="SELECT * FROM products WHERE STATUS=1 $this->dk LIMIT $this->start,$this->limit";
		$str = "";
		SanPham::select($sql);
		$str.='<div class="row">';
		while($row=SanPham::fetch_array_table()){
			$str.='<div class="col-lg-4 col-md-6">
				   	<div class="single-product">
					<img style="height:250px" class="img-fluid" src="'.$row["IMAGE"].'" alt="Lỗi hình ảnh">
						<div class="product-details">
						<h6>'.$row["NAME"].'</h6>
							<div class="price">';
							if($row["SALE"]==1){
								$str.='	<h6>$'.$row["PRICE"].'</h6>
										<h6 class="l-through">'.$row["OLDPRICE"].'</h6>';
							}
							else{
								$str.='<h6>$'.$row["PRICE"].'</h6>';
							}
				$str.=		'</div>
							<div class="prd-bottom">
							<a href="single-product.php?id='.$row['ID'].'" class="social-info">
							<span class="ti-bag"></span>
							<p class="hover-text">view more</p>
							</a>
							</div>
						</div>
					</div>
				</div>';
		}
		$str.='</div>';
		return($str);
	}
	function nut_phantrang(){
		$link='<div style="margin-left:410px" class="pagination">';
		if($this->page_current>1){
			$this->back=$this->page_current-1;
			$link.='<a class="prev-arrow" page="'.$this->back.'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>';
		}
		for($i=1;$i<=$this->totalRow();$i++){
			if($i>=$this->page_current-2 && $i<=$this->page_current+2){
				if($i==$this->page_current){
					$link.='<a class="active" page="'.$i.'">'.$i.'</a>';
				}
				else{
					$link.='<a page="'.$i.'">'.$i.'</a>';
				}
			}
		}
		if($this->page_current<$this->totalRow()){
			$this->next=$this->page_current+1;
			$link.='<a class="next-arrow" page="'.$this->next.'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
		}
		$link.='</div>';
		return($link);
	}
}
?>