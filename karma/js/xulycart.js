$(document).ready(function(){
	"use strict";
	function editcart(info,amount){
		var id=info.split("-");
		$.ajax({
			type:"post",
			url:"editcart.php",
			data:{id:id[0],size:id[1],amount:amount},
			success:function(data){
				$('#listcart td[title="total'+info+'"]').html("$"+data);
			}
		});
		//subtotal();
	}
			$("#listcart input").change(function(){
				//alert($(this).val());
				editcart($(this).attr('id'),$(this).val());
				//subtotal();
			});
		$(".minuss").click(function(){
			$("#listcart input#"+$(this).attr('name')).change();
		});
		$(".pluss").click(function(){
			$("#listcart input#"+$(this).attr('name')).change();
		});
	$(".bt-delproduct").click(function(){
		//alert("xoa");
		
		if(!confirm("Are you want to delete this product")){
			return false;
		}
		editcart($(this).attr('name'),0);
	});
});