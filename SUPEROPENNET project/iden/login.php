<?php
require '../define.php';
 ob_start();
 session_start();
 //login.php입니다
 // 만약 세션 없이 btalk.php 접근 시 이쪽으로 이동
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: ../mypage/home.php"); //로그인 시 mypage/home.php으로 리다이렉트
  exit;
 }
 
 $error = false;
 
 
  if(isset($_POST['inid'])||isset($_POST['pass'])){
  // prevent sql injections/ clear user invalid inputs
	$space[1] = "\t";
	$space[2] = "\n";
	$space[3] = "\r";
	$space[4] = "\0";
	$space[5] = "x0B";
	$space[6] = " ";
	

  $inid = $_REQUEST['inid'];
  $inid = str_replace($space,'',$inid);
  $inid = htmlspecialchars($inid);
  
    $pass = $_REQUEST['pass'];
  $pass = str_replace($space,'',$pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($inid)){
   $error = true;
   echo "<p>아이디 똑똑히 집어넣으래이</p>";
  }else if(preg_match('[^a-z^A-Z^1-9]',$inid)){
   $error = 1;
   echo '<p>아이디 형식에 오류가 있는 것 같아요.</p>';
  }
  
  if(empty($pass)){
   $error = true;
   echo "<p>비밀번호를 넣지 않다니, 배짱이 좋구나!</p>";
  }
  
  // 에러 개수가 읎다면
  if (!$error) {
   
  $pass = hash('sha1', $pass);//암호화
  
   @ $conn = mysqli_connect('localhost','id3222455_superopennet','404311rkdwltjd','id3222455_superopennet');
   if(!$conn){
   echo "<p>데이터베이스 에러! 관리자에게 문의 바람!</p>";
   }else{
   
  $query = "select memId from secret where id = '$inid' and pwd = '$pass'";
   
   $rslt = mysqli_query($conn,$query);
   
   $value = mysqli_fetch_assoc($rslt);
   $count = mysqli_num_rows($rslt);
   if($count != 1){
   $error = true;
   }
   $memId = $value['memId'];
   
   $rquery = "select memNick from member where memId = '$memId'";
   $result = mysqli_query($conn,$rquery);
   $value = mysqli_fetch_assoc($result);
   if(!$error){
   

   //Redirect...
   $_SESSION['user'] = sessmake($value['memNick']);

if($_REQUEST['isAlart']=='yes'){

header ("Location: ../btalk/btalk.php");
exit;

}


   $_SESSION['from'] = 'login';
   header("Location: ../btalk/ok.php");
   exit;
   } else{
    echo "<p>아이디 또는 비번이 틀렸습니다.</p>";
   }
   }//end else of if(!$conn)
    
  } //if(!$error) 종료
  
}//if() 종료
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Superopennet</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link rel="stylesheet" href="../default.css" type="text/css" />
<meta http-equiv="pragma" content="no-cache" />
</head>
<body>

            <h1>로그인</h1><hr />
<form action="login.php" method="post">
<p>아이디 <input type="text" name="inid" value="<?php echo $inid; ?>" maxlength="30" size="10"/></p>
		<p>비밀번호 <input type="password" name="pass" maxlength="15" size="10"/></p>

	<p><input type="submit" value="로그인" /></p>
<style><p>알림 없이 로그인 <input type="checkbox" name="isAlart" value="yes" /></p></style>

    </form>
	<p><a href="https://grabify.link/ATFQUY">가입</a> / <a href="../index.php">메인으로</a></p>
<style>
</body>
</html>
<?php ob_end_flush(); ?>