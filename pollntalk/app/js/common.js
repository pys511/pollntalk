/**
 * @auth   	: JEON JY
 * @date	: 20200705
 * 	공통 기능
 */

/*
 * 	화면 리플레시
 */
function refleshPage()
{
	location.reload();
}
/*
 * 	팝업 종료
 */
function closePopup()
{
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element != null)
		popupBox.removeChild(element);
	
	var joinPopup	= document.getElementById("popup");
	joinPopup.style.display	= "none"	
}
/*
 *	로그인 레이어 팝업
 */
function goLogin()
{	
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "380px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=login";
		popupBox.appendChild(element);
	}
}
/*
 *	회원가입 레이어 팝업
 */
function goSignup()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "800px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=sign_up";
		popupBox.appendChild(element);
	}
}

/*
 *	회원가입 완료 팝업
 */
function goSignupEnd()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "300px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=sign_up_end";
		popupBox.appendChild(element);
	}
}
/*
 *	회원정보수정 레이어 팝업
 */
function goModification()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "655px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=modification";
		popupBox.appendChild(element);
	}
}
/*
 *	대표사진업로드 레이어 팝업
 */
function goFileUp()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "300px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=file_up";
		popupBox.appendChild(element);
	}
}

/*
 *	대표사진업로드 레이어 팝업
 */
function goFindPass()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "100%";
		element.style.height	= "300px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/popup.php?mode=find_pass";
		popupBox.appendChild(element);
	}
}

function goCert()
{
	closePopup();
	
	var popup	= document.getElementById("popup");
	popup.style.display	= "block";
	
	var popupBox	= document.getElementById("popupBox");
	var element		= document.getElementById("popup_frame");
	if (element == null)
	{
		element					= document.createElement("iframe");
		element.id				= "popup_frame";
		element.style.cssFloat	= "left";
		element.style.width		= "610px";
		element.style.height	= "210px";
		element.style.border	= "0px";
		element.frameborder		= "0";
		element.src				= "/kcpcert/WEB_ENC/kcpcert_start.php";
		popupBox.appendChild(element);
	}
}

/*
 *	구독 처리
 */
function subscribeVote(memberSeq)
{
	var subscribeMemberSeq		= document.getElementById("subscribe_member_seq");
	subscribeMemberSeq.value	= memberSeq;
	var query					= core_ajax.instance().makeQuery(frmSubscribe, "");
	if (!query)
		return;
		
	core_ajax.instance().send(query, null, "/controller.php?mode=subscribe_proc", function(result)
	{
		if (result == "-1")
			return;
		
		if (result != "TRUE")
		{
			alert("구독 신청을 하는 중에 오류가 발생하였습니다.");
			return;
		}
		
		alert("구독 신청되었습니다.");
		return;
	});
}

/*
 *	메시지 전송
 */
function sendMessage(memberSeq, memberName, nTop)
{
	var popupmenubox	= document.getElementById("popupmenubox");
	popupmenubox.style.display	= "none";
			
	var messagebox				= document.getElementById("messagebox");
	messagebox.style.display	= "block";
	messagebox.style.top		= nTop + "px";
	
	var recvMemberSeq		= document.getElementById("recv_member_seq");
	recvMemberSeq.value		= memberSeq;
	
	var sendername			= document.getElementById("sendername");
	sendername.innerText	= "받는 이 : " + memberName;
	
	return;
}

/*
 *	메시지 박스 닫기
 */
function closeMessage()
{
	var messagecontext			= document.getElementById("messagecontext");
	messagecontext.value		= "";
		
	var messagebox				= document.getElementById("messagebox");
	messagebox.style.display	= "none";
	
	return;
}

/*
 *	보안코드 입력 박스 닫기
 */
function closeSecurebox()
{
	var securecode			= document.getElementById("securecode");
	securecode.value		= "";
		
	var securebox				= document.getElementById("securebox");
	securebox.style.display	= "none";
	
	return;
}

/*
 *	원화 표시
 */
function numberWithCommas(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/*
 *	검색 키워드 입력란에 표시
 */
function setSearchKeyword(keyword)
{
	var search		= document.getElementById("search");
	search.value	= keyword;
}

/*
 *	키워드 검색
 */
function searchKeyword()
{
	var search	= document.getElementById("search");
	if (search.value == "")
	{
		alert("검색어를 입력하셔야 합니다.");
		return;
	}
	
	var frmSearch	= document.getElementById("frmSearch");
	frmSearch.submit();
	
	return;
}

/*
 *	클립보드에 복사
 */
function copyClipboard(elementName) 
{
	var isHidden	= false;
	var element		= document.getElementById(elementName);	
	if (element.type == "hidden")
	{
		element.type = "text";
		isHidden	= true;
	}
	element.select();
	document.execCommand("copy");
	
	if (isHidden)
		element.type = "hidden";
	
	alert("복사되었습니다.");
	
	return;
}

/*
 *	투표 바로가기
 */
function goVote(elemName, voteSeq, isOpen)
{
	if (isOpen == "1")
	{
		var frmSecureCheck	= document.getElementById("frmSecureCheck");
		var secureVoteSeq	= document.getElementById("secure_vote_seq");
		secureVoteSeq.value	= voteSeq;
		var query			= core_ajax.instance().makeQuery(frmSecureCheck, "secure_vote_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/controller.php?mode=check_is_open", function(result)
		{
			if (result == "1")
			{
				var securebox	= document.getElementById("securebox");
				securebox.style.display	= "block";
				
				var element		= document.getElementById(elemName);				
				var nTop		= getPosY(element) + 25;
				securebox.style.top	= nTop + "px";
				
				var securecode	= document.getElementById("checksecurecode");	
				securecode.addEventListener("click", function()
				{
					var query			= core_ajax.instance().makeQuery(frmSecureCheck, "", null);
					if (!query)
						return false;
			
					core_ajax.instance().send(query, null, "/controller.php?mode=check_secure_code", function(result)
					{
						if (result == "FALSE")
						{
							alert("보안코드를 잘못입력하였습니다. 다시 시도하시기 바랍니다.");
							return;
						}
						else
							location.href = "/?mode=voteview&vote_seq=" + voteSeq;
					});
				});
			}
			else
				location.href = "/?mode=voteview&vote_seq=" + voteSeq;
		});
		
		return;
	}
	else
		location.href = "/?mode=voteview&vote_seq=" + voteSeq;
}

/*
 * 	페이지 공통 기능 처리
 */
window.addEventListener("load", function()
{
	
	$(document).keydown(function(event) {
    if ( event.keyCode == 27 || event.which == 27 ) {
			closePopup();
    	}
	});
	
	//로그인
	var login			= document.getElementById("login");
	if (login != null)
	{
		login.addEventListener("click", function()
		{
			goLogin();
		});
	}
	
	//회원가입
	var join			= document.getElementById("join");
	if (join != null)
	{
		join.addEventListener("click", function()
		{
			goSignup();
		});
	}
	
	var mlogin			= document.getElementById("mlogin");
	if (mlogin != null)
	{
		mlogin.addEventListener("click", function(login)
		{
			login.click();
		}.bind(this, login));
	}
	
	//logout
	var loginout		= document.getElementById("loginout");
	if (loginout != null)
	{
		loginout.addEventListener("click", function()
		{
			var result = window.confirm("로그아웃 하시겠습니까?");
			if (result)
				location.href	= "/logout.php";
		});
	}
	
	//회원정보 수정
	var modification			= document.getElementById("modification");
	if (modification != null)
	{
		modification.addEventListener("click", function()
		{
			goModification();
		});
	}
	

	/*var cert			= document.getElementById("cert");
	if (cert != null)
	{
		cert.addEventListener("click", function()
		{
			//goCert();
			location.href = "/kcpcert/WEB_ENC/kcpcert_start.php";
		});
	}*/
	
	//대표사진업로드
	var fileUp			= document.getElementById("file_up");
	if (fileUp != null)
	{
		fileUp.addEventListener("click", function()
		{
			goFileUp();
		});
	}
	
	var mjoin			= document.getElementById("mjoin");
	if (mjoin != null)
	{
		mjoin.addEventListener("click", function()
		{
			join.click();
		}.bind(this, join));
	}
	
	//모바일
	//검색창 선택시
	var search			= document.getElementById("search");
	search.addEventListener("focus", function()
	{
		var nWidth		= window.screen.width;
		if (nWidth <= 800)
		{
			var msearchbox				= document.getElementById("mobilesearchbox");
			msearchbox.style.display	= "block";
		}	
	});
	
	var closesearch		= document.getElementById("closesearch");
	closesearch.addEventListener("click", function()
	{
		mobilesearchbox.style.display	= "none";
	});
	
	//모바일
	//메뉴 버튼
	var mmenubutton		= document.getElementById("mobilemenubutton");
	mmenubutton.addEventListener("click", function()
	{
		if (mobilemenubox.style.display == "none")
			mobilemenubox.style.display	= "block";
		else
			mobilemenubox.style.display	= "none";
	});
	
	var mmenuclose		= document.getElementById("mmenuclose");
	mmenuclose.addEventListener("click", function()
	{
		mobilemenubox.style.display	= "none";
	});
	
	//팝업 메뉴
	var votedispusers	= document.querySelectorAll(".votedispuser");
	for (var i = 0; i < votedispusers.length; i++)
	{
		dispuser		= votedispusers[i];
		dispuser.addEventListener("click", function(dispuser)
		{
			var member_seq		= document.getElementById("member_seq");
			if (member_seq.value == "")
				return;
			
			var nLeft			= getPosX(dispuser) + 55;
			var nTop			= getPosY(dispuser) + 25;
			var popupmenubox	= document.getElementById("popupmenubox");
			var display			= "display:none;";
			
			if (popupmenubox.style.display == "none")
				display			= "display:block;";
				
			popupmenubox.setAttribute("style", display + "top:" + nTop + "px;left:" + nLeft + "px;z-index:1102;");
			
			var memberSeq		= dispuser.dataset.member;
			var memberName		= dispuser.dataset.name;
			var subscribe		= document.getElementById("subscribe");
			subscribe.addEventListener("click", subscribeVote.bind(null, memberSeq));
			
			var messageLink		= document.getElementById("messageLink");
			messageLink.addEventListener("click", sendMessage.bind(null, memberSeq, memberName, nTop));
			
		}.bind(null, dispuser)); //dispuser
	}
	
	//쪽지 전송
	var messageButton		= document.getElementById("messagebutton");
	messageButton.addEventListener("click", function()
	{
		var messageContext	= document.getElementById("messagecontext");
		if (messageContext.value == "")
		{
			alert("메시지를 작성하셔야 합니다.");
			messageContext.focus();
			return;
		}
		
		var frmMessage	= document.getElementById("frmMessage");
		var query		= core_ajax.instance().makeQuery(frmMessage, "");
		if (!query)
			return;
		
		core_ajax.instance().send(query, null, "/controller.php?mode=message_proc", function(result)
		{
			closeMessage();
			if (result != "TRUE")
			{
				alert("상대에게 메시지를 보낼 수 없습니다.");
				return;
			}
			
			alert("전송되었습니다.");
			return;
		});
	});
	
	//쪽지창 닫기
	var messageclose	= document.getElementById("messageclose");
	messageclose.addEventListener("click", function()
	{
		closeMessage();
	});
	
	//보안코드 닫기
	var secureboxclose	= document.getElementById("secureboxclose");
	secureboxclose.addEventListener("click", function()
	{
		closeSecurebox();
	});
	
	//검색 처리
	var goSearch		= document.getElementById("goSearch");
	goSearch.addEventListener("click", function()
	{
		searchKeyword();
	});
	
	var goSearch		= document.getElementById("search");
	goSearch.addEventListener("keypress", function()
	{
		if (window.event.keyCode == 13)
			searchKeyword();
	});
	
	var alertbutton		= document.getElementById("alertbutton");
	alertbutton.addEventListener("click", function()
	{
		var alertarea	= document.getElementById("alertarea");
		if (alertarea.style.display == "none")
			alertarea.style.display	= "block";
		else 
			alertarea.style.display	= "none";
			
		return;
	});
	
	var altTime	= setInterval(function()
	{
		var query	= core_ajax.instance().send("", null, "/controller.php?mode=get_alert", function(result)
		{
			result	= JSON.parse(result);
				
			var alertImage		= document.getElementById("alertimage");
			var alertmessage	= document.getElementById("alertmessage");
			var alertlink		= document.getElementById("alertlink");
			var messageText 	= result.MESSAGE;
			var linkUrl			= "";
			
			if (result.ALERT_KIND == "1")
			{
				alertImage.src	= "/app/images/alert.png";
				linkUrl			= "/?mode=boardView&sub=notice&num=" + result.SEQ;
			}
			else 
			{
				alertImage.src	= "/app/images/message.png";
				messageText		+= " [" + result.SENDER + "]"; 
				linkUrl			= "/?mode=mypage&sub=message";
			}
				
			alertmessage.innerText	= messageText;
			alertlink.href			= linkUrl;
			
			var alertMessageSeq	= document.getElementById("alert_message_seq");
			var alertarea		= document.getElementById("alertarea");
			if (alertMessageSeq.value == "" || alertMessageSeq.value != result.SEQ)
			{
				if (alertarea.style.display == "none" || alertarea.style.display == "")
					alertarea.style.display	= "block";
					
				alertMessageSeq.value = result.SEQ;
			}
			else
			{
				if (alertarea.style.display != "none" && alertarea.style.display != "")
					alertarea.style.display	= "none";
			}
		});
		
		return;
	}, 5000);
	
	return;
});

/*비로그인시 로그인 화면 띄우는 함수*/

function callLogin()
{
	var result = window.confirm("로그인 후 이용해 주세요");
	if (result)
		goLogin();
}