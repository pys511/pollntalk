<?php
try
{
    // 회원리스트
    // 페이지당 보여줄 회원수
    if ($list_size == "")
        $list_size = 10;

    $startNum = (int) $_GET["startNum"];
    // 회원리스트 시작 번호
    if ($startNum == "")
        $startNum = 0;

    // 보여줄 페이지수
    $page_num = 10;

    $kind = $_GET["kind"];
    $data = $_GET["data"];

    $memberCtrl = new CApp_Handler_Admin_member();
    if ($kind != '')
    {
        try
        {
            // 회원 검색
            $result         = $memberCtrl->searchOutMember($kind, $data);
            // 회원수
            $membercount    = $memberCtrl->searchOutMemberCount($kind, $data);
        }
        catch (CException $ex)
        {
            $ex->printException();
        }
    }
    else
    {
        try
        {
            // 전체회원
            $result         = $memberCtrl->getOutMemberList($startNum, $list_size);
            // 회원수
            $membercount    = $memberCtrl->getOutMembercount();
        }
        catch (CException $ex)
        {
            $ex->printException();
        }
    }
    // 페이지수
    $page_size      = floor(($membercount - 1) / $list_size);

    // 현재페이지
    $current_page   = floor($startNum / $list_size);
    $PHP_SELF       = "admin_manager.php?mode=outmemberlist";
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
				<div class="memberBox">
					<div class="memberTitle">
						<img src="/app/images/admin/title_mark.gif" /> <span>탈퇴회원목록</span>
					</div>
					<div class="memberBoxList">
						<div class="memberField">
							<span style="width: 5%">선택</span> <span style="width: 30%">이메일</span>
							<span style="width: 18%">가입일</span>
							<span style="width: 18%">탈퇴일</span>
						</div>
						<div class="memberList">
							<ul>
<?php
// 목록이 없을 경우
if (count($result) <= 0 || $result == false)
{
    ?>
        						<li id="noData">
									<div class="memberListItem">
										<div class="memberListItemGuide">
											<span>가입된 회원이 없습니다.</span>
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
?>
        						<li id="member_list">
									<div class="memberListItem">
										<div class="memberListItemCell" style="width: 5%">
											<input id="member_seq" name="member_seq[]" type="checkbox" value="<?php echo($items["member_seq"]); ?>" />
										</div>
										<span style="width: 30%"><?php echo($items["EMAIL"]); ?></span> 
            							<span style="width: 18%"><?php echo(substr($items["JOIN_DATE"],0,10)); ?></span>
            							<span style="width: 18%"><?php echo(substr($items["REGI_DATE"],0,10)); ?></span>
        							</div>
								</li>
<?php
    }
?>
        					</ul>
						</div>
					</div>
					<!-- 페이징 -->
					<div class="memberListButtonBox">
<?php
    echo ("<div id='adverpaging' class='boardPaging'>");
    $start_page = (int) ($current_page / $page_num) * $page_num;
    $end_page = $start_page + $page_num - 1;

    if ($page_size < $end_page)
        $end_page = $page_size;

    if ($start_page >= $page_num)
    {
        $prev_page = ($start_page - 1) * $list_size;
        echo ("<div class='buttonLeftBox'><a id='boardprev' href=\"$PHP_SELF&startNum=$prev_page\"><span class='buttonText'>◀</span></a></div>");
    }

    for ($i = $start_page; $i <= $end_page; $i ++)
    {
        $page = $list_size * $i; // 페이지 값을 no 값으로 변환
        $page_num = $i + 1; // 실제 페이지 값이 0부터 시작하므로 표시할때는 1을 더해준다.

        echo ("<div id='pageSample' class='buttonLeftBox'>");
        if ($startNum != $page)
        {
            echo ("<a href=\"$PHP_SELF&startNum=$page\">");
        }

        echo ("<span id='pageText' class='buttonText'>[$page_num]</span>"); // 페이지를 표시

        if ($startNum != $page)
        {
            echo ("</a>");
        }

        echo ("</div>");
    }

    if ($page_size > $end_page)
    {
        // 다음 페이지 리스트는 마지막 리스트 페이지보다 한 페이지 증가하면 된다.
        $next_page = ($end_page + 1) * $list_size;
        echo ("<div class='buttonLeftBox'><a id='boardprev' href=\"$PHP_SELF&startNum=$next_page\"><span class='buttonText'>▶</span></a></div>");
    }

    echo ("</div>");
?>
					</div>
<?php
}
?>        							
				</div>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
<script type="text/javascript" src="/app/js/admin_member.js" charset="utf-8"></script>
</body>
</html>