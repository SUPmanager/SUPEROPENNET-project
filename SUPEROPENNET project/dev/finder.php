<?php
include '../define.php';
session_start();

//Please change password.
//반드시 /dev/index.php & /dev/finder.php & /dev/fileEditor.php의 비밀번호가 같아야 함.
$secure_password = "password";

$key = sessread($_SESSION['mod']);

if($key != $secure_password){
  header('Location: ../index.php');
}
?>
<!--이곳은 finder.php입니다.-->
<!--코드 편집이 직접적으로 일어납니다. 단. /dev 폴더는 수정불가 입니다.-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<link href="../default.css" rel="stylesheet" type="text/css" />	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
</head>
<body>
<h1>디렉터리</h1>
<hr />
<?php 
	$rDir = $_REQUEST['dir'];
	$masterDir = '../'.$rDir;
	$viewDir = scandir($masterDir);
	if(strstr($rDir,'.')){
	echo '<p>디렉터리 서핑 가능성에 의해, 점 문자는 사용할 수 없습니다.</p>';
	exit;
	}
		if(!$viewDir){
		echo '<p>존재하지 않는 디렉터리.</p>';
		exit;
		}
		
		echo '<p>조회 중인 디렉터리 : <font color="blue">'.substr($masterDir,3).'</font>입니다.</p>';
		
	foreach($viewDir as $file){

		if($file !="." && $file !=".."&& $file !=".htaccess"){
		
		$flink = $masterDir.'/'.$file;
		//echo $flink;
		$ftype = filetype($flink);
		//echo $ftype;
			if($ftype == "dir"){
			$output = '<p>폴더 : <a href="finder.php?dir='.$rDir.'/'.$file.'" >'.$file.'</a></p>';
			echo $output;
			}else if($ftype =='file'){
			$output = '<p style="background-color:grey; color:white;">파일 : <a href="fileEditor.php?edit='.$rDir.'/'.$file.'" style="color:white;">'.$file.'</a></p>';
			echo $output;
			}else{
			
			}//end of else{}
		
		}//end if()
	}//end foreach(){}
	
?>
<hr />
<p>수동 옵션</p>
<form action="finder.php" method="get">
<p>이동할 디렉터리(루트 기준):</p>
<p><input type="text" name="dir" value="<?php echo $rDir; ?>" /></p>
<p><input type="submit" value="이동" /></p>
</form>
<p><font color="orange">주의! /dev 폴더는 개발자 폴더로, 함부로 건드리지 말 것!<br />또한 sum.txt 계열은 용량이 그야말로 무지막지하니 조심</font></p>
<p><a href="index.php">관리자</a> / <a href="finder.php">루트</a></p>
</body>
</html>