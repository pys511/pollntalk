<?php
$mode = $_GET[CONST_WEB_MESSAGE::MODE];
if ($mode == "")
    $mode   = "main";

if ($mode == "main" || 
    $mode == "votelist" || 
    $mode == "voteform" || 
    $mode == "voteformlist" || 
    $mode == "votewrite" ||
    $mode == "vote_register" ||
    $mode == "voteview" ||
    $mode == "vote_result") 
{
?>
<script type="text/javascript" src="/app/js/category.js?v=1.2" charset="utf-8">
</script>
<?php
}

if ($mode == "votewrite")
{
?>
<script type="text/javascript" src="/app/js/vote.js?v=1.0" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/calendar.js?v=1.4" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/votewrite.js?v=1.39" charset="utf-8">
</script>
<?php
}

if ($mode == "voteform")
{
?>
<script type="text/javascript" src="/app/js/voteform.js?v=1.1" charset="utf-8">
</script>
<?php     
}

if ($mode == "vote_register")
{
?>
<script type="text/javascript" src="/app/js/vote_register.js?v=1.4" charset="utf-8">
</script>
<?php
}

if ($mode == "vote_result")
{
?>    
<script type="text/javascript" src="/app/js/lib/canvasjs-3.2.3/canvasjs.min.js" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/vote_result.js?v=1.18" charset="utf-8">
</script>
<?php
}

$mypage = "";
if ($mode == "mypage")
{
    $sub        = $_GET["sub"]; 
    $mypage     .= "mypage_";
    if ($sub == "vote")
    {
        $mypage     .= "vote";
    }
}
if ($mode == "voteview" || $mypage == "mypage_vote")
{
?>
<script type="text/javascript" src="/app/js/voteview.js?v=1.27" charset="utf-8">
</script>
<?php 
}
else if ($sub == "mallcoupon")
{
?>
<script type="text/javascript" src="/app/js/mall.js?v=1.0" charset="utf-8">
</script>
<?php 
}
else if ($sub == "message")
{
?>
<script type="text/javascript" src="/app/js/message.js?v=1.0" charset="utf-8">
</script>
<?php
}
?>