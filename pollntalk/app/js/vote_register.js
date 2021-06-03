/**
 * @auth   	: JEON JY
 * @date	: 20200903
 * 설문 결제 처리 
 */

//업로드된 관련 파일 받기
//이벤트 이미지
var setEventImage = function(fileData)
{
	var real_path		= document.getElementById("event_real_path");
	real_path.value		= "/" + fileData.real_name;
	
	var image_file		= document.getElementById("event_imageFile");
	image_file.src		= "/" + fileData.real_name;
	
	return;
}

//베너 이미지
var setBannerImage = function(fileData)
{
	var real_path		= document.getElementById("ad_real_path");
	real_path.value		= "/" + fileData.real_name;
	
	var image_file		= document.getElementById("ad_imageFile");
	image_file.src		= "/" + fileData.real_name;
	
	return;
}

window.addEventListener("load", function()
{
	//서비스 유형 설정
	var vote_service_type	= document.getElementById("vote_service_seq");
	if (vote_service_type != null)
	{
		vote_service_type.addEventListener("change", function()
		{
			var serviceSeq		= this.options[this.selectedIndex].value;
			var productSeq		= document.getElementById("productSeq");
			
			productSeq.value	= serviceSeq;
			var query			= core_ajax.instance().makeQuery(null, "productSeq", null);
			if (!query)
				return false;
			core_ajax.instance().send(query, null, "/controller.php?mode=get_product", function(result)
			{
				if (result == "FALSE")
				{
					alert("서비스 정보를 요청하였으나 조회가 되지 않았습니다.");
					return;
				}
					
				var vote_service_price		= document.getElementById("vote_service_price");
				result			= JSON.parse(result);
				
				vote_service_price.value	= numberWithCommas(result.SERVICE_PRICE);			
			});
			
		}.bind(vote_service_type));
	}
	
	//계좌 유형 설정
	var service_account_type	= document.getElementById("service_account_type");
	if (service_account_type != null)
	{
		service_account_type.addEventListener("change", function()
		{
			var account_type		= this.options[this.selectedIndex].value;
			if (account_type == "-")
				return;
			
			var pay_account_type	= document.getElementById("bank_account_seq");
			pay_account_type.value	= account_type;
			
			var query	= core_ajax.instance().makeQuery(null, "bank_account_seq", null);
			if (!query)
				return false;
			core_ajax.instance().send(query, null, "/controller.php?mode=get_account", function(result)
			{
				var vote_service_account	= document.getElementById("vote_service_account");	
				result	= JSON.parse(result);
				vote_service_account.value	= result.ACCOUNT_NUMBER;
			});	
		}.bind(service_account_type));	
	}
	
	//프리미엄 서비스 경우 설정
	var vote_is_preminum	= document.getElementById("vote_is_preminum");
	if (vote_is_preminum != null)
	{
		vote_is_preminum.addEventListener("click", function()
		{
			var paymentbox	= document.getElementById("paymentbox");
			if (this.checked)
			{
				if (paymentbox.style.display == "none")
					paymentbox.style.display	= "block";
			}
			else
				paymentbox.style.display	= "none";
			
			return;
		}.bind(vote_is_preminum));
	}
	
	//이벤트 이미지 처리
	var find_event_image		= document.getElementById("find_event_image");
	if (find_event_image != null)
	{
		find_event_image.addEventListener("click", function()
		{
			var eventImageFile	= document.getElementById("eventImageFile");
			eventImageFile.click();
		});
		
		var eventImageFile	= document.getElementById("eventImageFile");
		eventImageFile.addEventListener("change", function()
		{
			var uploadFrame	= document.getElementById("uploadFrame");
			if (uploadFrame == null)
			{
				uploadFrame	= document.createElement("iframe");
				uploadFrame.setAttribute("style", "width:0px; height:0px;");
				uploadFrame.setAttribute("width", "0");
				uploadFrame.setAttribute("height", "0");
				uploadFrame.setAttribute("border", "0");
				uploadFrame.setAttribute("frameborder", "0");
				uploadFrame.setAttribute("id", "uploadFrame");
				
				document.getElementsByTagName("body").item(0).appendChild(uploadFrame);
			}
			
			var frmEventImage		= document.getElementById("frmEventImage");
			frmEventImage.target	= "uploadFrame";
			frmEventImage.submit();
		});
	}
	
	//베너 이미지 처리
	var find_ad_image			= document.getElementById("find_ad_image");
	if (find_ad_image != null)
	{
		find_ad_image.addEventListener("click", function()
		{
			var bannerImageFile	= document.getElementById("bannerImageFile");
			bannerImageFile.click();
		});
		
		var eventImageFile	= document.getElementById("bannerImageFile");
		bannerImageFile.addEventListener("change", function()
		{
			var uploadFrame	= document.getElementById("uploadFrame");
			if (uploadFrame == null)
			{
				uploadFrame	= document.createElement("iframe");
				uploadFrame.setAttribute("style", "width:0px; height:0px;");
				uploadFrame.setAttribute("width", "0");
				uploadFrame.setAttribute("height", "0");
				uploadFrame.setAttribute("border", "0");
				uploadFrame.setAttribute("frameborder", "0");
				uploadFrame.setAttribute("id", "uploadFrame");
				
				document.getElementsByTagName("body").item(0).appendChild(uploadFrame);
			}
			
			var frmBannerImage		= document.getElementById("frmBannerImage");
			frmBannerImage.target	= "uploadFrame";
			frmBannerImage.submit();
		});
	}
	
	//결제 처리
	var payProduct				= document.getElementById("payProduct");
	if (payProduct != null)
	{
		payProduct.addEventListener("click", function()
		{
			var vote_service_price		= document.getElementById("vote_service_price");
			if (vote_service_price.value == "")
			{
				alert("원하는 서비스를 선택하셔야 합니다.");
				vote_service_price.focus();
				return;
			}
			
			var vote_payment_type		= document.getElementById("vote_payment_type");
			if (!vote_payment_type.checked)
			{
				alert("결제방법을 선택하세요.");
				vote_payment_type.focus();
				return;
			}
			
			var service_account_type	= document.getElementById("service_account_type");
			if (service_account_type.options[service_account_type.selectedIndex].value == "")
			{
				alert("계좌번호를 선택하세요.");
				vote_service_account.focus();
				return;
			}
			
			var vote_service_payer		= document.getElementById("vote_service_payer");
			if (vote_service_payer.value == "")
			{
				alert("입금자명을 선택하세요.");
				vote_service_payer.focus();
				return;
			}
			
			//이벤트 정보가 있을 경우
			var is_event				= document.getElementById("is_event");
			if (is_event.value == "")
			{
				var vote_event_subject	= document.getElementById("vote_event_subject");
				if (vote_event_subject.value == "")
				{
					alert("이벤트 제목을 입력하셔야 합니다.");
					vote_event_subject.focus();
					return;
				}
				
				var vote_event_context	= document.getElementById("vote_event_context");
				if (vote_event_context.vallue == "")
				{
					alert("이벤트 내용을 입력하셔야 합니다.");
					vote_event_context.focus();
					return;
				}
				
				var event_real_path		= document.getElementById("event_real_path");
				if (event_real_path.value == "")
				{
					alert("선물 이미지를 입력하셔야 합니다.");
					event_real_path.focus();
					return;
				}
			}
			
			var frmVote		= document.getElementById("frmVote");
			frmVote.submit();
		});
	}
	
	//결제시 인증
	var payProductCert = document.getElementById("payProductCert");
	if(payProductCert != null){
		payProductCert.addEventListener("click", function()
		{	
			alert("본인인증 후 결제가 가능하십니다.");
			window.open("/kcpcert/WEB_ENC/kcpcert_start.php",'','width=610, height=210, scrollbars=no');
		});
	}
});