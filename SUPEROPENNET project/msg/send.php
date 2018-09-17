<?php
require '../define.php';
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
}
	$user = sessread($_SESSION['user']);
	$error =false;
	$log = "<p>에러 발생 원인은 ";
	$isrequestset = true;
	
	if($_SESSION['dobe']==1){
	$error = 1;
	$log = "도배가 감지되었고, ";
	}
	
	if(!isset($_REQUEST['sendTo'])&&!isset($_REQUEST['sendTo'])&&!isset($_REQUEST['sendTo'])){
	$isrequestset = false;
	}
	
	if(!empty($_REQUEST['sendTo'])&&!empty($_REQUEST['sendTo'])&&!empty($_REQUEST['sendTo'])){
		//수신기
		$sendTo = $_REQUEST['sendTo'];
		$sendTitle = $_REQUEST['sendTitle'];
		$sendText = $_REQUEST['sendText'];
		
		$sendTo = htmlentities($sendTo,ENT_QUOTES);
		$sendTitle = htmlentities($sendTitle,ENT_QUOTES);
		$sendText = htmlentities($sendText,ENT_QUOTES);
		//보안 처리기
		if(strlen(utf8_decode($sendTo))>15||strlen(utf8_decode($sendTo))==""){
			$log = $log."수신자가 너무 길고(또는 입력되지 않음), ";
			$error=true;
		}
		if(strlen(utf8_decode($sendTitle))>15||strlen(utf8_decode($sendTitle))==""){
			$log = $log."제목이 너무 길고, ";
			$error=true;
		}
		if(strlen(utf8_decode($sendText))>90||strlen(utf8_decode($sendText))==""){
			$log = $log."내용이 너무 길고, ";
			$error=true;
		}
		//유사 XML 변경기
		$sendText = str_replace('\n',' ',$sendText);
		
		$sendText = str_replace('[엔터]','<br />',$sendText);
		
		$sendText = str_replace('[큰글씨]','</p><h2>',$sendText);
		$sendText = str_replace('[/큰글씨]','</h2><p>',$sendText);
		
		$sendText = str_replace('[빨강]','</font><font color="red">',$sendText);
		$sendText = str_replace('[초록]','</font><font color="green">',$sendText);
		$sendText = str_replace('[파랑]','</font><font color="blue">',$sendText);
		$sendText = str_replace('[검정]','</font><font color="black">',$sendText);
		//읽기 가능화
		$sendText = '<font color="black">'.$sendText.'</font>';
		if(!$error){
			
			@$conn = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
			
			if(mysqli_connect_errno()){
		
			$error = true;
			$log = $log.'데이터베이스의 에러 코드 1(관리자 문의바람), ';
		
			}else{
				//MYSQL 데이터베이스도 에러없고 나머지도 정상인 상태. 여기에 SQL 작성.
				
				$memId_get_q = 'select memId from member where memNick = \''.$user.'\'';
				$memId_unpure = mysqli_query($conn,$memId_get_q);
				if(mysqli_num_rows($memId_unpure) != 1){
				$error = true;
				$log = $log."로그인되지 않았고, ";
				}else{
				$memId_requester = mysqli_fetch_assoc($memId_unpure);
				$memId_requester = $memId_requester['memId'];
				}
				
				$memId_get_q_t = 'select memId from member where memNick =\''.$sendTo.'\'';
				$memId_unpure_t = mysqli_query($conn,$memId_get_q_t);
				if(mysqli_num_rows($memId_unpure_t) != 1){
				$error = true;
				$log = $log."메시지 수신자가 존재하지 않고, ";
				}else{
				$memId_receiver = mysqli_fetch_assoc($memId_unpure_t);
				$memId_receiver = $memId_receiver['memId'];
				}
				
				if(!$error){
					
					$PHPtime = date('Y-m-d H:i:s');
					
					$msg_send_q = "insert into msg(msgBy,msgTo,msgText,msgTitle,msgRead,msgReport,msgTime) values('$memId_requester','$memId_receiver','$sendText','$sendTitle','unread','not',ADDTIME('$PHPtime','09:00:00'))";
					$result_send = mysqli_query($conn,$msg_send_q);
					$result_end = mysqli_affected_rows($conn);
					if($result_end != 1){
				
					$error = true;
					$log = $log.'데이터베이스의 에러 코드 2(관리자 문의바람), ';
				
					}
				
				}
				
				if(!$error){
				
				$log = '<p>성공적으로 쪽지가 전달되었습니다!</p><p><a href="../btalk/btalk.php">톡톡으로</a></p>';
				$_SESSION['dobe'] = 1;
				
				}else{
				
				$log = $log."와 같은 사항들에 의해 에러가 생겼습니다.</p>";
				
				}
				
			
			}
		}
		
			
	}else if($isrequestset){
	$log = " 모든 항목이 채워지지 않아서입니다.</p>";
	$error = true;
	
	}else{
	
	$log = "";
	$error = true;
	
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
<h1>쪽지 전송</h1>
<hr />
<?php
if($error){
echo '<p>전송 대상명에는 닉네임을 입력해야 합니다.</p>
<form action="send.php" method="post">
<p>전송 대상</p>
<p><input type="text" name="sendTo" size="6" maxlength="15" value="'.$_REQUEST['sendTo'].'"/></p>
<p>제목</p>
<p><input type="text" name="sendTitle" size="6" maxlength="15" value="'.$_REQUEST['sendTitle'].'"/></p>
<p>본문</p>
<p><textarea name="sendText" rows="3" cols="30">'.$_REQUEST['sendText'].'</textarea></p>
<p><input type="submit" value="보내기" /></p>
</form>
<p>*안내 : 쪽지 시스템의 본문은 유사 XML 문법을 사용합니다. <a href="sim_xml.html">배우기...</a></p>';
}

echo $log;
?><style>
</body>
</html>
<style>