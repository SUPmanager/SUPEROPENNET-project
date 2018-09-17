<?php
	require '../define.php';
	session_start();
	if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
	}
	$user = sessread($_SESSION['user']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<link href="../default.css" rel="stylesheet" type="text/css" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<style>
	span{
		background-color: 77ccee;
	}
	</style>
</head>
<body>
<h1>쪽지 읽기</h1>
<hr />
<?php

$msgId = $_REQUEST['msgId'];

@$conn = mysqli_connect('localhost','사용자 계정명','사용자 계정 비밀번호','사용자 계정명');
			
			if(mysqli_connect_errno()){
		
			$error = true;
			$log = $log.'데이터베이스의 에러 코드 1(관리자 문의바람), ';
		
			}else{
				//MYSQL 데이터베이스도 에러없고 나머지도 정상인 상태. 여기에 SQL 작성.
				
				$query_db = "select * from msg where msgId = '".$msgId."'";
				$wild_result = mysqli_query($conn,$query_db);
				if(mysqli_num_rows($wild_result) != 1){
				$error = true;
				$log = $log."존재하지 않는 쪽지입니다 ";
				}else{
				
				$number_of_result = mysqli_num_rows($wild_result);
				$ns = $number_of_result;
				
					$array_1 = mysqli_fetch_assoc($wild_result);
					$memId_sender = $array_1['msgBy'];
					$memId_receiver = $array_1['msgTo'];
					$msgText = $array_1['msgText'];
					$msgTitle = $array_1['msgTitle'];
					$msgTime = substr($array_1['msgTime'],5,16);
					
				
				}
			}
			
				//MYSQL 데이터베이스도 에러없고 나머지도 정상인 상태. 여기에 SQL 작성.
				
				$query_1 = "select memNick from member where memId = '".$memId_sender."'";
				$result_w = mysqli_query($conn,$query_1);
				if(mysqli_num_rows($result_w) != 1){
				$error = true;
				$log = $log."계삭되었거나 삭제된, 또는 처음부터 없는 계정이 보낸 쪽지입니다.";
				}else{

					$array_result_1 = mysqli_fetch_assoc($result_w);
					$memNick_sender = $array_result_1['memNick'];

				
				}
				
				$query_2 = "select memNick from member where memId = '".$memId_receiver."'";
				$result_e = mysqli_query($conn,$query_2);
				if(mysqli_num_rows($result_e) != 1){
				$error = true;
				$log = $log."로그인되지 않았고, ";
				}else{

					$array_result_2 = mysqli_fetch_assoc($result_e);
					$memNick_receiver = $array_result_2['memNick'];

				
				}
				if($memNick_receiver != $user){
				$error = true;
				}
				
				$query_3 = "update msg set msgRead='read' where msgId = '".$msgId."'";
				$result_f = mysqli_query($conn,$query_3);
				
				/*
				$array_1 = mysqli_fetch_assoc($wild_result);
					$memNick_sender = $array_result_1['memNick'];
					$memNick_receiver = $array_result_2['memNick'];
					$msgText = $array_1['msgText'];
					$msgTitle = $array_1['msgTitle'];
					$msgTime = substr($array_1['msgTime'],5,16);
				*/
				if(!$error){
				echo '<p>적성시간 : ['.$msgTime.']<br />제목 : ['.$msgTitle.']</p><p>발신자 : <a href="send.php?sendTo='.$memNick_sender.'">'.$memNick_sender.'</a></p><p><span>'.$msgText.'</span></p>';
			}else{
			echo $log."</p>";
			}
				

?>
<p><a href="list.php">쪽지 리스트</a> / <a href="../btalk/btalk.php">톡톡으로</a></p><style>
</body>
</html>
<style>