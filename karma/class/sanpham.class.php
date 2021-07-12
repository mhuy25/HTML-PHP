<?php
class SanPham{
	public $connect;
	public $user;
	public $pass;
	public $local;
	public $data;
	public $sql;
	public $result;
	public $result_query;
	public $error=array();
	
	function __construct(){
		include('config/dbcon.php');
		$this->local=$db_local;
		$this->user=$db_user;
		$this->pass=$db_pass;
		$this->data=$db_database;
		$this->connection();
	}
	public function connection(){
		//echo $this->local;
		$this->connect=mysqli_connect("$this->local","$this->user","$this->pass","$this->data")
		or die('ket noi khong thanh cong');
	}
	public function select($sql=null){
		
		if($sql==null){
			$this->result_query=mysqli_query($this->connect,'SELECT * FROM products WHERE STATUS=1') //lay bang products
			or
				die('truy van sai');
			
		}
		else{
			$this->result_query=mysqli_query($this->connect,$sql)
			or
				die('truy van bi sai');
			
		}
		return($this->result_query);
	}
	
	public function select_count(){
		return(mysqli_num_rows($this->result_query));
	}
	public function fetch_array_table($result=null){
		
		if($result==null){
			if($this->result_query){
				return(mysqli_fetch_array($this->result_query));
				
			}
			else
				die('loi');
		}
	}
}
?>