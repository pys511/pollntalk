/**
 * 
 */
function registerBoard(textEdit)
{
	var contextEdit	= document.getElementById(textEdit);
	var contextBody	= contextEdit.contentDocument.body;
	var context		= contextBody.innerHTML;
	
	alert(context);
}