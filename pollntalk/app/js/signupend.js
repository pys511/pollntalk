/**
 *	@auth	: Park Yoon Sik
 *	@date	: 20200806
 *	회원가입 결과 페이지
 */
/*
 * 	페이지 공통 기능 처리
 */
window.addEventListener("load", function()
{
	var goLogin			= document.getElementById("goLogin");
	if (goLogin != null)
	{
		goLogin.addEventListener("click", function()
		{
			parent.goLogin();
		});
	}
	
	var closeJoinPopup	= document.getElementById("closeJoinPopup");
	closeJoinPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});
});


function sendEmail(){
	
	
}