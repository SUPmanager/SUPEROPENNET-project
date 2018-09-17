<?php
require '../define.php';
session_start();
$_SESSION['dobe']=0;
?>



<head>
<meta name="viewport" content="width=device-width">
</head>



<head>
<meta name="description" content="슈퍼넷 임시 토론장입니다.">
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
<h1>토론장</h1>

<p><font color="bdadae">임시 토론장 입니다! 보통은 의견 내시면 그 주제로 토론합니다.</p><p>단 슈퍼넷 중대토론 있으면 그
주제로 교체합니다!</font></p><p><a href="../battleground/톡톡모음.php">나가기</a></p><p><font color="ff0000">[주제]끝말잇기 많은 참여 바랍니다~^^</font></p>
<p><font color="0000ff">[공지] 한번씩만 클릭하시고 가세요! <a href="https://grabify.link/RGNMKC"> 클릭!</a></font></p>

<p></p>

<p><a href="ok.php"><font color="0100FF">의견제출</font></a> / <a href="back.php"><font color="0100FF">의견들</font></a></p>
<h2><font color="FF5E00">토론장</font></h2>
<script language='php'>
	//HOStalktalk.php 입니다.
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
<p><font color="999999">끝말잇기는 탈락방식으로 진행됩니다아</font></p>

<p><?php if(!isset($_SESSION['user'])){ echo '<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>'; }else{ echo '<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>'; } ?> / <a href="../mypage/home.php"><font color="darkBlue">마이페이지</font></a> / <a href="report.php"><font color="darkBlue">신고</font></a><p><a href="HOStalk.php"><font color="darkRed">새로고침</font></a>
<?php

$account = sessread($_SESSION['user']);

if($account=="슈퍼님"||$account=="예비"){

echo ' / <a href="../dev/index.php"><font color="darkRed">관리자 페이지</font></a>';

}
?></p>
<style>
</body>
</html>
<style>