<?php
require '../define.php';
session_start();
$_SESSION['dobe']=0;
?>


<head>
<meta name="viewport" content="width=device-width">
</head>



<head>
<meta name="description" content="익명게시판 이다. ">
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
<h1>익명게시판</h1>

<p>자유 익명 게시판입니다.</p>
<p><a href="../index.php">뒤로가기</a></p><p><font color="red">[공지] NULL </font></p>
<p><font color="darkblue">[공지] 비로그인 상태에서도 글작성을 할수 있는 곳.</font></p>
<p><font color="0000ff">[공지] 한번씩만 클릭하시고 가세요! <a href="https://grabify.link/RGNMKC"> 클릭!</a></font></p>
<p></p>

<p><a href="ok.php"><font color="0100FF">글쓰기</font></a> / <a href="back.php"><font color="0100FF">이전글</font></a>                <h2><font color="FF5E00">게시판</font></h2><
<script language='php'>
	//review.php 입니다.
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
<p><font color="999999">베타 테스트 중.</font></p>

<p><?php if(!isset($_SESSION['user'])){ echo '<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>'; }else{ echo '<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>'; } ?> <p><a href="../review/review.php"><font color="darkRed">새로고침</font></a>
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