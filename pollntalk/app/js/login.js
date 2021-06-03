/**
 *	@auth   : Park Yoon Sik
 *	@date	: 20200713
 *	로그인 페이지 스크립트 처리
 */

function doLogin()
{
	var email		= document.getElementById("email");
	if (email.value == "")
	{
		alert("이메일을 입력하셔야 합니다.");
		email.focus();
		return;
	}
	
	var password	= document.getElementById("password");
	if (password.value == "")
	{
		alert("비밀번호를 입력하셔야 합니다.");
		password.focus();
		return;
	}
	
	if(saveemail.checked){ // EMAIL 저장하기를 체크
		var userEmail = email.value;
        setCookie("userEmail", userEmail, 30); // 30일 동안 쿠키 보관
    }
	
	var loginForm	= document.getElementById("loginForm");
	loginForm.submit();
	
	return;
}

window.addEventListener("load", function()
{
	var closeLoginPopup	= document.getElementById("closeLoginPopup");
	closeLoginPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});

	// 저장된 쿠키값을 가져와서 EMAIL 칸에 넣어준다. 없으면 공백
	var email	= document.getElementById("email");
	var userEmail = getCookie("userEmail");
	var saveemail	= document.getElementById("saveemail");
	
	if(userEmail != "")
	{
		$("#email").val(userEmail);
	}    
	
	if(email.value != "")
	{ 
        $("#saveemail").attr("checked", true); // EMAIL 저장하기를 체크 상태로 두기.
    }
    
	saveemail.addEventListener("change", function()
	{
		if(!this.checked)
		{ 
			// EMAIL 저장하기 체크해제 시
            deleteCookie("userEmail");
        }
	});
	
	var loginbutton		= document.getElementById("loginbutton");
	loginbutton.addEventListener("click", doLogin);
	
	var password		= document.getElementById("password");
	password.addEventListener("keypress", function()
	{
		if (window.event.keyCode == 13)
			doLogin();
	});
	
	var sign_up	= document.getElementById("sign_up");
	sign_up.addEventListener("click", function()
	{
		parent.goSignup();
	});
	
	
	var support	= document.getElementById("support");
	support.addEventListener("click", function()
	{
		window.parent.location.href="/?mode=customer&sub=support";
		parent.closePopup();
	});
	
	var findPass = document.getElementById("findPass");
	findPass.addEventListener("click", function()
	{
		parent.goFindPass();
	});
	
});

function setCookie(cookieName, value, exdays)
{
    var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
	document.cookie = cookieName + "=" + cookieValue;
}
 
function deleteCookie(cookieName)
{
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}
 
function getCookie(cookieName) 
{
    cookieName = cookieName + '=';
    var cookieData = document.cookie;
    var start = cookieData.indexOf(cookieName);
    var cookieValue = '';
    if(start != -1)
	{
        start += cookieName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    
	return unescape(cookieValue);
}