<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201029
 *  입금 계좌 관리
 */
try
{
    $position           = $_GET["position"];
    $pointCtrl          = new CApp_Handler_Point_Ctrl();
    $pointInfo          = $pointCtrl->getPointByPosition($position);
    $pointSeq           = $pointInfo["POINT_SEQ"];
    $pointPosition      = $pointInfo["POINT_POSITION"];
    $point              = $pointInfo["POINT"];
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
            	<form id="frmPoint" method="post" action="/admin_controller.php?mode=point_info_proc">
					<input type="hidden" id="point_seq" name="point_seq" value="<?php echo($pointSeq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>포인트 설정 관리</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>포인트 지급 위치</span>
								</div>
								<div class="boardInputBox">
									<select id="point_position_list" name="point_position_list" class="inputSelect">
										<option value="-">-</option>
										<option value="101" <?php if ($pointPosition == "101") { echo("selected"); } ?> >일반 투표 개설</option>
										<option value="102" <?php if ($pointPosition == "102") { echo("selected"); } ?> >일반 투표 참여</option>
										<option value="111" <?php if ($pointPosition == "111") { echo("selected"); } ?> >이벤트 투표 개설</option>
										<option value="112" <?php if ($pointPosition == "112") { echo("selected"); } ?> >이벤트 투표 참여</option>
										<option value="121" <?php if ($pointPosition == "121") { echo("selected"); } ?> >회원 가입 추천</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>지급 포인트</span>
								</div>
								<div class="boardInputBox">
									<input id="point" name="point" class="defaultInput" type="text" value="<?php echo($point); ?>" /><span>point</span>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="resetPoint" href="javascript:void(0)">
									<span class="buttonText">리셋</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="deletePointInfo" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerPointInfo" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
<?php 
$pointList    = $pointCtrl->getPointList();
?>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="banklistbox">
									<span>포인트 설정 목록</span> 
									<input type="hidden" id="point_position" name="point_position" />
									<select id="point_list" name="point_list" size="10">
<?php 									
for ($i = 0; $i < count($pointList); $i++)
{
    $pointPosition  = $pointList[$i]["POINT_POSITION"];
    $positionName   = $pointList[$i]["POINT_POSITION_NAME"];
    $point          = $pointList[$i]["POINT"];
?>
										<option value="<?php echo($pointPosition); ?>" ><?php echo($positionName);?>[포인트 : <?php echo($point) ?>]</option>
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
	<script type="text/javascript" src="/app/js/admin_point_register.js?v=1.5" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
</body>
</html>