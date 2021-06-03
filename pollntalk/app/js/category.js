/**
 * 
 */
function highlightCategory(element, seq)
{
	var catelist	= document.getElementById("catelist");
	for (var i = 0; i < catelist.childNodes.length; i++)
	{
		var cateitem	= catelist.childNodes[i];
		if (cateitem.nodeType != Node.ELEMENT_NODE)
			continue;
		
		var catename	= cateitem.getElementsByTagName("span");
		catename.item(0).className	= "";
	}
	
	var catesublist	= document.getElementsByClassName("categorysublist");
	for (var i = 0; i < catesublist.length; i++)
		catesublist[i].style.display	= "none";
		
	var catename	= element.getElementsByTagName("span");
	catename.item(0).className	= "title";
	
	var subelement	= document.getElementById("catesublist_" + seq);
	if (subelement != null)
		subelement.style.display	= "block";
	
	return;
}

function highlightSubCategory(element)
{
	var catelist	= document.getElementsByClassName("categorysublist");
	for (var i = 0; i < catelist.length; i++)
	{
		for (var j = 0; j < catelist[i].childNodes.length; j++)
		{
			var cateitem	= catelist[i].childNodes[j];
			if (cateitem.nodeType != Node.ELEMENT_NODE)
				continue;
			
			var catename	= cateitem.getElementsByTagName("span");
			catename.item(0).className	= "";
		}
	}
		
	var catename	= element.getElementsByTagName("span");
	catename.item(0).className	= "title";
	
	return;
}

function goCert(){
	alert("성인인증 후 이용 가능하십니다.");
	window.open("/kcpcert/WEB_ENC/kcpcert_start.php",'','width=610, height=210, scrollbars=no');
}

function uselogin(){
	alert("로그인 후 이용 가능하십니다.");
	parent.goLogin();
}