<?php
//게시판 보기
try 
{
    // 게시판View 처리
    $num            = $_GET["num"];
    $sub            = $_GET["sub"];
    
    $board          = new CApp_Handler_Board_Ctrl();
    $result         = $board->getBoardContext($num);
    if ($sub == "")
        $sub        = $result["TYPE_NAME"];
        
    $updatcount     = $board->updateBoardCount($num);
    
    $preNum     = $board->getPreView($sub, $num);
    $nextNum    = $board->getNextView($sub, $num);
} 
catch (CException $ex) 
{
    $ex->printException();
}

?>
<div class="content">
	<!-- 게시판 영역 시작 -->
	<div class="boardarea">
		<div class="boardviewbox">
			<div class="tabmenu">
<?php 
if($sub == "notice")
{
    echo("<div class='tabbuttonbox'>
        <button class='tabbuttonon'>
        <span class='title'>공지사항</span>
        </button>
        </div>
        <div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=faq'>
        <button class='tabbuttonoff'>                        				        
        <span class='disabletitle'>자주하는 질문</span>
        </button>
        </a>
        </div>
        <div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=support'>
        <button class='tabbuttonoff'>
        <span class='disabletitle'>1:1 고객지원</span>
        </button>
        </a>
        </div>"
        );
}
else if($sub == "faq")
{
    echo("<div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=notice'>
        <button class='tabbuttonoff'>
        <span class='disabletitle'>공지사항</span>
        </button>
        </a>
        </div>
        <div class='tabbuttonbox'>
        <button class='tabbuttonon'>
        <span class='title'>자주하는 질문</span>
        </button>
        </div>
        <div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=support'>
        <button class='tabbuttonoff'>
        <span class='disabletitle'>1:1 고객지원</span>
        </button>
        </a>
        </div>"
        );
}
else
{
    echo("<div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=notice'>
        <button class='tabbuttonoff'>
        <span class='disabletitle'>공지사항</span>
        </button>
        </a>
        </div>
        <div class='tabbuttonbox'>
        <a href='/?mode=customer&sub=faq'>
        <button class='tabbuttonoff'>
        <span class='disabletitle'>자주하는 질문</span>
        </button>
        </a>
        </div>
        <div class='tabbuttonbox'>
        <button class='tabbuttonon'>
        <span class='title'>1:1 고객지원</span>
        </button>
        </div>"
        );
}
?>
			</div>
			<!-- 게시판 안내 -->
			<div class="boardguide">
<?php 
	if($sub == "notice")
	{
	    echo("<div class='boardtopic'>
	        <span>공지사항/이벤트</span>
	        </div>
	        <div class='boarddoc'>
	        <!--<span>폴앤톡에서 알려드리는 공지사항과 이벤트입니다.</span>-->
	        </div>"
	        );
	}
	else if($sub == "faq")
	{
	    echo("<div class='boardtopic'>
	        <span>자주하는 질문</span>
	        </div>
	        <div class='boarddoc'>
	        <!--<span>폴앤톡에 자주하는질문입니다.</span>-->
	        </div>"
	        );
	}
	else
	{
	    echo("<div class='boardtopic'>
	        <span>1:1 고객지원</span>
	        </div>
	        <div class='boarddoc'>
	        <!--<span>폴앤톡에 문의하세요./span>-->
	        </div>"
	        );
	}
?>
			</div>
			<div class="boardcontent">
				<!-- 게시판 View 시작  -->
				<div class="boardcontent">
					<!-- 게시판 보기 시작  -->
					<div class="boardsubjectbox">
						<div class="boardsubject bline">
							<span><?php echo($result["SUBJECT"]); ?></span>
						</div>
						<div class="writedate">
							<span><?php echo($result["CREATE_DATE"]); ?></span>
						</div>
					</div>
					<div class="boardwriterbox">
						<div class="memberinfo">
							<span><?php echo($result["NAME"]); ?></span>
						</div>
						<div class="viewcount">
							<span>조회수 : <?php echo($result["COUNT"]); ?></span>
						</div>
					</div>
					<div class="boardcontext">
						<p><?php echo($result["CONTEXT"]); ?></p>
						<div class="boardfilebox">
							<span class="boardfiletitle">첨부파일</span>
    						<ul class="boardfilelist">
<?php 
try
{
    $result = $board->getBoardFileList($num);
}
catch (CException $ex)
{
    $ex->printException();
}

foreach ($result as $item)
{
?>
    							<li>
    								<a href="/controller.php?mode=file_download&file_seq=<?php echo(ATTACH_FILE_SEQ); ?>">
    									<span><?php echo($item["FILE_NAME"]); ?></span>
    								</a>
    							</li>
<?php
}
?>
    						</ul>
    					</div>
					</div>
				</div>
<?php 
if($sub == "support")
{
    try
    {
        // 1대1 고객지원 처리
        $board->updateChildBoardCount($num);
        $result     = $board->getChildBoardContext($num);
        $context    = $result["CONTEXT"];
        $memberSeq  = $result["MEMBER_SEQ"];
        $context    = str_replace("\"", "'", $context);
    }
    catch (CException $ex)
    {
        $ex->printException();
    }
?>
				<div class="boardcontent">
					<!-- 게시판 보기 시작  -->
					<div class="boardsubjectbox">
						<div class="boardsubject bline">
							<span>답변 : <?php echo($result["SUBJECT"]); ?></span>
						</div>
						<div class="writedate">
							<span><?php echo($result["CREATE_DATE"]); ?></span>
						</div>
					</div>
					<div class="boardwriterbox">
						<div class="memberinfo">
							<span><?php echo($result["NAME"]); ?></span>
						</div>
						<div class="viewcount">
							<span>조회수 : <?php echo($result["COUNT"]); ?></span>
						</div>
					</div>
					<div class="boardcontext">
						<p><?php echo($result["CONTEXT"]); ?></p>
						<div class="boardfilebox">
							<span class="boardfiletitle">첨부파일</span>
    						<ul class="boardfilelist">
<?php 
try
{
    $result = $board->getBoardFileList($result["NUM"]);
}
catch (CException $ex)
{
    $ex->printException();
}

foreach ($result as $item)
{
?>
    							<li>
    								<a href="/controller.php?mode=file_download&file_seq=<?php echo($item["ATTACH_FILE_SEQ"]); ?>">
    									<span><?php echo($item["FILE_NAME"]); ?></span>
    								</a>
    							</li>
<?php
}
?>
    						</ul>
    					</div>
					</div>
				</div>
<?php 
}
?>
				<div class="boardbuttonbox">
					<div class="boardbuttonleft">
<?php 
if($preNum[0]['NUM'] != "")
{  
?>
						<button type="button" >
							<a href="/?mode=boardView&sub=<?php echo($sub.'&num='.$preNum[0]['NUM']);?>">
								<span>< 이전</span>
							</a>
						</button>
<?php 
}

if($nextNum[0]['NUM'] != "")
{  
?>
						<button type="button" >
							<a href="/?mode=boardView&sub=<?php echo($sub.'&num='.$nextNum[0]['NUM']);?>">
								<span>다음 ></span>
							</a>
						</button>
<?php 
}
?>
					</div>
					<div class="boardbuttonright">
<?php
if ($sub == "support" && $_SESSION["member_seq"] == $memberSeq)
{
?>
						<button type="button" >
							<a href="/?mode=boardwrite&num=<?php echo($num); ?>">
								<span>수정하기</span>
							</a>
						</button>
<?php 
}
?>
						<button type="button" >
							<a href="/?mode=customer&sub=<?php echo($sub); ?>">
								<span>목록</span>
							</a>
						</button>
					</div>
				</div>
				<!-- 게시판 View 끝 -->
			</div>
			<!-- 텝 컨텐츠 끝 -->
		</div>
	</div>
	<!-- 게시판 영역 끝 -->
</div>