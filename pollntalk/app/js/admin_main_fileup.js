/**
 *	@auth	: Park Yoon Sik
 *	@date	: 20210411
 *	파일업로드 팝업 처리 
 */

var isCheck	= false;

/*
 *  파일업로드 페이지 스크립트 처리
 */

window.addEventListener("load", function()
{
	var fileupload = document.getElementById("fileupload");
	fileupload.addEventListener("click", function()
	{
		frmMain.submit();
	});
	
	var registerMainText1 = document.getElementById("registerMainText1");
	registerMainText1.addEventListener("click", function()
	{
		var query			= core_ajax.instance().makeQuery(null, 'main_text1', null);
		var main_text1	= document.getElementById("main_text1");

		var query = core_ajax.instance().makeQuery(null, "main_text1", null);
		if (!query)
		{
			return false;
		}
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=mainText_proc&num=1", function(result)
		{
			if (result == "FALSE")
			{
				alert("등록중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
				location.href	= "/admin_manager.php?mode=mainsetting";
				return;
			}
			alert("등록되었습니다.");
			location.href	= "/admin_manager.php?mode=mainsetting";
			return;			
		});		
	});
	
	var registerMainText2 = document.getElementById("registerMainText2");
	registerMainText2.addEventListener("click", function()
	{
		var main_text2	= document.getElementById("main_text2");
		var query = core_ajax.instance().makeQuery(null, "main_text2", null);
		if (!query){
			return false;
		}
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=mainText_proc&num=2", function(result)
		{
			if (result == "FALSE")
			{
				alert("등록중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
				location.href	= "/admin_manager.php?mode=mainsetting";
				return;
			}
			alert("등록되었습니다.");
			location.href	= "/admin_manager.php?mode=mainsetting";
			return;			
		});		
	});
	
	
});