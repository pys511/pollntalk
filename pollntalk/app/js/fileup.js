/**
 *	@auth	: Park Yoon Sik
 *	@date	: 20200806
 *	파일업로드 팝업 처리 
 */

var isCheck	= false;

/*
 *  파일업로드 페이지 스크립트 처리
 */

window.addEventListener("load", function()
{
	
	var closeFileUpPopup	= document.getElementById("closeFileUpPopup");
	var extArray = new Array('jpg','png', 'gif');

	closeFileUpPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});
	
	var upload = document.getElementById("upload");
	
	upload.addEventListener("change",function()
	{
		if(window.FileReader){
               var file = $(this)[0].files[0].name;
        } 
        else {
               var file = $(this).val().split('/').pop().split('\\').pop();
        }
		
		var ext = file.slice(file.indexOf(".") + 1).toLowerCase();		
		var checkExt = false;

		for(var i = 0; i < extArray.length; i++) {
			if(ext == extArray[i]) {
				checkExt = true;
				break;
			}
		}
		
		if(checkExt == true){
			$("#file").val(file);
		}else{
			alert("JPG,png,gif 이미지 파일만 업로드 할 수있습니다.");
		}		
	});
	
	var fileUpButton	= document.getElementById("fileUpButton");
	fileUpButton.addEventListener("click", function()
	{
		file_up.submit();
	});
	
});