<?php 
 ob_start();
 session_start();
 if(isset($_SESSION['user'])){
  header('Location: login.php');
 }
?>



<head>
<meta name="viewport" content="width=device-width">
</head>



<head>
<meta name="description" content="회원가입하는 공간입니다. ">
</head>



<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<link href="../default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
 $error = '0';
  
  // clean user inputs to prevent sql injections
	$space[1] = "\t";
	$space[2] = "\n";
	$space[3] = "\r";
	$space[4] = "\0";
	$space[5] = "x0B";
	$space[6] = " ";
	

  $innick = $_REQUEST['innick'];
  $innick = trim($innick);
  $innick = htmlspecialchars($innick);
    $newNick = str_replace('  ',' ',$innick);
  if($newNick != $innick){
 $error =1;
 $msg="<p>닉에 2연속 공백 금지</p>";  }

  
  $inid = $_REQUEST['inid'];
  $inid = str_replace($space,'',$inid);
  $inid = htmlspecialchars($inid);
  
    $password = $_REQUEST['password'];
  $password = str_replace($space,'',$password);
  $password = htmlspecialchars($password);
  
    $passCheck = $_REQUEST['passCheck'];
  $passCheck = str_replace($space,'',$passCheck);
  $passCheck = htmlspecialchars($passCheck);
  
  $trimNick = str_replace($space,'',$innick);
  
  $enter = 1;
  if(!isset($_REQUEST['innick'])&&!isset($_REQUEST['inid'])&&!isset($_REQUEST['inem'])&&!isset($_REQUEST['password'])&&!isset($_REQUEST['passCheck'])){
  $enter = 0;    
  }
   //up clean
  if($enter){
  if(empty($innick)){
   $error = 1;
   $msg = '<p>닉네임이 소멸했어요...ㄷㄷ</p>';
  }else if(strlen($innick) < 2){
   $error = 1;
   $msg = '<p>너무 닉네임이 짧아요!</p>';
  }else if(eregi('[^a-z^A-Z^가-힣^ㄱ-ㅎ^0-9^[[:space:]]\']',$innick) || strlen($innick) > 30){
   $error = 1;
   $msg = '<p>닉네임이 뭔가 이상해요!(아직은 닉네임에 특수문자를 못 넣어요), 너무 긴 건가요? 아니면 이상한 문자가 들어갔나요?</p>';
  }

else{
  @ $conna = new mysqli('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
   $querya = "SELECT trimNick FROM member WHERE trimNick='$trimNick'";
   $resulta = $conna -> query($querya);
   $counta = $resulta -> num_rows;
   if($counta != 0){
    $error = 1;
    $msg = '<p>이 닉네임은 존재합니다! </p>';
   }
    $resulta -> free();
    $conna -> close();
  }

  // basic inid validation
  if(empty($inid)){
   $error = 1;
   $msg = '<p>아이디가 왜 없죠?</p>';
  }else if(strlen($inid) < 6 || strlen($inid) > 20){
   $error = 1;
   $msg = '<p>아이디의 글자는 6자 이상 20자 이하입니다.</p>';
  }else if(eregi('[^a-z^A-Z^0-9]',$inid)){
   $error = 1;
   $msg = '<p>아이디 형식에 오류가 있는 것 같아요.</p>';
  }
else if(strpos($nick,$죽창)!==false){
   $error = 1;
   $msg = '<p>사용불가닉네임입니다</p>';
}
else if(strpos($nick,$에베)!==false){
   $error = 1;
   $msg = '<p>사용불가닉네임입니다</p>';
}
else{
  @ $connb = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
   $queryb = "SELECT id FROM secret WHERE id='$inid'";
   $resultb = mysqli_query($connb,$queryb);
   $countb = mysqli_num_rows($resultb);
   if($countb != 0){
    $error = 1;
    $msg = '<p>이미 사용되고 있는 아이디입니다! </p>';
   }
mysqli_free_result($resultb);
mysqli_close($connb);
}

  // password validation, pure
  if(empty($password)||empty($passCheck)){
   $error = 1;
   $msg = '<p>저기요? 암호를 쓰는 것을 잊으셨나요?</p>';
  }else if(strlen($password) < 6 || strlen($password) >20){
   $error = 1;
   $msg = '<p>암호는 최소 6자 최대 20자입니다!</p>';
  }else if(eregi('[^a-z^A-Z^0-9]',$password)){
   $error = 1;
   $msg = '<p>비밀번호 형식에 오류가 있는 것 같아요.</p>';
  }else if($password != $passCheck){
  $error = 1;
  $msg = '<p>암호와 암호확인이 맞지 않습니다.</p>';
  }
  
  // password encrypt using SHA1();
  $password = hash('sha1', $password);
  
  // if there's no error, continue to signup
  if( $error == '0' ){
  	@ $conn2 = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
 
	 if( mysqli_connect_errno() ){
  	echo '<p>데이터베이스 에러떴다요 관리자한테 알려주시라요</p>';
 	}
	//error?  
   $query1 = "INSERT INTO member(memNick,memStat,memRank,trimNick,memQuiz) VALUES('$innick','1','1','$trimNick','0')";
   $res1 = mysqli_query($conn2,$query1);
   
   $find = "select memId from member where memNick='$innick'";
   $pri = mysqli_query($conn2,$find);
   $row = mysqli_fetch_array($pri);
   $key = $row['memId'];
echo $row['memNick'];
   $query2 = "INSERT INTO secret(memId,id,pwd) VALUES('$key','$inid','$password')";
   $res2 = mysqli_query($conn2,$query2);
   $status = mysqli_affected_rows($conn2);
    //error?
   if($res1&&$res2){
    $errTyp = 'success';
    echo '<p>당신은 이제 슈퍼넷의 멤버입니다! </p>';
   }else{
    $errTyp = 'danger';
    echo '<p>에러가 생겼습니다. 다시 시도해 주세요!</p>'; 
   } 
   
  }
  } //end of if($enter)
  else{
  echo "<h1>회원가입</h1>

<p>환영합니다!</p>

<p>회원가입하는 것은 어렵지 않습니다.</p>

<p>가입 임시 오픈 중. </p>

<form action=\"register.php\" method=\"post\">
<p>사용 닉네임 <input maxlength=\"10\" name=\"innick\" required=\"required\" size=\"8\" type=\"text\" value=\"$innick\" a/></p>

<p><font color=\"grey\">아이디와 비밀번호는 6~20글자 사이고요, 오직 영어의 대문자와 소문자, 숫자만 쓸 수 있어요. 아이디와 비번에 공백이 들어가면 자동 삭제됩니다!</font></p>

<p>아이디 <input maxlength=\"20\" name=\"inid\" required=\"required\" size=\"8\" type=\"text\" value=\"$inid\"/></p>

<p>비밀번호 <input maxlength=\"20\" name=\"password\" required=\"required\" size=\"8\" type=\"password\" /></p>

<p>비밀번호 확인 <input maxlength=\"20\" name=\"passCheck\" required=\"required\" size=\"8\" type=\"password\" /></p>

<p>가입 버튼을 누르시면 <a href=\"eula.html\"><ins>약관</ins></a>에 동의한 것으로 간주합니다.</p>


<p><<input type=\"submit\" value=\"가입\" /></p>
</form>";



  }
?>
<?php
	echo $msg;
?>
<p><a href="../index.php">메인으로</a> / <a href="login.php">계정 이미 있음</a> </p>
<style>
</body>
</html>
<?php ob_end_flush(); ?>