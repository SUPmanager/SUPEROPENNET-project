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
<meta name="description" content="SKT계열 오픈넷의 방명록을 기념하였다.">
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
<h1>방명록</h1>

<p>방명록 입니다.</p>
<p><a href="../index.php">뒤로가기</a></p><p><font color="ff0000">[공지] NULL</font></p>
<p></p>

<p><a href="ok.php"><font color="0100FF">글쓰기</font></a> / <a href="back.php"><font color="0100FF">이전글</font></a></p>
<h2><font color="FF5E00">방명록</font></h2>
<script language='php'>
	//atalk.php 입니다.
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
<p><font color="grey">NULL.</font></p>

<p><?php if(!isset($_SESSION['user'])){ echo '<a href="../iden/login.php"><font color="Darkblue">로그인</font></a>'; }else{ echo '<a href="../iden/logout.php"><font color="Darkblue">로그아웃</font></a>'; } ?> / <a href="../mypage/home.php"><font color="darkBlue">마이페이지</font></a> / <a href="report.php"><font color="darkBlue">신고</font></a><p><a href="atalk.php"><font color="darkRed">새로고침</font></a>
<?php

$account = sessread($_SESSION['user']);

if($account=="DNA"||$account=="HG"||$account=="sisi"){

echo ' / <a href="../dev/index.php"><font color="darkRed">관리자 페이지</font></a>';

}
?></p>
</body>
</html>