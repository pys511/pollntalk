/**
 * @auth   	: JEON JY
 * @date	: 20201003
 * 계좌번호 처리
 */

window.addEventListener("load", function() 
{
	var bank_account_list	= document.getElementById("bank_account_list");
	bank_account_list.addEventListener("change", function()
	{
		var account				= this.options[this.selectedIndex].value;
		var bank_account_seq	= document.getElementById("bank_account_seq");
		bank_account_seq.value	= account;
		var query				= core_ajax.instance().makeQuery(null, "bank_account_seq", null);
		if (!query)
			return false;
				 
		core_ajax.instance().send(query, null, "/admin_controller.php?mode=get_bankaccount", function(result)
		{
			if (result == "FALSE")
			{
				alert("계좌 정보를 요청하였으나 조회가 되지 않았습니다.");
				return;
			}
			
			result					= JSON.parse(result);
			
			var account_seq			= document.getElementById("account_seq");
			account_seq.value 		= result.ACCOUNT_SEQ;
			
			var bank_account_name	= document.getElementById("bank_account_name");
			bank_account_name.value = result.ACCOUNT_NAME;
			
			var bank_account_number		= document.getElementById("bank_account_number");
			bank_account_number.value 	= result.ACCOUNT_NUMBER;
			
			return;
		});	
	}.bind(bank_account_list));
	
	var registerAccount		= document.getElementById("registerAccount");
	registerAccount.addEventListener("click", function()
	{
		var bank_account_name	= document.getElementById("bank_account_name");
		if (bank_account_name.value == "")
		{
			alert("은행 계좌 이름을 입력하시기 바랍니다.");
			bank_account_name.focus();
			return;
		}
		
		var bank_account_number	= document.getElementById("bank_account_number");
		if (bank_account_number.value == "")
		{
			alert("계좌번호를 입력하시기 바랍니다.");
			bank_account_number.focus();
			return;
		}
		
		var frmBankAccount		= document.getElementById("frmBankAccount");
		frmBankAccount.submit();
	});
});