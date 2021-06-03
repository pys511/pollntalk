/**
 * @auth   	: JEON JY
 * @date	: 20201003
 * 설문 처리
 */
var questions			= new Set();
var answers				= new Map();

var windowUpPostions		= new Map();
var windowDownPostions		= new Map();
var mobileUpPostions		= new Map();
var mobileDownPostions		= new Map();
var questionFileUploads		= new Map();
var answerFileUploads		= new Map();
var questionDeletes			= new Map();
var mobilePluses			= new Map();
var windowPluses			= new Map();
var mobileMinuses			= new Map();
var windowMinuses			= new Map(); 
var answerCorrects			= new Map();
var questionResourceViews	= new Map();
var answerResourceViews		= new Map();
var questionResourceTypes	= new Map();
var answerResourceTypes		= new Map();
var questionAnswerKinds		= new Map();

//업로드된 관련 파일 받기
var setFile = function(fileData)
{
	var real_path		= document.getElementById("real_path");
	real_path.value		= fileData.real_name;
	
	var event_file		= document.getElementById("event_file");
	event_file.value	= fileData.file_name;
	
	return;
}

//업로드된 투표 이미지 파일 받기
var setVoteFile	= function(fileData, question_index = undefined, answer_index = undefined)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var imgName		= "imageFile";
	var tempPath	= "temp_path";
	var realName	= "real_name";
	if (question_index != undefined && question_index != null && question_index != "" && (answer_index == null || answer_index == undefined || answer_index == ""))
	{
		imgName		= "question_" + imgName + "_" + question_index;
		tempPath	= "question_" + tempPath + "_" + question_index;
		realName	= "question_" + realName + "_" + question_index;
 	}

	if (answer_index != undefined && answer_index != null && answer_index != "")
	{
		imgName		= "answer_" + imgName + "_" + question_index + "_" + answer_index;
		tempPath	= "answer_" + tempPath + "_" + question_index + "_" + answer_index;
		realName	= "answer_" + realName + "_" + question_index + "_" + answer_index;
	}
	
	var imageFile	= document.getElementById(imgName);
	imageFile.setAttribute("src", fileData.real_name);
	
	var temp_path	= document.getElementById(tempPath);
	var real_name	= document.getElementById(realName);
	
	temp_path.setAttribute("value", fileData.temp_path);
	real_name.setAttribute("value", fileData.real_name);
	
	return;
}

//답변 삭제
function removeAnswer(questionIndex, answerIndex)
{
	var answer_lst_item		= document.getElementById("answer_lst_item_" + questionIndex + "_" + answerIndex);
	var answer_lst		= document.getElementById("answer_lst_" + questionIndex);
	answer_lst.removeChild(answer_lst_item);
	initQuestion();
	
	return;
}

//이미지/동영상 처리
var doResourceView = function(realName, tempName, resourceTypeId, imageControlId, videoControlId, resourceUrlId)
{
	var voteResourceType	= document.getElementById(resourceTypeId);
	var voteResourceUrl		= document.getElementById(resourceUrlId);
	var control 			= null;
	if (voteResourceType.value == "2")
	{
		control				= document.getElementById(imageControlId);
		control.src			= voteResourceUrl.value;
	}
	else if (voteResourceType.value == "3")
	{
		control				= document.getElementById(videoControlId);
		var videoUrl		= voteResourceUrl.value;
		var videoUrls		= videoUrl.split("/");
		var videoLast		= videoUrls[videoUrls.length - 1];
		videoUrl			= "https://www.youtube.com/embed/" + videoLast;	
		control.src			= videoUrl;
	}
	
	var voteRealFileName	= document.getElementById(realName);
	var voteTempFilePath	= document.getElementById(tempName);
	
	voteRealFileName.value	= voteResourceUrl.value;
	voteTempFilePath.value	= voteResourceUrl.value;
	
	return;
}

//이미지/동영상 보기 처리
var doResourceType = function(resourceType, resourceUrl, resourceView, imageFile, videoFile, resourceVal, fileuploadId)
{
	var resource_url	= document.getElementById(resourceUrl);
	if (resource_url != null)
		resource_url.style.display	= "none";
		
	var resource_view	= document.getElementById(resourceView);
	if (resource_view != null)
		resource_view.style.display	= "none";
		
	var resource_type 	= document.getElementById(resourceType);
	var image_File		= document.getElementById(imageFile);
	var video_File		= document.getElementById(videoFile);
	var fileupload		= null;
	if (fileuploadId != "" && fileuploadId != undefined && fileuploadId != null)
		fileupload		= document.getElementById(fileuploadId);
		
	if (resource_type.checked)
	{
		var typeVal					= resource_type.value;
		var voteResourceType		= document.getElementById(resourceVal);
		voteResourceType.value		= typeVal;
		switch(typeVal)
		{
			case "2":
				resource_url.style.display		= "block";
				resource_url.value				= "";
				resource_view.style.display		= "block";
				image_File.style.display		= "block";
				video_File.style.display		= "none";
				video_File.style.visibility		= "hidden";
				if (fileupload != null)				
					fileupload.style.display	= "none";
				break;
				
			case "3":
				resource_url.style.display		= "block";
				resource_url.value				= "";
				resource_view.style.display		= "block";
				image_File.style.display		= "none";
				video_File.style.display		= "block";
				video_File.style.visibility		= "visible";
				if (fileupload != null)	
					fileupload.style.display	= "none";
				break;
				
			case "1":
				image_File.style.display		= "block";
				video_File.style.display		= "none";
				video_File.style.visibility		= "hidden";
				if (fileupload != null)	
					fileupload.style.display	= "block";
				break;
				
			default:
				image_File.style.display		= "none";
				video_File.style.display		= "none";
				video_File.style.visibility		= "hidden";
				if (fileupload != null)	
					fileupload.style.display	= "none";
				break;
		}
	}
	
	return;
}

//질문 이미지 처리
var questionFileUpload = function(questionIndex)
{
	var question_upload_index	= document.getElementById("question_upload_index");
	question_upload_index.value	= questionIndex;
	var answwer_upload_index	= document.getElementById("answer_upload_index");
	answwer_upload_index.value	= "";
	var uploadName				= document.getElementById("uploadName");
	uploadName.click();
	return;
}

//응답 이미지 처리
var answerFileUpload = function(questionIndex, answerIndex)
{
	var question_upload_index	= document.getElementById("question_upload_index");
	question_upload_index.value	= questionIndex;
	var answwer_upload_index	= document.getElementById("answer_upload_index");
	answwer_upload_index.value	= answerIndex;
	var uploadName				= document.getElementById("uploadName");
	uploadName.click();
	return;
}

/*
 *	질문 위치 
 */
var questionUpPostion = function(index)
{
	var question_lst	= document.getElementById("question_lst");
	var currentElement	= document.getElementById("question_lst_item_" + index);
	var tempElement		= currentElement;
	while((previousSibling = tempElement.previousSibling) != null)
	{
		if (previousSibling.nodeType != Node.ELEMENT_NODE)
		{
			tempElement	= previousSibling;
			continue;
		}
		
		var className		= previousSibling.getAttribute("class");
		if (className.indexOf("newWriteItem") < 0)
		{
			alert("더 이상 이동할 수 없습니다.");
			return;
		}
			
		question_lst.insertBefore(currentElement, previousSibling);
		initQuestion();
		
		break;
	}
	
	return;
}

/*
 *	질문 위치 아래로 이동
 */
var questionDownPostion = function(index)
{
	var question_lst	= document.getElementById("question_lst");
	var currentElement	= document.getElementById("question_lst_item_" + index);
	var isNext			= false;
	while((nextSibling = currentElement.nextSibling) != null)
	{
		if (nextSibling.nodeType != Node.ELEMENT_NODE)
		{
			currentElement	= nextSibling;
			continue;
		}
		
		var className		= nextSibling.getAttribute("class");
		if (className.indexOf("newWriteItem") < 0)
		{
			alert("더 이상 이동할 수 없습니다.");
			return;
		}
			
		question_lst.insertBefore(nextSibling, currentElement);
		initQuestion();
		isNext	= true;		
		break;
	}
	
	if (!isNext)
	{
		alert("더 이상 이동할 수 없습니다.");
		return;
	}
	
	return;
}

/*
 *	질문 삭제
 */
var questionDelete	= function(index)
{
	var question_lst_item	= document.getElementById("question_lst_item_" + index);
	var question_lst		= document.getElementById("question_lst");
	question_lst.removeChild(question_lst_item);
	
	initQuestion();
}

/*
 *	응답 유형 설정
 */
var doQuestionAnswerKind = function(element)
{
	var kind	= this.options[this.selectedIndex].value;
	switch(kind)
	{
		case "1":
		case "2":
		case "3":
		case "4":
			element.style.display	= "block";
			break;
		case "5":
			element.style.display	= "none";
			break;
		default:
			element.style.display	= "block";
			break;
	}
	
	return;
}

/*
 * 	질문 초기화
 * 	데이터가 있을 경우 컨트롤 setting
 */
function initQuestion()
{
	var questionItems		= document.querySelectorAll(".newWriteItem");
	
	//질문 이미지 처리 일괄 제거
	for (let [key, value] of questionFileUploads)
		key.removeEventListener("click", value, false);
	questionFileUploads.clear();
	
	//응답 이미지 처리 일괄 제거
	for (let [key, value] of answerFileUploads)
		key.removeEventListener("click", value, false);
	answerFileUploads.clear();
	
	//윈도우 up 이벤트 일괄 제거
	for (let [key, value] of windowUpPostions) 
		key.removeEventListener("click", value, false);
	windowUpPostions.clear();
	
	//윈도우 down 이벤트 일괄 제거
	for (let [key, value] of windowDownPostions) 
		key.removeEventListener("click", value, false);
	windowDownPostions.clear();
	
	//모바일 up 이벤트 일괄 제거
	for (let [key, value] of mobileUpPostions) 
		key.removeEventListener("click", value, false);
	mobileUpPostions.clear();
	
	//모바일 down 이벤트 일괄 제거
	for (let [key, value] of mobileDownPostions) 
		key.removeEventListener("click", value, false);
	mobileDownPostions.clear();
	
	//질문 삭제 이벤트 일괄 제거
	for (let [key, value] of questionDeletes)
		key.removeEventListener("click", value, false);
	questionDeletes.clear();
	
	//모바일 응답 추가 이벤트 일괄 제거
	for (let [key, value] of mobilePluses)
		key.removeEventListener("click", value, false);
	mobilePluses.clear();
	
	//모바일 응답 삭제 이벤트 일괄 제거
	for (let [key, value] of mobileMinuses)
		key.removeEventListener("click", value, false);
	mobileMinuses.clear();
	
	//윈도우 응답 추가 이벤트 일괄 제거
	for (let [key, value] of windowPluses)
		key.removeEventListener("click", value, false);
	windowPluses.clear();
	
	//윈도우 응답 삭제 이벤트 일괄 제거
	for (let [key, value] of windowMinuses)
		key.removeEventListener("click", value, false);
	windowMinuses.clear();
	
	//정답 체크 이벤트 일괄 제거
	for (let [key, value] of answerCorrects)
		key.removeEventListener("click", value, false);
	answerCorrects.clear();
	
	//응답 종류 선택 버튼 이벤트 일괄 제거
	for (let [key, value] of questionAnswerKinds)
		key.removeEventListener("click", value, false);
	questionAnswerKinds.clear();
	
	//컨트롤 설정
	for (var i = 0; i < questionItems.length; i++)
	{
		var newQuestionList			= questionItems[i];
		var question_index			= newQuestionList.querySelector(".question_index");
		var index					= question_index.value;
		if (index == "")
		{
			var index	= 1;
			while (questions.has(index))
				index++;
			
			question_index.value	= index;
		}
		
		index	= parseInt(index);
		question_index.setAttribute("id", "question_index_" + index);
		question_index.setAttribute("name", "question_index[]");
		
		newQuestionList.setAttribute("id", "question_lst_item_" + index);
		
		//질문 sequence
		var question_seq			= newQuestionList.querySelector(".question_seq");
		question_seq.setAttribute("id", "question_seq_" + index);
		question_seq.setAttribute("name", "question_seq[]");
		
		//질문 순서
		var question_order			= newQuestionList.querySelector(".question_order");
		question_order.setAttribute("id", "question_order_" + index);
		question_order.setAttribute("name", "question_order[]");
		question_order.setAttribute("value", i);
		
		//질문 항목 표시
		var question_field			= newQuestionList.querySelector(".question_field");
		question_field.innerText	= "질문" + (i + 1);
		
		//질문 글
		var question_subject		= newQuestionList.querySelector(".question_subject");
		question_subject.setAttribute("id", "question_subject_" + index);
		question_subject.setAttribute("name", "question_subject[]");
		
		//질문 이미지
		var question_imageFile		= newQuestionList.querySelector(".imageFile");
		question_imageFile.setAttribute("id", "question_imageFile_" + index);
		
		//이미지/동영상 입력 선택
		var question_resource_type_00	= newQuestionList.querySelector(".question_resource_type_00");
		question_resource_type_00.setAttribute("id", "question_resource_type_00_" + index);
		question_resource_type_00.setAttribute("name", "question_resource_type_" + index + "[]");
		
		var question_resource_label_00	= newQuestionList.querySelector(".question_resource_label_00");
		question_resource_label_00.setAttribute("for", "question_resource_type_00_" + index);
		
		var question_resource_type_01	= newQuestionList.querySelector(".question_resource_type_01");
		question_resource_type_01.setAttribute("id", "question_resource_type_01_" + index);
		question_resource_type_01.setAttribute("name", "question_resource_type_" + index + "[]");
		
		var question_resource_label_01	= newQuestionList.querySelector(".question_resource_label_01");
		question_resource_label_01.setAttribute("for", "question_resource_type_01_" + index);
		
		var question_resource_type_02	= newQuestionList.querySelector(".question_resource_type_02");
		question_resource_type_02.setAttribute("id", "question_resource_type_02_" + index);
		question_resource_type_02.setAttribute("name", "question_resource_type_" + index + "[]");
		
		var question_resource_label_02	= newQuestionList.querySelector(".question_resource_label_02");
		question_resource_label_02.setAttribute("for", "question_resource_type_02_" + index);
		
		var question_resource_type_03	= newQuestionList.querySelector(".question_resource_type_03");
		question_resource_type_03.setAttribute("id", "question_resource_type_03_" + index);
		question_resource_type_03.setAttribute("name", "question_resource_type_" + index + "[]");
		
		var question_resource_label_03	= newQuestionList.querySelector(".question_resource_label_03");
		question_resource_label_03.setAttribute("for", "question_resource_type_03_" + index);
		
		//이미지/동영상 입력 처리
		var question_VideoFile			= newQuestionList.querySelector(".question_VideoFile");
		question_VideoFile.setAttribute("id", "question_VideoFile_" + index);
		question_VideoFile.setAttribute("name", "question_VideoFile[]");
		
		//이미지/동영상 리소스 입력 처리
		var vote_question_resource_type	= newQuestionList.querySelector(".vote_question_resource_type");
		vote_question_resource_type.setAttribute("id", "vote_question_resource_type_" + index);
		vote_question_resource_type.setAttribute("name", "vote_question_resource_type[]");
		
		//이미지/동영상 입력 선택 checked
		var questionResourceType		= vote_question_resource_type.value;
		switch (questionResourceType)
		{
			case "0":
				question_resource_type_00.checked	= true;
				break;
			
			case "1":
				question_resource_type_01.checked	= true;
				break;
				
			case "2":
				question_resource_type_02.checked	= true;
				break;
				
			case "3":
				question_resource_type_03.checked	= true;
				break;
				
			default:
				question_resource_type_01.checked	= true;
				break;
		}
		
		//이미지/동영상 url 입력 처리
		var vote_question_resource_url	= newQuestionList.querySelector(".vote_question_resource_url");
		vote_question_resource_url.setAttribute("id", "vote_question_resource_url_" + index);
		vote_question_resource_url.setAttribute("name", "vote_question_resource_url[]");
		
		//이미지/동영상 확인 버튼
		var question_resource_view	= newQuestionList.querySelector(".question_resource_view");
		question_resource_view.setAttribute("id", "question_resource_view_" + index);
		question_resource_view.setAttribute("name", "question_resource_view[]");
		var resourceViewFunc		= doResourceView.bind(null, "question_real_name_" + index, "question_temp_path_" + index, "vote_question_resource_type_" + index, "question_imageFile_" + index, "question_VideoFile_" + index, "vote_question_resource_url_" + index);
		question_resource_view.addEventListener("click", resourceViewFunc);
		questionResourceViews.set(question_resource_view, resourceViewFunc);
		
		//이미지 버튼 처리
		var fileupload				= newQuestionList.querySelector(".fileupload");
		fileupload.setAttribute("id", "fileupload_" + index);
		fileupload.setAttribute("name", "fileupload[]");
		var fileuploadFunc			= questionFileUpload.bind(null, question_index.value);
		fileupload.addEventListener("click", fileuploadFunc, false);
		questionFileUploads.set(fileupload, fileuploadFunc);
		
		//이미지 버튼이 처음에는 안보이도록
		var questionResourceType		= document.getElementsByName("question_resource_type_" + index + "[]");
		for (var j = 0; j < questionResourceType.length; j++)
		{
			var questionResourceItem	= questionResourceType[j];
			if (questionResourceItem.value == "0" && questionResourceItem.checked)
			{
				fileupload.style.display			= "none";
				question_imageFile.style.display	= "none";

				break;
			}
		}
		
		//이미지/동영상 선택 버튼
		var questionResourceType00Func	= doResourceType.bind(null, question_resource_type_00.id, vote_question_resource_url.id, question_resource_view.id, question_imageFile.id, question_VideoFile.id, vote_question_resource_type.id, fileupload.id);
		question_resource_type_00.addEventListener("click", questionResourceType00Func);
		questionResourceTypes.set(question_resource_type_00, questionResourceType00Func);
		
		var questionResourceType01Func	= doResourceType.bind(null, question_resource_type_01.id, vote_question_resource_url.id, question_resource_view.id, question_imageFile.id, question_VideoFile.id, vote_question_resource_type.id, fileupload.id);
		question_resource_type_01.addEventListener("click", questionResourceType01Func);
		questionResourceTypes.set(question_resource_type_01, questionResourceType01Func);
		
		var questionResourceType02Func	= doResourceType.bind(null, question_resource_type_02.id, vote_question_resource_url.id, question_resource_view.id, question_imageFile.id, question_VideoFile.id, vote_question_resource_type.id, fileupload.id);
		question_resource_type_02.addEventListener("click", questionResourceType02Func);
		questionResourceTypes.set(question_resource_type_02, questionResourceType02Func);
		
		var questionResourceType03Func	= doResourceType.bind(null, question_resource_type_03.id, vote_question_resource_url.id, question_resource_view.id, question_imageFile.id, question_VideoFile.id, vote_question_resource_type.id, fileupload.id);
		question_resource_type_03.addEventListener("click", questionResourceType03Func);
		questionResourceTypes.set(question_resource_type_03, questionResourceType03Func);
		
		//이미지 정보 저장
		var question_temp_path		= newQuestionList.querySelector(".question_temp_path");
		question_temp_path.setAttribute("id", "question_temp_path_" + index);
		question_temp_path.setAttribute("name", "question_temp_path[]");
		var question_real_name		= newQuestionList.querySelector(".question_real_name");
		question_real_name.setAttribute("id", "question_real_name_" + index);
		question_real_name.setAttribute("name", "question_real_name[]");
	
		//응답 종류
		var question_answer_kind	= newQuestionList.querySelector(".question_answer_kind");
		question_answer_kind.setAttribute("id", "question_answer_kind_" + index);
		question_answer_kind.setAttribute("name", "question_answer_kind[]");
		
		//응답 영역
		var answer_lst				= newQuestionList.querySelector(".answer_lst");
		answer_lst.setAttribute("id", "answer_lst_" + index);
		answer_lst.setAttribute("name", "answer_lst[]");
		
		//응답 종류 선택 처리
		var questionAnswerKindFunc		= doQuestionAnswerKind.bind(question_answer_kind, answer_lst);	
		question_answer_kind.addEventListener("change", questionAnswerKindFunc);
		questionAnswerKinds.set(question_answer_kind, questionAnswerKindFunc);
		
		//index 저장
		questions.add(index);
		
		//윈도우 위로 처리
		var upPosWindow		= newQuestionList.querySelector(".upPosWindow");
		var upPosFunc 		= questionUpPostion.bind(null, question_index.value);
		upPosWindow.addEventListener("click", upPosFunc, false);
		windowUpPostions.set(upPosWindow, upPosFunc);
		
		//윈도우 아래로 처리
		var downPosWindow	= newQuestionList.querySelector(".downPosWindow");
		var downPosFunc 	= questionDownPostion.bind(null, question_index.value);
		downPosWindow.addEventListener("click", downPosFunc, false);
		windowDownPostions.set(downPosWindow, downPosFunc);
		
		//모바일 위로 처리
		var upPosMobile		= newQuestionList.querySelector(".upPosMobile");
		var upPosFunc 		= questionUpPostion.bind(null, question_index.value);
		upPosMobile.addEventListener("click", upPosFunc, false);
		mobileUpPostions.set(upPosMobile, upPosFunc);
		
		//모바일 아래로 처리
		var downPosMobile	= newQuestionList.querySelector(".downPosMobile");
		var downPosFunc = questionDownPostion.bind(null, question_index.value);
		downPosMobile.addEventListener("click", downPosFunc, false);
		mobileDownPostions.set(downPosMobile, downPosFunc);
		
		//삭제 처리
		var deleteQuestion		= newQuestionList.querySelector(".deleteQuestion");
		var deleteQuestionFunc	= questionDelete.bind(null, question_index.value);
		deleteQuestion.addEventListener("click", deleteQuestionFunc, false);
		questionDeletes.set(deleteQuestion, deleteQuestionFunc);
		
		initAnswer(answer_lst, parseInt(index));
	}
	
	return;
}

/*
 * 	응답 초기화
 * 	데이터가 있을 경우 컨트롤 setting
 */
function initAnswer(answer_lst, questionIndex)
{
	var vote_type		= document.getElementById("vote_type");
	var answerItems		= answer_lst.querySelectorAll(".newAnswerItem");
	for (var index = 0; index < answerItems.length; index++)
	{
		newAnswerItem		= answerItems[index];
		newAnswerItem.setAttribute("id", "answer_lst_item_" + questionIndex + "_" + index);
		
		//응답 sequence
		var answerSeq		= newAnswerItem.querySelector(".answer_seq");
		answerSeq.setAttribute("id", "answer_seq_" + questionIndex + "_" + index);
		answerSeq.setAttribute("name", "answer_seq_" + questionIndex + "[]");
		
		//응답 index
		var answer_index	= newAnswerItem.querySelector(".answer_index");
		answer_index.setAttribute("id", "answer_index_" + questionIndex + "_" + index);
		answer_index.setAttribute("name", "answer_index_" + questionIndex + "[]");
		answer_index.setAttribute("value", index);
		
		//응답 글
		var answer_subject	= newAnswerItem.querySelector(".answer_subject");
		answer_subject.setAttribute("id", "answer_subject_" + questionIndex + "_" + index);
		answer_subject.setAttribute("name", "answer_subject_" + questionIndex + "[]");
		
		//모바일 응답 추가
		var moPluses		= newAnswerItem.querySelectorAll(".mobilePlus");
		for (var i = 0; i < moPluses.length; i++)
		{
			var addAnswerItem		= moPluses[i];
			addAnswerItem.setAttribute("id", "mobilePlus_" + questionIndex + "_" + index);
			var appendAnswerFunc	= appendAnswer.bind(null, questionIndex)
			addAnswerItem.addEventListener("click", appendAnswerFunc, false);
			mobilePluses.set(addAnswerItem, appendAnswerFunc);
		}
		
		//모바일 응답 삭제
		var moMinuses		= newAnswerItem.querySelectorAll(".mobileMinus");
		for (var i = 0; i < moMinuses.length; i++)
		{
			var delAnswerItem		= moMinuses[i];
			delAnswerItem.setAttribute("id", "mobileMinus_" + questionIndex + "_" + index);
			var removeAnswerFunc	= removeAnswer.bind(null, questionIndex, index); 
			delAnswerItem.addEventListener("click", removeAnswerFunc, false);
			mobileMinuses.set(delAnswerItem, removeAnswerFunc);
		}
		
		//윈도우 응답 추가
		var winPlues		= newAnswerItem.querySelectorAll(".windowPlus");
		for (var i = 0; i < winPlues.length; i++)
		{
			var addAnswerItem		= winPlues[i];
			addAnswerItem.setAttribute("id", "windowPlus_" + questionIndex + "_" + index);
			var appendAnswerFunc	= appendAnswer.bind(null, questionIndex)
			addAnswerItem.addEventListener("click", appendAnswerFunc, false);
			windowPluses.set(addAnswerItem, appendAnswerFunc);
		}
		
		//윈도우 응답 삭제
		var winMinuses		= newAnswerItem.querySelectorAll(".windowMinus");
		for (var i = 0; i < winMinuses.length; i++)
		{
			var delAnswerItem		= winMinuses[i];
			delAnswerItem.setAttribute("id", "windowMinus_" + questionIndex + "_" + index);
			var removeAnswerFunc	= removeAnswer.bind(null, questionIndex, index); 
			delAnswerItem.addEventListener("click", removeAnswerFunc, false);
			windowMinuses.set(delAnswerItem, removeAnswerFunc);
		}
		
		//이미지/동영상 입력 선택
		var answer_resource_type_00		= newAnswerItem.querySelector(".answer_resource_type_00");
		answer_resource_type_00.setAttribute("id", "answer_resource_type_00_" + questionIndex + "_" + index);
		answer_resource_type_00.setAttribute("name", "answer_resource_type_" + questionIndex + "_" + index + "[]");
		
		var answer_resource_label_00	= newAnswerItem.querySelector(".answer_resource_label_00");
		answer_resource_label_00.setAttribute("for", "answer_resource_type_00_" + questionIndex + "_" + index);
		
		var answer_resource_type_01		= newAnswerItem.querySelector(".answer_resource_type_01");
		answer_resource_type_01.setAttribute("id", "answer_resource_type_01_" + questionIndex + "_" + index);
		answer_resource_type_01.setAttribute("name", "answer_resource_type_" + questionIndex + "_" + index + "[]");
		
		var answer_resource_label_01	= newAnswerItem.querySelector(".answer_resource_label_01");
		answer_resource_label_01.setAttribute("for", "answer_resource_type_01_" + questionIndex + "_" + index);
		
		var answer_resource_type_02		= newAnswerItem.querySelector(".answer_resource_type_02");
		answer_resource_type_02.setAttribute("id", "answer_resource_type_02_" + questionIndex + "_" + index);
		answer_resource_type_02.setAttribute("name", "answer_resource_type_" + questionIndex + "_" + index + "[]");
		
		var answer_resource_label_02	= newAnswerItem.querySelector(".answer_resource_label_02");
		answer_resource_label_02.setAttribute("for", "answer_resource_type_02_" + questionIndex + "_" + index);
		
		var answer_resource_type_03		= newAnswerItem.querySelector(".answer_resource_type_03");
		answer_resource_type_03.setAttribute("id", "answer_resource_type_03_" + questionIndex + "_" + index);
		answer_resource_type_03.setAttribute("name", "answer_resource_type_" + questionIndex + "_" + index + "[]");
		
		var answer_resource_label_03	= newAnswerItem.querySelector(".answer_resource_label_03");
		answer_resource_label_03.setAttribute("for", "answer_resource_type_03_" + questionIndex + "_" + index);
		
		//이미지/동영상 입력 처리
		var answer_VideoFile			= newAnswerItem.querySelector(".answer_VideoFile");
		answer_VideoFile.setAttribute("id", "answer_VideoFile_" + questionIndex + "_" + + index);
		answer_VideoFile.setAttribute("name", "answer_VideoFile[]");
		
		//이미지/동영상 리소스 입력 처리
		var vote_answer_resource_type	= newAnswerItem.querySelector(".vote_answer_resource_type");
		vote_answer_resource_type.setAttribute("id", "vote_answer_resource_type_" + questionIndex + "_" + index);
		vote_answer_resource_type.setAttribute("name", "vote_answer_resource_type_" + questionIndex + "[]");
		
		var answerResourceType			= vote_answer_resource_type.value;
		switch (answerResourceType)
		{
			case "0":
				answer_resource_type_00.checked	= true;
				break;
				
			case "1":
				answer_resource_type_01.checked	= true;
				break;
				
			case "2":
				answer_resource_type_02.checked	= true;
				break;
				
			case "3":
				answer_resource_type_03.checked	= true;
				break;
				
			default:
				answer_resource_type_01.checked	= true;
				break;
		}
		
		//이미지/동영상 url 입력 처리
		var vote_answer_resource_url	= newAnswerItem.querySelector(".vote_answer_resource_url");
		vote_answer_resource_url.setAttribute("id", "vote_answer_resource_url_" + questionIndex + "_" + + index);
		vote_answer_resource_url.setAttribute("name", "vote_answer_resource_url_" + questionIndex + "[]");
		
		//이미지/동영상 확인 버튼
		var answer_resource_view		= newAnswerItem.querySelector(".answer_resource_view");
		answer_resource_view.setAttribute("id", "answer_resource_view_" + questionIndex + "_" + + index);
		answer_resource_view.setAttribute("name", "answer_resource_view[]");
		var resourceViewFunc			= doResourceView.bind(null, "answer_real_name_" + questionIndex + "_" + index, "answer_temp_path_" + questionIndex + "_" + index, "vote_answer_resource_type_" + questionIndex + "_" + index, "answer_imageFile_" + questionIndex + "_" + index, "answer_VideoFile_" + questionIndex + "_" + + index, "vote_answer_resource_url_" + questionIndex + "_" + index);
		answer_resource_view.addEventListener("click", resourceViewFunc);
		answerResourceViews.set(answer_resource_view, resourceViewFunc);
		
		//응답 이미지 처리
		var answerImgFile	= newAnswerItem.querySelector(".imageFile");
		answerImgFile.setAttribute("id", "answer_imageFile_" + questionIndex + "_" + index);
		
		//이미지 버튼 처리
		var fileupload		= newAnswerItem.querySelector(".fileupload");
		fileupload.setAttribute("id", "fileupload_" + questionIndex + "_" + index);
		fileupload.setAttribute("name", "fileupload_" + questionIndex + "[]");
		var fileuploadFunc	= answerFileUpload.bind(null, questionIndex, answer_index.value);
		fileupload.addEventListener("click", fileuploadFunc);
		answerFileUploads.set(fileupload, fileuploadFunc);
		
		//이미지 버튼이 처음에는 안보이도록
		var answerResourceType		= document.getElementsByName("answer_resource_type_" + questionIndex + "_" + index + "[]");
		for (var j = 0; j < answerResourceType.length; j++)
		{
			var answerResourceItem	= answerResourceType[j];
			if (answerResourceItem.value == "0" && answerResourceItem.checked)
			{
				fileupload.style.display	= "none";
				answerImgFile.style.display	= "none";
				break;
			}
		}
		
		//이미지/동영상 선택 버튼
		var answerResourcetype00Func	= doResourceType.bind(null, answer_resource_type_00.id, vote_answer_resource_url.id, answer_resource_view.id, answerImgFile.id, answer_VideoFile.id, vote_answer_resource_type.id, fileupload.id);
		answer_resource_type_00.addEventListener("click", answerResourcetype00Func);
		answerResourceTypes.set(answer_resource_type_00, answerResourcetype00Func);
		
		var answerResourcetype01Func	= doResourceType.bind(null, answer_resource_type_01.id, vote_answer_resource_url.id, answer_resource_view.id, answerImgFile.id, answer_VideoFile.id, vote_answer_resource_type.id, fileupload.id);
		answer_resource_type_01.addEventListener("click", answerResourcetype01Func);
		answerResourceTypes.set(answer_resource_type_01, answerResourcetype01Func);
		
		var answerResourcetype02Func	= doResourceType.bind(null, answer_resource_type_02.id, vote_answer_resource_url.id, answer_resource_view.id, answerImgFile.id, answer_VideoFile.id, vote_answer_resource_type.id, fileupload.id);
		answer_resource_type_02.addEventListener("click", answerResourcetype02Func);
		answerResourceTypes.set(answer_resource_type_02, answerResourcetype02Func);
		
		var answerResourcetype03Func	= doResourceType.bind(null, answer_resource_type_03.id, vote_answer_resource_url.id, answer_resource_view.id, answerImgFile.id, answer_VideoFile.id, vote_answer_resource_type.id, fileupload.id);
		answer_resource_type_03.addEventListener("click", answerResourcetype03Func);
		answerResourceTypes.set(answer_resource_type_03, answerResourcetype03Func);
		
		var answerTempPath		= newAnswerItem.querySelector(".answer_temp_path");
		answerTempPath.setAttribute("id", "answer_temp_path_" + questionIndex + "_" + index);
		answerTempPath.setAttribute("name", "answer_temp_path_" + questionIndex + "[]");
		
		var answerRealName		= newAnswerItem.querySelector(".answer_real_name");
		answerRealName.setAttribute("id", "answer_real_name_" + questionIndex + "_" + index);
		answerRealName.setAttribute("name", "answer_real_name_" + questionIndex + "[]");
	
		//정답 여부
		var answerCorrect		= newAnswerItem.querySelector(".answer_correct");
		answerCorrect.setAttribute("id", "answer_correct_" + questionIndex + "_" + index);
		answerCorrect.setAttribute("name", "answer_correct_" + questionIndex + "[]");
		if (vote_type.options[vote_type.selectedIndex].value == "4")
		{
			var answerCorrectItem	= newAnswerItem.querySelector(".answerCorrect");
			answerCorrectItem.style.display = "block";
			answerCorrect.setAttribute("value", index);
		}
		
		var answerLabel			= newAnswerItem.querySelector(".answer_correct_label");
		answerLabel.setAttribute("for", "answer_correct_" + questionIndex + "_" + index);
		
		var checkCorrectFunc	= checkCorrect.bind(null, answer_lst, answerCorrect);
		answerCorrect.addEventListener("click", checkCorrectFunc);
		answerCorrects.set(answerCorrect, checkCorrectFunc);
		
		newAnswerItem.setAttribute("style", "display:block");
		
		answer_lst.appendChild(newAnswerItem);
		answers.set(questionIndex, index);
	}

	return;
}

/*
 * 	질문 순서 처리
 */
function orderSortQuestion()
{
	var question_order		= document.getElementsByName("question_order[]");
	for (var i = 0; i < question_order.length; i++)
		question_order[i].value	= i;
	
	return;
}

/*
 * 	질문 추가
 */
function appendQuestion()
{
	var question_lst_item		= document.getElementById("question_lst_item");
	var newQuestionList			= question_lst_item.cloneNode(true);
	newQuestionList.setAttribute("class", "votewritecont vtallline newWriteItem");
	
	var question_lst			= document.getElementById("question_lst");
	newQuestionList.style.display	= "block";
	question_lst.appendChild(newQuestionList);
	
	initQuestion();
	var question_index			= newQuestionList.querySelector(".question_index");
	appendAnswer(question_index.value);
	orderSortQuestion();
	
	return;
}

/*
 *	퀴즈 정답 체크
 */
function checkCorrect(parentElement, meElement)
{
	var corrects	= parentElement.querySelectorAll(".answer_correct");
	for (var i = 0; i < corrects.length; i++)
	{
		var correctItem	= corrects[i];
		correctItem.checked	= false;
	}
	
	meElement.checked	= true;
	
	return;
}

/*
 * 	응답 추가
 */
function appendAnswer(questionIndex)
{
	var index	= 0;
	if (answers.has(questionIndex))
	{
		index	= answers.get(questionIndex);
		index++;
	}
	
	var answer_lst		= document.getElementById("answer_lst_" + questionIndex);
	var answer_lst_item	= answer_lst.querySelector(".answer_lst_item");
	var newAnswerItem	= answer_lst_item.cloneNode(true);
	newAnswerItem.setAttribute("id", "answer_lst_item_" + questionIndex + "_" + index);
	newAnswerItem.setAttribute("class", "answer_lst_item newAnswerItem");
	
	newAnswerItem.setAttribute("style", "display:block");
	answer_lst.appendChild(newAnswerItem);
	initQuestion();
	answers.set(questionIndex, index);
	
	return;
}


/*
 *	투표 컨트롤 처리
 */
window.addEventListener("load", function()
{
	//퀴즈일 때 정답 설정
	var vote_type		= document.getElementById("vote_type");
	vote_type.addEventListener("change", function()
	{
		var answer_corrects	= document.querySelectorAll(".answerCorrect");
		if (vote_type.options[vote_type.selectedIndex].value == "4")
		{
			for (var i = 0; i < answer_corrects.length; i++)
			{
				var correct	= answer_corrects[i];
				correct.style.display	= "block";	
			}
		}
		else
		{
			for (var i = 0; i < answer_corrects.length; i++)
			{
				var correct	= answer_corrects[i];
				correct.style.display	= "none";
			}
		}
	});
	
	//1depth 카테고리 선택
	var	vote_cate_seq	= document.getElementById("vote_cate_seq");
	vote_cate_seq.addEventListener("change", function()
	{
		var cate_seq			= document.getElementById("cate_seq");
		cate_seq.value			= this.value;
		
		//var selectedSeq		= this.options[this.selectedIndex].value;
		var query		= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/controller.php?mode=get_cate", function(result)
		{
			if (result == "FALSE")
				return;
			
			result	= JSON.parse(result);
			var real_name		= document.getElementById("real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("imageFile");
			imageFile.setAttribute("src", result[0].CATE_REAL_IMAGE_PATH);
			
			core_ajax.instance().send(query, null, "/controller.php?mode=get_cate_list", function(result)
			{
				var cate_2dept_seq	= document.getElementById("cate_2dept_seq");
				var tempElement		= cate_2dept_seq.firstChild;
				while (tempElement)
				{
					if (tempElement.nodeType != Node.ELEMENT_NODE)
					{
						tempElement	= tempElement.nextSibling;
						continue;
					}
						
					if (tempElement.tagName.toLowerCase() != "option")
					{
						tempElement	= tempElement.nextSibling;
						continue;
					}
						
					if (tempElement.value == "-")
					{
						tempElement	= tempElement.nextSibling;
						continue;
					}
					
					var targetElement	= tempElement;
					tempElement			= tempElement.nextSibling; 
					cate_2dept_seq.removeChild(targetElement);
				}
				
				if (result == "FALSE")
					return;
				
				result				= JSON.parse(result);
				for(var index in result)
				{
					var option			= document.createElement("OPTION");
					option.value		= result[index].CATE_SEQ;
					option.innerText	= result[index].CATE_NAME;
					
					cate_2dept_seq.appendChild(option);
				}
				
				return;
			});
			
			return;
		});
	});
	
	//2depth 카테고리 선택
	var cate_2dept_seq		= document.getElementById("cate_2dept_seq");
	cate_2dept_seq.addEventListener("change", function()
	{
		var cate_seq			= document.getElementById("cate_seq");
		cate_seq.value			= this.value;
		
		//var selectedSeq		= this.options[this.selectedIndex].value;
		var query			= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/controller.php?mode=get_cate", function(result)
		{
			result	= JSON.parse(result);
			var real_name		= document.getElementById("real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("imageFile");
			imageFile.setAttribute("src", result[0].CATE_REAL_IMAGE_PATH);
			
			return;
		});
		
		return false;
		
	}.bind(cate_2dept_seq));
	
	var resource_type		= document.getElementsByName("resource_type[]");
	var voteResourceType	= document.getElementById("vote_resource_type");
	var voteImageFile		= document.getElementById("imageFile");
	var voteVideoFile		= document.getElementById("videoFile");
	var vote_resource_url	= document.getElementById("vote_resource_url");
	var resource_view		= document.getElementById("resource_view");
	var upImageFile			= document.getElementById("upImageFile");
	for (var i = 0; i < resource_type.length; i++)
	{
		var resourctItem		= resource_type[i];
		var doResourceTypeFunc	= doResourceType.bind(null, resourctItem.id, vote_resource_url.id, resource_view.id, voteImageFile.id, voteVideoFile.id, voteResourceType.id, upImageFile.id);
		resourctItem.addEventListener("click", doResourceTypeFunc);
	}
	
	var resource_view		= document.getElementById("resource_view");
	var resourceViewFunc	= doResourceView.bind(null, "real_name", "temp_path", "vote_resource_type", "imageFile", "videoFile", "vote_resource_url");
	resource_view.addEventListener("click", resourceViewFunc);
	
	//파일 업로드 처리
	var uploadName			= document.getElementById("uploadName");
	uploadName.addEventListener("change", function()
	{
		//파일 업로드를 받을 페이지를 iframe으로 생성
		//폼 frmFileUpload로 submit
		var uploadFrame	= document.getElementById("uploadFrame");
		if (uploadFrame == null)
		{
			uploadFrame	= document.createElement("iframe");
			uploadFrame.setAttribute("style", "width:0px; height:0px;");
			uploadFrame.setAttribute("width", "0");
			uploadFrame.setAttribute("height", "0");
			uploadFrame.setAttribute("border", "0");
			uploadFrame.setAttribute("frameborder", "0");
			uploadFrame.setAttribute("id", "uploadFrame");
			
			document.getElementsByTagName("body").item(0).appendChild(uploadFrame);
		}
		
		var frmImageUpload		= document.getElementById("frmImageUpload");
		frmImageUpload.target	= "uploadFrame";
		frmImageUpload.submit();
	});
	
	//질문 추가
	var addQuestion		= document.getElementById("appendQuestion");
	addQuestion.addEventListener("click", function()
	{
		appendQuestion();
		
		return;
	});
	
	//이미지 등록
	upImageFile.addEventListener("click", function()
	{
		var uploadName	= document.getElementById("uploadName");
		uploadName.click();
		return;
	});
	
	//이벤트 투표시 버튼 처리
	var vote_kind		= document.getElementById("vote_kind");
	if (vote_kind.value == "2")
	{
		var find_event_file	= document.getElementById("find_event_file");
		var docFile			= document.getElementById("docFile");
		find_event_file.addEventListener("click", function(docFile)
		{
			docFile.click();
		}.bind(null, docFile));
		
		docFile.addEventListener("change", function()
		{
			//파일 업로드를 받을 페이지를 iframe으로 생성
			//폼 frmFileUpload로 submit
			var uploadFrame	= document.getElementById("uploadFrame");
			if (uploadFrame == null)
			{
				uploadFrame	= document.createElement("iframe");
				uploadFrame.setAttribute("style", "width:0px; height:0px;");
				uploadFrame.setAttribute("width", "0");
				uploadFrame.setAttribute("height", "0");
				uploadFrame.setAttribute("border", "0");
				uploadFrame.setAttribute("frameborder", "0");
				uploadFrame.setAttribute("id", "uploadFrame");
				
				document.getElementsByTagName("body").item(0).appendChild(uploadFrame);
			}
			
			var frmFileUpload		= document.getElementById("frmFileUpload");
			frmFileUpload.target	= "uploadFrame";
			frmFileUpload.submit();
		});
	}
	
	//투표 정보 등록을 위한 validation 체크 
	var registerVote	= document.getElementById("registerVote");
	registerVote.addEventListener("click", function()
	{
		var frmVote		= document.getElementById("frmVote");
		var voteKind	= frmVote.elements["vote_kind"];
		if (voteKind.value == "")
		{
			alert("투표 종류(일반/이벤트)를 선택하셔야 합니다.");
			return;
		}
		
		var vote_type		= frmVote.elements["vote_type"];
		if (vote_type.options[vote_type.selectedIndex].value == "0")
		{
			alert("투표 유형을 선택하셔야 합니다.");
			vote_type.focus();
			return;
		}
		
		var vote_subject	= frmVote.elements["vote_subject"];
		if (vote_subject.value == "")
		{
			alert("투표 제목을 입력하셔야 합니다.");
			vote_subject.focus();
			return;
		}
		
		var vote_cate1_seq	= frmVote.elements["vote_cate_seq"]; 
		if (vote_cate1_seq.options[vote_cate1_seq.selectedIndex].value == "0")
		{
			alert("투표 유형을 입력하셔야 합니다.");
			vote_cate1_seq.focus();
			return;
		}
		
		/*
		var vote_real_name	= frmVote.elements["vote_real_name"];
		if (vote_real_name.value == "")
		{
			alert("투표 이미지를 등록하셔야 합니다.");
			var voteImageFile		= document.getElementById("upImageFile");
			voteImageFile.focus();
			return;
		}
		*/
		var vote_real_name	= frmVote.elements["real_name"];
		if (vote_real_name.value == "")
		{
			alert("투표 이미지를 등록하셔야 합니다.");
			var voteImageFile		= document.getElementById("upImageFile");
			voteImageFile.focus();
			return;
		}		
		
		//이벤트 투표
		if (vote_kind.value == "2")
		{
			var event_phone	= frmVote.elements["event_phone"];
			if (event_phone.value == "")
			{
				alert("담당자 연락처를 입력하셔야 합니다.");
				event_phone.focus();
				return;
			}
		}
		
		var question_subjects	= document.getElementsByName("question_subject[]");
		for (var i = 0; i < question_subjects.length; i++)
		{
			if (question_subjects[i].value == "")
			{
				alert("질문을 입력하셔야 합니다.");
				question_subjects[i].focus();
				isValue	= false;
				break;
			}
			
			isValue	= true;
		}
		
		if (!isValue)
			return;
		
		var answer_kinds		= document.getElementsByName("question_answer_kind[]");
		for (var i = 0; i < answer_kinds.length; i++)
		{
			if (answer_kinds[i].options[answer_kinds[i].selectedIndex].value == "-")
			{
				alert("응답 종류를 입력하셔야 합니다.");
				answer_kinds[i].focus();
				isValue	= false;
				break;
			}
			
			isValue	= true;
		}
		
		if (!isValue)
			return;
		
		var question_indexs		= document.getElementsByName("question_index[]");
		for (var i = 0; i < question_indexs.length; i++)
		{
			var questionIndex	= question_indexs[i].value;
			var answer_subjects	= document.getElementsByName("answer_subject_" + questionIndex + "[]");
			for (var j = 0; j < answer_subjects.length; j++)
			{
				if (answer_subjects[j].value == "")
				{
					alert("응답을 입력하셔야 합니다.");
					answer_subjects[j].focus();
					isValue	= false;
					break;
				}
				
				isValue	= true;
			}
			
			if (!isValue)
				break;
		}
		
		if (!isValue)
			return;
		
		frmVote.submit();
	});
	
	initQuestion();
});