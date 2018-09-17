<?php
require '../define.php';
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
}
	$user = sessread($_SESSION['user']);
	$error =false;
	
	@$conn = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
			
			if(mysqli_connect_errno()){
		
			$error = true;
		
			}else{
				
			$memId_get_q = 'select memId from member where memNick = \''.$user.'\'';
			$memId_unpure = mysqli_query($conn,$memId_get_q);
			
			if(mysqli_num_rows($memId_unpure) != 1){
				$error = true;
				$log = $log."로그인되지 않았고, ";
			}else{
				$memId_requester = mysqli_fetch_assoc($memId_unpure);
				$memId = $memId_requester['memId'];
			}
$requestnum = 1;
$num = 1;
if(isset($_REQUEST['num'])){
$requestnum = $_REQUEST['num'];
$num = $_REQUEST['num'];
}
$requestnum = ($requestnum -1)*8;
			
			$msg_list_q = 'select * from msg where msgTo = \''.$memId.'\' and msgRead != \'removed\' order by msgId desc limit '.$requestnum.' , 8';
			$msg_list_r = mysqli_query($conn,$msg_list_q);
			$msg_qu = mysqli_num_rows($msg_list_r);
			
			if($msg_qu==0){
			$log = "<p>메시지가 없습니다.</p>";
			$error = true;
			}
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
<h1>쪽지 조회</h1>
<hr />
<p><a href="list.php"><font color="red"><u>받은 쪽지</u></font></a> / <a href="send_list.php"><font color="blue">보낸 쪽지</font></a></p>
<form action="list.php">
<p>쪽지 페이지 <input type="text" maxlength="6" size="6" name="num"/></p>
<p><input type="submit" value="조회"/></p>
</form>
<p></p>
<?php
if(!$error){
	echo '<p><font color="green">'.$num.'</font>페이지를 보고 있습니다.</p>';
	
	for($i=0;$i<$msg_qu;$i=$i+1){
	
		$details = mysqli_fetch_assoc($msg_list_r);
		$viewTime = substr($details['msgTime'],5,16);
		$target_memId = $details['msgBy'];
		$subject = $details['msgTitle'];
		$msgId = $details['msgId'];
	
	$text = $details['msgText'];
	
	$isRead = '';
	if($details['msgReport']=='reported'){
	echo '<p>귀하가 신고하신 메시지를 감추었습니다.(발신자 $msgBy)</p>';
	continue;
	}else if($details['msgRead']!='read'){
	$isRead = '<br /><font color="red"><i>읽지 않음</i></font>';
	}
	
	$query_db = "select memNick from member where memId = '$target_memId'";
				$wild_result = mysqli_query($conn,$query_db);
				if(mysqli_num_rows($wild_result) != 1){
				$error = true;
				$log = $log."오류 발생, 문의 바람(코드 3), ";
				//break;
				}else{
				
				$unpured_rslt = mysqli_fetch_assoc($wild_result);
				
				$memNick = $unpured_rslt['memNick'];
				
				}		
	$j =$i+1;
	echo "<p>$j : 발신시각 : [$viewTime]<br />발신자 : [ $memNick ]".$isRead."<br />제목 : [$subject] <a href=\"view.php?msgId=".$msgId."\">&gt;&gt;읽기</a><hr />";
	;
	
	
	}
}else{
echo $log;
}
	
?>
<p><a href="send.php">쪽지 보내기</a> / <a href="../btalk/btalk.php">돌아가기</a></p><style>
</body>
</html>
<style>