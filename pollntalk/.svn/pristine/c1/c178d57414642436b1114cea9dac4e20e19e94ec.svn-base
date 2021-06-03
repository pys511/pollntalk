<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  상품 관리자 페이지
 */
try 
{
    $serviceSeq         = $_GET["service_seq"];
    $productCtrl        = new CApp_Handler_Product_Ctrl();
    $productInfo        = $productCtrl->getProductInfo($serviceSeq);
    $productType        = $productInfo["SERVICE_TYPE"];
    $productName        = $productInfo["SERVICE_NAME"];
    $productContext     = $productInfo["SERVICE_CONTEXT"];
    $paymentType        = $productInfo["SERVICE_PAYMENT_TYPE"];
    $productPrice       = $productInfo["SERVICE_PRICE"];
    $isOpen             = $productInfo["SERVICE_IS_OPEN"];
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
            	<form id="frmProduct" method="post" action="/admin_controller.php?mode=product_proc">
					<input type="hidden" id="service_seq" name="service_seq" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>상품 등록</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>서비스 유형</span>
								</div>
								<div class="boardInputBox">
									<select id="product_type" name="product_type" class="inputSelect">
										<option value="-">-</option>
										<option value="1" <?php if ($productType == "1") echo("selected"); ?> >프리미엄 서비스</option>
										<option value="2" <?php if ($productType == "2") echo("selected"); ?> >이벤트 투표</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>서비스 이름</span>
								</div>
								<div class="boardInputBox">
									<input id="product_name" name="product_name" class="middleInput" type="text" value="<?php echo($productName); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>서비스 내용</span>
								</div>
								<div class="boardInputBox">
									<input id="product_context" name="product_context" class="longInput" type="text" value="<?php echo($productContext); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>결제 유형</span>
								</div>
								<div class="boardInputBox">
									<select id="payment_type" name="payment_type" class="inputSelect">
										<option value="-">-</option>
										<option value="1" <?php if ($paymentType == "1") echo("selected"); ?> >무통장입금</option>
										<option value="2" <?php if ($paymentType == "2") echo("selected"); ?> >카드결제</option>
										<option value="3" <?php if ($paymentType == "3") echo("selected"); ?> >휴대폰결제</option>
            						</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>가격</span>
								</div>
								<div class="boardInputBox">
									<input id="product_price" name="product_price" class="defaultInput" type="text" value="<?php echo($productPrice); ?>" />
									<span>원</span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>적용 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" id="product_is_open" name="product_is_open" value="1" <?php if ($isOpen == "1") echo("checked"); ?> />
									<label for="product_is_open"> 
										<span>적용</span>
									</label> 
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="deleteService" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="resetService" href="javascript:void(0)">
									<span class="buttonText">리셋</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerService" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="categorybox">
									<span>상품 유형</span> 
									<select id="service_type" name="service_type" size="10">
										<option value="1" >프리미엄 서비스</option>
										<option value="2" >이벤트 투표</option>
                                    </select>
								</div>
								<div class="categorybox">
									<span>상품 목록</span> 
									<select id="service_list" name="service_list" size="10">
										<option value="" >-</option>
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
	<script type="text/javascript" src="/app/js/admin_product_register.js?v=1.5" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
</body>
</html>