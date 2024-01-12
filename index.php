<?php
/******************************************************************************
* index.php
* .htaccess 설정으로 모든 URL은 index.php 파일로 온다..
* 주석 수정 - 2022-05-24
* 2022-06-19 github action. git-ftp test
******************************************************************************/

//error_reporting( E_ALL );
//error_reporting( E_ALL & ~E_NOTICE );
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR );
ini_set( "display_errors", 1 );


require_once 'application/libs/config.php';
require_once 'application/libs/function.php';
require_once 'application/libs/sql.php';
require_once 'application/libs/fun_thum_ksr.php';

// TODO: 언어감지 로직 수정해야함(수정중)

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  $browserLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

  $languages = explode(',', $browserLanguage);
  $browserLanguageCode = strtolower(substr(chop($languages[0]), 0, 2));
}

if($browserLanguageCode == "") $browserLanguageCode = "en";

$userLanguage = $_SESSION['sessLang'];
if($userLanguage == "") $userLanguage = $browserLanguageCode;

if($userLanguage == "en"){
  $language = 'en_US.utf8';
  $language2 = 'en_US';
}elseif($userLanguage == "ko"){
  $language = 'ko_KR.utf8';
  $language2 = 'ko_KR';
}elseif($userLanguage == "zh"){
  $language = 'zh_CN.utf8';
  $language2 = 'zh_CN';
}else{  
  $language = 'ko_KR.utf8';
  $language2 = 'ko_KR';
}
/*
putenv('LANG=' . $language);
setlocale(LC_ALL, $language2);
bindtextdomain('messages', './locale');
textdomain('messages');

echo gettext("menu06");
*/
// TODO: 언어감지 로직 수정해야함(수정중)


require_once _ROOT.'/application/vender/autoload.php';


new \application\libs\Application();
?>