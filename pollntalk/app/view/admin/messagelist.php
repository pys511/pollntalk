<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201013
 *  댓글 목록
 */
try 
{
    $keyword        = "";
    $page           = $_GET["page"];
    $member_seq     = $_GET["member_seq"];
    
    $member         = new CApp_Handler_Admin_member();
    $result         = $member->getMemberInfo($member_seq);
    
    $messageCtrl    = new CApp_Handler_Message_Ctrl();
    $count          = $messageCtrl->getMessageListCount($_POST);
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
    			<div class="contentBox">
    				<div class="boardTitle">
    					<img src="/app/images/admin/title_mark.gif" />
            			<span>쪽지 목록</span>
    				</div>
    				<!-- /admin_controller.php?mode=register_subreply_proc -->
    				<form id="frmMessage" name="frmMessage" action="/admin_controller.php?mode=message_proc" method="post">
    					<input type="hidden" id="exec" name="exec" />
						<div class="boardBox">
        					<div class="boardWriteItem">
        						<div class="boardName">
        							<span>쪽지 현황</span>
        						</div>
        						<div class="boardInputBox">
        							<span>현황 : <?php echo($count); ?>개</span>
        						</div>
        					</div>
<?php 
if ($member_seq != "")
{
    $memberName = $result["uname"];
?>
        					<div class="boardWriteItem">
        						<div class="boardName">
        							<span><?php echo($memberName); ?>님에게 쪽지 보내기</span>
        						</div>
        						<div class="boardImageInputBox">
        							<textarea id="messageContext" name="messageContext" cols="100" rows="5"></textarea>
        							<input type="hidden" id="is_all" name="is_all" value="0" />
        							<input type="hidden" id="member_seq" name="member_seq" value="<?php echo($member_seq); ?>" />
        							<!-- 버튼 -->
                					<div class="boardListButtonBox">
                						<div class="buttonBox">
                							<a id="sendall" href="javascript:void(0);">
                								<span class="buttonText">전송하기</span>
                							</a>
                						</div>
                					</div>
        						</div>
        					</div>
<?php 
}
else
{
?>
							<div class="boardWriteItem">
        						<div class="boardName">
        							<span>쪽지 보내기</span>
        						</div>
        						<div class="boardImageInputBox">
        							<textarea id="messageContext" name="messageContext" cols="100" rows="5"></textarea>
        							<input type="checkbox" id="is_all" name="is_all" value="1" />
        							<label for="is_all"> 
        								<span>전체 보내기</span>
        							</label> 
        							<!-- 버튼 -->
                					<div class="boardListButtonBox">
                						<div class="buttonBox">
                							<a id="sendall" href="javascript:void(0);">
                								<span class="buttonText">전송하기</span>
                							</a>
                						</div>
                					</div>
        						</div>
        					</div>
<?php 
}
?>
        				</div>
        				<div class="boardListButtonBox">
							<div class="buttonBox">
    							<a id="delall" href="javascript:void(0);">
    								<span class="buttonText">삭제하기</span>
    							</a>
    						</div>
						</div>
        				<div class="boardBox">
        					<div class="boardField">
        						<span class="fieldShortShort">선택</span> 
        						<span class="fieldDefault">번호</span> 
        						<span class="fieldShort">보낸사람</span>
        						<span class="fieldShort">받은사람</span>
        						<span class="fieldCommon">댓글내용</span>
        						<span class="fieldNumber">등록일</span> 
        					</div>
        					<div class="boardList">
        						<ul>
<?php
try
{
    $paging     = $messageCtrl->makePaging($count, $page);
    $result     = $messageCtrl->getMessageList($_POST, $paging);
    // 목록이 없을 경우
    if (count($result) <= 0 || $result == false) 
    {
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
        foreach ($result as $items) 
        {
            $messageSeq     = $items["MESSAGE_SEQ"];
            $messageContext = $items["MESSAGE_CONTEXT"];
            $senderName     = $items["SENDER_NAME"];
            $recverName     = $items["RECVER_NAME"];
            $recverSeq      = $items["RECVER"];
            $senderSeq      = $items["SENDER"];
            $regiDate       = $items["MESSAGE_REGI_DATE"];
?>
            						<li id="replyitem_<?php echo($messageSeq); ?>">
            							<div class="boardListItem">
        									<div class="fieldShortShort">
        										<input id="message_seq_<?php echo($messageSeq); ?>" name="message_seq[]" type="checkbox" value="<?php echo($messageSeq); ?>" />
        									</div>
        									<span class="fieldDefault"><?php echo($messageSeq); ?></span>
        									<a href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($senderSeq)?>">
        										<span class="fieldShort"><?php echo($senderName); ?></span>
        									</a>
        									<a href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($recverSeq)?>">
        										<span class="fieldShort"><?php echo($recverName); ?></span>
        									</a> 
        									<span class="fieldCommon"><?php echo($messageContext); ?></span>
        									<span class="fieldNumber"><?php echo($regiDate); ?></span>
        									<a href="javascript:removeMessage('member_seq_<?php echo($messageSeq); ?>');">
        										<span class="fieldNumber">삭제</span>
        									</a>
        								</div>
        							</li>
<?php
        }
    }
}
catch (CException $ex)
{
    $ex->executeException();   
}
?>
    							</ul>
							</div>
						</div>
    			        <!-- 페이징 -->
        				<div class="boardListButtonBox">
            				<div class="buttonLeftBox">
            					<a id="boardprev" href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($senderSeq);?>&page=<?php echo($paging["boardprev"])?>">
            						<span class="buttonText">◀</span>
            					</a>
            				</div>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
        					<div id="adverpaging" class="boardPaging">
        						<div id="pageSample" class="buttonLeftBox">
        							<a id="page" href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($senderSeq);?>&page=<?php echo($i)?>">
        								<span id="pageText" class="buttonText">
        									<?php echo($i)?>
        								</span>
        							</a>
        						</div>
        					</div>
<?php
}
?>
        					<div class="buttonLeftBox">
        						<a id="boardnext" href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($senderSeq);?>&page=<?php echo($paging["boardnext"])?>">
        							<span class="buttonText">▶</span>
        						</a>
        					</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<script type="text/javascript" src="/app/js/admin_message_list.js?v=1.1" charset="utf-8">
	</script>
<?php 
if ($_GET["replyresult"] != "")
{
?>
<script type="text/javascript">
    var replyresult	= "<?php echo($_GET["messageresult"]); ?>";
    if (replyresult == "  MESSAGE_FALSE")
       	alert("메시지를 등록하는데 실패하였습니다. 잠시 후에 다시 시도해보시기 바랍니다.");
</script>
<?php 
}
?>
</body>
</html>