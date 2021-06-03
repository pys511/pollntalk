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
		var main_seq	= document.getElementById("seq");
		
		main_seq.value	= seq;
		
		var query		= core_ajax.instance().makeQuery(null, "seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_main_info", function(result)
		{
			if (result == "FALSE")
				return;
			
			result	= JSON.parse(result);
			
			var seq				= document.getElementById("seq");
			seq.value			= result.MAIN_SEQ;
			
			var main_text1		= document.getElementById("main_text1");
			main_text1.value	= result.M_TEXT1;
			
			var main_color1		= document.getElementById("main_color1");
			main_color1.value	= result.M_TEXT1_COLOR;
			
			var main_text2		= document.getElementById("main_text2");
			main_text2.value	= result.M_TEXT2;
			
			var main_color2		= document.getElementById("main_color2");
			main_color2.value	= result.M_TEXT2_COLOR;
			
			var main_backcolor		= document.getElementById("main_backcolor");
			main_backcolor.value	= result.M_BACKCOLOR;
			
			var imageFile		= document.getElementById("imageFile");
			imageFile.src		= "/" + result.M_REAL_IMAGE;
			
			var temp_path		= document.getElementById("temp_path");
			temp_path.value		= "/" + result.M_ORIGIN_IMAGE;
			
			var real_name		= document.getElementById("real_name");
			real_name.value		= "/" + result.M_REAL_IMAGE;
			
			var is_open			= document.getElementById("is_open");
			if (result.M_IS_OPEN == "1")
				is_open.checked	= true;
			else
				is_open.checked	= false;
			
			return;			
		});
	});
	
	//리셋
	var resetMain		= document.getElementById("resetMain");
	resetMain.addEventListener("click", function()
	{
		var seq				= document.getElementById("seq");
		seq.value			= "";
		
		var main_text1		= document.getElementById("main_text1");
		main_text1.value	= "";
		
		var main_color1		= document.getElementById("main_color1");
		main_color1.value	= "";
		
		var main_text2		= document.getElementById("main_text2");
		main_text2.value	= "";
		
		var main_color2		= document.getElementById("main_color2");
		main_color2.value	= "";
		
		var main_backcolor		= document.getElementById("main_backcolor");
		main_backcolor.value	= "";
		
		var imageFile		= document.getElementById("imageFile");
		imageFile.src		= "";
		
		var temp_path		= document.getElementById("temp_path");
		temp_path.value		= "";
		
		var real_name		= document.getElementById("real_name");
		real_name.value		= ""
		
		var is_open			= document.getElementById("is_open");
		is_open.checked	= false;
	});
	
	//삭제
	var deleteMain		= document.getElementById("deleteMain");
	deleteMain.addEventListener("click", function()
	{
		var seq			= document.getElementById("seq");
		if (seq.value == "")
		{
			alert("이미지 목록에서 항목을 선택하셔야 합니다.");
			return;
		}
		
		var proc		= document.getElementById("proc");
		proc.value		= "delete";
		
		var frmMain		= document.getElementById("frmMain");
		frmMain.submit();
		
		return;
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
		
		var proc		= document.getElementById("proc");
		proc.value		= "register";
		
		var frmMain		= document.getElementById("frmMain");
		frmMain.submit();
		
		return;
	});
});