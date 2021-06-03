/**
 * @auth   	: JEON JY
 * @date	: 20201111
 * 관리자 설문 정보 처리
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

/*
 *	통화 표시
 */
function numberWithCommas(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//이미지/동영상 처리
var doResourceView = function(realName, tempName, resourceTypeId, imageControlId, videoControlId, resourceUrlId)
{
	var voteResourceType	= document.getElementById(resourceTypeId);
	var voteResourceUrl		= document.getElementById(resourceUrlId);
	var control 			= null;
	if (voteResourceType.value == "2")
	{
		control				= document.getElementById(imageControlId);
		control.src			= voteResourceUrl.value;
	}
	else if (voteResourceType.value == "3")
	{
		control				= document.getElementById(videoControlId);
		var videoUrl		= voteResourceUrl.value;
		var videoUrls		= videoUrl.split("/");
		var videoLast		= videoUrls[videoUrls.length - 1];
		videoUrl			= "https://www.youtube.com/embed/" + videoLast;	
		control.src			= videoUrl;
	}
	
	var voteRealFileName	= document.getElementById(realName);
	var voteTempFilePath	= document.getElementById(tempName);
	
	voteRealFileName.value	= voteResourceUrl.value;
	voteTempFilePath.value	= voteResourceUrl.value;
	
	return;
}

//이미지/동영상 보기 처리
var doResourceType = function(resourceType, resourceUrl, resourceView, imageFile, videoFile, resourceVal, fileuploadId)
{
	var resource_url	= document.getElementById(resourceUrl);
	if (resource_url != null)
		resource_url.style.display	= "none";
		
	var resource_view	= document.getElementById(resourceView);
	if (resource_view != null)
		resource_view.style.display	= "none";
		
	var resource_type 	= document.getElementById(resourceType);
	var image_File		= document.getElementById(imageFile);
	var video_File		= document.getElementById(videoFile);
	var fileupload		= null;
	if (fileuploadId != "" && fileuploadId != undefined && fileuploadId != null)
		fileupload		= document.getElementById(fileuploadId);
		
	if (resource_type.checked)
	{
		var typeVal					= resource_type.value;
		var voteResourceType		= document.getElementById(resourceVal);
		voteResourceType.value		= typeVal;
		switch(typeVal)
		{
			case "2":
				resource_url.style.display		= "block";
				resource_view.style.display		= "block";
				image_File.style.display		= "block";
				video_File.style.display		= "none";
				video_File.style.visibility		= "hidden";
				if (fileupload != null)				
					fileupload.style.display	= "none";
				break;
				
			case "3":
				resource_url.style.display		= "block";
				resource_view.style.display		= "block";
				image_File.style.display		= "none";
				video_File.style.display		= "block";
				video_File.style.visibility		= "visible";
				if (fileupload != null)	
					fileupload.style.display	= "none";
				break;
				
			default:
				image_File.style.display		= "block";
				video_File.style.display		= "none";
				video_File.style.visibility		= "hidden";
				if (fileupload != null)	
					fileupload.style.display	= "block";
				break;
		}
	}
	
	return;
}

/*
 *	투표 컨트롤 처리
 */
window.addEventListener("load", function()
{
	//1차 카테고리 선택
	var	vote_cate_seq	= document.getElementById("vote_cate_seq");
	vote_cate_seq.addEventListener("change", function()
	{
		var cate_seq			= document.getElementById("cate_seq");
		cate_seq.value			= this.value;
		
		//var selectedSeq		= this.options[this.selectedIndex].value;
		var query		= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		var result;
		core_ajax.instance().send(query, null, "/controller.php?mode=get_cate", function(result)
		{
			if (result == "FALSE")
				return;
			
			result	= JSON.parse(result);
			var real_name		= document.getElementById("vote_real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("voteImageFile");
			imageFile.setAttribute("src", "/" + result[0].CATE_REAL_IMAGE_PATH);
			
			core_ajax.instance().send(query, null, "/controller.php?mode=get_cate_list", function(result)
			{
				var cate_2dept_seq	= document.getElementById("cate_2dept_seq");
				while (cate_2dept_seq.firstChild)
					cate_2dept_seq.removeChild(cate_2dept_seq.firstChild);
				
				if (result == "FALSE")
					return;
				
				result				= JSON.parse(result);
				for(var index in result)
				{
					var option			= document.createElement("OPTION");
					option.value		= result[index].CATE_SEQ;
					option.innerText	= result[index].CATE_NAME;
					
					cate_2dept_seq.appendChild(option);
				}
				
				return;
			});
			
			return;
		});
	});
	
	//2depth 카테고리 선택
	var cate_2dept_seq		= document.getElementById("cate_2dept_seq");
	cate_2dept_seq.addEventListener("change", function()
	{
		var cate_seq			= document.getElementById("cate_seq");
		cate_seq.value			= this.value;
		
		//var selectedSeq		= this.options[this.selectedIndex].value;
		var query			= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		var result;
		core_ajax.instance().send(query, null, "/controller.php?mode=get_cate", function(result)
		{
			result	= JSON.parse(result);
			var real_name		= document.getElementById("vote_real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("voteImageFile");
			imageFile.setAttribute("src", "/" + result[0].CATE_REAL_IMAGE_PATH);
			
			return;
		});
		
		return false;
		
	}.bind(cate_2dept_seq));
	
	//파일 업로드 처리
	var uploadName			= document.getElementById("uploadName");
	uploadName.addEventListener("change", function()
	{
		//파일 업로드를 받을 페이지를 iframe으로 생성
		//폼 frmFileUpload로 submit
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
		
		var frmImageUpload		= document.getElementById("frmImageUpload");
		frmImageUpload.target	= "uploadFrame";
		frmImageUpload.submit();
	});
	
	//이미지 파일 올리기 버튼 처리
	var upImageFile				= document.getElementById("upImageFile");
	upImageFile.addEventListener("click", function()
	{
		var uploadName			= document.getElementById("uploadName");
		uploadName.click();
		return;
	});
	
	//이미지/동영상 선택 처리
	var resource_type		= document.getElementsByName("resource_type[]");
	var voteResourceType	= document.getElementById("vote_resource_type");
	var voteImageFile		= document.getElementById("voteImageFile");
	var voteVideoFile		= document.getElementById("voteVideoFile");
	var vote_resource_url	= document.getElementById("vote_resource_url");
	var resource_view		= document.getElementById("resource_view");
	for (var i = 0; i < resource_type.length; i++)
	{
		var resourctItem		= resource_type[i];
		var doResourceTypeFunc	= doResourceType.bind(null, resourctItem.id, vote_resource_url.id, resource_view.id, voteImageFile.id, voteVideoFile.id, voteResourceType.id, upImageFile.id);
		resourctItem.addEventListener("click", doResourceTypeFunc);
	}
	
	var resource_view		= document.getElementById("resource_view");
	var resourceViewFunc	= doResourceView.bind(null, "vote_resource_type", "voteImageFile", "voteVideoFile", "vote_resource_url");
	resource_view.addEventListener("click", resourceViewFunc);
	
	var is_start_val		= document.getElementsByName("is_start_val[]");
	for (var i = 0; i < is_start_val.length; i++)
	{
		var isStartItem		= is_start_val[i];
		if (isStartItem.checked)
		{
			var is_start	= document.getElementById("is_start");
			is_start.value	= isStartItem.value;
			break;
		}
	}
	
	//이벤트 내용 체크박스 처리
	var is_event		= document.getElementById("is_event");
	is_event.addEventListener("change", function()
	{
		var view_event				= document.getElementById("view_event");
		if (this.checked)
			view_event.style.display	= "block";
		else
			view_event.style.display	= "none";
	}.bind(is_event));	
	
	//수정하기 버튼 처리
	var registerVote	= document.getElementById("registerVote");
	registerVote.addEventListener("click", function()
	{
		var vote_type	= document.getElementById("vote_type");
		if (vote_type.options[vote_type.selectedIndex].value == "-")
		{
			alert("투표 유형을 선택하세요.");
			vote_type.focus();
			return;
		}
		
		var vote_subject	= document.getElementById("vote_subject");
		if (vote_subject.value == "")
		{
			alert("투표 제목을 입력하셔야 합니다.");
			vote_subject.focus();
			return;
		}
		
		var vote_cate_seq	= document.getElementById("vote_cate_seq");	
		if (vote_cate_seq.options[vote_cate_seq.selectedIndex].value == "-")
		{
			alert("카테고리를 선택하셔야 합니다.");
			vote_cate_seq.focus();
			return;
		}
		
		var cate_2dept_seq	= document.getElementById("cate_2dept_seq");
		if (cate_2dept_seq.options[cate_2dept_seq.selectedIndex].value == "-")
		{
			alert("하위 카테고리를 선택하셔야 합니다.");
			cate_2dept_seq.focus();
			return;
		}
		
		var is_event		= document.getElementById("is_event");
		if (is_event.checked)
		{
			var vote_event_subject	= document.getElementById("vote_event_subject");
			if (vote_event_subject.value == "")
			{
				alert("이벤트 내용에서 제목을 입력하셔야 합니다.");
				return;
			}
			
			var vote_event_context	= document.getElementById("vote_event_context");
			if (vote_event_context.value == "")
			{
				alert("이벤트 내용에서 내용을 입력하셔야 합니다.");
				return;
			}
			
			var event_real_path		= document.getElementById("event_real_path");
			if (event_real_path.value == "")
			{
				alert("이벤트 내용에서 선물 이미지를 입력하셔야 합니다.");
				return;
			}
		}
		
		var vote_resource_type	= document.getElementById("vote_resource_type");
		var resourceType		= vote_resource_type.value;
		switch (resourceType)
		{
			case "1":
				var real_path	= document.getElementById("vote_real_name");
				if (real_path.value == "")
				{
					alert("업로드할 파일을 선택하셔야 합니다.");
					var upImageFile	= document.getElementById("upImageFile");
					upImageFile.focus();
				}
				
				break;
			
			case "2":
			case "3":
				var vote_resource_url	= document.getElementById("vote_resource_url");
				if (vote_resource_url.value == "")
				{
					alert("동영상 또는 이미지의 경로를 입력하셔야 합니다.");
					break;
				}
				
				break;	
			default:
				break;			
		}
		
		var vote_is_preminum	= document.getElementById("vote_is_premium");
		if (vote_is_preminum.value != "")
		{
			var vote_service_seq	= document.getElementById("vote_service_seq");
			if (vote_service_seq != null)
			{
				if (vote_service_seq.options[vote_service_seq.selectedIndex].value == "-")
				{
					alert("프리미엄 서비스를 선택하셔야 합니다.");
					vote_service_seq.focus();
					return;
				}
				
				var vote_service_price	= document.getElementById("vote_service_price");
				if (vote_service_price.value == "")
				{
					alert("결제금액을 입력하셔야 합니다.");
					vote_service_price.focus();
					return;
				}
				
				var vote_service_price	= document.getElementById("vote_service_price");
				if (vote_service_price.value == "")
				{
					alert("결제금액을 입력하셔야 합니다.");
					vote_service_price.focus();
					return;
				}
				
				var service_account_type	= document.getElementById("service_account_type");
				if (service_account_type.options[service_account_type.selectedIndex].value == "-")
				{
					alert("계좌를 선택하셔야 합니다.");
					service_account_type.focus();
					return;
				}
				
				var vote_service_payer	= document.getElementById("vote_service_payer");
				if (vote_service_payer.value == "")
				{
					alert("입금자명을 입력하셔야 합니다.");
					vote_service_payer.focus();
					return;				
				}
			}
		}
		
		var frmVote	= document.getElementById("frmVote");
		frmVote.submit();
		
		return;
	});
	
	//삭제하기 버튼 처리
	var deleteVote	= document.getElementById("deleteVote");
	deleteVote.addEventListener("click", function()
	{
		var result		= window.confirm("삭제하시겠습니까?");
		if (!result)
			return;
			
		var vote_seq	= document.getElementById("vote_seq");
		if (vote_seq.value == "")
		{
			alert("잘못된 정보로 삭제할 수 없습니다.");
			return;
		}
			
		var frmVote		= document.getElementById("frmVote");
		frmVote.submit();
		
		return;
	});
	
	//프리미엄 서비스 정보 조회
	var vote_is_preminum	= document.getElementById("vote_is_premium");
	if (vote_is_preminum.value != "")
	{
		var vote_service_type	= document.getElementById("vote_service_seq");
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
		
		//계좌 정보 조회
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
					if (result == "FALSE")
					{
						alert("서비스 정보를 요청하였으나 조회가 되지 않았습니다.");
						return;
					}
				
					var vote_service_account	= document.getElementById("vote_service_account");	
					result	= JSON.parse(result);
					vote_service_account.value	= result.ACCOUNT_NUMBER;
				});	
			}.bind(service_account_type));
		}
	}
	
	//투표 정보 바로가기
	var goVote	= document.getElementById("goVote");
	goVote.addEventListener("click", function()
	{
		var vote_seq	= document.getElementById("vote_seq");
		var win = window.open("/?mode=votewrite&vote_seq=" + vote_seq.value, '_blank');
        win.focus();

		return;
	});
	
	//쿠폰 정보 조회
	var searchCoupon	= document.getElementById("searchCoupon");
	if (searchCoupon != null)
	{
		searchCoupon.addEventListener("click", function()
		{
			var coupon_index	= document.getElementById("coupon_index");
			if (coupon_index.value == "")
			{
				alert("쿠폰 번호를 입력하셔야 합니다.");
				return;
			}
			
			var query			= core_ajax.instance().makeQuery(null, "coupon_index", null);
			if (!query)
				return false;
				
			core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_coupon", function(result)
			{
				if (result == "FALSE")
				{
					alert("쿠폰 정보를 요청하였으나 조회가 되지 않았습니다.");
					return;
				}
				
				var tempResult				= JSON.parse(result);
				var coupon_Seq				= document.getElementById("coupon_Seq");
				coupon_Seq.value			= tempResult.COUPON_SEQ;
				
				var coupon_name				= document.getElementById("coupon_name");
				coupon_name.innerText		= tempResult.COUPON_NAME;
				
				var coupon_count			= document.getElementById("coupon_count");
				coupon_count.innerText		= tempResult.COUPON_COUNT;
				
				var coupon_ext_count		= document.getElementById("coupon_ext_count");
				coupon_ext_count.innerText	= tempResult.COUPON_EXT_COUNT;
				
				var coupon_expire_date			= document.getElementById("coupon_expire_date");
				coupon_expire_date.innerText	= tempResult.COUPON_EXPIRE_DATE_NAME;
				
				return;
			});	
		});
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
});