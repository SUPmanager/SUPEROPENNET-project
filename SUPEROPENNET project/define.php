<?php

set_time_limit(10);

//Please modify default to any random key, Like password
//무작위 키로 변수 $secret_key를 초기화해 주세요.
$secret_key = "password";

function encrypt($string, $key) {

    $result = '';

    for($i=0; $i<strlen($string); $i++) {

        $char = substr($string, $i, 1);
        
        $char = chr(ord($char)+ord($keychar));

        $result .= $char;
    }
        return base64_encode($result);
}
 
function decrypt($string, $key) {
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        
        $char = chr(ord($char)-ord($keychar));
        $result .= $char;
    }
    return $result;
}

function sessmake($session){
	
	return encrypt($session,$secret_key);

}

function sessread($session){

	return decrypt($session,$secret_key);

}
?>