/**
 *  @auth : JEON JY
 *  @date	: 202000601
 *  admin 등록 처리
 */
var isCheck	= false;

var valdiateFrom	= function()
{
	var user_seq		= document.getElementById("admin_seq").value;
	if (user_seq == "")
	{
		if (!isCheck)
		{
			alert("아이디 중복체크를 하셔야 합니다.");
			document.getElementById("admin_id").focus();
			return false;
		}
	}
	
	var elmPhone_comp		= document.getElementById("phone_comp");
	var admin_id			= document.getElementById("admin_id").value;
	var admin_pw			= document.getElementById("admin_pw").value;
	var admin_name			= document.getElementById("admin_name").value;
	var admin_pw_re			= document.getElementById("admin_pw_re").value;
	var elmPhonenumber		= document.getElementById("phonenumber");
	var elmPhone_comp		= document.getElementById("phone_comp");
	var phone_comp			= elmPhone_comp.options[elmPhone_comp.selectedIndex].value;	
	var phone_first			= document.getElementById("phone_first").value;
	var phone_second		= document.getElementById("phone_second").value
	var admin_mail			= document.getElementById("admin_mail").value;;
	
	if (admin_id == "")
	{
		alert("아이디를 입력하셔야 합니다.");
		document.getElementById("admin_id").focus();
		return false;
	}
	
	if (admin_name == "")
	{
		alert("이름을 입력하셔야 합니다.");
		document.getElementById("admin_name").focus();
		return false;
	}
	
	if (admin_pw == "")
	{
		alert("비밀번호를 입력하셔야 합니다.");
		document.getElementById("admin_pw").focus();
		return false;
	}
	
	if (admin_pw_re == "")
	{
		alert("비밀번호 확인을 입력하셔야 합니다.");
		document.getElementById("admin_pw_re").focus();
		return false;
	}
	
	if (admin_pw != admin_pw_re)
	{
		alert("비밀번호 확인을 입력하셔야 합니다.");
		document.getElementById("admin_pw").value = "";
		document.getElementById("admin_pw_re").value = "";
		document.getElementById("admin_pw").focus();
		return false;
	}
	
	if (phone_first == "")
	{
		alert("연락처를 입력하셔야 합니다.");
		document.getElementById("phone_first").focus();
		return false;
	}
	
	if (phone_second == "")
	{
		alert("연락처를 입력하셔야 합니다.");
		document.getElementById("phone_second").focus();
		return false;
	}
	
	if (admin_mail == "")
	{
		alert("이메일을 입력하셔야 합니다.");
		document.getElementById("admin_mail").focus();
		return false;
	}
	
	elmPhonenumber.value	= phone_comp + phone_first + phone_second;
	
	return true;
}

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

/*
 * 	등록 페이지 컨트롤 이벤트 설정
 */
window.addEventListener("load", function()
{
	//파일 업로드
	var uploadName		= document.getElementById("uploadName");
	var thumb_upload	= document.getElementById("fileupload");
	thumb_upload.addEventListener("click", function()
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
	
	//id 중복 체크
	var idCheck				= document.getElementById("idCheck");
	idCheck.addEventListener("click", function()
	{
		var frmMember		= document.getElementById("frmMember");
		var query			= core_ajax.instance().makeQuery(frmMember, "admin_id", function()
		{
			var admin_id	= document.getElementById("admin_id");
			if (admin_id.value == "")
			{
				alert("아이디를 입력하셔야 합니다.");
				return false;
			}
			
			return true;
		});
		
		if (!query)
			return;
		
		var result;
		core_ajax.instance().send(query, null, "/?mode=id_check", function(result)
		{
			if (result == "FALSE")
			{
				alert("이미 사용중인 아이디입니다.");
				isCheck	= false;
			}
			else
				isCheck	= window.confirm("사용 가능한 아이디입니다.\r\n현재 아이디로 이용하시겠습니까?");
			
			return;
			
		}.bind(admin_id));
		
		return;
	});
	
	//중복 체크에서 확인 버튼을 누른 후 다시 id입력란에 키를 누르면 초기화 
	var admin_id		= document.getElementById("admin_id");
	admin_id.addEventListener("keypress", function()
	{
		if (isCheck == true)
		{
			this.value 	= "";
			isCheck		= false;
		}
		
		return;
		
	}.bind(admin_id));
	
	//관리자 등록 submit 처리
	var registerAdmin		= document.getElementById("registerAdmin");
	registerAdmin.addEventListener("click", function()
	{
		var frmMember		= document.getElementById("frmMember");
		core_submit.instance().send(frmMember, valdiateFrom);
	});
	
	//관리자 수정 submit 처리
	var registerAdmin		= document.getElementById("updateAdmin");
	registerAdmin.addEventListener("click", function()
	{
		var frmMember		= document.getElementById("frmMember");
		core_submit.instance().send(frmMember, valdiateFrom);
	});
	
	//관리자 삭제 처리
	var registerAdmin		= document.getElementById("deleteAdmin");
	registerAdmin.addEventListener("click", function()
	{
		var frmMember		= document.getElementById("frmMember");
		frmMember.action	= "/?mode=admin_delete_proc";
		core_submit.instance().send(frmMember, function()
		{
			var user_seq	= document.getElementById("user_seq");
			if (user_seq.value == "")
				return false;
				
			var isOK		= window.confirm("삭제하시겠습니까?");
			if (!isOK)
				return false;
			
			return true;
		});
	});
});