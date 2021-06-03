var objText			= null;
var arrImageList	= new Array();
var	imageIndex		= 0;
var range			= null;
var colorType		= "foreColor";

function escapeHtml(str) 
{
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};
	
	return str.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function selectFontName(strTextEdit, strSelName)
{
	objTextEditor	= document.getElementById(strTextEdit);
	
	var objSelName		= document.getElementById(strSelName);
	var strFontName		= objSelName.options[objSelName.selectedIndex].value;
	
	objTextEditor.contentDocument.execCommand("fontName", 0, strFontName);
	objTextEditor.focus();
	
	return;
}

function selectFontSize(strTextEdit, strSelName)
{
	objTextEditor	= document.getElementById(strTextEdit);
	
	var objSelName		= document.getElementById(strSelName);
	var strFontSize		= objSelName.options[objSelName.selectedIndex].value;
	
	objTextEditor.contentDocument.execCommand("fontSize", 0, strFontSize);
	objTextEditor.focus();
	
	return;
}

function setEditCommand(strTextEdit, strCommand)
{
	objTextEditor	= document.getElementById(strTextEdit);
	objTextEditor.focus();	
	if (strCommand == "createLink")
	{
		var szURL = prompt("주소를 입력하세요.:", "http://");
		var result		= objTextEditor.contentDocument.execCommand(strCommand, false, szURL);
		if (!result)
			console.log("edit error");
	}
	else
	{
		var result		= objTextEditor.contentDocument.execCommand(strCommand, false);
		if (!result)
			console.log("edit error");
	}
	
	return;
}

function insertForeColor(colorPane, foreColor, colorPaneControl)
{
	//var colorPane				= document.getElementById("colorPane");
	var colorPane		= document.getElementById(colorPane);
	if (colorPane.style.display == "block")
	{
		colorPane.style.display		= "none";
		return;
	}
	else
		colorPane.style.display		= "block";	
	
	//var objElement		= document.getElementById('btnSetForeColor');
	var objElement		= document.getElementById(foreColor);
	var	nTop			= 0;
	var nLeft			= 0;
	
	while (objElement)
	{
		nTop 			+= objElement.offsetTop;
		nLeft 			+= objElement.offsetLeft;
		objElement		= objElement.offsetParent;
	}
	
	nTop				+= 25;
	
	//var objColorPane			= document.getElementById("dvColorPane");
	var objColorPane			= document.getElementById(colorPaneControl);
	objColorPane.style.top		= nTop + "px";
	objColorPane.style.left		= nLeft + "px";
	colorType					= "foreColor";
	
	return;
}

function insertBackColor(colorPane, foreColor, colorPaneControl)
{
	//var colorPane				= document.getElementById("colorPane");
	var colorPane		= document.getElementById(colorPane);
	if (colorPane.style.display == "block")
	{
		colorPane.style.display		= "none";
		return;
	}
	else
		colorPane.style.display		= "block";	
	
	//var objElement		= document.getElementById('btnSetBackColor');
	var objElement		= document.getElementById(foreColor);
	var	nTop			= 0;
	var nLeft			= 0;
	
	while (objElement)
	{
		nTop 			+= objElement.offsetTop;
		nLeft 			+= objElement.offsetLeft;
		objElement		= objElement.offsetParent;
	}
	
	nTop				+= 25;
	
	//var objColorPane			= document.getElementById("dvColorPane");
	var objColorPane			= document.getElementById(colorPaneControl);
	objColorPane.style.top		= nTop + "px";
	objColorPane.style.left		= nLeft + "px";
	colorType					= "backColor";
	
	return;
}


function selectForeColor(strTextEdit, strColor)
{
	objTextEditor		= document.getElementById(strTextEdit);
	objTextEditor.contentDocument.execCommand(colorType, 0, strColor);
	objTextEditor.focus();
	objText	= null;
	
	var colorPane	= document.getElementById("colorPane");
	colorPane.style.display	= "none";	
	
	return;
}

function findFile()
{
	var uploadFile				= document.getElementById("uploadFile");
	uploadFile.click();
	return;
}

function insertEditFile(frameId, formId)
{
	//var uploadFrame	= document.getElementById("uploadFrame");
	var frame	= document.getElementById(frameId);
	if (frame == null)
	{
		frame	= document.createElement("iframe");
		frame.setAttribute("style", "width:0px; height:0px;");
		frame.setAttribute("width", "0");
		frame.setAttribute("height", "0");
		frame.setAttribute("border", "0");
		frame.setAttribute("frameborder", "0");
		frame.setAttribute("id", frameId);
		
		document.getElementsByTagName("body").item(0).appendChild(frame);
	}
	
	//var frmFileUpload		= document.getElementById("frmFileUpload");
	var frmFileUpload		= document.getElementById(formId);
	frmFileUpload.target	= frameId;
	frmFileUpload.action	= "/controller.php?mode=board_file";
	
	//action="/controller.php?mode=image_upload"
	frmFileUpload.submit();
	
	return;
}

function setEditerFile(fileData)
{
	//strFilePath, strRealFileName
	var strRealFileName		= fileData.real_name;
	var strFilePath			= fileData.temp_path;
	var filelist			= document.getElementById("viewfilelist");
	var optionItem			= document.createElement("OPTION");
	optionItem.value		= strFilePath;
	optionItem.innerText	= strRealFileName;
	
	filelist.appendChild(optionItem);
	
	return;
}

function findImageFile()
{
	var uploadImage				= document.getElementById("uploadImage");
	uploadImage.click();
	return;
}

function insertEditImage(frameId, formId)
{
	//var uploadFrame	= document.getElementById("uploadFrame");
	var uploadFrame	= document.getElementById(frameId);
	if (uploadFrame == null)
	{
		uploadFrame	= document.createElement("iframe");
		uploadFrame.setAttribute("style", "width:0px; height:0px;");
		uploadFrame.setAttribute("width", "0");
		uploadFrame.setAttribute("height", "0");
		uploadFrame.setAttribute("border", "0");
		uploadFrame.setAttribute("frameborder", "0");
		uploadFrame.setAttribute("id", frameId);
		
		document.getElementsByTagName("body").item(0).appendChild(uploadFrame);
	}
	
	//var frmFileUpload		= document.getElementById("frmFileUpload");
	var frmFileUpload		= document.getElementById(formId);
	frmFileUpload.target	= frameId;
	frmFileUpload.action	= "/controller.php?mode=board_image";
	
	//action="/controller.php?mode=image_upload"
	frmFileUpload.submit();
	
	return;
}

function setEditerImage(fileData)
{
	var strFileName		= fileData.real_name;
	var strFilePath		= fileData.temp_path;
	objTextEditor		= document.getElementById("textEdit");
	var strImageTag		= "<img style='width:75%;' src=\"" + strFilePath + "\" />";
	
	objTextEditor.contentDocument.execCommand("insertHTML", 0, strImageTag);
	objTextEditor.focus();
	objText	= null;
	
	arrImageList[imageIndex]	= strFileName;
	imageIndex++;
	
	return;
}

function getFileListToJSON(arrList)
{
	if (arrList.length <= 0)
		return "";
	
	var result	= JSON.stringify(arrList);
	return result;
}

function setContext(textEdit, contextBody)
{
	var bodyTag			= "<!doctype html><html><BODY MONOSPACE STYLE=\"font:10pt arial,sans-serif\">";
	bodyTag				= bodyTag + contextBody + "</BODY></html>";  
	
	var editor	=  textEdit.contentWindow.document;
	editor.write(bodyTag);
	
	textEdit.contentDocument.designMode 	= "on";	
	
	/*
	if (objTextEdit != null)
	{
		//objTextEdit.contentDocument.designMode 	= "On";
		var editor	=  objTextEdit.contentWindow.document;
		editor.write(bodyTag);
	}
	*/
	
	return;
}

function viewHTML(btnViewHTML, htmlEdit, textEdit)
{
	var objButton		= document.getElementById(btnViewHTML);
	var objHtmlEdit		= document.getElementById(htmlEdit);
	var objTextEdit		= document.getElementById(textEdit);
	var contextBody		= objTextEdit.contentDocument.body;
	
	if (objHtmlEdit.style.display == "none")
	{
		var context			= contextBody.innerHTML;
		objHtmlEdit.value	= context;
		objHtmlEdit.style.display	= "block";
		objTextEdit.style.display	= "none";
		objButton.innerText	= "디자인";
	}
	else
	{
		var context				= objHtmlEdit.value;
		contextBody.innerHTML	= context;
		objHtmlEdit.style.display	= "none";
		objTextEdit.style.display	= "block";
		objButton.innerText	= "HTML";
	}
	
	return;
}

function deleteBoard(formID)
{
	var boardNum		= document.getElementById("NUM");
	if (boardNum.value == "")
	{
		alert("삭제할 글을 선택하셔야 합니다.");
		return;	
	}
	
	var exec			= document.getElementById("exec");
	exec.value			= "delete";
	
	var frmBoard		= document.getElementById(formID);
	
	frmBoard.submit();
	
	return;
}

function registerBoard(formId, subjectId, editorId, contextId, viewfilelistId, inputfilelistId, inputimagelistId)
{
	var boardNum		= document.getElementById("NUM");
	var parentNum		= document.getElementById("PARENT_NUM");
	var parentNum_value	= "";
	if (parentNum != null)
		parentNum_value	= parentNum.value;
	var exec			= document.getElementById("exec");
	if (boardNum.value != "" && parentNum_value == "")
		exec.value		= "update";
	else
		exec.value		= "register";
	
	var boardSubject	= document.getElementById(subjectId);
	if (boardSubject.value == "")
	{
		alert("제목을 입력하셔야 합니다.");
		boardSubject.focus();
		return;
	}
	
	var contextEdit		= document.getElementById(editorId);
 	var contextBody		= contextEdit.contentDocument.body;
 	var context			= contextBody.innerHTML;
	if (context == "")
	{
		alert("내용을 입력하셔야 합니다.");
		return;
	}

	var frmBoard		= document.getElementById(formId);
	var boardContext	= document.getElementById(contextId);
	
	boardContext.value	= context;
	
	var viewfilelist	= document.getElementById(viewfilelistId);
	var arrFileList		= new Array();		
	for (var i = 0; i < viewfilelist.options.length; i++)
	{
		var fileItem 	= viewfilelist.options[i];
		if (fileItem.value == "-" || fileItem.value == "")
			continue;
	
		var arrFileItem	= {'real_name':fileItem.innerText, 'temp_name':fileItem.value};
		arrFileList.push(arrFileItem);	
	}
	
	var file_list 		= document.getElementById(inputfilelistId);
	file_list.value 	= getFileListToJSON(arrFileList);
	
	var image_list		= document.getElementById(inputimagelistId);
	image_list.value	= getFileListToJSON(arrImageList);
	
	frmBoard.submit();
	
	return;
}

function deleteBoardFile(filelist)
{
	var file_list	= document.getElementById(filelist);
	if (file_list.selectedIndex < 0)
		return;
		
	file_list.removeChild(file_list.options[file_list.selectedIndex]);
	
	return;
}

window.addEventListener("load", function()
{
	var bodyTag			= "<!doctype html><html><BODY MONOSPACE STYLE=\"font:10pt arial,sans-serif\"></BODY></html>";
	var objTextEdit		= document.getElementById("textEdit");
	var objHtmlEdit 	= document.getElementById("htmlEdit");
	setContext(objTextEdit, objHtmlEdit.value);
	/*
	if (objTextEdit != null)
	{
		objTextEdit.contentDocument.designMode 	= "on";	
		objTextEdit.contentDocument.write(bodyTag);
	}
	*/
	
	return;
	
}, true);