/**
 *	@auth   : Park Yoon Sik
 *	@date	: 20210530
 *	패스워드찾기 페이지 스크립트 처리
 */

window.addEventListener("load", function()
{
	var closefindPassPopup	= document.getElementById("closefindPassPopup");
	closefindPassPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});
	
	var findPass		= document.getElementById("findPass");
	var email		= document.getElementById("email");
	
	findPass.addEventListener("click", function()
	{
		if (email.value == "")
		{
			alert("이메일을 입력하셔야 합니다.");
			email.focus();
			return;
		}
		
		var findPassForm	= document.getElementById("findPassForm");
		findPassForm.submit();
	
		return;
		
	});
	
	
	email.addEventListener("keypress", function()
	{
		if (window.event.keyCode == 13){
			doLogin();
		}
	});
});