/**
 * 	@auth   : JEON JY
 * 	@date	: 20200913
 * 	포인트 몰 상세
 */
window.addEventListener("load", function() 
{
	var buyCoupon	= document.getElementById("buyCoupon");
	if (buyCoupon != null)
	{
		buyCoupon.addEventListener("click", function()
		{
			var coupon_seq	= document.getElementById("coupon_seq");
			if (coupon_seq.value == "")
			{
				alert("잘못된 접근으로 처리를 할 수 없습니다.");
				return;	
			}	
			
			var query		= core_ajax.instance().makeQuery(null, "coupon_seq", null);
			if (!query)
				return false;
				
			core_ajax.instance().send(query, null, "/controller.php?mode=buy_coupon_proc", function(result)
			{
				if (result == "FALSE")
				{
					alert("쿠폰 구매를 처리하는 중에 문제가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
					return;
				}
				else
				{
					alert("구매되었습니다.");
					location.href	= "/index.php?mode=mypage&sub=coupon";
					return;
				}
			});
		})
	}
	
	//구매시 인증
	var buyCouponCert = document.getElementById("buyCouponCert");
	if(buyCouponCert != null){
		buyCouponCert.addEventListener("click", function()
		{	
			alert("본인인증 후 이용 가능하십니다.");
			window.open("/kcpcert/WEB_ENC/kcpcert_start.php",'','width=610, height=210, scrollbars=no');
		});
	}
});