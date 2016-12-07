/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/

$(function(){
	
	//减少
	$(".reduce_num").click(function(){
		var amount = $(this).parent().find(".amount");
		if (parseInt($(amount).val()) <= 1){
			alert("商品数量最少为1");
		} else{
			$(amount).val(parseInt($(amount).val()) - 1);
			//先获取所在的TR
			var tr = $(this).parent().parent();
			var gid = tr.attr("goods_id");
			var gaid = tr.attr("goods_attr_id");
			// 执行AJAX更新到服务器
			ajaxUpdateCartData(gid, gaid, $(amount).val());
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
	});

	//增加
	$(".add_num").click(function(){
		var amount = $(this).parent().find(".amount");
		$(amount).val(parseInt($(amount).val()) + 1);
		// 先获取所在的TR
		var tr = $(this).parent().parent();
		var gid = tr.attr("goods_id");
		var gaid = tr.attr("goods_attr_id");
		// 执行AJAX更新到服务器
		ajaxUpdateCartData(gid, gaid, $(amount).val());
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
	});

	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(this).val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(this).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));

	});

	// delete
	$(".col6 a").click(function(){
		if(confirm("are you sure?")){
			// 先获取所在的TR
			var tr = $(this).parent().parent();
			var gid = tr.attr("goods_id");
			var gaid = tr.attr("goods_attr_id");
			// 执行AJAX更新到服务器
			ajaxUpdateCartData(gid, gaid, 0);
			var newTp = parseFloat($("#total").html()) - parseFloat(tr.find(".col5").find("span").html());
			$("#total").html(newTp.toFixed(2));
			tr.remove();
		}
		return false; 
	});
});