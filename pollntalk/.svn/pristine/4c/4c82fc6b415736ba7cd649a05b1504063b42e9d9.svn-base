/**
 * @auth   	: PARK YS
 * @date	: 20210404
 * 검색어 처리
 */

window.addEventListener("load", function() 
{
	//키워드 등록
	var registerkeyword = document.getElementById("registerkeyword");
	registerkeyword.addEventListener("click", function()
	{
		var keyword_name = document.getElementById("keyword_name");
		if (keyword_name.value == "")
		{
			alert("검색어를 입력하시기 바랍니다.");
			keyword_name.focus();
			return;
		}
		
		var frmkeyword = document.getElementById("frmkeyword");
		frmkeyword.submit();		
	});
	
	//키워드 삭제
	var deletekeyword = document.getElementById("deletekeyword");
	deletekeyword.addEventListener("click", function()
	{
		var keyword_seq		= document.getElementById("keyword_seq");
		if (keyword_seq.value == "")
		{
			alert("검색어를 선택하셔야 합니다.");
			return;	
		}
		
		var query			= core_ajax.instance().makeQuery(null, "keyword_seq", null);
		
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=delete_keyword_proc", function(result)
		{
			if (result == "FALSE")
			{
				alert("삭제하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
				location.href	= "/admin_manager.php?mode=searchkeyword";
				return;
			}
			alert("삭제되었습니다.");
			location.href	= "/admin_manager.php?mode=searchkeyword";
			return;			
		});
			
	});
	
	//키워드 선택
	keyword_list.addEventListener("click", function()
	{
		var keyword_list	= document.getElementById("keyword_list");
		var keyword_seq		= document.getElementById("keyword_seq");
		
		keyword_seq.value	= keyword_list.options[keyword_list.selectedIndex].value;
		
		var keyword_name 	= document.getElementById("keyword_name");
		keyword_name.value	= keyword_list.options[keyword_list.selectedIndex].innerText;
		
		return;
	});	
});