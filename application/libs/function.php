<?
function Page_Msg_Back($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
		    history.back();
		</script>";
}

function Page_Msg($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
		</script>";
}

function Page_Url($url) {
	echo "<script language='javascript'>
			location.href='$url'
		</script>";
}

function Page_Msg_Url($msg, $url) {
 	echo "<script language='javascript'>
		alert(\"$msg\");
		location.href='$url';
	</script>";
}


function replace_in_se($string){
	if ($string){
		$string = str_replace("sp_","",$string);
		$string = str_replace("xp_","",$string);
		$string = str_replace("<script>","",$string);
		$string = str_replace("</script>","",$string);
		$string = str_replace("'","\'",$string);
 	}
	return $string;
}

function replace_out_se($string){
	if ($string){
		$string = str_replace("\'","'",$string);
		$string = str_replace("\\\'","'",$string);
 		$string=stripslashes($string);
 	}
	return $string;
}


function replace_out($string){
	if ($string){
		$string = str_replace("\'","'",$string);
		$string = str_replace("\\\'","'",$string);
		$string=nl2br($string);
		$string=stripslashes($string);
 	}
	return $string;
}
// 세션변수값 지정
function set_session($session_name, $value) {
	$_SESSION["$session_name"] = $value;
}

// 세션변수값 얻음
function get_session($session_name) {
    return $_SESSION[$session_name];
}

//페이지 이동시 기본 변수
function getAdmParams($FPOST){
	$ad_params = "";
	return $ad_params;
}

//년도로 나이계산
function getAge($birth_year_month_day){
	$birth_year = substr($birth_year_month_day, 0, 4);
	$current_year = date('Y');
	$age = $current_year - $birth_year;
	return $age;
}


//숫자로 요일 계산
function getDayTxt($day_txt) {
	$dayOfWeek = ["일", "월", "화", "수", "목", "금", "토"];

	$parts = explode("_", $day_txt);
	$days = [];

	foreach ($parts as $part) {
			$dayIndex = intval($part);
			if ($dayIndex >= 0 && $dayIndex <= 6) { // 인덱스 0부터 6까지가 일요일부터 토요일
					$days[] = $dayOfWeek[$dayIndex];
			}
	}

	if (count($days) > 0) {
			$daysList = implode(', ', $days);
			return $daysList;
	} 
}


//////////////////////////////////////////////
// 공통코드 불러오는 함수
// getCodeCom('apply_cms_amt')
// 2017-12-02 By gayoung
 //////////////////////////////////////////////

function getCodeCom($objCode){

	$com_code['coupon_state']  = array('1' => '사용', '2' => '미사용');
	$com_code['use_yn']  = array('Y' => 'Y', 'N' => 'N');
	$com_code['useYN']  = array('Y' => '사용', 'N' => '미사용');
	$com_code['out_YN']  = array('Y' => '출고', 'N' => '미출고');

	return $com_code[$objCode];
}

//////////////////////////////////////////////
// 라디오버튼 공통 함수
// radioBoxCommon('10', 'ra_age', 'apply_age')
// 2017-12-22 By gayoung
//////////////////////////////////////////////
function radioBoxCommon($selectVal, $objName, $arrCode){
 	$noArry =  getCodeCom($arrCode);
 	$html_txt = "";
	$i = 0;
	foreach($noArry as $code=>$name){
 		$chkval = "";
		if($selectVal != '' && $selectVal == $code ) $chkval = "checked";
		$html_txt .= "<input type='radio' name='$objName' id='id_$objName_$i' value='$code' $chkval /> <label for='id_$objName_$i'>$name</label> ";
		$i++;
	}
	return $html_txt;
}

//타임스템프(밀리세컨드까지)
function FN_get_timestamp(){
	list($microtime, $tStamp) = explode(' ',microtime());
	$timestamp = $tStamp . substr($microtime, 2, 3);
	return $timestamp;
}

//전화번호 하이픈 넣기
function format_phone($phone){
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	switch($length){
		case 11 :
				return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
				break;
		case 10:
				return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
				break;
		default :
				return $phone;
				break;
	}
}




//랜덤숫자문자 얻기
function RndomNum($cnt)  {
	$ran= "";

	for( $i=0; $i<$cnt; $i++) //7자리만 출력
	{
		 if( strlen($ran)<$cnt ) $ran .= rand( 0, 9 ); //숫자

	}

	return $ran;

}

/*
 * 랜덤 문자열 생성(인수 : 길이, 타입)
 * 지정된 타입의 문자열로 지정된 길이의 랜덤 문자열을 반환한다.
 * 타입 0 : 영문 대소문자(A-Z,a-z), 숫자(0-9)
 * 타입 1 : 영문 대문자(A-Z), 숫자(0-9)
 * 타입 2 : 영문 소문자(a-z), 숫자(0-9)
 * 타입 3 : 영문 대문자(A-Z)
 * 타입 4 : 영문 소문자(a-z)
 * 타입 5 : 숫자(0-9)
 * 디폴트 : false 반환.
*/
function rand_str($length, $type)
{
    switch($type){
        case 0:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 1:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            break;
        case 2:
            $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 3:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 4:
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 5:
            $chars = '1234567890';
            break;
        default:
            return false;
    }
    $chars_length = (strlen($chars) - 1);
    $string = '';
    for ($i = 0; $i < $length; $i = strlen($string)){
        $string .= $chars[rand(0, $chars_length)];
    }
    return $string;
}

?>