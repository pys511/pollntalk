<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210423
 *  문의 사항 관리자 페이지
 */
try
{
    $seq        = $_GET["num"];
    $mainCtrl   = new CApp_Handler_Util_AdSetting();
    if($seq != "")
    {
        $result             = $mainCtrl->getAd($seq);
    
        $ad_index           = $result["ad_index"];
        $ad_subject         = $result["ad_subject"];
        $ad_position        = $result["ad_position"];
        $ad_type            = $result["ad_type"];
        $ad_use             = $result["ad_use"];
        $pcRealImage        = $result["ad_realimg"];
        $pcTempImage        = $result["ad_tempimg"];
        $mobileRealImage    = $result["ad_mrealimg"];
        $mobileTempImage    = $result["ad_mtempimg"];
        $ad_url             = $result["ad_url"];
        $ad_script          = $result["ad_script"];
    }
    
    $count      = $mainCtrl->getAdCount();
    $page       = $_GET["page"];
    $paging     = $mainCtrl->makePaging($count, $page);
    $list       = $mainCtrl->getAdList($paging);
    
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html id="start" xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body id="body">
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
				<form id="frmAdver" name="frmAdver" method="post" action="/admin_controller.php?mode=adSetting_proc">
					<input type="hidden" id="ad_index" name="ad_index" value="<?php echo($ad_index);?>" />
					<input type="hidden" id="proc_name" name="proc_name" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>광고 등록</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>제목</span>
								</div>
								<div class="boardInputBox">
									<input id="ad_subject" name="ad_subject" class="longInput" type="text" value="<?php echo($ad_subject); ?>"/>
								</div>
								<div class="boardName">
									<span>타입</span>									
								</div>
								<div class="boardInputBox">
								<select id="ad_type" name="ad_type">
    									<option value="1" <?php if($ad_type == "1")echo("selected='selected'")?>>이미지형</option>
    									<option value="2" <?php if($ad_type == "2")echo("selected='selected'")?>>스크립트형</option>
    							</select>
								</div>
								<div class="boardName">
									<span>위치</span>									
								</div>
								<div class="boardInputBox">
								<select name="ad_position">
    									<option value="1" <?php if($ad_position == "1")echo("selected='selected'")?>>메인</option>
    									<option value="2" <?php if($ad_position == "2")echo("selected='selected'")?>>투표 리스트</option>
    									<option value="3" <?php if($ad_position == "3")echo("selected='selected'")?>>투표 양식</option>
    									<option value="4" <?php if($ad_position == "4")echo("selected='selected'")?>>투표 양식 보기</option>
    									<option value="5" <?php if($ad_position == "5")echo("selected='selected'")?>>투표 보기</option>
    									<option value="6" <?php if($ad_position == "6")echo("selected='selected'")?>>투표 결과</option>
    									<option value="7" <?php if($ad_position == "7")echo("selected='selected'")?>>이벤트 투표 목록</option>
    									<option value="8" <?php if($ad_position == "8")echo("selected='selected'")?>>핫이슈 투표 목록</option>
    									<option value="9" <?php if($ad_position == "9")echo("selected='selected'")?>>프리미엄 투표 목록</option>
    									<option value="10" <?php if($ad_position == "10")echo("selected='selected'")?>>검색 결과</option>
    							</select>
								</div>
								<div class="boardName">
									<span>사용여부</span>
								</div>
								<div class="boardInputBox">
									<input type="radio" id="use" name="ad_use" value="Y" <?php if($ad_use != "N")echo("checked='checked'")?>/>
									<label for="use"> <span class="buttonText">사용</span></label> 
									<input type="radio" id="unused" name="ad_use" value="N" <?php if($ad_use == "N")echo("checked='checked'")?>/> 
									<label for="unused"> <span class="buttonText">비사용</span></label>
								</div>
								<div id="type_img" <?php if($ad_type != "2"){echo("style='display:block'");}else{echo("style='display:none'");}?>>
									<div class="boardName">
										<span>PC 이미지</span>
									</div>
									<div class="boardImageInputBox" >
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
// 이미지 출력
if ($pcRealImage == "") 
{
?>
	           							<img id="pc_imageFile" src="/app/images/admin/photo.png" width="250" />
<?php
} 
else 
{
?>
	           							<img id="pc_imageFile" src="/<?php echo($pcTempImage); ?>" width="500" />
<?php
}
?>
            							<div id="pc_fileupload" class="buttonBox">
											<a href="javascript:void(0);">
												<span class="buttonText">이미지 업로드</span>
											</a>
										</div>
										<input type="hidden" id="pc_temp_path" name="pc_temp_path" value="<?php echo($pcTempImage); ?>" /> 
										<input type="hidden" id="pc_real_name" name="pc_real_name" value="<?php echo($pcRealImage); ?>" />
									</div>
									<div class="boardName">
										<span>모바일 이미지</span>
									</div>
									<div class="boardImageInputBox">
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
// 이미지 출력
if ($mobileRealImage == "") 
{
?>
	           							<img id="mobile_imageFile" src="/app/images/admin/photo.png" width="250" />
<?php
} 
else 
{
?>
	           							<img id="mobile_imageFile" src="/<?php echo($mobileTempImage); ?>" width="500" />
<?php
}
?>
            							<div id="mobile_fileupload" class="buttonBox">
											<a href="javascript:void(0);">
												<span class="buttonText">이미지 업로드</span>
											</a>
										</div>
										<input type="hidden" id="mobile_temp_path" name="mobile_temp_path" value="<?php echo($mobileTempImage); ?>" /> 
										<input type="hidden" id="mobile_real_name" name="mobile_real_name" value="<?php echo($mobileRealImage); ?>" />
									</div>
									<div class="boardName">
										<span>URL</span>
									</div>
									<div class="boardInputBox">
										<input id="ad_url" name="ad_url" class="longInput" type="text" value="<?php echo($ad_url); ?>"/>
									</div>
								</div>
								<div id="type_script" <?php if($ad_type == "2"){echo("style='display:block'");}else{echo("style='display:none'");}?>>
									<div class="boardName">
										<span>스크립트</span>
									</div>
									<div class="contentTextArea">
										<textarea id="ad_script" name="ad_script" rows="10" cols="0"><?php echo($ad_script); ?></textarea>
									</div>
								</div>
							</div>
						</div>					
					    <!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="registerAd" class="buttonBox">
								<a href="javascript:void(0)">
									<span class="buttonText">등록</span>
								</a>
							</div>
							<div id="deleteAd" class="buttonBox">
								<a href="javascript:void(0)">
									<span class="buttonText">삭제</span>
								</a>
							</div>
							<div id="initAd" class="buttonBox">
								<a href="javascript:void(0)">
									<span class="buttonText">초기화</span>
								</a>
							</div>
						</div>
					</div>
				</form>
				<div class="contentBox">
					<div class="boardTitle">
						<img src="/app/images/admin/title_mark.gif" /> 
						<span>광고 리스트</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span style="width: 10%">번호</span>
							<span style="width: 50%">제목</span>
							<span style="width: 10%">위치</span>
							<span style="width: 10%">사용여부</span>
							<span style="width: 20%">등록일</span> 
						</div>
						<div class="boardList">
							<ul>
<?php
// 목록이 없을 경우
if (count($list) <= 0 || $list == false) {
?>
        						<li id="noData">
									<div class="boardListItem">
										<div class="borderListItemGuide">
											<span>등록된 컨텐츠가 없습니다.</span>
										</div>
									</div>
								</li>
<?php
} // 목록이 있을 경우
else 
{
    // $length = count($result);
    foreach ($list as $items) 
    {
?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<span style="width: 10%"> <?php echo($items["ad_index"]); ?>
        								</span> 
        								<a id="adverName" href="/admin_manager.php?mode=adversetting&num=<?php echo($items["ad_index"]); ?>"> 
        									<span style="width: 50%"> <?php echo($items["ad_subject"]); ?>
        									</span>
        								</a>
        								<!-- 메인 중단 1
								                       투표 중단 2 -->
        								<span style="width: 10%"> 
<?php
    	switch ($items["ad_position"])
    	{
    	    case "1":
    	        echo("메인");
    	        break;
    	    case "2":
    	        echo("투표리스트");
    	        break;
    	    case "3":
    	        echo("투표 양식");
    	        break;
    	    case "4":
    	        echo("투표 양식 보기");
    	        break;
    	    case "5":
    	        echo("투표 보기");
    	        break;
    	    case "6":
    	        echo("투표 결과");
    	        break;
    	    case "7":
    	        echo("이벤트 투표 목록");
    	        break;
    	    case "8":
    	        echo("핫이슈 투표 목록");
    	        break;
    	    case "9":
    	        echo("프리미엄 투표 목록");
    	        break;
    	    case "10":
    	        echo("검색 결과");
    	        break;
    	    default:
    	        echo("");
    	}      
?>
        								</span>
        								<span style="width: 10%"> <?php if($items["ad_use"] == "Y"){echo("사용");}else{echo("비사용");} ?>
        								</span>
        								<span style="width: 20%"> <?php echo($items["ad_regidate"]); ?>
        								</span>
									</div>
								</li>
<?php
    }
}
?>
        					</ul>
						</div>
					</div>
					<!-- 페이징 -->
					<div class="boardListButtonBox">
						<div class="buttonLeftBox">
							<a id="boardprev" href="/admin_manager.php?mode=adversetting&page=<?php echo($paging["boardprev"])?>">
								<span class="buttonText">◀</span>
							</a>
						</div>
						<div id="adverpaging" class="boardPaging">
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
    						<div class="buttonLeftBox">
								<a id="page" href="/admin_manager.php?mode=adversetting&page=<?php echo($i)?>">
									<span id="pageText" class="buttonText">
										<?php echo($i)?>        								
    								</span>
								</a>
							</div>
<?php
}
?>
        				</div>
						<div class="buttonLeftBox">
							<a id="boardnext" href="/admin_manager.php?mode=adversetting&page=<?php echo($paging["boardnext"])?>">
								<span class="buttonText">▶</span>
							</a>
						</div>
					</div>
            	</div>
			</div>
		</div>
	</div>
	<!-- 파일을 업로드할 폼 -->
	<form id="frmPcFileUpload" method="post" action="/admin_controller.php?mode=ad_pc_image_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="pc_image" name="pc_image" style="display: none" accept="image/*" />
	</form>
	<form id="frmMobileUpload" method="post" action="/admin_controller.php?mode=ad_mobile_image_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="mobile_image" name="mobile_image" style="display: none" accept="image/*" />
	</form>
	<script type="text/javascript" src="/app/js/adSetting.js?v=1.01"></script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
	</body>
</html>