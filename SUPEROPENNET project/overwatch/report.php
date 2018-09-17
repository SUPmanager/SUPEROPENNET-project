<?php
session_start();
require '../define.php';
if(!isset($_SESSION['user'])){
header("Location: ../iden/login.php");
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

<script language='php'>
$error = 1;
	if(isset($_REQUEST['nick'])&&isset($_REQUEST['thing'])&&isset($_SESSION['user'])&&isset($_REQUEST['clue'])&&$_SESSION['dobe']!='1'){
	$error = 0;
	}
	//report.php입니다.
	if($_SESSION['dobe']=='1'){
	echo '<p>반복신고는 금지입니다.</p>';
	}
 	$nick = $_REQUEST['nick'];
  	$thing = $_REQUEST['thing'];
  	$reporter = sessread($_SESSION['user']);
  	$clue = $_REQUEST['clue'];
  	$success = '<p>신고되었습니다.</p><p><a href="overwatchtalk.php"><font color="0100FF">게시판으로 돌아가기</font></a></p>';
  	if(!$error){
  	$clue = $clue."페이지";
   	$outputstr = "[ 신고자 : $reporter ]<br />[ 신고 대상: $nick ]<br />[ 신고내용 : $thing ]<br />[ 증거 : $clue ]<hr />";//구분자삽입
   	@ $filev = fopen("report.txt", 'ab');//열기
   	if(!$filev)
   	{
   		$success = "<p>신고에 실패했습니다! 다시 시도해 보시고, 이런 문제가 반복되면 관리자에게 문의해 주세요.</p>";
   		exit;
   	}
      	@ flock($filev, LOCK_EX);//락걸기
      	if(!$filev)
   	{
   		$success = "<p>일시적 에러가 발생했습니다, 이 메시지가 보이지 않을 때까지 새로고침을 하십시오.</p>";
   		exit;
   	}
	@ fwrite($filev, $outputstr, strlen($outputstr));//쓰기
   	if(!$filev)
   	{
   		$success = "<p>일시적 에러가 발생했습니다, 이 메시지가 보이지 않을 때까지 새로고침을 하십시오.</p>";
   		exit;
   	}
   	flock($filev, LOCK_UN); //락제거
	echo $success;  //메시지출력
} else{
echo '<h1>신고</h1>

<hr />
<p>신고 시스템 입니다.</p>

<p>허위 신고는 무조건 차단입니다! 모든 항목을 다 채우지 않으면 신고가 전송되지 않습니다!</p>

<form action="report.php" method="get">
<p>신고 대상 닉네임</p>

<p><input maxlength="20" name="nick" size="10" type="text" value="'.$_REQUEST['nick'].'"/></p>

<p>신고 내용</p>

<p><textarea cols="30" name="thing" rows="3">'.$_REQUEST['thing'].'</textarea></p>

<p>증거 페이지</p>

<p><input maxlength="6" name="clue" size="5" type="text" value="'.$_REQUEST['clue'].'"/></p>

<p><input type="submit" value="신고" /></p>
</form>';
}
</SCRIPT>

<style>
</body>
</html>