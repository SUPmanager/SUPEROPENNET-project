<?php
require '../define.php';
session_start();

//Please change password.
//반드시 /dev/index.php & /dev/finder.php & /dev/fileEditor.php의 비밀번호가 같아야 함.
$secure_password = "password";

$key = sessread($_SESSION['mod']);
if($key != $secure_password){
  header('Location: ../index.php');
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<link href="../default.css" rel="stylesheet" type="text/css" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
</head>
<body>
<h1>파일</h1>
<hr />
<?php 
	$link = $_REQUEST['edit'];
	
	$pure = basename($link);
	//echo $pure;
	$p_dir = str_replace($pure,'',$link);
	
	if(strstr($link,'../')){
	echo '<p>디렉터리 서핑 가능성에 의해, 패런츠 디렉터리는 사용할 수 없습니다.</p>';
	exit;
	}
	
	$master = '../'.$link;
	
	$fp = fopen($master, 'a+b');
rewind($fp);
	$length = filesize($master);
	
	$text = fread($fp, $length);
	/*if(stripos($text,'<textarea>')||stripos($text,'</textarea>')){
	echo '<p> &lt;textarea&gt; 태그가 들어간 페이지입니다...</p>';
	exit;
	}*/
if(!isset($_REQUEST['edited']) || $_REQUEST['otype'] == "open"){

echo '<p>조회 중인 파일 : <font color="blue">'.substr($master,3).'</font>입니다.</p>';

echo '<form action="fileEditor.php" method="post">
<p>파일의 내부 내용</p>
<p><textarea cols="30" name="edited" rows="10">'.htmlentities($text).'</textarea></p>
<p>고치거나 열 파일(루트 기준)</p>
<p><input type="text" name="edit" value="'.$link.'" /></p>
<p>파일 여는 모드? 수정 모드?</p>
<p>수정(기본) <input type="radio" name="otype" value="edit" checked="checked" /> / 열기 <input type="radio" name="otype" value="open" /></p>
<p><input type="submit" value="Patch!" /></p>
</form>';

	}else{
	
	$edited_txt = $_REQUEST['edited'];
	
	$timesp = getdate();
	$timesp = $timesp[0];
	
	$link3 = str_replace('.','_',$link);

$link2 = str_replace('/','_',$link3);
	$link2 = substr($link2,1);
	$arcLink = 'archive/'.$link2.'__'.$timesp.'.txt';
	@$arc = fopen($arcLink,'xb');
	
	fwrite($arc, $text);
	
	fclose($arc);
	fclose($fp);
	
	@$fp = fopen($master, 'w+b');
	@fwrite($fp, $edited_txt);
	fclose($fp);
	
	echo '<p>성공적 반영!</p><p><font color="red">'.$arcLink.'</font></p><p>에 백업버전이 존재합니다... </p><p><a href="finder.php?dir="'.$p_dir.'">돌아가기</a></p>';
	}
?>
<p><a href="index.php">관리자</a> / <a href="finder.php?dir=<?php echo $p_dir; ?>">디렉터리</a> / <a href="../btalk/btalk.php">톡톡으로</a></p>/ <a href="../atalk/atalk.php">방명록으로</a></p>
</body>
</html>