<?php
require '../define.php';
session_start();
$_SESSION['dobe']=0;
?>

<head>
<meta name="viewport" content="width=device-width">
</head>


<head>
<meta name="description" content="마이페이지 입니다.">
</head>




<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    	<meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" type="text/css" rel="stylesheet" />
	</head>
<body>
<h1>마이페이지</h1>

<p><font color="ff0000"> 개발중.</font></p>


<p>"동시 접속자 수 입니다."</p>
<script id="_waux9p">var _wau = _wau || []; _wau.push(["dynamic", "cli2a9djve", "x9p", "c4302bffffff", "small"]);</script><script async src="//waust.at/d.js"></script>

<p></p>

<a href="../msg/send.php"><font color="0100ff">쪽지전송</font></a> / <a href="../quiz/quiz.php"><font color="0100ff">퀴즈풀기 </font></a> /  <a href="../atalk/atalk.php"><font color="0100ff">방명록</font></a> / <a href="../battleground/톡톡모음.php"><font color="0100ff">톡톡모음</font></a>  / <a href="../NOVELtalk/NOVELtalk.php"><font color="0100ff">소설게시판</font></a><p></p><p><?php if(!isset($_SESSION['user'])){echo'<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>';}else{echo'<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>';}?><p></p>
<p></p>
<p></p>
<p></p>
<?php  $account=sessread($_SESSION['user']);   if($account=="DNA"||$account=="예비"){   echo'  <a href="../dev/index.php"><font color="darkRed">관리자페이지</font></a>';}?></p> 
<p></p>	


<p><font color="grey">마이페이지에 오신 것을 환영합니다 <?php $pr=sessread($_SESSION['user']); echo $pr; ?>님!</p></p>	

<p><a href="../btalk/btalk.php"><font color="ff0000">[인기]</font>우리끼리톡톡</a></p > 


<div id=ipipipip1>로딩 중...</div>
<script src=http://www.ipipipip.net/data/ipipipip1.js>
</script>
<p></p>
</body>
</html>