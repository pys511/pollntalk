/**
 * @auth   	: JEON JY
 * @date	: 20201103
 * 쿠폰 등록 처리
 */
//업로드된 관련 파일 받기
var setFile	= function(fileData)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var tempPath	= fileData.temp_path;
	var imageFile	= document.getElementById("imageFile");
	imageFile.setAttribute("src", tempPath);
	
	var temp_path	= document.getElementById("temp_path");
	var real_name	= document.getElementById("real_name");
	
	temp_path.setAttribute("value", fileData.temp_path);
	real_name.setAttribute("value", fileData.real_name);
	
	return;
}

window.addEventListener("load", function()
{
	//이미지 등록
	var fileupload		= document.getElementById("fileupload");
	fileupload.addEventListener("click", function()
	{
		var uploadName	= document.getElementById("uploadName");
		uploadName.click();
		return;
	});
	
	//파일 업로드 처리
	var uploadName		= document.getElementById("uploadName");
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
		
		var frmImageUpload		= document.getElementById("frmFileUpload");
		frmImageUpload.target	= "uploadFrame";
		frmImageUpload.submit();
	});
	
	var couponExtCount	= document.getElementById("coupon_ext_count");
	couponExtCount.addEventListener("focus", function()
	{
		if (this.value != "")
			return;
			
		var couponCount	= document.getElementById("coupon_count");
		this.value		= couponCount.value;
		
	}.bind(couponExtCount));
	
	var resetCoupon		= document.getElementById("resetCoupon"); 
	resetCoupon.addEventListener("click", function()
	{
		var coupon_index		= document.getElementById("coupon_index");
		coupon_index.innerText	= "";
		
		var coupon_seq			= document.getElementById("coupon_seq");
		coupon_seq.value		= "";
		
		var coupon_context		= document.getElementById("coupon_context");
		coupon_context.value	= "";
		
		var coupon_name			= document.getElementById("coupon_name");
		coupon_name.value		= "";
		
		var imageFile			= document.getElementById("imageFile");
		imageFile.src			= "/app/images/admin/photo.png";
		
		var temp_path			= document.getElementById("temp_path");
		temp_path.value			= "";
		
		var real_name			= document.getElementById("real_name");
		real_name.value			= "";
		
		var coupon_count		= document.getElementById("coupon_count");
		coupon_count.value		= "";
		
		var coupon_ext_count	= document.getElementById("coupon_ext_count");
		coupon_ext_count.value	= "";
		
		var calendarbox			= document.getElementById("calendarbox");
		calendarbox.value		= "";
		
		return;
	});
	
	var deleteCoupon	= document.getElementById("deleteCoupon");
	deleteCoupon.addEventListener("click", function()
	{
		var coupon_seq	= document.getElementById("coupon_seq");
		if (coupon_seq.value == "")
		{
			alert("지정된 쿠폰 정보가 아니므로 삭제할 수 없습니다.");
			return;
		}
		
		var frmCoupon		= document.getElementById("frmCoupon");
		frmCoupon.action 	= frmCoupon.action + "&exec=del";
		frmCoupon.submit();
	});
	
	var is_limited	= document.getElementById("is_limited");
	is_limited.addEventListener("change", function()
	{
		if (this.checked)
		{
			var coupon_limited_date		= document.getElementById("coupon_limited_date");
			coupon_limited_date.value 	= "";
		}
	}.bind(is_limited));
	
	var no_expire	= document.getElementById("no_expire");
	no_expire.addEventListener("change", function()
	{
		if (this.checked)
		{
			var coupon_expire_date		= document.getElementById("coupon_expire_date");
			coupon_expire_date.value	= "";
		}
	}.bind(no_expire));
	
	var registerCoupon	= document.getElementById("registerCoupon");
	registerCoupon.addEventListener("click", function()
	{
		var coupon_name	= document.getElementById("coupon_name");
		if (coupon_name.value == "")
		{
			alert("쿠폰 이름을 입력하셔야 합니다.");
			coupon_name.focus();
			return;
		}
		
		var coupon_context	= document.getElementById("coupon_context");
		if (coupon_context.value == "")
		{
			alert("쿠폰 내용을 입력하셔야 합니다.");
			coupon_context.focus();
			return;
		}
		
		var real_name		= document.getElementById("real_name");
		if (real_name.value == "")
		{
			alert("쿠폰 이미지를 입력하셔야 합니다.");
			document.getElementById("fileupload").focus();
			return;
		}
		
		var coupon_count	= document.getElementById("coupon_count");
		if (coupon_count.value == "")
		{
			alert("구입 가능 인원을 입력하셔야 합니다.");
			coupon_count.focus();
			return;
		}
		
		var coupon_ext_count	= document.getElementById("coupon_ext_count");
		if (coupon_ext_count.value == "")
		{
			var result 	= window.confirm("잔여 쿠폰수를 입력하지 않았습니다. \r\n구입 가능 인원과 동일하게 입력하시겠습니까?");
			if (result)
				coupon_ext_count.value	= coupon_count.value;
			else
			{
				alert("잔여 쿠폰수를 입력하셔야 합니다.");
				coupon_ext_count.focus();
				return;
			}
		}
		
		var expire_date		= document.getElementById("coupon_expire_date");
		var no_expire		= document.getElementById("no_expire");
		if (expire_date.value == "")
		{
			if (!no_expire.checked)
			{
				alert("유효 기간을 입력하셔야 합니다.");
				expire_date.focus();
			}
		}
		else
		{
			if (no_expire.checked)
				no_expire.checked	= false;
		}
		
		var limited_date	= document.getElementById("coupon_limited_date");
		var is_limited		= document.getElementById("is_limited");
		if (limited_date.value == "")
		{
			if (!is_limited.checked)
			{
				alert("유효 기간을 입력하셔야 합니다.");
				limited_date.focus();
			}
		}
		else
		{
			if (is_limited.checked)
				is_limited.checked	= false;
		}
		
		var frmCoupon	= document.getElementById("frmCoupon");
		frmCoupon.submit();
		
		return;
	})
});