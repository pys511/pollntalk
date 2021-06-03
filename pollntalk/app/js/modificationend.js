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
	var closePopup			= document.getElementById("closePopup");
	if (closePopup != null)
	{
		closePopup.addEventListener("click", function()
		{
			parent.refleshPage();
			parent.closePopup();
			
		});
	}
	
	var closeJoinPopup	= document.getElementById("closeEndPopup");
	closeJoinPopup.addEventListener("click", function()
	{
		parent.refleshPage();
		parent.closePopup();
		
	});
});