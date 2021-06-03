/**
 *  @auth : JEON JY
 *  @date	: 20210108
 *  회원 수정
 */

/*
 * 	회원 정보 수정
 */
window.addEventListener("load", function()
{
	//파일 업로드
	var uploadName		= document.getElementById("uploadName");
	var fileupload		= document.getElementById("fileupload");	
	fileupload.addEventListener("click", function()
	{
		this.click();
		return;
	}.bind(uploadName));
	
	//파일 업로드 처리
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
		
		var frmFileUpload		= document.getElementById("frmFileUpload");
		frmFileUpload.target	= "uploadFrame";
		frmFileUpload.submit();
	});
	
	//회원 탈퇴 처리
	var withdrawalMember	= document.getElementById("withdrawalMember");
	withdrawalMember.addEventListener("click", function()
	{
		var member_seq	= document.getElementById("member_seq");
		if (member_seq.value == "")
		{
			alert("지정된 회원이 없습니다.");
			location.href	= "/admin_manager.php?mode=memberlist";
			return;
		}
		
		var proc		= document.getElementById("proc");
		proc.value		= "delete";
		
		var frmMember	= document.getElementById("frmMember");
		frmMember.submit();
		return;
	});
	
	//회원 정보 수정
	var updateMember	= document.getElementById("updateMember");
	updateMember.addEventListener("click", function()
	{	
		var member_seq	= document.getElementById("member_seq");
		if (member_seq.value == "")
		{
			alert("지정된 회원이 없습니다.");
			location.href	= "/admin_manager.php?mode=memberlist";
			return;
		}
	
		var uname		= document.getElementById("uname");
		if (uname.value == "")
		{
			alert("이름을 입력하셔야 합니다.");
			uname.focus();
			return;
		}
		
		var nname		= document.getElementById("nname");
		if (nname.value == "")
		{
			alert("닉네임을 입력하셔야 합니다.");
			nname.focus();
			return;
		}
		
		var real_name	= document.getElementById("real_name");
		if (real_name.value == "")
		{
			alert("썸네일 이미지를 입력하셔야 합니다.");
			fileupload.focus();
			return;
		}
		
		var email		= document.getElementById("email");
		if (email.value == "")
		{
			alert("이메일 주소를 입력하셔야 합니다.");
			email.focus();
			return;
		}
		
		var birthday	= document.getElementById("b_birth");
		if (birthday.value == "")
		{
			alert("생년월일을 입력하셔야 합니다.");
			birthday.focus();
			return;
		}
		
		var grade		= document.getElementById("grade");
		if (grade.options[grade.selectedIndex].value == "-")
		{
			alert("회원등급을 입력하셔야 합니다.");
			grade.focus();
			return;
		}
		
		var proc		= document.getElementById("proc");
		proc.value		= "register";
		
		var frmMember	= document.getElementById("frmMember");
		frmMember.submit();
		return;
	});
});

//업로드된 파일 받기
var setFile	= function(fileData)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var tempPath	= fileData.temp_path;
	var realName	= fileData.real_name;
	
	var imageFile	= document.getElementById("imageFile");
	imageFile.setAttribute("src", tempPath);
	
	var temp_path	= document.getElementById("temp_path");
	var real_name	= document.getElementById("real_name");
	
	temp_path.setAttribute("value", fileData.temp_path);
	real_name.setAttribute("value", fileData.real_name);
	
	return;
}