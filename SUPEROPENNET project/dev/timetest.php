<?php

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
</head>
<body>
<?php

$memNick = $_SESSION['user'];

@$conn = mysqli_connect('localhost','superopennt','404311rkdwltjd','superopennt');
			
			if(mysqli_connect_errno()){
		
			$error = true;
			$log = $log.'데이터베이스의 에러 코드 1(관리자 문의바람), ';
		
			}else{
				//MYSQL 데이터베이스도 에러없고 나머지도 정상인 상태. 여기에 SQL 작성.
				
				$query_db = "select * from member where memNick = '르니'";
				$wild_result = mysqli_query($conn,$query_db);
				if(mysqli_num_rows($wild_result) != 1){
				$error = true;
				$log = $log."로그인되지 않았고, ";
				}else{
				
				$number_of_result = mysqli_num_rows($wild_result);
				$ns = $number_of_result;
				
				for($i=0;$i<$ns;$i=$i+1){
					$array_result_1 = mysqli_fetch_assoc($wild_result);
					$memId = $array_result_1['memId'];
					
				}
				
				}
			}
				
$_SESSION['user']="FIRE";
?>
<p><a href="../index.php">메인으로</a></p>
</body>
</html>