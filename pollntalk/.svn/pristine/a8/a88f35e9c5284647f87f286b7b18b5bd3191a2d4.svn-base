/**
 * @auth   	: SIGI PARK
 * @date	: 20201008
 */

/*
 * 	공지사항 쓰기
 */

window.addEventListener("load", function()
{
	var notice_title = document.getElementById("notice_title");
	
	notice_title.addEventListener("keydown", function()
	{

		if(notice_title.value.length > 51)
		{
			alert("제목은 50자 이내로 적어주세요");
    		notice_title.value = notice_title.value.substring(0,50);
			return false;
		}
		
	});	
});

function registerBoard(){
	
	var objTextEdit = document.getElementById("objTextEdit").innerHTML;
	var getval = $('#objTextEdit').contents().find('#board_context').attr("value");
	
	alert(getval);
	
	if(objTextEdit == "")
	{
		alert("내용을 입력해주세요");
		return false;
	}
	
	return false;
}