<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201016
 *  받은 메시지 조회
 */
try
{
    $page           = $_GET["page"];
    
    $paging         = $message->makePaging($recvcount, $page);
    $result         = $message->getRecvMessageList($keyword, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!-- 쪽지 버튼 영역 시작 -->
<div class="messagebuttonbox">
	<button type="button" id="deletebutton" class="messagebutton">
		<span>삭제</span>
	</button>
	<button class="messagebutton brspace">
		<span>답장</span>
	</button>
</div>
<!-- 쪽지 버튼 영역 끝 -->
<form id="frmMessageList" method="post" action="/controller.php?mode=del_message">
	<input type="hidden" id="mypageName" name="mypageName" value="recv" />
    <!-- 쪽지 게시판 시작  -->
    <div class="board">
    	<!-- 쪽지 필드 시작 -->
    	<div class="boardfieldbox">
    		<div class="larealong">
    			<div class="boardcheckbox">
    				<input type="checkbox" />
    			</div>
    			<div class="boardmember">
    				<span>보낸 사람</span>
    			</div>
    		</div>
    		<div class="rareashort">
    			<div class="boardtitle">
    				<span>내용</span>
    			</div>
    			<div class="boarddate">
    				<span>날짜</span>
    			</div>
    			<div class="boardbutton">
    				<span>차단</span>
    			</div>
    		</div>
    	</div>
    	<!-- 쪽지 필드 끝 -->
    	<!-- 쪽지 게시판 목록 시작 -->
    	<div class="boardlist">
    		<!-- 쪽지 게시판 목록 시작 -->
    		<ul>
<?php
$i  = 0;
foreach ($result as $items)
{
    $messageSeq         = $items["MESSAGE_SEQ"];
    $messageType        = $items["MESSAGE_TYPE"];
    $sender             = $items["SENDER"];
    $senderName         = $items["NNAME"];
    $senderPic          = $items["PIC"];
    $recver             = $items["RECVER"];
    $viewChecker        = $items["VIEW_CHECK"];
    $messagePos         = $items["MESSAGE_POS"];
    $messageContext     = $items["MESSAGE_CONTEXT"];
    $messageRefUrl      = $items["MESSAGE_REF_URL"];
    $messageRegiDate    = $items["MESSAGE_REGI_DATE"];
    
    $className  = "class='mrspace'";
    $ext        = $i % 2;
    $i++;
?>
    			<li>
    				<div class="larealong">
    					<div class="boardcheckbox">
    						<input id="message_seq_<?php echo($i); ?>" name="message_seq[]" type="checkbox" value="<?php echo($messageSeq); ?>" />
    					</div>
    					<div class="boardmember">
    						<img src="/<?php echo($senderPic); ?>" /> 
    						<span><?php echo($senderName); ?></span>
    					</div>
    					<div class="boarddate mview">
    						<span><?php echo($messageRegiDate); ?></span>
    					</div>
    				</div>
    				<div class="rareashort">
    					<div class="boardtitle">
    						<span><?php echo($messageContext); ?></span>
<?php 
    if ($messageRefUrl != "")
    {
?>
							<span>
								<a href="<?php echo($messageRefUrl); ?>">&nbsp;&nbsp;[바로가기]</a>
							</span>
<?php 
    }
?>
    					</div>
    					<div class="boarddate wview">
    						<span><?php echo($messageRegiDate); ?></span>
    					</div>
    					<div class="boardbutton">
    						<button class="messagebutton">
    							<span>차단</span>
    						</button>
    					</div>
    				</div>
    			</li>
<?php 
}
?>
    		</ul>
    		<!-- 쪽지 게시판 목록 끝 -->
    		<!-- 페이징 시작 -->
    		<div class="paging">
    			<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
    			<a id="boardprev" href="/?mode=mypage&sub=message&messagesub=recv&page=<?php echo($paging["boardprev"])?>">
    				<div class="pagingbutton pageleft pagenavinoselect">
    				</div>
    			</a>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
    if ($page == "")
        $page   = "1";
?>
    			<div class="pagingbutton <?php if($page == $i) echo("pageselect"); ?>">
    				<a id="page" href="/?mode=mypage&sub=message&messagesub=recv&page=<?php echo($i)?>">
    					<span><?php echo($i)?></span>
    				</a>
    			</div>
<?php
}
?>
    			<a id="boardprev" href="/?mode=mypage&sub=message&messagesub=recv&page=<?php echo($paging["boardnext"])?>">
    				<div class="pagingbutton pageright pagenaviselect">
    				</div>
    			</a>
    		</div>
    		<!-- 페이징 끝 -->
    	</div>
    	<!-- 쪽지 게시판 목록 영역 끝 -->
    </div>
</form>