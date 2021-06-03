/**
 *  @auth : JEON JY
 *  @date	: 20200529
 *  ajax의 기능을 수행
 */
core_ajax = function()
{
	var m_ajax		= null;
	var m_isAjax	= false;
	var m_url		= location.host;
	var m_result	= "";
	
	//ajax 생성
	//브라우저는 최신 브라우저에서만 이용할 수 있도록 한다.
	if (typeof(XMLHttpRequest) == "object" || typeof(XMLHttpRequest) == "function")
	{
		m_ajax		= new XMLHttpRequest();
		m_isAjax	= true;
	}
	else
	{
		m_ajax		= null;
		m_isAjax	= false;
		throw new wdk_core_exception(null, wdk_core_exception.TYPE.FATAL, "[core][net][1]본 사이트는 최신 브라우저에서만 이용할 수 있습니다.");
	}
	
	this.isAjax	= function()
	{
		return m_isAjax;
	}
	
	this.setHeader = function(key, value)
	{
		m_ajax.setRequestHeader(key, value);
	}
	
	//ajax 데이터 전송 처리
	this.send = function(query, dataGet, path, callback)
	{
		if ((m_ajax == null) || (m_ajax == undefined) || (!m_isAjax))
			return false;
		
		var targetURL 	= "http://" + m_url;
		if (path != "")
			targetURL	+= path;
		
		if (dataGet != "" && dataGet != null && dataGet != undefined)
		{
			if (targetURL.indexOf("?") < 0 && dataGet.indexOf("?") < 0)
			{
				if (dataGet.indexOf("/") >= 0)
					targetURL	+= dataGet;
				else
					targetURL	+= "?" + dataGet;
			}
			else
				targetURL	+= dataGet;
		}
		
		try
		{
			//m_ajax.open("post", targetURL, false);
			m_ajax.open("post", targetURL, true);
			m_ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
			m_ajax.send(query);
			m_ajax.onreadystatechange = function()
			{
				if ((m_ajax.readyState == m_ajax.DONE || m_ajax.readyState == m_ajax.OPENED) && m_ajax.status == 200)
				{
					m_result	= m_ajax.responseText;
					if (callback != null && callback != undefined)
						callback(m_result);
					return true;
				}
			}
		}
		catch (ex)
		{
			throw new wdk_core_exception(ex, wdk_core_exception.TYPE.FATAL, "[core][net][2]통신중에 오류가 발생하였습니다.");
		}
		
		return false;
	}
	
	/*
	 *	special charactor 치환
	 */
	this.replaceSpecialChar	= function(value)
	{
		value 	= value.replace(/&/g,"&amp;");
		value 	= value.replace(/</g,"&lt;");
		value 	= value.replace(/>/g,"&gt;");
		value 	= value.replace(/\"/g,"&quot;");
		value 	= value.replace(/\'/g,"&#39;");
		value 	= value.replace(/\n/g,"<br />");
		
		return value;
	}
	
	/*
	 * 	ajax query 작성
	 * 	ex) key=value&key=value&key=value....
	 */
	this.getFormData = function(element, data)
	{
		if (element == null || element == undefined)
			return data;
		
		if (element.nodeType != Node.ELEMENT_NODE)
			return data;
		
		var tagName		= element.tagName.toLowerCase();
		var value		= "";
		
		if (tagName == "select")
			value		= element.options[element.selectedIndex].value;
		else
		{
			var inputType	= element.getAttribute("type");
			if (inputType == "checkbox" || inputType == "radio")
			{
				if (element.checked)
					value	= element.value;
				else
					return data;
			}
			else
				value		= element.value;
		}
		
		value		= this.replaceSpecialChar(value);
		var name	= element.getAttribute("name");
		if (data != "")
			data 	= data + "&";
		
		data	+= name + "=" + value;
		
		return data;
	}
	
	/*
	 *	form에 데이터를 추출해서 ajax query로 변환.
	 *	id는 지정되어 있으면 해당 elemente만 찾는다. 없으면 null을 넣을 것.
	 */
	this.makeQuery = function(formElement, id, checker)
	{
		if (checker != undefined)
		{
			var tempResult	= checker();
			if (typeof tempResult != "boolean")
			{
				alert("폼 검증하는데 문제가 발생하였습니다.");
				return false;
			}
			if (!tempResult)
				return false;
		}
		
		var result	= "";
		if (id == "" || id == undefined || id == null)
		{
			var length	= formElement.elements.length;
			for (var i = 0; i < length; i++)
			{
				var element	= formElement.elements[i];
				result		= this.getFormData(element, result);
			}
		}
		else
		{
			var element	= null;
			if (formElement != null)
				element	= formElement.elements[id];
			else
				element	= document.getElementById(id);
			
			result		= this.getFormData(element, result);
		}
		
		return result;
	}
	
	this.getResult = function()
	{
		return m_result;
	}
}

/**
 *  @auth : JEON JY
 *  @date	: 20200529
 *  form submit 처리
 */
core_submit = function()
{
	var m_url		= location.host;
	this.send = function(formElement, checker)
	{
		if (checker != undefined)
		{
			var tempResult	= checker();
			if (typeof tempResult != "boolean")
			{
				alert("폼 검증하는데 문제가 발생하였습니다.");
				return false;
			}
			if (!tempResult)
				return false;
		}
		
		if (formElement.action == "")
		{
			var targetURL 	= "http://" + m_url;
			if (path != "")
				targetURL	+= path;
			
			if (dataGet != "" && dataGet != null && dataGet != undefined)
			{
				if (targetURL.indexOf("?") < 0 && dataGet.indexOf("?") < 0)
				{
					if (dataGet.indexOf("/") >= 0)
						targetURL	+= dataGet;
					else
						targetURL	+= "?" + dataGet;
				}
				else
					targetURL	+= dataGet;
			}
			else
			{
				var search	= location.search;
				targetURL	+= search;
			}
		}
		
		formElement.submit();
	}
}

/*
 * 	ajax singleton instance 반환
 */
core_ajax.instance	= function()
{
	if (this.m_instance == null)
		this.m_instance	= new core_ajax();
	
	return this.m_instance;
}

/*
 * 	submit singleton instance 반환
 */
core_submit.instance	= function()
{
	if (this.m_instance == null)
		this.m_instance	= new core_submit();
	
	return this.m_instance;
}

/*
 * 	출력 위치
 */
function getPosX(objElement)
{
	var nPosX					= objElement.offsetLeft;
	var objTempElement			= objElement;
	
	while ((objTempElement = objTempElement.offsetParent) != null)
		nPosX					+= objTempElement.offsetLeft;
		
	return nPosX;
}

function getPosY(objElement)
{
	var nPosY					= objElement.offsetTop;
	var objTempElement			= objElement;
	
	while ((objTempElement = objTempElement.offsetParent) != null)
		nPosY					+= objTempElement.offsetTop;
		
	return nPosY;
}

window.addEventListener("load", function()
{
	var selects			= document.querySelectorAll("select");
	for (var i = 0; i < selects.length; i++)
	{
		selects[i].addEventListener("change", function()
		{
			var optionElement	= this.options[this.selectedIndex];
			if (optionElement.value == "0" || optionElement.value == "-" )
				this.style.color = "#d9d9d9";
			else
				this.style.color = "#999999";			
		});
	}
	
	return;	
});