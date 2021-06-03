/**
 *  @auth : JEON JY
 *  @date	: 20200529
 *  admin 로그인
 */

/*
 *  admin login 처리
 */
var login_proc	= function(eventVal)
{
	if (eventVal.keyCode != 13 && eventVal.type == "keypress")
		return false;
	
	//로그인 submit 처리
	var frmLogin	= document.getElementById("frmLogin");
	core_submit.instance().send(frmLogin, function()
	{
		var adminid 	= document.getElementById("adminid").value;
		var adminpw	= document.getElementById("adminpw").value;
		if (adminid == "아이디" || adminid == "")
		{
			alert("아이디를 입력하셔야 합니다.");
			document.getElementById("adminid").focus();
			isInput	= false;
			return false;
		}
		
		if (adminpw == "비밀번호" || adminpw == "")
		{
			alert("비밀번호를 입력하셔야 합니다.");
			document.getElementById("adminpw").focus();
			isInput	= false;
			return false;
		}
		
		return true;
	});
}

/*
 * 	admin login 이벤트 처리
 */
window.addEventListener("load", function()
{
	var adminid			= document.getElementById("adminid");
	adminid.addEventListener("focus", function()
	{
		this.value = "";
	}.bind(adminid));
	
	var adminpw			= document.getElementById("adminpw");
	adminid.addEventListener("focus", function()
	{
		this.value = "";
	}.bind(adminpw));
	
	var submitLogin		= document.getElementById("login");	
	submitLogin.addEventListener("click", login_proc);
	adminpw.addEventListener("keypress", login_proc);
});