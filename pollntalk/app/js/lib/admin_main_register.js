/**
 *	@auth   : JEON JY
 * 	@date	: 20201003
 * 	관리자 메인 화면 정보 처리
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

/*
 *	관리자 메인 페이지 컨트롤 설정
 */
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
	
	//이미지 선택
	var main_info_list	= document.getElementById("main_info_list");
	main_info_list.addEventListener("click", function()
	{
		var seq			= main_info_list.options[main_info_list.selectedIndex].value;
		var main_seq	= document.getElementById("main_seq");
		
		main_seq.value	= seq;
		
		var query		= core_ajax.instance().makeQuery(null, "main_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_main_info", function(result)
		{
			
			return;			
		});
	});
	
	//메인 정보 등록 처리
	var registerMain	= document.getElementById("registerMain");
	registerMain.addEventListener("click", function()
	{
		var main_text1	= document.getElementById("main_text1");
		if (main_text1.value == "")
		{
			alert("메시지를 입력해야 합니다.");
			return;
		}
		
		var real_name	= document.getElementById("real_name");
		if (real_name.value == "")
		{
			alert("메인 이미지를 입력하셔야 합니다.");
			document.getElementById("fileupload").focus();
			return;
		}
		
		var frmMain		= document.getElementById("frmMain");
		frmMain.submit();
		
		return;
	});
});