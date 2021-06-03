/**
 *	@auth   : JEON JY
 * 	@date	: 20201003
 * 	관리자 포인트 처리
 */

/*
 *	포인트 관리자 페이지 컨트롤 설정
 */
window.addEventListener("load", function() 
{
	//포인트 정보 등록
	var registerPointInfo	= document.getElementById("registerPointInfo");
	registerPointInfo.addEventListener("click", function()
	{
		var pointPosition	= document.getElementById("point_position_list");
		if (pointPosition.options[pointPosition.selectedIndex].value == "")
		{
			alert("포인트를 부여할 위치를 선택하셔야 합니다.");
			pointPosition.focus();
			return;
		}
		
		var point			= document.getElementById("point");
		if (point.value == "")
		{
			alert("포인트를 입력하셔야 합니다.");
			point.focus();
			return;
		}
		
		var frmPoint		= document.getElementById("frmPoint");
		frmPoint.submit();
		
		return;
	});
	
	//포인트 정보 삭제
	var deletePointInfo		= document.getElementById("deletePointInfo");
	deletePointInfo.addEventListener("click", function()
	{
		if (!window.confirm("삭제하시겠습니까?"))
			return;
			
		var	point_seq	= document.getElementById("point_seq");
		if (point_seq.value == "")
		{
			alert("삭제할 포인트의 포지션을 선택하세요.");
			return;
		}
			
		var frmPoint		= document.getElementById("frmPoint");
		frmPoint.action		= "/admin_controller.php?mode=point_info_proc&exec=del";
		frmPoint.submit();
	});
	
	//리셋
	var resetPoint			= document.getElementById("resetPoint");
	resetPoint.addEventListener("click", function()
	{
		var	point_seq		= document.getElementById("point_seq");
		point_seq.value		= "";
		
		var pointPosition	= document.getElementById("point_position_list");
		pointPosition.options[0].selected	= true;
		
		var point			= document.getElementById("point");
		point.value			= "";
		
		return;
	});
	
	//포인트 선택 후 정보 표시
	var point_list		= document.getElementById("point_list");
	point_list.addEventListener("change", function()
	{
		var point_position 		= document.getElementById("point_position");
		point_position.value	= this.value;
		
		var query		= core_ajax.instance().makeQuery(null, "point_position", null);
		if (!query)
			return false;
			
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_point", function(result)
		{
			result		= JSON.parse(result);
			if (result == "FALSE")
			{
				alert("포인트 정보를 조회하는 중에 오류가 발생하였습니다.");
				return;
			}
			
			var point_position		= document.getElementById("point_position");
			point_position.value	= result.POINT_POSITION;
			
			var point_position_list	= document.getElementById("point_position_list");
			for (var i = 0; i < point_position_list.options.length; i++)
			{
				if (point_position_list.options[i].value == result.POINT_POSITION)
				{
					point_position_list.options[i].selected	= true;
					break;
				}	
			}
			
			var point		= document.getElementById("point");	
			point.value		= result.POINT;
			
			var point_seq 	= document.getElementById("point_seq");
			point_seq.value	= result.POINT_SEQ;
			
			return;
		});
		
		return false;	
	});
});