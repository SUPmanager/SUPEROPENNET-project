<?php
require '../define.php';
session_start();

//Please change password.
//반드시 /dev/index.php & /dev/finder.php & /dev/fileEditor.php의 비밀번호가 같아야 함.
$secure_password = "password";

?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>SUPERVISOR</h1>

<hr />
<?php
$key = $_REQUEST['key'];
	if(isset($_SESSION['mod'])){
	$key = sessread($_SESSION['mod']);
	}

if($key != $secure_password){
	echo '<p><form action="index.php" method="get"> <p>키값 <input type="password" name="key"></p><input type="submit" value="Verify"></form></p>';
}else{
	$_SESSION['mod'] = sessmake($key);
	echo '
	<form action="index.php" method="post" />
	<p>삭제하실 계정 <input type="text" name="delete_account"/></p>
	<p>신고 조회 <input type="text" name="view_report"/></p>
	<p>닉네임 변경 <input type="text" name="change_session"/></p>
	<p><a href="finder.php">코드 수정기</a></p>
	<input type="submit" value="Apply" />
	</form>
	';
	
	if($_REQUEST['delete_account'] !=""){
	$account = $_REQUEST['delete_account'];
	
	if($account=="DNA"||$account=="HG"||$account=="sisi"||$account=="예비"){
	
	$error = 1;
	echo '<p><font color=red>계정 시스템</font> : 스태프의 계정은 지울 수 없습니다. 마스터 관리자에게 문의 바랍니다.</p>';
	$account = 'foo';
	}
	if(!$error){
   @ $conn = mysqli_connect('localhost','superopennt','404311rkdwltjd','superopennt');

  $query = "select memId from member where memNick = '$account' ";
   
   $rslt = mysqli_query($conn,$query);
   
   $value = mysqli_fetch_assoc($rslt);
   $count = mysqli_num_rows($rslt);
   $memId = $value['memId'];
   
   $rquery = "delete from member where memId = '$memId'";
   $result = mysqli_query($conn,$rquery);
   
   $lquery = "delete from secret where memId = '$memId'";
   $lesult = mysqli_query($conn,$lquery);
   
   $value = mysqli_affected_rows($conn);
 if(!$value){
    echo "<p><font color=red>계정 시스템</font> : 삭제 대상이 없는 계정입니다.</p>";
}else{ echo '<p><font color=red>계정 시스템</font> : 성공적으로 <font color="orange">'.$account.'</font>의 계정을 삭제했습니다..</p>';}
	mysqli_close($conn);
	}
   }	

if(isset($_REQUEST['view_report'])){
	$page = $_REQUEST['view_report'];
	$error = 0;
	if(eregi('[^0-9]',$page)||$page == 0){
		echo "<p>유효하지 않은 숫자입니다.</p>";
		$error = 1;
	}
	if(!$error){
	$opage = $page;
		@ $fp = fopen("../btalk/report.txt",'rb');
                @ $sum = fopen("../atalk/report.txt",'rb');
                @ $sum = fopen("../FREEtalk/report.txt",'rb');
                @ $sum = fopen("../BLIZZARDtalk/report.txt",'rb');
                @ $sum = fopen("../BlueHoletalk/report.txt",'rb');
                @ $sum = fopen("../NOVELtalk/report.txt",'rb');
		fseek($fp,0,SEEK_END);
		$npage = ftell($fp);
		$npage = (($npage - ($npage % 900))/900) + 1;
		if($page <= $npage){
		echo "<p><font color=green>$page</font>번째 신고페이지입니다. (전체 <font color=orange>$npage</font>페이지)</p>";
		fclose($fp);
		$page = 900 * ($page - 1);
		@ $sum = fopen("../btalk/report.txt",'rb');
                @ $sum = fopen("../atalk/report.txt",'rb');
                @ $sum = fopen("../FREEtalk/report.txt",'rb');
                @ $sum = fopen("../BLIZZARDtalk/report.txt",'rb');
                @ $sum = fopen("../BlueHoletalk/report.txt",'rb');
                @ $sum = fopen("../NOVELtalk/report.txt",'rb');
		fseek($sum,$page,SEEK_SET);
			$result = fread($sum,900);
			echo $result;
		fclose($sum);
		}else{
		echo '<p>신고시스템 : 없는 페이지입니다.</p>';
		}
	}
} else{

		@ $delta = fopen("../btalk/report.txt",'rb');
                @ $sum = fopen("../atalk/report.txt",'rb');
                @ $sum = fopen("../FREEtalk/report.txt",'rb');
                @ $sum = fopen("../BLIZZARDtalk/report.txt",'rb');
                @ $sum = fopen("../BlueHoletalk/report.txt",'rb');
                @ $sum = fopen("../NOVELtalk/report.txt",'rb');
		fseek($delta,0,SEEK_END);
		$inde = ftell($delta);
		$inde = (($inde - ($inde % 900))/900) + 1;
		echo '<p>페이지는 총 <font color="blue">'.$inde.'</font>페이지입니다.</p>';
		fclose($delta);
}
	
	
	if($_REQUEST['change_session'] !=""){
	$session = $_REQUEST['change_session'];
	
	if($session=="DNA"||$session=="예비"){
	
	echo '<p><font color=red>사칭 시스템</font> : 스태프의 계정은 따라할 수 없습니다. 마스터 관리자에게 문의 바랍니다.</p><p>010 4643 5643</p>';
	
	$session = 'Errored';
	
	}
	
	$_SESSION['user'] = sessmake($session);
	
	echo '<p><font color=red>사칭 시스템</font> : 성공적으로 닉이 변경되었습니다.</p>';
	}
	
	
}
		

?><p><font color="999999"> 관리자페이지에 오신 것을 환영합니다! <?php $pr=sessread($_SESSION['user']); echo $pr; ?>님!</p></p>
<p><a href="../btalk/btalk.php">돌아가기</a></p>
</body></html>