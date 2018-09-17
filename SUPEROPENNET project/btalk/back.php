<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    	<meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" type="text/css" rel="stylesheet" />
</head><body>
<div id="wrapper">
<h1>이전글 보기</h1>
<?php
//back.php입니다.
if(isset($_REQUEST['page'])){
	$page = $_REQUEST['page'];
	$error = 0;
	if(eregi('[^0-9]',$page)||$page == 0){
		echo "<p>유효하지 않은 숫자입니다.</p>";
		$error = 1;
	}
	if(!$error){
	$opage = $page;
		@ $fp = fopen("sum.txt",'rb');
		fseek($fp,0,SEEK_END);
		$npage = ftell($fp);
		$npage = (($npage - ($npage % 1000))/1000) + 1;
		if($page <= $npage){
		echo "<p><font color=green>$page</font>번째 페이지입니다. (전체 <font color=orange>$npage</font>페이지)</p>";
		fclose($fp);
		$page = 1000 * ($page - 1);
		@ $sum = fopen("sum.txt",'rb');
		fseek($sum,$page,SEEK_SET);
			$result = fread($sum,1000);
			echo $result;
		fclose($sum);
		}else{
		echo '<p>없는 페이지입니다.</p>';
		}
	}
} else{

		@ $delta = fopen("sum.txt",'rb');
		fseek($delta,0,SEEK_END);
		$inde = ftell($delta);
		$inde = (($inde - ($inde % 1000))/1000) + 1;
		echo '<p>페이지는 총 <font color="blue">'.$inde.'</font>페이지입니다.</p>';
		fclose($delta);
}
?>
<p></p>
<form action="back.php" method="get"><p>페이지 번호 : <input type="text" name="page" size="4"/></p><p><input type="submit" value="보기"/></p></form>
<?php
if(isset($_REQUEST['page'])){
$m1num = $opage - 1;
$p1num = $opage + 1;
echo "<a href=\"back.php?page=$m1num\">&lt; 이전</a> <font color=\"black\">/</font> <a href=\"back.php?page=$p1num\">다음 &gt;</a></p>";
}
?>
<p><a href="btalk.php">돌아가기</a></p>
</div>
</body></html>