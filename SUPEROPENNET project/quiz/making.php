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
	if(isset($_REQUEST['nick'])&&isset($_REQUEST['thing'])&&$_SESSION['dobe']!='1'){
	$error = 0;
	}
	//report.php입니다.
	if($_SESSION['dobe']=='1'){
	echo '<p>제안 테러를 막기 위한 도배 방지 회로가 작동했습니다.</p>';
	}
 	$nick = $_REQUEST['nick'];
  	$thing = $_REQUEST['thing'];
  	$reporter = sessread($_SESSION['user']);
  	$clue = $_REQUEST['clue'];
  	$success = '<p>제안되었습니다.</p><p><a href="../btalk/btalk.php"><font color="0100FF">톡톡으로 돌아가기</font></a></p>';
  	if(!$error){
   	$outputstr = "[ 제안자 : $reporter ]<br />[ 제안 장르 : $nick ]<br />[ 출제내용 : $thing ]<br />[ 정답 및 풀이 : $clue ]<hr />";//구분자삽입
   	@ $filev = fopen("submit.txt", 'ab');//열기
   	if(!$filev)
   	{
   		$success = "<p>출제에 실패했습니다! 다시 시도해 보시고, 이런 문제가 반복되면 관리자에게 문의해 주세요.</p>";
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
echo '<h1>출제</h1>

<hr />
<p>퀴즈 제안 시스템 입니다.</p>

<p>주관식만 출제 바랍니다. 객관식/서술형은 지양(비추천)됩니다. 출제자의 이름은 문제에 나오게 됩니다.</p>

<form action="making.php" method="post">
<p>제안 장르</p>

<p><input maxlength="20" name="nick" size="10" type="text" value="'.$_REQUEST['nick'].'"/></p>

<p>문제 내용</p>

<p><textarea cols="30" name="thing" rows="3">'.$_REQUEST['thing'].'</textarea></p>

<p>정답 및 풀이</p>

<p><textarea cols="30" rows="3" name="clue">'.$_REQUEST['clue'].'</textarea></p>

<p><input type="submit" value="제출" /></p>
</form>';
}
</SCRIPT>
<style>
</body>
</html>