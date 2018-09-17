<?php
require '../define.php';
session_start();
$_SESSION['dobe']=0;
?>


<head>
<meta name="viewport" content="width=device-width">
</head>



<head>
<meta name="description" content="신고게시판입니다. ">
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
<h1>신고게시판</h1>

<p>자유 신고 게시판 입니다.</p>
<p><a href="../index.php">뒤로가기</a></p><p><font color="red">[공지] 신고가 클ㅡ린한 슈퍼넷을 만들어줍니다. </font></p>
<p><font color="darkblue">[공지] 어그로, 허위신고, 타 유저 비방하는 악성 신고행위가 발견될 경우 계정정지.</font></p><p></p>

<p><a href="ok.php"><font color="0100FF">글쓰기</font></a> / <a href="back.php"><font color="0100FF">이전글</font></a>                               <h2><font color="FF5E00">게시판</font></h2>
<script language='php'>
	//REPORT.php 입니다.
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
<p><font color="999999">신고게시판 오픈.</font></p>

<p><?php if(!isset($_SESSION['user'])){ echo '<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>'; }else{ echo '<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>'; } ?><p><a href="../reporting/REPORT.php"><font color="darkRed">새로고침</font></a>
<?php

$account = sessread($_SESSION['user']);

if($account=="슈퍼님"||$account=="예비"){

echo ' / <a href="../dev/index.php"><font color="darkRed">관리자 페이지</font></a>';

}
?></p>
<style>
</body>
</html>