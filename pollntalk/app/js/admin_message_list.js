/**
 *  @auth : JEON JY
 *  @date	: 20210108
 *  메시지 관리자 등록
 */

/*
 * 	메시지 관리페이지 컨트롤 이벤트 설정
 */
window.addEventListener("load", function()
{
	var sendall	= document.getElementById("sendall");
	sendall.addEventListener("click", function()
	{
		var ischecked		= false;
		var memberSeqs		= document.getElementsByName("member_seq[]");
		for (var i = 0; i < memberSeqs.length; i++)
		{
			var member		= memberSeqs[i];
			if (member.checked)
			{
				ischecked	= true;
				break;
			}
		}
		
		if (!ischecked)
		{
			alert("쪽지를 받을 회원을 선택하셔야 합니다.");
			return;
		}
		
		var messageContext	= document.getElementById("messageContext");
		if (messageContext.value == "")
		{
			alert("전송할 메시지를 입력하셔야 합니다.");
			return;
		}
		
		var execType		= document.getElementById("exec");
		execType.value		= "send";
		
		var frmMessage		= document.getElementById("frmMessage");
		frmMessage.submit();
		
		return;
	});
	
	var delall	= document.getElementById("delall");
	delall.addEventListener("click", function()
	{
		var ischecked		= false;
		var messageSeqs		= document.getElementsByName("message_seq[]");
		for (var i = 0; i < messageSeqs.length; i++)
		{
			var message		= messageSeqs[i];
			if (message.checked)
			{
				ischecked	= true;
				break;
			}
		}
		
		if (!ischecked)
		{
			alert("삭제할 회원을 선택하셔야 합니다.");
			return;
		}
		
		var execType		= document.getElementById("exec");
		execType.value		= "del";
		
		var frmMessage		= document.getElementById("frmMessage");
		frmMessage.submit();
		
		return;
	});
	
	var is_all	= document.getElementById("is_all");
	is_all.addEventListener("click", function()
	{
		var memberSeqs		= document.getElementsByName("message_seq[]");
		if (is_all.checked)
		{
			for (var i = 0; i < memberSeqs.length; i++)
			{
				var member		= memberSeqs[i];
				member.checked	= true;
			}
		}
		else
		{
			for (var i = 0; i < memberSeqs.length; i++)
			{
				var member		= memberSeqs[i];
				member.checked	= false;
			}
		}		
	});
});

function removeMessage(selectedMemberSeq)
{
	var execType		= document.getElementById("exec");
	execType.value		= "del";
	
	var memberSeqs		= document.getElementsByName("message_seq[]");
	for (var i = 0; i < memberSeqs.length; i++)
	{
		var member		= memberSeqs[i];
		if (member.checked)
			ischecked	= false;
	}
	
	var selMemberSeq		= document.getElementById(selectedMemberSeq);
	selMemberSeq.checked	= true; 
	
	var frmMessage			= document.getElementById("frmMessage");
	frmMessage.submit();
	
	return;
}