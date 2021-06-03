/**
 * @auth   	: JEON JY
 * @date	: 20200903
 * 서비스 처리
 */

window.addEventListener("load", function() 
{
	var registerService	= document.getElementById("registerService");
	registerService.addEventListener("click", function()
	{
		var product_type	= document.getElementById("product_type");
		if (product_type.options[product_type.selectedIndex].value == "-")
		{	
			alert("서비스 유형을 선택하셔야 합니다.");
			product_type.focus();
			return;
		}
		
		var product_name	= document.getElementById("product_name");
		if (product_name.value == "")
		{
			alert("서비스명을 입력하셔야 합니다.");
			product_name.focus();
			return;
		}
		
		var product_context	= document.getElementById("product_context");
		if (product_context.value == "")
		{
			alert("서비스 내용을 입력하셔야 합니다.");
			product_context.focus();
			return;
		}
		
		var payment_type	= document.getElementById("payment_type");
		if (payment_type.options[payment_type.selectedIndex].value == "-")
		{
			alert("결제유형을 입력하셔야 합니다.");
			payment_type.focus();
			return;
		}
		
		var product_price	= document.getElementById("product_price");
		if (product_price.value == "")
		{
			alert("가격을 입력하셔야 합니다.");
			product_price.focus();
			return;
		}
		
		var frmProduct		= document.getElementById("frmProduct");
		frmProduct.submit();
		
		return;
	});
	
	var service_type		= document.getElementById("service_type");
	service_type.addEventListener("change", function()
	{
		var service_seq		= this.options[this.selectedIndex].value;
		var product_type	= document.getElementById("product_type");
		
		product_type.value	= service_seq;
		var query			= core_ajax.instance().makeQuery(null, "product_type", null);
		if (!query)
			return false;
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_product", function(result)
		{
			var serviceList	= document.getElementById("service_list");
				while (serviceList.firstChild)
					serviceList.removeChild(serviceList.firstChild);
				
			if (result == "FALSE")
				return;
			
			result				= JSON.parse(result);
			for(var index in result)
			{
				var option			= document.createElement("OPTION");
				option.value		= result[index].SERVICE_SEQ;
				option.innerText	= result[index].SERVICE_NAME;
				
				serviceList.appendChild(option);
			}
			
			return;
		});
	}.bind(service_type));
	
	//리셋
	var resetService			= document.getElementById("resetService");
	resetService.addEventListener("click", function()
	{
		var	service_seq			= document.getElementById("service_seq");
		service_seq.value		= "";
		
		var product_type		= document.getElementById("product_type");
		product_type.options[0].selected	= true;
		
		var product_name		= document.getElementById("product_name");
		product_name.value		= "";
		
		var product_context		= document.getElementById("product_context");
		product_context.value	= "";
		
		var product_type		= document.getElementById("product_type");
		product_type.options[0].selected	= true;
		
		var product_price		= document.getElementById("product_price");
		product_price.value		= "";
		
		var product_is_open		= document.getElementById("product_is_open");
		product_is_open.checked	= false;
		
		return;
	});
	
	var service_list		= document.getElementById("service_list");
	service_list.addEventListener("change", function()
	{
		var service_seq		= this.options[this.selectedIndex].value;
		location.href		= "/admin_manager.php?mode=product&service_seq=" + service_seq;
	}.bind(service_list));
});