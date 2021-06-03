/**
 * 	ir 문의 사항 등록 처리
 */
window.addEventListener("load", function()
{
	//보내기 버튼 클릭
	var submitAsk	= document.getElementById("submitAsk");
	submitAsk.addEventListener("click", function()
	{
		//폼에서 데이터 추출
		var frmAsk	= document.getElementById("frmAsk");
		var query	= core_ajax.instance().makeQuery(frmAsk, null, function()
		{
			//데이터 검증
			var compName	= document.getElementById("compName");
			if (compName.value == "")
			{
				alert("성명 또는 기업명을 입력하셔야 합니다.");
				compName.focus();
				return false;
			}
			
			var compPhone	= document.getElementById("compName");
			if (compName.value == "")
			{
				alert("연락 가능한 전화번호를 입력하셔야 합니다.");
				compPhone.focus();
				return false;
			}
			
			var compEmail	= document.getElementById("compEmail");
			if (compEmail.value == "")
			{
				alert("이메일 주소를 입력하셔야 합니다.");
				compEmail.focus();
				return false;
			}
			
			var compContext	= document.getElementById("compContext");
			if (compContext.value == "")
			{
				alert("문의 내용을 입력하셔야 합니다.");
				compContext.focus();
				return false;
			}
			
			return true;
		});
		
		if (!query)
			return;
	
		//문의사항 데이터 전송
		var result;
		core_ajax.instance().send(query, null, frmAsk.action, function(result)
		{
			if (result == "FALSE")
				alert("ir 정보를 등록하는데 오류가 발생하였습니다.");
			else
				alert("등록되었습니다.");
		});
	});
});