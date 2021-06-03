/**
 *  @auth : YS PARK
 *  @date	: 20200529
 *  admin 회원목록 검색
 */

window.addEventListener("load", function()
{
	var searchButton = document.getElementById("searchButton");	
	searchButton.addEventListener("click", function()
	{
		var kind = document.getElementById("kind");
		var data = document.getElementById("data");
		
		if(data.value == "")
		{
			alert("검색어를 입력해주세요.");
			document.getElementById("data").focus();
			
			return false;
		}
		
		location.href	= "/admin_manager.php?mode=memberlist&kind="+kind.value+"&data="+data.value;
			
	});
});
