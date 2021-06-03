/**
 * @auth   	: JEON JY
 * @date	: 20210103
 * 관리자 댓글 처리
 */

window.addEventListener("load", function()
{
	var hostKind	= document.getElementById("host_kind");
	hostKind.addEventListener("change", function()
	{
		var hostKindValue	= this.options[this.selectedIndex].value;
		location.href		= document.URL + "&host_kind=" + hostKindValue;
	}.bind(hostKind));
	
	/*
	 *	댓글 등록
	 */
	var registerReply	= document.getElementById("registerReply");
	if (registerReply != null)
	{
		registerReply.addEventListener("click", function()
		{
			var frmReply		= document.getElementById("frmReply");
			var replycontext	= document.getElementById("replycontext");
			if (replycontext.value == "")
			{
				alert("댓글을 입력하셔야 합니다.");
				replycontext.focus();
				return;
			}
			
			var voteSeq			= document.getElementById("reply_vote_seq");
			var vote_form_seq	= document.getElementById("reply_vote_form_seq");
			if (voteSeq.value == "" && vote_form_seq.value == "")
			{
				alert("설문 또는 투표나 설문양식이 지정되지 않았습니다.");
				return;
			}
			
			var reply_proc		= document.getElementById("reply_proc");
			reply_proc.value	= "register";
			
			frmReply.submit();
		})
	}
});

/*
 *	댓글 삭제
 */
function removeReply(replySeq)
{
	if (!window.confirm("삭제하시겠습니까?"))
		return;
	
	var reply_Seq	= document.getElementById("reply_seq");	
	reply_Seq.value	= replySeq;
	
	var reply_proc		= document.getElementById("reply_proc");
	reply_proc.value	= "delete";
	
	var frmReply		= document.getElementById("frmReply");
	frmReply.submit();
}

/*
 *	답글 등록 보기
 */
function viewSubReply(replySeq)
{
	var subreplyarea	= document.querySelectorAll(".subreplyarea");	
	for (var i = 0; i < subreplyarea.length; i++)
	{
		if (subreplyarea[i].id != "subreply_" + replySeq)
			subreplyarea[i].style.display	= "none";
	}
	
	var subreply		= document.getElementById("subreply_" + replySeq);
	if (subreply.style.display == "none")
	{
		subreply.style.display = "block";
		
		//답글 출력
		var parent_replyseq		= document.getElementById("parent_replyseq");
		parent_replyseq.value	= replySeq;
		var query	= core_ajax.instance().makeQuery(null, "parent_replyseq", null);
		if (!query)
			return false;
			
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_subreplylist", function(result)
		{
			if (result == "FALSE" || result == "0")
				return;
				
			result				= JSON.parse(result);
			for (var i = 0; i < result.length; i++)
			{
				var subreplyitem	= subreply.querySelector(".subreplybox");
				subreplyitem.style.display		= "block";
				
				var subreplysample		= subreplyitem.querySelector(".subreplysample");
				var newElement			= subreplysample.cloneNode(true);
				
				var replycontext		= newElement.querySelector(".subreplycontext");
				replycontext.innerText	= result[i].REPLY_CONTEXT;
				
				var replywriterlink		= newElement.querySelector(".subreplywriterlink");
				replywriterlink.setAttribute("href", "/admin_manager.php?mode=memberinfo&member_seq=" + result[i].REPLY_WRITER_SEQ);	
				
				var replywriter			= newElement.querySelector(".subreplywriter");
				replywriter.innerText	= result[i].NNAME;
				
				var replyregidate		= newElement.querySelector(".subreplyregidate");
				replyregidate.innerText	= result[i].REPLY_REGI_DATE;
				
				var deletesubreply		= newElement.querySelector(".deletesubreply");
				deletesubreply.setAttribute("href", "deleteSubReply('" + result[i].REPLY_SEQ + "')");
				
				subreplyitem.appendChild(newElement);
				newElement.style.display	= "block";
			}
					
			return;
		}.bind(subreply));
	}
	else
		subreply.style.display = "none";
	
	return;
}

/*
 *	답글 등록
 */
function registerSubReply(replySeq)
{
	var reply_Seq		= document.getElementById("parent_replyseq");	
	reply_Seq.value		= replySeq;
	
	var temp_context	= document.getElementById("subreplycontext_" + replySeq);
	var reply_context	= document.getElementById("subreply_context");
	reply_context.value	= temp_context.value;
	
	var frmReply		= document.getElementById("frmSubReply");
	frmReply.submit();
}