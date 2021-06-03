/**
 *  @auth : JEON JY
 *  @date : 20201021
 *  메시지 처리
 */

window.addEventListener("load", function()
{
	var deleteButton	= document.getElementById("deletebutton");
	if (deleteButton != null)
	{
		var isCheck		= false;
		deleteButton.addEventListener("click", function()
		{
			var messageSeqs	= document.getElementsByName("message_seq[]");
			for (var i = 0; i < messageSeqs.length; i++)
			{
				var messageSeqItem	= messageSeqs[i];
				if (messageSeqItem.checked)
				{
					isCheck	= true;
					break;
				}
			}
			
			if (!isCheck)
			{
				alert("삭제할 메시지를 선택하셔야 합니다.");
				return;
			}
			
			var frmMessageList	= document.getElementById("frmMessageList");
			frmMessageList.submit();
			
			return;
		});
	}
	
	return;
});