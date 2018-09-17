<?php
	require '../define.php';
	session_start();
	if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
	}

$memNick = sessread($_SESSION['user']);
$answer = $_REQUEST['answer']; // quiz.php에서 요청된 정답검증

$realAnswer = array( '네','슈퍼님','4.55','손수건','배틀그라운드','노무현대통령','참새','썰렁해','나선형','산화작용','비실체적','페이스북','036008640024','180','시계','마우스','10260','눈썹을 밀어버리는 것이 여자','치킨,탕수육,뻥튀기','머리칼','P대 NP문제','건포도','할머니와엄마와딸','시험','주희철','1','아이비','C8H1ON402','기본 전하','시공조아','119600','고추장,초고추장','공허','오토 한','호구' ); //정답을 보관한 배열입니다. 마지막의 AsDfdefr은 다른 랜덤문자로 바꿔 주세요. 만약 초기화하지 않으면 퀴즈 로직이 망가집니다.

@$conn = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
			
			if(mysqli_connect_errno()){
		
			$error = true;
			$log = $log.'데이터베이스의 에러 코드 1(관리자 문의바람), ';
		
			}else{
				//MYSQL 데이터베이스도 에러없고 나머지도 정상인 상태. 여기에 SQL 작성.
				
					$query_db = "select memQuiz from member where memNick = '".$memNick."'";
				$wild_result = mysqli_query($conn,$query_db);
				if(mysqli_num_rows($wild_result) != 1){
				$error = true;
				$log = $log."잘못된 세션 키(재로그인 바랍니다), ";
				}else{
				
					$array_result_1 = mysqli_fetch_assoc($wild_result);
					$quizlevel = $array_result_1['memQuiz'];
					$error = false;
				
				}
			}



if(!$error){
	
	if($answer == $realAnswer[$quizlevel]){
	
	$newLV = $quizlevel + 1;
	//mysql 쿼리
	$query_md = "update member set memQuiz ='$newLV' where memNick='$memNick'";
	@ $raw_result = mysqli_query($conn, $query_md);
	// quiz.php에 정답통보
	header("Location: quiz.php?a=right");
	exit;
	
	}else{
	
	header("Location: quiz.php?a=wrong");
	exit;
	
	}
	
}else{
	echo '<p>에러입니다. 문의 주십시오.</p>';
}
?>