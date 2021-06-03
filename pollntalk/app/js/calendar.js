/**
 * @auth   	: JEON JY
 * @date	: 20200705
 * 달력 처리
 */

var cur_calendar	= null;
/*
 *	달력 처리
 */
window.addEventListener("load", function()
{
	//var calendarbox	= document.getElementById("calendarbox");
	var calendarboxs	= document.querySelectorAll(".calendarbox");
	for (var i = 0; i < calendarboxs.length; i++)
	{
		var calendarbox	= calendarboxs[i];
		calendarbox.addEventListener("click", function()
		{
			core_ajax.instance().send(null, null, "/app/view/common/calendar.html", function(result)
			{
				cur_calendar			= this;
				var objpopupareaElement		= document.getElementById("calendarPopup");
				var objpopupboxElement		= document.getElementById("calendarpopupBox");
				var nLeft					= getPosX(this) + 2;
				var nTop					= getPosY(this) + 20;
				
				objpopupboxElement.setAttribute("style", "display:block;position:absolute;top:" + nTop + "px;left:" + nLeft + "px;z-index:1102;background-color:#ffffff;border:1px #1c9cd9 solid;padding:5px 5px 5px 5px;");
				result						= result.replace("\\\"", "'");
				result						= result.replace("\\\n", "");
				result						= result.replace("\\\t", "");
				objpopupboxElement.innerHTML	= result;
				
				//오늘날짜를 구하고
				var objDate					= new Date();
				
				//달력 출력
				var objCalElement			= document.getElementById("cal_data");
				makeCalendar(objCalElement, objDate);
				
				objpopupareaElement.style.display	= "block";
			}.bind(this));
			
			return;
		}.bind(calendarbox));
	}
});

function getEndDay(nYear, nMonth)
{
	var	nEndDay		= 30;
	
	switch (nMonth)
	{
	case 2:
		if (((nYear % 4 == 0) && (nYear % 100 != 0)) || (nYear % 400 == 0))
			nEndDay	= 29;
		else
			nEndDay	= 28;
		break;
	case 4 : case 6 : case 9 : case 11:
		nEndDay		= 30;
		break;
		
	default:
		nEndDay		= 31;
		break;
	}
	
	return nEndDay;
}

function makeTwoNumber(nNumber)
{
	var strResult	= "";
	
	if (nNumber < 10)
		strResult	= "0" + nNumber;
	else
		strResult	= nNumber;
	
	return strResult;
}

function closeCalendarView()
{
	var objpopupareaElement		= document.getElementById("calendarPopup");
	var objCalElement			= document.getElementById("cal_data");
	var objTempElement			= document.getElementById("calendarpopupBox");
	objCalElement.innerHTML		= "";
	//objCalElement.deleteRow();
	objTempElement.style.display		= "none";
	objpopupareaElement.style.display	= "none";
	
	return;
}

function setDateData(strElement, strDate)
{
	//var objElement				= document.querySelector(strElement);
	cur_calendar.value			= strDate;
	closeCalendarView();
	cur_calendar.focus();
	
	return;
}

function goMonth(strMonth)
{
	var objDate					= new Date(strMonth);;
	
	//달력 출력
	var objCalElement			= document.getElementById("cal_data");
	objCalElement.innerHTML		= "";
	
	
	makeCalendar(objCalElement, objDate);
	
	return;
}

function makeCalendar(objCalElement, objDate)
{
	var nYear					= objDate.getFullYear();
	var nMonth					= objDate.getMonth() + 1;
	var strMonth				= makeTwoNumber(nMonth);
	var strCurrentMonthString	= nYear + "년" + nMonth + "월";
	document.getElementById("current_month").innerText	= strCurrentMonthString;
	
	var strPrevMonth			= "";
	var strNextMonth			= "";
	
	//이전 달 구하기
	if (nMonth <= 1)
		strPrevMonth			= (nYear - 1) + "-12-01";
	else
	{
		var	nPrevMonth			= nMonth - 1;
		strPrevMonth			= makeTwoNumber(nPrevMonth);
		strPrevMonth			= nYear + "-" + strPrevMonth + "-01";
	}
	
	var objPrevMonth			= document.getElementById("prev_month");
	objPrevMonth.innerHTML		= "<a href=\"javascript:goMonth('" + strPrevMonth + "')\">◀</a>";
	
	//다음달 구하기
	if (nMonth >= 12)
		strNextMonth			= (nYear + 1) + "-01-01";
	else
	{
		var nNextMonth			= nMonth + 1;
		strNextMonth			= makeTwoNumber(nNextMonth);
		strNextMonth			= nYear + "-" + strNextMonth + "-01";
	}
	
	var objNextMonth			= document.getElementById("next_month");
	objNextMonth.innerHTML		= "<a href=\"javascript:goMonth('" + strNextMonth + "')\">▶</a>";
	
	var strCurDateValue			= nYear + "-" + strMonth;
	
	//시작 날짜를 구한다.
	var strStartDate			= strCurDateValue + "-01";
	var objStartDate			= new Date(strStartDate);
	var nStartWeek				= objStartDate.getDay();
	var nEndDayValue			= getEndDay(nYear, nMonth);
	
	//마지막 날짜를 구한다.
	var strEndDate				= strCurDateValue + "-" + nEndDayValue;
	var objEndDate				= new Date(strEndDate);
	var nEndWeek				= objEndDate.getDay();
	
	//위치를 잡는다.
	var nStartPosition			= nStartWeek + 1;
	var nEndPosition			= nEndWeek + 1;
	
	//달력 출력
	var nCurrentPosition		= 1;
	var nCurrentWeek			= 0;
	var nCurrentDay				= 1;
	var bStartStatus			= true;
	var bEndStatus				= false;
	var bCurrentDisplay			= true;
	var objWeekElement			= null;
	
	while (bCurrentDisplay)
	{
		//한 주의 시작
		if (nCurrentWeek == 0)
		{
			objWeekElement		= document.createElement("tr");
			nCurrentWeek		= 1;
		}
		
		//현재 위치가 해당 달이 아닐 경우
		var objDayElement		= document.createElement("td");
		
		if ((nCurrentPosition < nStartPosition) && (bStartStatus))
			objDayElement.setAttribute("class", "cal_empty");
		else if (bEndStatus)
		{	
			objDayElement.setAttribute("class", "cal_empty");
			nCurrentDay++;
		}
		else
		{
			if (nCurrentPosition == 1)
				objDayElement.setAttribute("class", "cal_sunday");
			else
				objDayElement.setAttribute("class", "cal_date");
			
			
			var strCurrentDate		= strCurDateValue + "-" + makeTwoNumber(nCurrentDay);
			var strCurrentDay		= "<a href=\"javascript:setDateData('.calendarbox', '" + strCurrentDate + "')\">" + nCurrentDay + "</a>"; 
			objDayElement.innerHTML	= strCurrentDay;
			nCurrentDay++;
			bStartStatus		= false;
		}
		
	
		objWeekElement.appendChild(objDayElement);
		nCurrentPosition++;
		
		if (nCurrentPosition > 7)
		{
			nCurrentWeek		= 0;
			objCalElement.appendChild(objWeekElement);
			nCurrentPosition	= 1;
		}
		
		if (nCurrentDay > nEndDayValue)
		{
			bEndStatus				= true;
			var nLimitPosition		= 7;
			
			if (nEndPosition < nLimitPosition)
			{//if (((nCurrentDay > (nEndDayValue + nEndPosition)) && (nEndPosition <= 7)))
				if (nLimitPosition <= nCurrentPosition)
				{
					bCurrentDisplay	= false;
					objCalElement.appendChild(objWeekElement);
				}
			}
			else
				bCurrentDisplay	= false;
		}
	}
	
	return;
}