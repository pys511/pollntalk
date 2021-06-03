/**
 *	@auth	: Park Yoon Sik
 *	@date	: 20200806
 *	회원가입 팝업 처리 
 */

var isEmailCheck	= false;
var isN_nameCheck = false;
var isAuthCheck = false;
/*
 * 	회원가입 페이지 스크립트 처리
 */
window.addEventListener("load", function()
{
	//회원가입 팝업 종료
	var closeJoinPopup	= document.getElementById("closeJoinPopup");
	closeJoinPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});
	
	//엔터막기
	document.addEventListener('keydown', function(event) {
  		if (event.keyCode === 13) {
    		event.preventDefault();
  		};
	}, true);
	
	
	//이메일 중복체크
	$("#checkEmail").click(function()
	{
		var frmSignup	= document.getElementById("sign_up");
		var email	= document.getElementById("email");
		var authNum	= document.getElementById("authNum");
		var query		= core_ajax.instance().makeQuery(frmSignup, "email", function()
		{
			if (email.value == "")
			{
				alert("이메일을 입력하셔야 합니다.");
				return false;
			}
			
			if(email.value == "" || !validateEmail(email.value))
			{
            	alert("올바른 이메일 주소를 입력하세요.");
            	sign_up.email.focus();
            	return false;
        	}
		    
			return true;
		});
		
		function validateEmail(mail) 
    	{
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			return re.test(mail);
		}
		
		if (!query)
			return false;
		
		var result;
		core_ajax.instance().send(query, null, "/controller.php?mode=email_check", function(result)
		{
			
			if (result == 1)
			{	
				isEmailCheck = window.confirm("사용 가능한 이메일입니다.\r\n현재 이메일로 이용하시겠습니까?");
				
				if (isEmailCheck == 1){
					$("#email").prop("readonly", true);
				}
				else
				{
					$("#email").prop("readonly", false);
					authNum.value = "";
					isAuthCheck = false;
					
				}
				
			}
			else{
				alert("이미 사용중인 이메일입니다.");
			}
			return;
			
		});
		
		return false;
	});
	
		
	//닉네임 중복체크
	$("#checkN_name").click(function()
	{
		var frmSignup	= document.getElementById("sign_up");
		var n_name	= document.getElementById("n_name");
		var query	= core_ajax.instance().makeQuery(frmSignup, "n_name", function()
		{
			if (n_name.value == "")
			{
				alert("닉네임을 입력하셔야 합니다.");
				return false;
			}
			
			return true;
		});
		
		if (!query)
			return false;
		
		var result;
		core_ajax.instance().send(query, null, "/controller.php?mode=n_name_check", function(result)
		{
			
			if (result == 1)
			{	
				isN_nameCheck	= window.confirm("사용 가능한 닉네임입니다.\r\n현재 닉네임으로 이용하시겠습니까?");
				
				if (isN_nameCheck == 1){
					$("#n_name").prop("readonly", true);
				}
				else
				{
					$("#n_name").prop("readonly", false);
				}
			}
			else{
				alert("이미 사용중인 닉네임입니다.");
			}
			return;
			
		});
		
		return false;
	});
	
	//인증메일  발송
	$("#auth").click(function()
	{
		var frmSignup	= document.getElementById("sign_up");
		var email	= document.getElementById("email");
		var authNum	= document.getElementById("authNum");
		
		authNum.value =	generateRandomCode(6);
		
		if(email.value == ""){
			alert("이메일을 입력하셔야 합니다.");
			return false;			
		}
		
		if (isEmailCheck == false){
			alert("이메일 중복체크를 해주세요.");
			sign_up.email.focus();
            return false;
		}
		
		var query	= core_ajax.instance().makeQuery(frmSignup, "email", function()
		{
			if (email.value == "")
			{
				alert("이메일을 입력하셔야 합니다.");
				return false;
			}
			
			return true;
		});
		
		if (!query)
			return false;
				
		var result;
		core_ajax.instance().send(query, null, "/controller.php?mode=send_authNum_ctrl&authNum="+authNum.value, function(result)
		{
			
			if (result == 1)
			{	
				alert("인증 메일을 전송하였습니다.");
			}
			else{
				alert("시스템문제로 잠시 후 이용부탁드립니다.");
			}
			return;
			
		});
		
		return false;
		
	});
	
	function generateRandomCode(n) {
  		let str = ''
  		for (let i = 0; i < n; i++) {
    		str += Math.floor(Math.random() * 10)
  		}
  		return str
	}

	//인증메일 확인
	$("#checkAuth").click(function()
	{
		var authNum = document.getElementById("authNum");
		var inputAuthNum = document.getElementById("inputAuthNum");
		
		if(inputAuthNum.value == ""){
			alert("인증번호를 입력하셔야 합니다.");
			return false;
		}
		
		if(inputAuthNum.value == authNum.value){
			alert("인증되었습니다.");
			isAuthCheck = true;
			
		}
		else{
			alert("인증번호가 잘못되었습니다. 다시 확인하시고 입력 부탁드립니다.");	
		}
		
		return false;
		
	});
	
	
	//park src
	//회원가입 validate
	$("#validateForm").click(function()
	{
		var sign_up = document.forms.sign_up;
		var gender 	= document.getElementsByName('gender');
		var agree 	= document.forms.sign_up.agree.checked;
		var v_gender;
		
		if (isEmailCheck == false){
			alert("이메일 중복체크를 해주세요.");
			sign_up.email.focus();
            return false;
		}
		
		if (isN_nameCheck == false){
			alert("닉네임 중복체크를 해주세요.");
			sign_up.n_name.focus();
            return false;
		}
		
		if (isAuthCheck == false){
			alert("이메일인증을 해주세요.");
			sign_up.inputAuthNum.focus();
            return false;
		}
		
		if(sign_up.password1.value == "")
		{
            alert("비밀번호를 입력하세요.");
            sign_up.password1.focus();
            return false;
        }

		if (!checkPassword(sign_up.password1.value))
			return false;
		
		if(sign_up.password2.value == "")
		{
            alert("비밀번호확인를 입력하세요.");
            sign_up.password2.focus();
            return false;
        }
		
		if(sign_up.password1.value != sign_up.password2.value)
		{
        	alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        	sign_up.password1.focus();
        	return false;
		}
		
		if(sign_up.u_name.value == "")
		{
            alert("이름을 입력하세요.");
            sign_up.u_name.focus();
            return false;
        }
		
		if(sign_up.n_name.value == "")
		{
            alert("닉네임을 입력하세요.");
            sign_up.n_name.focus();
            return false;
        }
		
		var bYear		= document.getElementById("b_year");
		var bYearValue	= bYear.options[bYear.selectedIndex].value;
		if (bYearValue == "-")
		{
			alert("생년월일을 입력하셔야 합니다.");
			return false;
		}
		
		var bMonth		= document.getElementById("b_month");
		var bMonthValue	= bMonth.options[bMonth.selectedIndex].value;
		if (bMonthValue == "-")
		{
			alert("생년월일을 입력하셔야 합니다.");
			return false;
		}
		
		if (bMonthValue.length <= 1)
			bMonthValue = "0" + bMonthValue;
		
		var bDay		= document.getElementById("b_day");
		var bDayValue	= bDay.options[bDay.selectedIndex].value;
		if (bDayValue == "-")
		{
			alert("생년월일을 입력하셔야 합니다.");
			return false;
		}
		
		if (bDayValue.length <= 1)
			bDayValue = "0" + bDayValue;
		
		sign_up.b_birth.value	= bYearValue + bMonthValue + bDayValue;
		
		if(isDate(sign_up.b_birth.value))
		{
            alert("생년월일을 정확히 입력하세요.");
            sign_up.b_day.focus();
            return false;
        }
		
		var gender_check = 0;
    	for(var i = 0; i<gender.length; i++)
    	{
        	if(gender[i].checked==true)
        	{
            	v_gender = gender[i].value;                	
            	gender_check ++;
        	}
    	}
    	
    	if(gender_check==0)
    	{
        	alert("성별을 선택해주세요");
        	return false;
    	}
    	
    	if(!agree)
    	{
        	alert('이용약관 및 개인정보처리방침에 동의해주세요.');
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
    	
    	function isDate(txtDate) 
    	{
			var currVal = txtDate;
			if (currVal == '')
    			return true;

			var rxDatePattern = /^(\d{4})(\d{1,2})(\d{1,2})$/;                  
			var dtArray = currVal.match(rxDatePattern);
			if (dtArray == null)
    			return true;

			dtYear = dtArray[1];
            dtMonth = dtArray[2];
            dtDay = dtArray[3];
            
            if (dtMonth < 1 || dtMonth > 12)
                return true;
            else if (dtDay < 1 || dtDay > 31)
                return true;
            else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
                return true;
            else if (dtMonth == 2) 
            {
                var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
                if (dtDay > 29 || (dtDay == 29 && !isleap))
                    return true;
            }
            
            return false;
        }
    	
    	sign_up.submit();
		
	});
});