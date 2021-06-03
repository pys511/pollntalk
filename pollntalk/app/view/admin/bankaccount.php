<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200929
 *  입금 계좌 관리
 */
try
{
    $accountSeq         = $_GET["account_seq"];
    $productCtrl        = new CApp_Handler_Product_Ctrl();
    $productInfo        = $productCtrl->getBankAccount($accountSeq);
    $accountSeq         = $productInfo["ACCOUNT_SEQ"];
    $accountName        = $productInfo["ACCOUNT_NAME"];
    $accountNumber      = $productInfo["ACCOUNT_NUMBER"];
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body>
	<div id="mobilemenu" class="mobileMenu" style="display: none;">
		<!-- 서브메뉴 -->
	</div>
	<div class="pageArea">
<?php
require_once ('./app/view/admin/common.php');
?>	
		<div id="content" class="pageBox">
			<!-- content -->
			<div class="contentArea">
<?php
require_once ('./app/view/admin/submenu.php');
?>	
            	<form id="frmBankAccount" method="post" action="/admin_controller.php?mode=bank_account_proc">
					<input type="hidden" id="account_seq" name="account_seq" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>입금 계좌 등록</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>은행 계좌 이름</span>
								</div>
								<div class="boardInputBox">
									<input id="bank_account_name" name="bank_account_name" class="defaultInput" type="text" value="<?php echo($productName); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>계좌 번호</span>
								</div>
								<div class="boardInputBox">
									<input id="bank_account_number" name="bank_account_number" class="middleInput" type="text" value="<?php echo($productContext); ?>" />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="deleteAccount" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerAccount" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
<?php 
$accountlist    = $productCtrl->getBankAccountList();
?>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="banklistbox">
									<span>입금 계좌 목록</span> 
									<input type="hidden" id="bank_account_seq" name="bank_account_seq" />
									<select id="bank_account_list" name="bank_account_list" size="10">
<?php 									
for ($i = 0; $i < count($accountlist); $i++)
{
    $accountSeq     = $accountlist[0]["ACCOUNT_SEQ"];
    $accountName    = $accountlist[0]["ACCOUNT_NAME"];
    $accountNumber  = $accountlist[0]["ACCOUNT_NUMBER"];
?>
										<option value="<?php echo($accountSeq); ?>" ><?php echo($accountName);?>[<?php echo($accountNumber) ?>]</option>
<?php
}
?>
								    </select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<!-- admin 정보 등록 js -->
	<script type="text/javascript" src="/app/js/admin_account_register.js?v=1.5" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
</body>
</html>