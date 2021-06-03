/**
 *	@auth   : JEON JY
 *	@date	: 20200903
 *	설문 조사 결과
 */
var renderChart = function(query, vote_seq, questionIndex)
{
	core_ajax.instance().send(query, null, "/controller.php?mode=get_vote_resp&vote_seq=" + vote_seq.value, function(result)
	{
		if (result == "FALSE")
		{
			alert("잘못된 데이터를 조회하였습니다. 관리자에게 문의하시기 바랍니다.");
			return;
		}
		
		var dataPoints	= [];
		var datalist	= JSON.parse(result);
		var view_type 	= document.getElementById("view_type");
		if (view_type.value == "") 
		{
			for (var index in datalist)
			{
				var item		= datalist[index];
				var dataitem	= [];
				dataitem.y 		= parseInt(item.ANSWERS_COUNT);
				dataitem.label 	= item.ANSWER_TEXT;
				dataPoints.push(dataitem);
			}
			
			var chart1 = new CanvasJS.Chart("chart_bar_" + questionIndex.value, 
			{
				animationEnabled: true,
				theme: "light1", // "light1", "light2", "dark1", "dark2",
				data: [{        
					type: "column",  
					legendMarkerColor: "grey",
					//legendText: "폴앤톡 투표 바차트",
					dataPoints
				}]
			});
			
			chart1.render();
			
			var chart2 = new CanvasJS.Chart("chart_pie_" + questionIndex.value, 
			{
				animationEnabled: true,
				data: [{
					type: "pie",
					startAngle: 240,
					yValueFormatString: "##0.00\"%\"",
					indexLabel: "{label} {y}",
					legendText: "폴앤톡 투표 파이차트",
					dataPoints
				}]
			});
			
			chart2.render();
		}
		else if (view_type.value != "")
		{
			var datas	= {};
			datas.animationEnabled	= true;
			datas.theme				= "light2";
			datas.axisY				= {};
			datas.axisY.interval	= 10;
			datas.axisY.suffix		= "%";
			datas.toolTip			= {};
			datas.toolTip.shared	= true;
			datas.data				= [];
			
			var dataItem		= null;
			var dataItems		= null;
			var key				= "";
			for (var index in datalist)
			{
				var item		= datalist[index];
				if (key != item.VAL_KEY)
				{
					if (dataItems != null)
						datas.data.push(dataItem);
						
					dataItem		= {};
					dataItem.name	= item.VAL_KEY;
					key				= item.VAL_KEY;
					dataItem.type	= "stackedBar100";
					dataItem.toolTipContent	= "{label}<br><b>{name}:</b> {y} (#percent%)";
					dataItem.showInLegend	= true;
					dataItem.dataPoints		= [];
				}
				
				dataItems		= {};
				dataItems.y 	= parseInt(item.ANSWERS_COUNT);
				dataItems.label	= item.ANSWER_TEXT;
				
				dataItem.dataPoints.push(dataItems);
			}
			
			datas.data.push(dataItem);
			
			var chart = new CanvasJS.Chart("chart_" + questionIndex.value, datas);
			//var chart = new CanvasJS.Chart("chart_" + questionIndex.value, dataTemps);
			
			chart.render();
		}
	});
}

window.addEventListener("load", function()
{
	var query		= location.search;
	if (query.indexOf("replyresult=REPLY_TRUE") >= 0)
	{
		var replylist	= document.getElementById("replylist");
		window.scrollTo(0, replylist.offsetTop);
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
	
	var vote_type		= document.getElementById("vote_type");
	var view_type		= document.getElementById("view_type");
	if (vote_type.value != "4")
	{
		var vote_seq		= document.getElementById("vote_seq");
		var question_seqs	= document.getElementsByName("question_seq[]");
		var question_indexs	= document.getElementsByName("question_index[]");
		for (var i = 0; i < question_seqs.length; i++)
		{
			var questionSeq		= question_seqs[i];
			var questionIndex	= question_indexs[i];
			var id				= questionSeq.id;
			var query			= core_ajax.instance().makeQuery(frmVote, null, null);
			
			setTimeout(renderChart.bind(null, query, vote_seq, questionIndex), i * 1000);
		}
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