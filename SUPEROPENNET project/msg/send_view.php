<?php
	require '../define.php';
	session_start();
	if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
	}
	

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
				
				$query_1 = "select memNick from member where memId = '".$memId_receiver."'";
				$result_w = mysqli_query($conn,$query_1);
				if(mysqli_num_rows($result_w) != 1){
				$error = true;
				$log = $log."수신자의 계정은 삭제되었습니다. 에러코드 2";
				}else{

					$array_result_1 = mysqli_fetch_assoc($result_w);
					$memNick_receiver = $array_result_1['memNick'];

				
				}
				
				$query_2 = "select memNick from member where memId = '".$memId_sender."'";
				$result_e = mysqli_query($conn,$query_2);
				if(mysqli_num_rows($result_e) != 1){
				$error = true;
				$log = $log."세션 키에 문제가 있습니다(재로그인 바랍니다), ";
				}else{

					$array_result_2 = mysqli_fetch_assoc($result_e);
					$memNick_sender = $array_result_2['memNick'];

				
				}
				if($memNick_sender != sessread($_SESSION['user'])){
				$error = true;
				}
				
				
				/*
				$array_1 = mysqli_fetch_assoc($wild_result);
					$memNick_receiver = $array_result_1['memNick'];
					$memNick_receiver = $array_result_2['memNick'];
					$msgText = $array_1['msgText'];
					$msgTitle = $array_1['msgTitle'];
					$msgTime = substr($array_1['msgTime'],5,16);
				*/
				if(!$error){
				echo '<p>작성시간 : ['.$msgTime.']<br />제목 : ['.$msgTitle.']</p><p>수신자 : <a href="send.php?sendTo='.$memNick_rece.'">'.$memNick_receiver.'</a></p><p><span>'.$msgText.'</span></p>';
			}else{
			echo $log."</p>";
			}
				

?>
<p><a href="send_list.php">보낸 쪽지</a> / <a href="../btalk/btalk.php">톡톡으로</a></p><style>
</body>
</html>
<style>