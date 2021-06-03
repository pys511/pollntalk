/**
 * @auth	: Park Y.S.
 * @date	: 20210423
 * 광고관리 
 */

//업로드된 관련 파일 받기
var setPCFile	= function(fileData)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var tempPath	= fileData.temp_path;
	var pcImageFile	= document.getElementById("pc_imageFile");
	pcImageFile.setAttribute("src", tempPath);
	
	var temp_path	= document.getElementById("pc_temp_path");
	var real_name	= document.getElementById("pc_real_name");
	
	temp_path.setAttribute("value", fileData.temp_path);
	real_name.setAttribute("value", fileData.real_name);
	
	return;
}

//업로드된 관련 파일 받기
var setMobileFile	= function(fileData)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var tempPath	= fileData.mtemp_path;
	var mobileImageFile	= document.getElementById("mobile_imageFile");
	mobileImageFile.setAttribute("src", tempPath);
	
	var temp_path	= document.getElementById("mobile_temp_path");
	var real_name	= document.getElementById("mobile_real_name");
	
	temp_path.setAttribute("value", fileData.mtemp_path);
	real_name.setAttribute("value", fileData.mreal_name);
	
	return;
}


window.addEventListener("load", function()
{	
	var registerAd	= document.getElementById("registerAd");
	registerAd.addEventListener("click", function()
	{
		var ad_subject	= document.getElementById("ad_subject");
		if(ad_subject.value == ""){
			alert("제목을 입력하셔야 합니다.");
			return false;
		}
		var ad_type =	document.getElementById("ad_type");
		if(ad_type.value == "1"){
			var real_name	= document.getElementById("pc_real_name");
			if (real_name.value == "")
			{
				alert("이미지를 입력하셔야 합니다.");
				document.getElementById("fileupload").focus();
				return;
			}
		
			var ad_url 		= document.getElementById("ad_url");
			if(ad_url.value == "")
			{
				alert("URL를 입력하셔야 합니다.");
				return;
			}
		}else{
			var ad_script	= document.getElementById("ad_script");
			if(ad_script.value.trim == "")
			{
				alert("스크립트를 입력하셔야 합니다.");
				return;
			}
		}
		
		
		var proc_name	= document.getElementById("proc_name");
		proc_name.value	= "register";
		
		var frmAdver = document.getElementById("frmAdver");
		frmAdver.submit();
		
		return;
	});
	
	var ad_type = document.getElementById("ad_type");
	ad_type.addEventListener("change", function()
	{
		var ad_type =	document.getElementById("ad_type");
		if(ad_type.value == "1")
		{
			var type_img =	document.getElementById("type_img");
			type_img.style.display = "block";	
			
			var type_script =	document.getElementById("type_script");
			type_script.style.display = "none";	
		} else
		{
			var type_img =	document.getElementById("type_img");
			type_img.style.display = "none";
			
			var type_script =	document.getElementById("type_script");
			type_script.style.display = "block";	
		}
		
	});
	
	
	
	var deleteAd	= document.getElementById("deleteAd");
	deleteAd.addEventListener("click", function()
	{
		var ad_index			= document.getElementById("ad_index");
		if (ad_index.value == "")
		{
			alert("삭제할 광고를 선택하셔야 합니다.");
			return;
		}
		
		var proc_name	= document.getElementById("proc_name");
		proc_name.value	= "delete";
		
		var frmAdver = document.getElementById("frmAdver");
		frmAdver.submit();
		
		return;
	})
	
	var initAd	= document.getElementById("initAd");
	initAd.addEventListener("click", function()
	{
		var ad_index			= document.getElementById("ad_index");
		ad_index.value			= "";
		
		var ad_subject			= document.getElementById("ad_subject");
		ad_subject.value		= "";
		
		var ad_url 				= document.getElementById("ad_url");
		ad_url.value			= "";
		
		var pc_real_name		= document.getElementById("pc_real_name");
		pc_real_name.value		= "";
		
		var pc_temp_path		= document.getElementById("pc_temp_path");
		pc_temp_path.value		= "";
		
		var mobile_real_name	= document.getElementById("mobile_real_name");
		mobile_real_name.value	= "";
		
		var mobile_temp_path	= document.getElementById("mobile_temp_path");
		mobile_temp_path.value	= "";
		
		var pc_imageFile		= document.getElementById("pc_imageFile");
		pc_imageFile.src		= "/app/images/admin/photo.png";
		
		var mobile_imageFile	= document.getElementById("mobile_imageFile");
		mobile_imageFile.src	= "/app/images/admin/photo.png";
		
		var proc_name			= document.getElementById("proc_name");
		proc_name.value			= "";
		
		return;
	});
	
	//PC 이미지 등록
	var pcfileupload		= document.getElementById("pc_fileupload");
	pcfileupload.addEventListener("click", function()
	{
		var uploadName		= document.getElementById("pc_image");
		uploadName.click();
		return;
	});
	
	//모바일 이미지 등록
	var mobilefileupload	= document.getElementById("mobile_fileupload");
	mobilefileupload.addEventListener("click", function()
	{
		var uploadName		= document.getElementById("mobile_image");
		uploadName.click();
		return;
	});
	
	//파일 업로드 처리
	var pc_image		= document.getElementById("pc_image");
	pc_image.addEventListener("change", function()
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
		
		var frmImageUpload		= document.getElementById("frmPcFileUpload");
		frmImageUpload.target	= "uploadFrame";
		frmImageUpload.submit();
	});
	
	//파일 업로드 처리
	var mobile_image	= document.getElementById("mobile_image");
	mobile_image.addEventListener("change", function()
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
		
		var frmImageUpload		= document.getElementById("frmMobileUpload");
		frmImageUpload.target	= "uploadFrame";
		frmImageUpload.submit();
	});
}, true);