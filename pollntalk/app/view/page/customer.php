<?php
// 회원리스트
// 페이지당 보여줄 회원수
$sub = $_GET["sub"];
try 
{
    // 공지 사항 처리
    $board      = new CApp_Handler_Board_Ctrl();
    $count      = $board->getboardcount("2");
    $page       = $_GET["page"];
    $paging     = $board->makePaging($count, $page);
    $result     = $board->getBoardList($sub, $paging);
} 
catch (CException $ex) 
{
    $ex->printException();
}

$PHP_SELF = "/?mode=customer&sub=".$sub;
?>
<div class="content">
	<!-- 게시판 영역 시작 -->
	<div class="boardarea">
		<div class="boardbox">
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
        <span class='disabletitle'>공지사항/이벤트</span>
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
        <span>공지사항</span>
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
        <span>서비스요청/에러신고</span>
        </div>
        <div class='boarddoc'>
        <!--<span>폴앤톡에 서비스요청및 에러신고입니다.</span>-->
        </div>"
        );
}
?>
			</div>
			<div class="boardcontent">
				<!-- 게시판 시작  -->
				<div class="board">
					<!-- 게시판 필드 시작 -->
					<div class="boardfieldbox">
						<div class="larealong">
							<div class="boardnumber">
								<span>번호</span>
							</div>
							<div class="boardmember">
								<span>작성자</span>
							</div>
						</div>
						<div class="rareashort">
							<div class="boardtitlelong">
								<span>제목</span>
							</div>
							<div class="boarddate">
								<span>날짜</span>
							</div>
							<div class="boardshort">
								<span>조회</span>
							</div>
						</div>
					</div>
					<!-- 게시판 필드 끝 -->
					<!-- 게시판 목록 시작 -->
					<div class="boardlist">
						<ul>
						<!-- 게시판 목록 시작 	-->
<?php 
foreach ($result as $items) 
{
?>
        					<li>
								<div class="larealong">
									<div class="boardnumber">
										<span><?php echo($items["NUM"]); ?></span>
									</div>
									<div class="boardmember">
										<span><?php echo($items["NAME"]); ?></span>
									</div>
								</div>
								<div class="rareashort">
									<div class="boardtitlelong">
<?php 
    if ($_SESSION["member_seq"] != "")
    {
        if ($sub != "support")
        {
?>
										<a href="/?mode=boardView&sub=<?php echo($sub.'&num='.$items['NUM']);?>">
<?php
        }
        else
        {
            if ($_SESSION["member_seq"] != $items["MEMBER_SEQ"] )
            {
?>
										<a href="javascript:alert('조회할 권한이 없습니다.');">				
<?php 
            }
            else
            {
?>   
   										<a href="/?mode=boardView&sub=<?php echo($sub.'&num='.$items['NUM']);?>">
<?php 
            }
        }
    }
    else
    {
?>										
										<a href="javascript:callLogin();">
<?php 
    }
?>
											<span><?php echo($items["SUBJECT"]); ?></span>
										</a>
									</div>
									<div class="boarddate wview">
										<span><?php echo($items["CREATE_DATE"]); ?></span>
									</div>
									<div class="boardshort">
										<span><?php echo($items["COUNT"]); ?></span>
									</div>
								</div>
							</li>
<?php
}
?>

						</ul>
						
						<!-- 게시판 목록 끝 -->
						<!-- 페이징 시작 -->
						<div class="paging">
							<div class="pagingbutton pageleft pagenavinoselect">
							</div>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
							<div class="pagingbutton">
								<span><?php echo($i); ?></span>
							</div>
<?php
}
?>							
							<div class="pagingbutton pageright pagenaviselect">
							</div>
						</div>
						<!-- 페이징 끝 -->
					</div>
					<!-- 게시판 목록 영역 끝 -->
				</div>
				<!-- 게시판 끝 -->
<?php 
if($sub == 'support')
{
?>
				<!-- 게시판 버튼 시작 -->
				<div class="boardbuttonbox">
					<div class="boardbuttonright">						
<?php 
    if ($_SESSION["member_seq"] != "")
    {
?>
							<a href='/?mode=boardwrite&sub=<?php echo($sub); ?>'>
<?php
    }
    else
    {
?>
							<a href="javascript:callLogin()">
<?php    
    }
?>
							<button>
								<span>글쓰기</span>
							</button>
						</a>
					</div>
				</div>
				<!-- 게시판 버튼 끝 -->
<?php 
}
?>
			</div>
			<!-- 텝 컨텐츠 끝 -->
		</div>
	</div>
	<!-- 게시판 영역 끝 -->
</div>