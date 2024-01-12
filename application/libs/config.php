<?php
/*******************************************************************************
 * /application/libs/config.php
*******************************************************************************/
session_start();

@extract($_GET);
@extract($_POST);
@extract($_SERVER);

header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

define('_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('_SERVERNAME', $_SERVER['SERVER_NAME']);
define('_LOG_IP', $_SERVER['REMOTE_ADDR']);
define('_LOG_DATE', date("Y-m-d H:i:s"));

define('_DBTYPE', 'mysql');
if (!empty($_SERVER['HTTPS'])) {
    define('_HTTP', 'https://');
} else {
    define('_HTTP', 'http://');
}
// if(strpos(_SERVERNAME, "localhost") !== false){ //로컬, 가상호스트 때문에 변경 - KSR
// 	define('_DBHOST', 'wingkey.awsome-app.kr');
// } else {    //------------------- 서버
// 	define('_DBHOST', 'localhost');
// } 

//define('_HOST', $_SERVER['HTTP_HOST']);
// define('_HOST', "wingkey.awsome-app.kr");
// define('_DBNAME', 'wingkey');
// define('_DBUSER', 'wingkey');
// define('_DBPASSWORD', '!awesome0709');
// define('_CHARSET', 'utf8');

//게시판(관리자) 페이징
define('_BOARD_CNT', 10);

//스타일 관련
define('_ASSETS', _HTTP.$_SERVER['HTTP_HOST']."/application/assets/");
// define('_ASSETS_AD', _HTTP.$_SERVER['HTTP_HOST']."/application/assets/boffice/");
define('_ASSETS_COM', _HTTP.$_SERVER['HTTP_HOST']."/application/assets/common/");

// define('_ADMIN_DIR', "/boffice");
define('_FRONT_DIR', "/front");
define('_LIBS_DIR', _HTTP.$_SERVER['HTTP_HOST']."/application/libs");

if (isset($_GET['cateidx'])) {
    $cateidx = $_GET['cateidx'];
} else {
    $cateidx = "";
}


if (isset($_GET['pg_mode'])) {
    $pg_mode = $_GET['pg_mode'];
} else {
    $pg_mode = "";
}
define('_SITENAME', 'Branding');
/*****************************************************************************
 * 로그인 세션 관련 정보
 *****************************************************************************/
// if(!empty( $_SESSION["MEM_IDX"])){
// 	define('_SESS_MEM_IDX',  $_SESSION["MEM_IDX"]);
// 	define('_SESS_MEM_LEVEL',  $_SESSION["MEM_LEVEL"]);
// 	define('_SESS_MEM_ID',  $_SESSION["MEM_ID"]);
// 	define('_SESS_MEM_NAME',  $_SESSION["MEM_NAME"]);
// }
// if(!empty( $_SESSION["ADM_IDX"])){
// 	define('_SESS_ADM_IDX',  $_SESSION["ADM_IDX"]);
// 	define('_SESS_ADM_LEVEL',  $_SESSION["ADM_LEVEL"]);
// 	define('_SESS_ADM_ID',  $_SESSION["ADM_ID"]);
// 	define('_SESS_ADM_NAME',  $_SESSION["ADM_NAME"]);
// }

/*****************************************************************************
 * API KEY 값
 *****************************************************************************/
	// define('G5_OAUTH_ID_DELIMITER', '_');		// 로그인 ID 구분자
	// define('G5_OAUTH_NICK_PREFIX',  '');	// 닉네임 Prefix

	// // OAUTH Callback URL
	// define('G5_OAUTH_CALLBACK_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/front/Login/Callback');
	// define('G5_OAUTH_CALLBACK_URLS', 'https://' . $_SERVER['HTTP_HOST'] . '/front/Login/Callback');

	// define('_KKO_LOGIN_API',  "25c0e25c383cdd93a907a2638bbb0a2b");
	// define('_GOOGLE_LOGIN_CLIENTID',  "477052959064-ujivp8vjr081sjt00q51l0jg7sbb967s.apps.googleusercontent.com");
	// define('_GOOGLE_LOGIN_API',  "AIzaSyDVnx0dCBTkK6t89MMdoGmexR4XK1YTVMs");

/*****************************************************************************
 * 나이스 휴대폰 인증 관련
 *****************************************************************************/
//
// define('_NICE_CODE', 'CA245');
// define('_NICE_PWD', 'q493IpBTig76');
// if (isset($_GET['cateidx'])) {
//     $cateidx = $_GET['cateidx'];
// } else {
//     $cateidx = "";
// }

//푸시관련
// define('_FCM_KEY', 'AAAAlvLICK4:APA91bEoIgqziPS2diR5PuAgW_YRuilJ-vca-f1jG47IyDyeecIl2BZ5EEvc-YTwas56YtQ2nBBFUTZqZ8w9h1Q8lqbwJDj9E_hXLs18znl0929ijfAgm2d_oranqmMmqXUkm6Pvcy8T');
// define('_FCM_URL', 'https://fcm.googleapis.com/fcm/send');


//채팅 관련
// define('_CHAT_SERVER', 'https://awsome-app.kr:4003');   //챗 서버
// define('_CHAT_URL', '/front/Chatting/');     //챗 방 Base URL

//파파고 언어번역 API
// define('_LANG_PAPAGO_URL', 'https://openapi.naver.com/v1/papago/n2mt');   //언어번역
// define('_LANG_PAPAGO_DETECT_URL', 'https://openapi.naver.com/v1/papago/detectLangs');   //언어감지
// define('_NAVER_CLIENTID', 'OUSwC5W2Q63WHlsm9W8O');   //clientId
// define('_NAVER_SECRET', 'JovFDrXKJa');   //clientSecret
?>