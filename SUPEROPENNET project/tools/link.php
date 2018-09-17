<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    	<meta http-equiv="pragma" content="no-cache" />
	<title>Superopennet</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="../default.css" type="text/css" rel="stylesheet" />
	</head>
<body>
<h1>링크기능</h1>

<hr />
<form action="link.php" method="get">
<p>>사이트 방문 <input type="text" name="link" value="http://" /></p>
<p>>나무위키 검색 <input type="text" name="namuwiki" value="검색어" /></p>
<p>>페미위키 검색 <input type="text" name="femiwiki" value="검색어" /></p>
<input type="submit" value="생성" />
<p><font color="grey">페미위키에는 슈퍼넷문서가 존재합니다.</font></p>
</form>
<?php
if(!empty($_GET['link'])&&$_GET['link']!="http://"){
$url = $_GET['link'];
echo "<p><font color=\"red\">$url</font></p><p>로 연결된 <a href=\"".$url."\"><u><font color=\"red\">링크</font></u></a>입니다.</p>";
$lighturl = 'http://googleweblight.com/?lite_url='.$url;
echo "<p><font color=\"blue\">$url</font></p><p>로 연결된 <a href=\"".$lighturl."\"><u><font color=\"blue\">저데이터(피쳐폰 용)링크</font></u></a>입니다.</p>";
}
if(!empty($_GET['namuwiki'])&&$_GET['namuwiki']!="검색어"){
$namu = $_GET['namuwiki'];
$namulink = "http://googleweblight.com/?lite_url=https://namu.wiki/w/".$namu;
echo "<p>나무위키 중 <font color=\"green\">$namu</font></p><p>로 연결됩니다.<a href=\"".$namulink."\"><u><font color=\"green\">링크</font></u></a>입니다.</p>";
}
if(!empty($_GET['femiwiki'])&&$_GET['femiwiki']!="검색어"){
$femi = $_GET['femiwiki'];
$femilink = "http://googleweblight.com/?lite_url=https://femiwiki.com/".$femi;
echo "<p>페미위키 중 <font color=\"purple\">$femi</font></p><p>로 연결됩니다.<a href=\"".$femilink."\"><u><font color=\"purple\">링크</font></u></a>입니다.</p>";
}
?>
<hr />
<p>피쳐폰을 위한 서비스들</p><p>* <a href="http://mbasic.facebook.com/">페이스북</a></p><p>* <a href="http://mobile.twitter.com/">트위터</a></p><p>* <a href="http://www.google.com">구글</a><p>* <a href="http://newpennet.com"><font color="ff0000">[서비스종료]</font color="ff0000">뉴픈넷</a></p><p>* <a href="http://www.mannana.com">만나나</a></p><p>* <a href="http://www.superopennet.com"><font color="ff0000">[정식]</font color="ff0000">슈퍼넷</a></p>* <a href="http://featurenet.000webhostapp.com/">피쳐넷</a></p><p>*<a href="http://m.dcmys.kr">디시인사이드 갤러리</a></p><p>*<a href="http://supermys.000webhostapp.com">Supermys Wap 서비스</a></p><p>*<a href="http://superopennet.dothome.co.kr/index.php">슈퍼넷 테스트서버</a></p>
<?php
$texts = array("*주의! 열려는 페이지 중 이미지가 많다고 예상되는 페이지는 저데이터 모드로도 접속을 추천하지 않습니다.","*주의! 본 서비스는 구글 웹라이트를 사용합니다.","*알림: 나무위키의 문서 링크는 잘못 입력할 시 404 가능성이 있습니다.","*주의! 저데이터 모드에서 로그인 시 해킹 가능성이 있습니다.","안내: 저데이터 기능에서 생기는 에러는 문의하지 마세요");
shuffle($texts);
$warning = $texts[0];
echo "<p><font color=\"grey\">$warning</font></p>";
?>
<p><a href="../index.php">돌아가기</a></p>
</form>
<style>
</body>
</html>