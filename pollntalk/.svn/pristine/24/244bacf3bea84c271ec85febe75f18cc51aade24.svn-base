/**
 *	@auth	: Park Yoon Sik
 *	@date	: 20200806
 *	회원정보수정 팝업 처리 
 */

var isCheck	= false;
var isN_nameCheck = false;

/*
 * 	회원정보수정 페이지 스크립트 처리
 */

window.addEventListener("load", function()
{
	var closemodificationPopup	= document.getElementById("closemodificationPopup");
	closemodificationPopup.addEventListener("click", function()
	{
		parent.closePopup();
	});
	
	
	//닉네임 중복체크
	$("#checkN_name").click(function()
	{
		var frmSignup	= document.getElementById("sign_up");
		var n_name	= document.getElementById("n_name");
		var pre_n_name = document.getElementById("pre_n_name");
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
			
		if (n_name.value == pre_n_name.value)
		{
			isN_nameCheck	= window.confirm("사용 가능한 닉네임입니다.\r\n현재 닉네임으로 이용하시겠습니까?");
				
			if (isN_nameCheck == 1)
			{
				$("#n_name").prop("readonly", true);
			}
			else
			{
				$("#n_name").prop("readonly", false);
			}
			
			return false;
		}
		
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
	
	//park src
	//정보수정 update
	$("#updateForm").click(function()
	{
		var modification = document.forms.modification;
		var gender 	= document.getElementsByName('gender');
		var v_gender;
		
		/*if (isN_nameCheck == false){
			alert("닉네임 중복체크를 해주세요.");
			sign_up.n_name.focus();
            return false;
		}*/
		
		if(modification.email.value == "" || !validateEmail(modification.email.value))
		{
            alert("올바른 이메일 주소를 입력하세요.");
            modification.email.focus();
            return false;
        }
		
		if (!checkPassword(modification.password1.value))
			return false;
		
		if(modification.password1.value == "")
		{
            alert("비밀번호를 입력하세요.");
            modification.password1.focus();
            return false;
        }
		
		if(modification.password2.value == "")
		{
            alert("비밀번호확인를 입력하세요.");
            modification.password2.focus();
            return false;
        }
		
		if(modification.password1.value != modification.password2.value)
		{
        	alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        	modification.password1.focus();
        	return false;
		}
		
		if(modification.u_name.value == "")
		{
            alert("이름을 입력하세요.");
            modification.u_name.focus();
            return false;
        }
		
		if(modification.n_name.value == "")
		{
            alert("닉네임을 입력하세요.");
            modification.n_name.focus();
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
		
		modification.b_birth.value	= bYearValue + bMonthValue + bDayValue;
		
		if(isDate(modification.b_birth.value))
		{
            alert("생년월일을 정확히 입력하세요.");
            modification.b_day.focus();
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
    			alert("비밀번호에 영문, 숫자를 포함하여 입력해주세요.");
    			return false;
			}
    		
    		return true;
    	}
    	
    	function validateEmail(mail) 
    	{
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			return re.test(mail);
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
    	
    	modification.submit();
	});
});