/**
 * 패스워드 변경 처리
 */

window.addEventListener("load", function()
{
	
	//엔터막기
	document.addEventListener('keydown', function(event) {
  		if (event.keyCode === 13) {
    		event.preventDefault();
  		};
	}, true);
	
	//park src
	//회원가입 validate
	$("#changeForm").click(function()
	{
		var password_change = document.forms.password_change;
		
		if(password_change.authNum.value == "")
		{
            alert("인증번호를 입력하세요.");
            password_change.authNum.focus();
            return false;
        }

		if(password_change.password1.value == "")
		{
            alert("비밀번호를 입력하세요.");
            password_change.password1.focus();
            return false;
        }

		if (!checkPassword(password_change.password1.value))
			return false;
		
		if(password_change.password2.value == "")
		{
            alert("비밀번호확인를 입력하세요.");
            password_change.password2.focus();
            return false;
        }
		
		if(password_change.password1.value != password_change.password2.value)
		{
        	alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        	sign_up.password1.focus();
        	return false;
		}
		
    	
    	//비밀번호 체크
    	function checkPassword(password)
    	{
    		var number		= password.search(/[0-9]/g);
    		var english		= password.search(/[a-z]/ig);
    		
    		if (password.length < 8 || password.length > 16)
			{
    			alert("비밀번호는 8자리 ~ 16자리 이내로 입력해주세요.");
    			return false;
			}
    		
    		if (password.search(/\s/) != -1)
			{
    			alert("비밀번호는 공백없이 입력해주세요.");
    			return false;
			}
    		
    		if (number < 0 || english < 0)
			{
    			alert("비밀번호는 영문, 숫자를 포함하여 입력해주세요.");
    			return false;
			}
    		
    		return true;
    	}
    	
    	password_change.submit();
		
	});
});