/**
 * @auth   	: JEON JY
 * @date	: 20201003
 * 투표 보기 처리
 */

window.addEventListener("load", function()
{
	var query		= location.search;
	if (query.indexOf("replyresult=REPLY_TRUE") >= 0)
	{
		var replylist	= document.getElementById("replylist");
		window.scrollTo(0, replylist.offsetTop);
	}
	
	/*
	 *	투표 보기
	 */
	var goVote	= document.getElementById("goVote");
	if (goVote != null)
	{
		goVote.addEventListener("click", function()
		{
			var vote_seq	= document.getElementById("vote_seq");
			location.href	= "/index.php?mode=voteview&vote_seq=" + vote_seq.value;
		});
	}
	
	/*
	 *	투표 댓글 등록 가능 유무
	 */
	var replycontext	= document.getElementById("replycontext");
	var yesReplyContext	= false;
	if (replycontext != null)
	{
		replycontext.addEventListener("focus", function()
		{
			if (!yesReplyContext)
			{
				core_ajax.instance().send("", null, "/controller.php?mode=is_login", function(result)
				{
					if (result == "FALSE")
					{
						alert("로그인을 하셔야 합니다.");
						this.readonly	= true;
						yesReplyContext	= false;
					}
					else
					{
						this.removeAttribute("readonly");
						yesReplyContext	= true;
					}
				}.bind(replycontext));	
			}	
		})
	}
	
	/*
     *	투표 응답 등록
     */
	var registerVoteResp	= document.getElementById("registerVoteResp");
	if (registerVoteResp != null)
	{
		registerVoteResp.addEventListener("click", function()
		{
			var is_answer	= false;
			var is_error	= false;
			var question_indexs	= document.getElementsByName("question_index[]");
			var question_length	= question_indexs.length;
			for (var i = 0; i < question_length; i++)
			{
				var question_index	= question_indexs[i];
				if (question_index == null)
				{
					alert("투표 질문에 오류가 발생하였습니다. 관리자에게 문의하시기 바랍니다.");
					is_answer	= false;
					is_error	= true;
					break;
				}
				
				var questionRespType 	= document.getElementById("question_resp_type_" + question_index.value);
				if (questionRespType.value == "3" || questionRespType.value == "4" || questionRespType.value == "5")
				{
					var answerTextarea		= document.getElementById("answer_textarea_" + question_index.value);
					if (answerTextarea.value == "")
					{
						var answer_frees	= document.getElementsByName("answer_free_" + question_index.value + "[]");
						for (var i = 0; i < answer_frees.length; i++)
						{
							var answerFreeItem	= answer_frees[i];
							if (answerFreeItem.checked)
							{
								is_answer	= true;
								break;
							}
						}
					}
					else
						is_answer	= true;
					
					if (!is_answer)
					{
						answerTextarea.focus();
						break;	
					}
				}	
				else
				{	
					var answerName			= "answer_" + question_index.value + "[]";
					var answers				= document.getElementsByName(answerName);
					var answer_length		= answers.length;
					for (var j = 0; j < answer_length; j++)
					{
						var answerVal	= answers[j];
						if (answerVal.checked)
						{
							is_answer	= true;
							break;
						}
					}
					
					if (!is_answer)
					{
						answers[0].focus();
						break;
					}
				}				
			}
			
			if (!is_error)
			{
				if (!is_answer)
				{
					alert("모든 질문에 응답을 하셔야 합니다.");
					return;
				}
			}
			else
				return;
			
			var frmVote	= document.getElementById("frmVote");
			frmVote.action		= "/controller.php?mode=vote_resp_proc&proc=1";
			frmVote.submit();
			
			return;
		});
	}
	
	/*
	 *	투표 응답 유형에 따른 입력 컨트롤 설정
     */
	var question_indexs		= document.getElementsByName("question_index[]");
	var question_resp_types	= document.getElementsByName("question_resp_type[]");
	for (var i = 0; i < question_indexs.length; i++)
	{
		var questionIndex		= question_indexs[i];
		var questionRespType	= question_resp_types[i];
		var answerTextID		= "answer_textarea_" + questionIndex.value;
		var answerText			= document.getElementById(answerTextID);
		if (answerText == null)
			continue;
					
		if (questionRespType.value == "3" || questionRespType.value == "4" || questionRespType.value == "5")
			answerText.style.display	= "block";
		else
			answerText.style.display	= "none";
			
		answerText.addEventListener("focusin", function(questionIndex, questionRespType)
		{
			if (questionRespType.value == "3")
			{
				if (this.id == document.activeElement.id)
				{
					var answers		= document.getElementsByName("answer_" + questionIndex.value + "[]");
					for (var i = 0; i < answers.length; i++)
						answers[i].checked	= false;
				}
			}
		}.bind(answerText, questionIndex, questionRespType));
		
		answerText.addEventListener("blur", function(questionIndex, questionRespType)
		{
			if (this.id == document.activeElement.id)
			{
				
			}
		}.bind(answerText, questionIndex, questionRespType));
	}

	/*
	 *	자유 응답 등록
	 */	
	var goVoteResults		= document.querySelectorAll(".goVoteResult");
	for (var i = 0; i < goVoteResults.length; i++)
	{
		var goVoteResult	= goVoteResults[i];
		goVoteResult.addEventListener("click", function()
		{
			var query	= core_ajax.instance().makeQuery(null, "vote_seq", null);
			if (!query)
				return false;
				
			core_ajax.instance().send(query, null, "/controller.php?mode=check_resp_vote", function(result)
			{
				if (result == "FALSE" || result == "0")
				{
					alert("설문/투표에 참여를 하셔야 결과를 확인하실 수 있습니다.");
					return;
				}
				
				var voteSeq		= document.getElementById("vote_seq");
				location.href	= "/index.php?mode=vote_view&vote_seq=" + voteSeq.vale; 
				
				return;
			}.bind(replycontext));
			
			return;
		});
	}
	
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
				alert("댓글을 입력하셔야 합니다");
				replycontext.focus();
				return;
			}
			
			var reply_proc		= document.getElementById("reply_proc");
			reply_proc.value	= "register";
			
			frmReply.submit();
		})
	}
	
	/*
	 *	구독 처리
	 */
	var dispuser	= document.getElementById("dispuser");
	dispuser.addEventListener("click", function(dispuser)
	{
		var vote_writer_seq = document.getElementById("vote_writer_seq");
		subscribeVote(vote_writer_seq.value);
		dispuser.style.color = "#1c9cd9";
	}.bind(null, dispuser)); //dispuser
	
	/*
	 *	좋아요 처리
	 */
	var recomm		= document.getElementById("recomm");
	recomm.addEventListener("click", function()
	{
		var query	= core_ajax.instance().makeQuery(null, "vote_seq", null);
		if (!query)
			return false;
			
		core_ajax.instance().send(query, null, "/controller.php?mode=recomm_vote", function(result)
		{
			if (result == "FALSE" || result == "0")
			{
				alert("추천을 처리하는 중에 오류가 발생하였습니다.");
				return;
			}
			
			if (result < 0)
			{
				alert("이미 추천하셨습니다.");
				return;
			}
			
			alert("추천되었습니다."); 
			
			var recomm_count	= document.getElementById("recomm_count");
			recomm_count.value	= result;
			
			var recommButton	= document.getElementById("recomm");
			recommButton.style.color = "#1c9cd9";
			
			return;
		});
		
		return;	
	});
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
			
		core_ajax.instance().send(query, null, "/controller.php?mode=get_subreplylist", function(result)
		{
			if (result == "FALSE" || result == "0")
				return;
				
			result				= JSON.parse(result);
			for (var i = 0; i < result.length; i++)
			{
				var subreplyitem			= subreply.querySelector(".subreplybox");
				subreplyitem.style.display	= "block";
				
				var subreplysample			= subreplyitem.querySelector(".subreplysample");
				var newElement				= subreplysample.cloneNode(true);
				
				var replycontext			= newElement.querySelector(".subreplycontext");
				replycontext.innerText		= result[i].REPLY_CONTEXT;
				
				var replywriterpic			= newElement.querySelector(".subreplywriterpic");
				replywriterpic.src			= result[i].PIC;
				
				var replywriterlink			= newElement.querySelector(".subreplywriterlink");
				replywriterlink.setAttribute("href", "/admin_manager.php?mode=memberinfo&member_seq=" + result[i].REPLY_WRITER_SEQ);	
				
				var replywriter				= newElement.querySelector(".subreplywriter");
				replywriter.innerText		= result[i].NNAME;
				
				var replyregidate			= newElement.querySelector(".subreplyregidate");
				replyregidate.innerText	= result[i].REPLY_REGI_DATE;
				
				var deletesubreply			= newElement.querySelector(".deletesubreply");
				deletesubreply.setAttribute("href", "deleteSubReply('" + result[i].REPLY_SEQ + "')");
				
				subreplyitem.appendChild(newElement);
				newElement.style.display	= "block";
			}
			
			return;
		}.bind(subreply));
	}
	else
		subreply.style.display = "none";
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