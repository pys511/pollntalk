<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200929
 *  검색어관리
 */
try
{
    $productCtrl = new CApp_Handler_Search_Ctrl();
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
            	<form id="frmkeyword" method="post" action="/admin_controller.php?mode=register_keyword_proc">
					<input type="hidden" id="keyword_seq" name="keyword_seq" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>검색어 목록</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>검색어</span>
								</div>
								<div class="boardInputBox">
									<input id="keyword_name" name="keyword_name" class="defaultInput" type="text" />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="deletekeyword" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerkeyword" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
<?php 
$keywordlist    = $productCtrl->getkeywordList();
?>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="banklistbox">
									<span>검색어 목록</span> 
									<input type="hidden" id="keyword_seq" name="keyword_seq" />
									<select id="keyword_list" name="keyword_list" size="10">
<?php 									
for ($i = 0; $i < count($keywordlist); $i++)
{
    $keywordName    = $keywordlist[$i]["KEYWORD_NAME"];
    $keywordSeq     = $keywordlist[$i]["KEYWORD_SEQ"];
?>
										<option value="<?php echo($keywordSeq); ?>"><?php echo($keywordName);?></option>
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
	<script type="text/javascript" src="/app/js/keyword_register.js?v=1.4" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
</body>
</html>