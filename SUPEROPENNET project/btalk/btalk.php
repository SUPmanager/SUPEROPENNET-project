<?php
   header('Content-Type: text/html; charset=utf-8');
?>


<?php
require '../define.php';
session_start();
$_SESSION['dobe']=0;
?>


<head>
<meta name="viewport" content="width=device-width">
</head>



<head>
<meta name="description" content="SKT계열 오픈넷의 '우리끼리톡톡'이라는 게시판을 추모하는 마음으로 작명하였다. ">
</head>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    	<meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" type="text/css" rel="stylesheet" />
	</head><body>
<h1>우리끼리톡톡</h1>

<p>자유 게시판 입니다.</p>
<p><a href="../index.php">뒤로가기</a></p><p><font color="red">[공지] 7월 8일 2018년 서비스종료!</p>
<p></p>
<p><a href="ok.php"><font color="0100FF">글쓰기</font></a> / <a href="back.php"><font color="0100FF">이전글</font></a> / <a href="../battleground/톡톡모음.php"><font color="0100ff">톡톡모음</font></a> / <a href="../quiz/quiz.php"><font color="0100ff">퀴즈풀기</a></p></font>                                  <h2><font color="FF5E00">게시판</font></h2>
<script language='php'>
	//btalk.php 입니다.
	$pathtxt = "sum.txt";
	
	@ $wri = fopen("sum.txt", 'rb'); //파일 열기
	if(!$wri){
	$errorp = "<p><font color=red></font></p>"; //파일 안열림
	echo $errorp;//경고출력
	exit;//종료
	}
	fseek($wri, -1000, SEEK_END);
	$mem = fread($wri, 1000);
	echo nl2br($mem);
	fclose($wri);
</SCRIPT>

<p></p>
<p><font color="999999">새로운 시작, 슈퍼넷</font></p>

<p><?php if(!isset($_SESSION['user'])){ echo '<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>'; }else{ echo '<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>'; } ?> / <a href="../btalk/report.php"><font color="Darkblue">Q&A</font></a> / <a href="../atalk/atalk.php"><font color="darkBlue">방명록</font></a> / <a href="../msg/list.php"><font color="darkBlue">쪽지함</font></a></p><p><a href="../mypage/home.php"><font color="darkRed">마이페이지</font></a><p><a href="../btalk/btalk.php"><font color="darkRed">새로고침</font></a>
<?php

$account = sessread($_SESSION['user']);

if($account=="DNA"||$account=="예비"){

echo ' / <a href="../dev/index.php"><font color="darkRed">관리자 페이지</font></a>';

}
?></p>
</body>
</html>