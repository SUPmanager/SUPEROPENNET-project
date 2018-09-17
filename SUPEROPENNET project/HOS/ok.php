<?php
require '../define.php';
 session_start();
  	if(!isset($_SESSION['user'])){
  	
 	header("Location: ../iden/login.php");
 	
 	}else if($_SESSION['from'] == 'login'){
 	



 	//출력문 다듬기
 	$name = sessread($_SESSION['user']);
 	$time2 =date('i');
   	$intermsg = "[".$time2."분에 <font color=\"green\">".$name."</font>님이 접속!]<hr />";
 	
 	//파일 처리
 	$filex = fopen("sum.txt", 'ab');
 	@ flock($filex, LOCK_EX);
 	@ fwrite($filex, $intermsg, strlen($intermsg));//쓰기
	@ flock($filex, LOCK_UN);
	
	//리다이렉트
	unset($_SESSION['from']);
	header("Location: HOStalk.php");
	exit;
 	
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
	$errored = 0;
	//ok.php입니다.
define("POST_DELAY",9);
	if(!isset($_REQUEST['thing'])){
	$errored = 1;
	}else{
 	$nick = sessread($_SESSION['user']);
 	
  	$thing = $_REQUEST['thing'];
  	$ccode = $_REQUEST['ccode'];
  	$success = "<p>글이등록되었습니다!</p><p><a href=\"HOStalk.php\"><font color=\"0100FF\">게시판으로 돌아가기</font></a></p>";
  	
  	$space[1] = "\t";
	$space[2] = "\n";
	$space[3] = "\r";
	$space[4] = "\0";
	$space[5] = "x0B";

    $thing = str_replace('  ',' ',$thing);
  	
  		if($_SESSION['dobe']==1){
	$errored = 1;
	echo "<p>도배 감지!</p>";
	$success = "";
	}
	
  	if(!isset($_SESSION['user'])){
  	$errored = 1;
  	echo '<p>로그인을 하셔야 합니다! <a href="../iden/login.php">Log in...</a></p>';
  	$success = "";
  	}
  	
	$thing = trim($thing);
	$thing = htmlentities($thing, ENT_QUOTES, "UTF-8");
	
		if($thing == ""){
			echo "<p>글 칸이 비어있으면 안됩니다!</p>";
			$success = "";
			$errored = 1;
		}
		if( strlen($ccode) != 0 ){
			if( eregi('[^0-9^a-f^A-F]', $ccode)|| strlen($ccode) != 6 ){
				echo "<p>닉염 코드가 존재하지 않습니다!</p>";
				$success = "";
				$errored = 1;
			}
		}
		if( !trim($ccode)|| $ccode == "ffffff" ){
		$ccode = "000000";
		}
	//새로운코드입니다 - 스태프 권한(isStaff 를 따로 추가시킵니다. 글자수제한에 넣었기 때문에 다른사람들 닉을 추가할 수 없던 문제를 발견했습니다)
		if($nick=="슈퍼님"){
			$isStaff = 1;
			$mcode = $_REQUEST['mcode'];
		}
	
	//사칭 방지 구간
	//사칭 방지 구간 종료
	//글자수제한
		if($nick=="슈퍼님"||$nick=="예비"){
		echo "<p>매일 꾸준한 접속은 언제나 환영이야~</p>";
		$mcode = $_REQUEST['mcode'];
		
		}else if(strlen(utf8_decode($thing)) > 1000){
		
	echo "<p>글이 너무 깁니다.</p>";
		$success = "";
		$errored = 1;
		
		}else{
		
		$thing = str_replace('\n',' ',$thing);
		
		}
		
	//포스트 생성

	$oldnick = $nick;
	$nick = "<font color=\"".$ccode."\">".$nick."</font>";
	
	if($oldnick=="슈퍼님"){
	
		$thing = '<font color="'.$mcode.'">'.$thing.'</font>';
	
	}
	
	$time =date('H:i');
   	$outputstr = "[".$time."]".$nick."<br />[".$thing."]<hr />";	//구분자삽입
   	


   	@ $filev = fopen("sum.txt", 'ab');	//열기
   	if(!$filev)
   	{
   		$success = "<p>글 등록에 실패했습니다! 다시 시도해 보시고, 이런 문제가 반복되면 관리자에게 문의해 주세요.</p>";
   		$success = "";
   		$errored = 1;
   	}
      	@ flock($filev, LOCK_EX);//락걸기
      	if(!$filev)
   	{
   		$success = "<p>일시적 에러가 발생했습니다, 이 메시지가 보이지 않을 때까지 새로고침을 하십시오.</p>";
   		$success = "";
   		$errored = 1;
   	}
   	if(!$errored){
	@ fwrite($filev, $outputstr, strlen($outputstr));//쓰기
	}
   	if(!$filev)
   	{
   		$success = "<p>일시적 에러가 발생했습니다, 이 메시지가 보이지 않을 때까지 새로고침을 하십시오.</p>";
   		$success = "";
   		$errored = 1;
   	}
   	flock($filev, LOCK_UN); //락제거
	echo $success;
	if(!$errored){
	$_SESSION['dobe'] = 1;
$_SESSION['cc'] = $ccode;
		if($oldnick=="슈퍼님"){
		$_SESSION['mc'] = $mcode;
		}
	}
}
	 if($errored){
echo '<h1>글쓰기</h1>

<hr />

<p><font color="grey">* 표시는 글과 각종 코드들로 채워넣으셔야 합니다!</font></p>

<form action="ok.php" method="post">

<p>내용*</p>

<p><textarea cols="30" name="thing" required="required" rows="3" method="get">'.$thing.'</textarea></p>

<p><font color="grey">닉염 코드 6자리</font></p>

<p><input maxlength="6" name="ccode" size="6" type="text" value="'.$_SESSION['cc'].'"/></p>';

	$checker = sessread($_SESSION['user']);
	if($checker=="슈퍼님"){
	
	$isStaff = 1;
	
	}

	if($isStaff){
	echo '<p></p><p><font color="grey">글염코드 6자리</font></p><p><input maxlength="6" name="mcode" size="6" type="text" value="'.$_SESSION['mc'].'"/></p><p></p>';
	}

echo '<p></p>

<p><input type="submit" value="확인" /></p>
</form>';

}
</SCRIPT>
<style>
</body>
</html>