/**
 *  @auth : JEON JY
 *  @date	: 202000601
 *  카테고리 등록 처리
 */
var isCheck	= false;

/*
 * 	카테고리 등록 페이지 컨트롤 이벤트 설정
 */
window.addEventListener("load", function()
{
	//상위 카테고리를 선택시
	var cateParentSeq	= document.getElementById("cate_parent_seq");
	cateParentSeq.addEventListener("change", function()
	{
		var cate_seq		= document.getElementById("cate_seq");
		cate_seq.value		= "";
		
		return;
	});
	
	//파일 업로드
	var uploadName		= document.getElementById("uploadName");
	var thumb_upload	= document.getElementById("fileupload");
	thumb_upload.addEventListener("click", function()
	{
		this.click();
		return;
	}.bind(uploadName));
	
	//파일 업로드 처리
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
		
		var frmFileUpload		= document.getElementById("frmFileUpload");
		frmFileUpload.target	= "uploadFrame";
		frmFileUpload.submit();
	});
	
	//리셋
	var resetCategory	= document.getElementById("resetCategory");
	resetCategory.addEventListener("click", function()
	{
		var cate_seq		= document.getElementById("cate_seq");
		cate_seq.value		= "";
		var cate_name		= document.getElementById("cate_name");
		cate_name.value		= "";
		var cate_parent_seq	= document.getElementById("cate_parent_seq");
		cate_parent_seq.selectedIndex	= 0;
		var real_name		= document.getElementById("real_name");
		real_name.value		= "";
		var cate_text		= document.getElementById("cate_text");
		cate_text.value		= "";
		var imageFile		= document.getElementById("imageFile");
		imageFile.setAttribute("src", "/app/images/admin/photo.png");
		
		return;
	});
	
	//카테고리 삭제
	var deleteCategory	= document.getElementById("deleteCategory");
	deleteCategory.addEventListener("click", function()
	{
		if (!window.confirm("삭제하시겠습니까?"))
			return;
		
		var frmCategory	= document.getElementById("frmCategory");
		var query		= core_ajax.instance().makeQuery(frmCategory, "cate_seq", function()
		{
			var	cate_seq	= document.getElementById("cate_seq");
			if (cate_seq.value == "")
			{
				alert("하단에 카테고리 목록에서 삭제할 카테고리 항목을 선택하세요.");
				return;
			}
			
			return true;
		});
		
		if (!query)
			return;
		
		var result;
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=cate_proc&exec=del", function(result)
		{
			location.reload();
			return;
			
		});
	}, true);
	
	//카테고리 등록
	var registerCategory	= document.getElementById("registerCategory");
	registerCategory.addEventListener("click", function()
	{
		var cate_name		= document.getElementById("cate_name");
		if (cate_name.value == "")
		{
			alert("카테고리 이름을 입력하셔야 합니다.");
			cate_name.focus();
			return;
		}
		
		var real_name		= document.getElementById("real_name");
		if (real_name.value == "")
		{
			alert("카테고리 이미지를 입력하셔야 합니다.");
			real_name.focus();
			return;
		}
		
		var cate_text		= document.getElementById("cate_text");
		if (cate_text.value == "")
		{
			alert("카테고리 설명을 입력하셔야 합니다.");
			cate_text.focus();
			return;
		}
		
		/*
		var cate_parent_seq	= document.getElementById("cate_parent_seq");
		if (cate_parent_seq.selectedIndex > 0)
		{
			var cate_seq	= document.getElementById("cate_seq");
			cate_seq.value	= "";
		}
		*/
		
		var frmCategory		= document.getElementById("frmCategory");
		frmCategory.submit();		
	});
	
	//1depth 카테고리 선택
	var cate_1dept_seq		= document.getElementById("cate_1dept_seq");
	cate_1dept_seq.addEventListener("change", function()
	{
		var cate_seq			= document.getElementById("cate_seq");
		cate_seq.value			= this.value;
		
		//var selectedSeq		= this.options[this.selectedIndex].value;
		var query			= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_cate", function(result)
		{
			if (result == "FALSE")
			{
				alert("카테고리 정보를 조회하는 중에 오류가 발생하였습니다.");
				return;
			}
			
			result	= JSON.parse(result);
			var cate_name		= document.getElementById("cate_name");
			cate_name.value		= result[0].CATE_NAME;
			
			var real_name		= document.getElementById("real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("imageFile");
			imageFile.setAttribute("src", result[0].CATE_REAL_IMAGE_PATH);
			
			var cate_text		= document.getElementById("cate_text");
			cate_text.value		= result[0].CATE_TEXT;
			
			var isCert			= document.getElementById("cate_is_cert");
			if (result[0].CATE_IS_CERT == '1')
				isCert.checked	= true;
			else
				isCert.checked	= false;
			
			core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_cate_list", function(result)
			{
				var cate_2dept_seq	= document.getElementById("cate_2dept_seq");
				while (cate_2dept_seq.firstChild)
					cate_2dept_seq.removeChild(cate_2dept_seq.firstChild);
				
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
		
		return false;
		
	}.bind(cate_1dept_seq));
	
	//2depth 카테고리 선택
	var cate_2dept_seq		= document.getElementById("cate_2dept_seq");
	cate_2dept_seq.addEventListener("change", function()
	{
		var cate_seq		= document.getElementById("cate_seq");
		cate_seq.value		= this.value;
		
		var query			= core_ajax.instance().makeQuery(null, "cate_seq", null);
		if (!query)
			return false;
		
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_cate", function(result)
		{
			result	= JSON.parse(result);
			if (result == "FALSE")
			{
				alert("하위 카테고리 정보를 조회하는 중에 오류가 발생하였습니다.");
				return;
			}
			
			var cate_name		= document.getElementById("cate_name");
			cate_name.value		= result[0].CATE_NAME;
			
			var real_name		= document.getElementById("real_name");
			real_name.value		= result[0].CATE_REAL_IMAGE_PATH;
			
			var imageFile		= document.getElementById("imageFile");
			imageFile.setAttribute("src", result[0].CATE_REAL_IMAGE_PATH);
			
			var cate_text		= document.getElementById("cate_text");
			cate_text.value		= result[0].CATE_TEXT;
			
			var isCert			= document.getElementById("cate_is_cert");
			if (result[0].CATE_IS_CERT == '1')
				isCert.checked	= true;
			else
				isCert.checked	= false;
			
			if (result[0].CATE_PARENT_SEQ != "" && result[0].CATE_PARENT_SEQ != undefined && result[0].CATE_PARENT_SEQ != null)
			{
				var cateParentSeq	= document.getElementById("cate_parent_seq");
				for (var i = 0; i < cateParentSeq.options.length; i++)
				{
					if (cateParentSeq.options[i].value == result[0].CATE_PARENT_SEQ)
					{
						cateParentSeq.options[i].selected	= true;
						break;
					}
				}	
			}
			
			return;
		});
		
		return false;
		
	}.bind(cate_2dept_seq));
});

//업로드된 파일 받기
var setFile	= function(fileData)
{
	if (fileData == undefined || fileData == null || fileData == "FALSE")
	{
		alert("파일을 업로드를 하는데 문제가 발생하였습니다.");
		return;
	}
	
	var tempPath	= fileData.temp_path;
	var realName	= fileData.real_name;
	
	var imageFile	= document.getElementById("imageFile");
	imageFile.setAttribute("src", tempPath);
	
	var temp_path	= document.getElementById("temp_path");
	var real_name	= document.getElementById("real_name");
	
	temp_path.setAttribute("value", fileData.temp_path);
	real_name.setAttribute("value", fileData.real_name);
	
	return;
}