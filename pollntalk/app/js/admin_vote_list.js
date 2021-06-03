/**
 * @auth   	: JEON JY
 * @date	: 20201003
 * 서비스 처리
 */

window.addEventListener("load", function() 
{
	var	cate_seq	= document.getElementById("cate_seq");
	cate_seq.addEventListener("change", function()
	{
		if (this.options[this.selectedIndex].value == "-")
			return;
			
		var vote_cate_seq	= document.getElementById("vote_cate_seq");
		vote_cate_seq.value	= this.options[this.selectedIndex].value;
		var frmVote			= document.getElementById("frmVote");
		frmVote.submit();
	}.bind(cate_seq));
	
	//2depth 카테고리 선택
	var cate_sub_seq		= document.getElementById("cate_sub_seq");
	cate_sub_seq.addEventListener("change", function()
	{
		if (this.options[this.selectedIndex].value == "-")
			return;
			
		var vote_cate_sub_seq	= document.getElementById("vote_cate_sub_seq");
		vote_cate_sub_seq.value	= this.options[this.selectedIndex].value;
		var frmVote				= document.getElementById("frmVote");
		frmVote.submit();
	}.bind(cate_sub_seq));
});