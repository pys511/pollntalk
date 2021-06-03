<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201129
 *  쿠폰 등록
 */
try 
{
    $coupon_seq = $_GET["coupon_seq"];
    $coupon     = new CApp_Handler_Coupon_Ctrl();
    $result     = $coupon->getCouponInfo($coupon_seq);
    
    $coupon_seq             = $result["COUPON_SEQ"];
    $coupon_index           = $result["COUPON_INDEX"];
    $coupon_type            = $result["COUPON_TYPE"];
    $coupon_status          = $result["COUPON_STATUS"];
    $coupon_name            = $result["COUPON_NAME"];
    $coupon_context         = $result["COUPON_CONTEXT"];
    $imagePath              = $result["COUPON_IMAGE_PATH"];
    $coupon_count           = $result["COUPON_COUNT"];
    $coupon_ext_count       = $result["COUPON_EXT_COUNT"];
    $coupon_used_point      = $result["COUPON_USED_POINT"];
    $coupon_expire_date     = $result["COUPON_EXPIRE_DATE"];
    if ($coupon_expire_date == "0000-00-00 00:00:00")
        $coupon_expire_date     = "";
    
    $no_expire              = $result["COUPON_NO_EXPIRE"];
    $coupon_limited_date    = $result["COUPON_LIMITED_DATE"];
    if ($coupon_limited_date == "0000-00-00 00:00:00")
        $coupon_limited_date    = "";
    
    $is_limited             = $result["COUPON_IS_LIMIT"];
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
            	<form id="frmCoupon" method="post" action="/admin_controller.php?mode=counponregister_proc">
					<input type="hidden" id="coupon_seq" name="coupon_seq" value="<?php echo($coupon_seq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>쿠폰 등록</span>
						</div>
						<!-- 쿠폰 등록 -->
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 번호</span>
								</div>
								<div class="boardInputBox">
									<span id="coupon_index"><?php echo($coupon_index); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 유형</span>
								</div>
								<div class="boardInputBox">
									<select id="coupon_type" name="coupon_type">
										<option value="-" <?php if ($coupon_type == "") { echo("selected"); } ?>>유형 선택</option>
										<option value="1" <?php if ($coupon_type == "1") { echo("selected"); } ?>>일반 쿠폰</option>
										<option value="2" <?php if ($coupon_type == "2") { echo("selected"); } ?>>이벤트 쿠폰</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 이름</span>
								</div>
								<div class="boardInputBox">
									<input id="coupon_name" name="coupon_name" class="defaultInput" type="text" value="<?php echo($coupon_name); ?>"  />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이미지 업로드</span>
								</div>
								<div class="boardImageInputBox">
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
// 이미지 출력
if ($imagePath == "") 
{
?>
	           						<img id="imageFile" src="/app/images/admin/photo.png" width="250" />
<?php
} 
else 
{
?>
	           						<img id="imageFile" src="<?php echo($imagePath); ?>" width="250" />
<?php
}
?>
            						<div id="fileupload" class="buttonBox">
										<a href="javascript:void(0);">
											<span class="buttonText">이미지 업로드</span>
										</a>
									</div>
									<input type="hidden" id="temp_path" name="temp_path" value="<?php echo($imagePath); ?>" /> 
									<input type="hidden" id="real_name" name="real_name" value="<?php echo($imagePath); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 설명</span>
								</div>
								<div class="boardImageInputBox">
									<textarea id="coupon_context" name="coupon_context" rows="3" cols="90"><?php echo($coupon_context); ?></textarea>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>구매 가능 인원</span>
								</div>
								<div class="boardInputBox">
									<input id="coupon_count" name="coupon_count" class="defaultInput" type="number" style="ime-mode:disabled;" value="<?php echo($coupon_count); ?>" />
									<span>명</span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 잔량</span>
								</div>
								<div class="boardInputBox">
									<input id="coupon_ext_count" name="coupon_ext_count" class="defaultInput" type="text" value="<?php echo($coupon_ext_count); ?>" <?php if ($coupon_ext_count != "") { echo("checked"); } ?> />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>소진 포인트</span>
								</div>
								<div class="boardInputBox">
									<input id="coupon_used_point" name="coupon_used_point" class="defaultInput" type="text" value="<?php echo($coupon_used_point); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>상태</span>
								</div>
								<div class="boardInputBox">
									<select id="coupon_status" name="coupon_status">
										<option value="-">상태 선택</option>
										<option value="1" <?php if ($coupon_status == "1") { echo("selected"); } ?> >미게시</option>
										<option value="2" <?php if ($coupon_status == "2") { echo("selected"); } ?> >게시</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>구인기한</span>
								</div>
								<div class="boardInputBox">
									<input  type="text" id="coupon_limited_date" name="coupon_limited_date" class="defaultInput calendarbox" value="<?php echo($coupon_limited_date); ?>" />
									<input type="checkbox" id="is_limited" name="is_limited" value="1" <?php if ($is_limited == "1") { echo("checked"); } ?> />
									<label for="is_limited"> 
										<span>무제한</span>
									</label>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>유효기간</span>
								</div>
								<div class="boardInputBox">
									<input type="text" id="coupon_expire_date" name="coupon_expire_date" class="defaultInput calendarbox" value="<?php echo($coupon_expire_date); ?>" />
									<input type="checkbox" id="no_expire" name="no_expire" value="1" <?php if ($no_expire == "1") { echo("checked"); } ?>  />
									<label for="no_expire"> 
										<span>무제한</span>
									</label>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="registerCoupon" class="buttonBox">
								<a href="#"><span class="buttonText">등록하기</span></a>
							</div>
							<div id="resetCoupon" class="buttonBox">
								<a href="#"><span class="buttonText">리셋</span></a>
							</div>
							<div id="deleteCoupon" class="buttonBox">
								<a href="#"><span class="buttonText">삭제하기</span></a>
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- 파일을 업로드할 폼 -->
	<form id="frmFileUpload" method="post" action="/controller.php?mode=image_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="uploadName" name="uploadName" style="display: none" accept="image/*" />
	</form>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<!-- admin 정보 등록 js -->
	<script type="text/javascript" src="/app/js/calendar.js?v=1.4" charset="utf-8">
	</script>
	<script type="text/javascript" src="/app/js/admin_coupon_register.js?v=1.3" charset="utf-8">
	</script>
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
	<div id="calendarPopup" style="display: none">
		<div class="popuparea">
			<div id="calendarpopupBox" class="popupbox"></div>
		</div>
	</div>
</body>
</html>