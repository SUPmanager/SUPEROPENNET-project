<?php
include '../define.php';
session_start();

if(!isset($_SESSION['user'])){
	header("Location: ../iden/login.php");
	exit;
}

$memNick = sessread($_SESSION['user']);

@$conn = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
			
		    $log = "다음과 같은 에러들이 발생했습니다 : ";
			
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
	<?php echo '<!-- Your Quiz Level :'.$quizlevel.'-->'; ?>
	</head>
<body>
<h1>퀴즈</h1>
<hr />
<?php

	if($_REQUEST['a']=='wrong')
	echo '<p><font color="red"><i>틀렸습니다.</i></font></p>';
	if($_REQUEST['a']=='right')
	echo '<p><font color="blue"><i>정답입니다!</i></font></p>';
	

	if(!$error){
	
		switch( $quizlevel ){
		
		default:
		
		echo '<p><font color="ff0000">퀴즈 문제 준비중!;</p><p>죄송합니다. We\'re sorry.</font></p>';





                    case 0:
		echo '<p><i>환영합니다.</i></p>

	<p>이곳은 슈퍼넷의 퀴즈 구역입니다. 힌트와 문제를 다른 사람들과 공유하며, 풀어 나아가 보세요! 문제는 <a href="making.php">이곳</a> 또는 톡톡의 [출제] 탭에서 직접 낼 수도 있습니다.</p>
	
	<p>준비되었습니까? 이 안내문은&nbsp;<u>0번 문제</u>에 해당합니다. 답에는 띄어쓰기를 쓰지 않습니다.</p>
	
	<p>0번 문제의 답은 <u>네</u>입니다. 행운을 빕니다.</p>';
	break; //네
		
		case 1:
			echo '<p>1번 문제</p> <p>이 웹사이트의 최초 제작자는?</p>';
			break; //슈퍼님
		case 2:
			echo '<p>문제 2</p> <p>1 더하기 3.55 는?</p>';
			break; //4.55
                 case 3:
			echo '<p>문제 3</p> <p>수건은 수건인데 닦을
 수 없는 수건은?</p>';
			break; //손수건
                 case 4:
			echo '<p>문제 4</p> <p>2017년 12월 기준으로
 PC방 1위를 달성한 게임 이름은?</p>';
			break; //배틀그라운드
                 case 5:
			echo '<p>문제 5</p> <p>2017년 당선된 대통령의 오랜 친구는?(힌트:그 친구도 대통령이었다.)(//이건 알아야한다....상식이다.//띄어쓰기없이 OOO대통령)</p>';
			break; //노무현대통령
		
		case 6:
			echo '<p>문제 6</p> <p>진짜 새의
 이름은 무엇일까?</p>';
			break; //참새
       
		case 7:
			echo '<p>문제 7</p> <p>세상에서
 가장 추운 바다는?</p>';
			break; //썰렁해
                  case 8:
           echo'<p>문제 8</p>
<p><font color="0000ff">출제자 이치고님께 진심으로 감사드립니다.</font></p><p>신소재 탄소 나노튜브는 무슨 모양일까요?(??형)</p>';
             break; //나선형
                    case 9:  
              echo'<p>문제 9</p>
    <p>겨울에 많이 애용하는 핫팩이 뜨거워지면서 무슨 작용을 하나요?(??작용)</p>';     
	                  break; //산화작용                                                             

                       case 10:                                                  
               echo'<p>문제 10</p>                       
<p>아리스토텔레스의 한 이론이다. 얼굴이 빨개지는것은 비??적이다.</p>';                     
                      break; //비실체적          

                     case 11:
            echo'<p>문제 11</p>
<p>마크저커버그가 만든 유명한 SNS이름은?(쉬어가세요~답을 드린 문제예요~)</p>';
                    
break; //페이스북

                        case 12:
                echo'<p>문제 12</p> 
<p><font color="0000ff">출제자 이치고님께 감사드립니다.(헬게이트가열렸습니다!)</font></p>
<p><font color="999999">물음표 안에 각각 들어갈 숫자를 고르시오</font></p><p>16????????????192002592000267840031536000</p>';
            break; //036008640024
          
                      case 13:
               echo'<p>문제 13</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다.</font></p>
<p>6  2  8  2  10  ?  4  12  10  6  ?  16  18  14  18   </p>';
                       break; //180 

                      case 14:
                echo'<p>문제 14</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다.</font></p>
<p>어떤 예술가가 작품을 만들었습니다. 이 작품의 내용은 무엇일까요?</p>
<p>1 &nbsp; &nbsp;  3  &nbsp; &nbsp; 9  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                  8  &nbsp; -</p><p>
&nbsp; &nbsp; &nbsp;          1   &nbsp; &nbsp; &nbsp; &nbsp;                2  &nbsp; &nbsp;  7 &nbsp;&nbsp;  _</p><p>
 &nbsp;   &nbsp; &nbsp; &nbsp;                     6   &nbsp; &nbsp;  5   &nbsp;  &nbsp; 4 &nbsp; &nbsp; &nbsp; &nbsp;</p><p>
       1    &nbsp; &nbsp;   2 &nbsp; &nbsp;  0          </p>';
                                      
                           break; //시계


                      case 15:
               echo'<p>문제 15</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다.</font></p>
<p>전자공학과 학생이 컴퓨터 공학과 학생에게 문제를 냈다.</p>
<p>110058=8 이 등식을 디지털 숫자로 전환한 뒤 막대 3개만 옳겨서 맞는 식으로 만들어봐라!</p>
<p>풀어낸 등식의 우변에 나타나는 게 무엇인지 쓰시오. </p>';

                break; //마우스

                    case 16:
                 echo'<p>문제 
16</p>
<p><font color="0000ff">힘내서 풀어봅시다!</font></p>
<p>3:4:5일때, 가장 큰°=a</p>
<p>9+5=2, 5+8=1일때, 1:60/11=2:120/11=3:180/11=4:240/11=5:300/11=6:360/11=7:420/11=8:480/11=9:540/11=10:600/11=12:b이다.</p>
<p>H=1 V=23 F=9 S=16 I=53 W=74
Y=39 P=15일때, K=c이다.</p>
<p>d 28 496 8128 33550336 8589869056</p>
<p>acd+11b=?</p>';


break; //10260


                    case 17:
                 echo'<p>문제 
17</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!</font></p>
<p>레오나르도 다 빈치의 모나리자에 나오는 여인은 눈썹이 없습니다. 눈썹이 없는 이유는 무엇일까요?</p>
<p>[그 당시에는 ㄴㅆㅇ ㅁㅇㅂㄹㄴ ㄱㅇ ㅇㅈ들 사이의 유행이었다]</p>';


break; //눈썹을 밀어버리는 것이 여자




                    case 18:
                 echo'<p>문제 
18</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>세상에서 가장 위험한 음식 3가지는 무엇일까요?(예시:A, B, C)</p>';


break; //치킨,탕수육,뻥튀기



                    case 19:
                 echo'<p>문제 
19</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>사람이 항상 몸에 지니고 다니는 흉기는 무엇일까요?</p>';


break; //머리칼



                    case 20:
                 echo'<p>문제 
20</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>밀레니엄 문제들 중에서 유일하게 컴퓨터와 관련된 대표적인 이 문제는 무엇일까요?(띄어쓰기 포함)(김양곤 교수, 스펀지 // ?대 ??문제)</p>';


break; //P대 NP문제




                    case 21:
                 echo'<p>문제 
21</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>달걀 세상에서 가장 작은 섬은 무엇일까요?</p>';


break; //건포도



                    case 22:
                 echo'<p>문제 
22</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>2명의 엄마와 2명의 딸이 결혼식에 입을 새 드레스를 사기위해 옷가게를 갔다. 
<p>그들은 각각 새 드레스를 고른 후 가격을 지불했다.</p> 
<p>그런데, 드레스는 단지 3벌뿐이었다. 이유가 무엇일까?(드레스를 입을 사람들을 정답칸에
 나열해보시오. 띄어쓰기는 없고 조사를 사용해야 할 것이오.)</p>';


break; //할머니와엄마와딸





                    case 23:
                 echo'<p>문제 
23</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>한 여<font color="0000ff">학생</font>이 멀쩡한 팔에 깁스를 했다. 신체건강하고 다친적도 없는 여<font color="0000ff">학생</font>이 왜 깁스를 했을까?</p>
<p>이 여<font color="0000ff">학생</font>은 무엇을 앞두고 있었기에 꾀병을 부린 것일까요?</p>
<p>단서</p>
<p>1.동정심을 유도하려 깁스를 한 것이 아니다.</p>
<p>2.여<font color="0000ff">학생</font>은 중요한 일을 앞두고 있었다.</p>
<p>3.깁스 안에 비밀스런 물건을 숨기지 않았다.</p>
<p>4.깁스하면 분명 눈에 띌 거라 생각했다.</p>';



break; //시험





                    case 24:
                 echo'<p>문제 
24</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>SKT오픈넷 유저들의 정모파티에서 살인사건이 발생했다.
<p>피해자는 동창회 파티를 제안했던 이치고(32)가 흉기에 찔려 사망했다고 한다.</p>
<p></p>
<p>그가 마지막으로 남긴 다잉메시지로</p>
<p></p>
<p>"102182193851512"라는 정체불명의 숫자가 적혀있었다고 한다.</p>
<p></p>
<p>용의자는 다음과 같다.범인은 누구일까?</p>
<p></p>
<p>1.평소 이치고에게 앙심을 품고 있었던 피해자의 형</p> 
<p></p>
<p>백룡(32)</p>
<p></p>
<p>2.피해자의 여자친구</p>
<p></p>
<p>최혜수(30)</p>
<p></p>
<p>3.이치고의 직장 상사이며 같은 SKT오픈넷 회원이었던 참석자</p>
<p></p>
<p>주희철(32)</p>
<p></p>
<p>4.정모 참석자</p>
<p></p>
<p>김아미(32)</p>
<p></p>
<p>5.정모 참석자</p>
<p></p>
<p>고등어(32)</p>
<p></p>
<p>6.폭력서클 두목</p>
<p></p>
<p><font color="ff0000">슈퍼님</font>(33)</p>
<p></p>
<p>범인은 누구일까?</p>';



break; //주희철




                    case 25:
                 echo'<p>문제 
25</p>
<p><font color="0000ff">출제자 <font color="ff0000">슈퍼님</font>님께 감사드립니다!</font></p>
<p>물을표에 들어갈 숫자를 구하시오.</p>
<p></p>
<p></p>
<p>100-10=5</p>
<p></p>
<p>500-20=8</p>
<p></p>
<p>100-30=3</p>
<p></p>
<p>500-40=6</p>
<p></p>
<p>100-50=?</p>';




break; //1




                    case 26:
                 echo'<p>문제 
26</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!</font></p>
<p>우리가 흔히 기르는 벽걸이 식물 중 가장 강한 독을 가진 식물의 이름은?</p>';




break; //아이비




                    case 27:
                 echo'<p>문제 
27</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!</font></p>
<p>카페인의 화학식은?</p>';




break; //C8H10N4O2



                  case 28:
           echo'<p>문제 28</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>
<p>양성자 하나가 지닌 전하, 전자 하나가 지닌 전하의 절댓값을 부르는 용어는? (띄어쓰기 있습니다.)</p>';



break; //기본 전하



                  case 29:
           echo'<p>문제 29</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>
<p>한글로 해석하시오. 施共助我 표기법 (????)</p>';


break; //시공조아



                  case 30:
           echo'<p>문제 30</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>
<p>후후후 여기까지 잘왔노라 이제 고통을 느껴보아라!</p><p>과연 이 문제를 얼마만에 풀수있을까?</p>
<p>M=1, 4 U=7 E=3 V=2 N=8 S=a </p>
<p>77 8 7=b</p>
<p>1 7 4 2 3 5 0 6 9 8, 7=2 9=6 8=7 일때, 64=c</p>
<p>자연상태로 발견되는 원소 중 가장 무거운 원소=d</p>
<p>abcd=?</p>';

break; //119600


                  case 31:
           echo'<p>문제 31</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>
<p>추장보다 높은 사람을 계급 순으로 2명쓰시오. 표기법(???,????)띄어쓰기없음</p>';

break; //고추장,초고추장



                  case 32:
           echo'<p>문제 32</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>
<p>히오스오브더스톰 게시판 좇망겜이지만
삭제 기념! </p>
<p>빈칸에 들어갈 단어는?</p><p>☆공허의유산☆♚♚</p><p>히어로즈 오브 더 스☆톰♚♚가입시$$전원 카드팩☜☜뒷면 100%증정※</p><p>♜월드오브 워크래프트♜ 펫 무료증정￥</p><p>특정조건 §§디아블로3§§★??의 유산★초상화획득기회@@@</p>';

break; //공허






                 case 33:
           echo'<p>문제 33</p>
<p><font color="0000ff">출제자 이치고님께 감사드립니다!
</font></p>                   
<p>빈칸에 들어갈 인물의 이름은?(띄어쓰기 있음)</p>
<p>우라늄 235(235U, 원자번호 92)에 열중성자를 충돌시키면</p><p>질량이 비슷한 두 개의 바륨(Ba, 원자번호 56), 크립톤(Kr, 원자번호 36) 동위원소로 갈라지고</p><p>중성자가 2~3개 방출되면서 기존의 핵반응과는 비교되지 않을 정도의 큰 에너지가 발생하는 것을 발견하였다.</p><p>그리고 1939년 1월에는 그들과 함께 연구했던</p><p>리제 마이트너(Lise Meitner 1878~1968)와 프리쉬(Otto Frisch)가 열중성자를 충돌시킨 우라늄 핵이 에너지를 방출하면서</p><p>비슷한 질량을 가진 두 개의 원소로 깨진다는 것을 실험하였다.</p><p>?? ?은 1944년에 이 공로로 노벨 화학상을 받았다</p>';


break; //오토 한

                         case 34:
                 echo'<p>문제 
34</p>
<p><font color="0000ff">출제자 <font color="ff0000">누군가</font>님께 감사드립니다!</font></p>
<p>현재 슈퍼넷에서 최고로 병신력이 탄탄한 유저의 닉네임을 쓰시오.(힌트:에러닉네임을 주로 사용하지만 이 두 글자의 닉네임으로 많이 알려져있습니다!)</p>';


break; //호구




                                                                    		                                                                                                                                                                                                                                                                                                        } //switch종료
	
	} //기본코드 종료(!$error)
?>
<form action="check.php">
<p>정답 입력 : <input type="text" name="answer" method="post"></p></p>
<p><input type="submit" value="제출" /></p>
<p><a href="../btalk/btalk.php">톡톡으로</a></p>
</form>
<style>
</body>
</html>