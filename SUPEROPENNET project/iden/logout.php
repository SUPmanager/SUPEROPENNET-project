<?php
 session_start();
 if (!isset($_SESSION['user'])) {
  header("Location: login.php");
 }
  if(isset($_GET['ok'])){
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: login.php");
  }
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    	<meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" type="text/css" rel="stylesheet" />
	</head>
<body>
<h1>로그아웃</h1>

<hr />
<p>정말로 로그아웃 하시겠습니까?</p>
<form action="" method="get">
<input type="hidden" value="ok" name="ok" />
<p><input type="submit" value="네" /> / <a href="../btalk/btalk.php">아니오</a></p>

</form>
<style>
</body>
</html>