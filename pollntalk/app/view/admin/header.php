<?php
if ($_SESSION["admin_seq"] == "" && $mode != "login")
    header("Location: /admin_manager.php?mode=login");
?>
<head id="head">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="/app/css/admin/common.css?v=1.7" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/default.css?v=1.2" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/member.css?v=1.1" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/login.css" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/sub.css?v=1.18" />
<link type="text/css" rel="stylesheet" href="/app/css/calendar.css" />
<!-- <link type="text/css" rel="stylesheet" href="/app/css/admin/member.css?v=1.0" /> -->
<title>폴앤톡 관리자 모드</title>
</head>