<?
function dbconn(){
	$dsn = _DBTYPE . ':host=' ._DBHOST. ';dbname=' . _DBNAME . ';charset=' . _CHARSET;
	// PDO 객체 생성 & DB 접속
	try{
		$conn = new PDO($dsn, _DBUSER, _DBPASSWORD);
		return $conn;
	}catch(PDOException  $e){
		echo $e->getMessage();
		return;
	}
}

function QRY_CNT($tbl,$searchand){
	$pdo = dbconn();
	$sql = "SELECT
						COUNT(*) AS CNT
					FROM
						$tbl
					WHERE 1=1
						$searchand"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$cnt_row = $stmt->fetch(PDO::FETCH_ASSOC);	//레코드 수 카운팅
	$cnt = $cnt_row['CNT'];
	return $cnt;
}

function QRY_MAX($tbl,$searchand,$item){
	$pdo = dbconn();
	$sql = "SELECT
						MAX($item) AS MAX
					FROM
						$tbl
					WHERE 1=1
						$searchand";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$cnt_row = $stmt->fetch(PDO::FETCH_ASSOC);	//레코드 수 카운팅
	$cnt = $cnt_row['MAX'];
	return $cnt;
}


function QRY_VIEW($tbl,$searchand){
	$pdo = dbconn();
	$sql = "select * from $tbl where 1 = 1 $searchand";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch();
	return $row;
}

function QRY_VIEW_echo($tbl,$searchand){
	$pdo = dbconn();
	$sql = "select * from $tbl where 1 = 1 $searchand";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch();
	return $row;
}

function getQueryItem($table, $where, $getId){
	$pdo = dbconn();
	$sql = "select * from $table where 1 = 1 $where limit 0, 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch();
	$cnt = $stmt->rowCount();
	$rowVal = "";
	if($cnt > 0){
		$rowVal = $row[$getId];
	}
	return $rowVal;
}

function comQueryResult($sql){
	$pdo = dbconn();
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rsData = $stmt->fetchAll();
	return $rsData;
}


function QRY_TMP_IDX($tableName){
	$max = QRY_MAX("tempIdx"," and tableName='".$tableName."'","tempIdx");
	$max++;
	$sql = "UPDATE tempIdx SET tempIdx = $max WHERE tableName = '$tableName'";
	comQueryResult($sql);
	return $max;
}

/**********************************************
	호출방법 ::
	$order_query = selectRow("all",$page," sc_ord asc");
*******************************************/

function selectRow($cnt,$page,$ord){

	$startno = ($page-1) * $cnt;
	if($cnt!="all"){
		$limit = "LIMIT  $startno,$cnt ";
	}
    $sql = " order by		$ord		$limit";
  return $sql;
}
function QRY_TOTALPAGE($cnt,$recordcnt){
	$total_page = (int)($cnt%$recordcnt);

	if ($total_page != 0){
		$totalpage = (int)($cnt/$recordcnt)+1;
	} else {
		$totalpage = (int)($cnt/$recordcnt);
    }

	return $totalpage;
}

/*
code 공통코드 싱글 선택 라디오버튼 생성 함수
$selectVal : 실제 선택 된 값
$checkName : 라디오버튼 name (아이디값은 name1, name2 로 생성)
$code_gubun : code_gubun 컬럼의 구분값 
Author : 2023-03-18 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<?=radioSingleList($selectVal, $checkName, $code_gubun)?>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function radioSingleList($selectVal, $checkName, $code_gubun, $className  = "", $title=""){
	$pdo = dbconn();
	$sql = "select * from code where 1 = 1 and code_gubun='$code_gubun' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			if($item->comm_code === $selectVal){
				$selected = "checked";
			}else{
				$selected = "";
			}
			$vHtml .= "<input type='radio' $selected class='".$className."' name='".$checkName."' id='".$checkName.$i."' title='".$title."' value='".$item->comm_code."'/><label for='".$checkName.$i."'>".$item->code_nm."</label>";
			$i++;
		}
	}
	return $vHtml;
}
/*
code 공통코드 싱글 선택 체크박스 생성 함수
$selectVal : 실제 선택 된 값
$checkName : 체크박스name (아이디값은 name1, name2 로 생성)
$code_gubun : code_gubun 컬럼의 구분값 
Author : 2023-03-18 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<?=checkboxSingleList($selectVal, $checkName, $code_gubun)?>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function checkboxSingleList($selectVal, $checkName, $code_gubun){
	$pdo = dbconn();
	$sql = "select * from code where 1 = 1 and code_gubun='$code_gubun' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$vHtml .= "<input type='checkbox' class='com_chk' name='".$checkName."' id='".$checkName.$i."' value='".$item->comm_code."'/><label for='".$checkName.$i."'>".$item->code_nm."</label>";
			$i++;
		}
	}
	return $vHtml;
}


/*
code 튜터 싱글 선택 라디오버튼 생성 함수
$selectVal : 실제 선택 된 값
$checkName : 라디오버튼 name (아이디값은 name1, name2 로 생성)  
Author : 2023-08-09 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<?=radioTutorGradeList($selectVal, $checkName, $code_gubun, $className, $title)?>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function radioTutorGradeList($selectVal, $checkName, $code_gubun, $className  = "", $title=""){
	$pdo = dbconn();
	$sql = "select * from member_grade where 1 = 1 and grd_type='$code_gubun' and use_yn='y' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$vHtml .= "<input type='radio' class='".$className."' name='".$checkName."' id='".$checkName.$i."' title='".$title."' value='".$item->grd_num."'/><label for='".$checkName.$i."'>".$item->grd_title."</label>";
			$i++;
		}
	}
	return $vHtml;
}

/*
code 공통코드 멀티선택 체크박스 생성 함수 
$selectVal : 실제 선택 된 값
$checkName : 체크박스name (아이디값은 name1, name2 로 생성)
$code_gubun : code_gubun 컬럼의 구분값 
Author : 2023-03-18 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<?=checkboxMultiList($selectVal, $checkName, $code_gubun)?>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function checkboxMultiList($selectVal, $checkName, $code_gubun, $use_YN = '', $class_name=''){
	$pdo = dbconn();
	$sql_where = "";
	if($use_YN){
		$sql_where = " and use_YN = '$use_YN'";
	}
	$sql = "select * from code where 1 = 1 and code_gubun='$code_gubun' ".$sql_where." order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$selectedChk = "";
			if(strpos($selectVal, $item->comm_code) !== false) {
				$selectedChk = "checked";
			}else{
				$selectedChk = "";
			} 
			if($code_gubun === "DAYS"){
				if(strpos($selectVal, $item->code_etc1) !== false) {
					$selectedChk = "checked";
				}else{
					$selectedChk = "";
				} 
				$item->comm_code = $item->code_etc1;
			}
			$vHtml .= "<input type='checkbox' class='".$class_name."' name='".$checkName."[]' id='".$checkName.$i."' value='".$item->comm_code."'  ".$selectedChk." /><label for='".$checkName.$i."' >".$item->code_nm."</label> ";
			$i++;
		}
	}
	return $vHtml;
}


function checkboxMultiListTxt($selectVal, $checkName, $code_gubun){
	$pdo = dbconn();
	$sql = "select * from code where 1 = 1 and code_gubun='$code_gubun' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$selectedChk = "";
			if(strpos($selectVal, $item->comm_code) !== false) {
				$vHtml .= $item->code_nm.", ";
			}
			$i++;
		}
	}
	return $vHtml;
}


function fnGetCateList($parent_idx){
	$pdo = dbconn();
	$sql = "SELECT * 
			FROM shop_category
			WHERE useYN = 'Y' AND parent_idx = '$parent_idx'
		";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	return $row;
}

function fnGetWordist(){
	$pdo = dbconn(); 
	$sql = "SELECT * 
			FROM suggest_word
			WHERE use_YN = 'Y'
		";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	return $row;
}


/*
code 공통코드 셀렉트박스 생성 함수
: select 박스는 별도로 선언하고 option 부분만 호출 
$selectVal : 실제 선택 된 값
$code_gubun : code_gubun 컬럼의 구분값 
Author : 2023-03-18 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<select name="">
<?=codeSelectList($selectVal, $code_gubun)?>
</select>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function codeSelectList($selectVal, $code_gubun){
	$pdo = dbconn();

	if($code_gubun=='CONTRY'){ ///국가코드 일경우
		$sql = "select * from code_country order by comm_code asc";
	}else{
		$sql = "select * from code where 1 = 1 and code_gubun='$code_gubun'  order by sort_no asc";		 
	}

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			if($selectVal == $item->comm_code){
				$selected = "selected";
			}else{
				$selected = "";
			}
			if($code_gubun === "MONEY_TYPE"){
				$item->code_nm = $item->code_nm.$item->code_etc1;
			}
			if($code_gubun === "CI_TIME"){
				$item->comm_code = $item->code_etc1;
			}
			$vHtml .= "<option value='".$item->comm_code."' ".$selected."/>".$item->code_nm."</option>";
			$i++;
		}
	}
	return $vHtml;
}


/*
code_timezone 공통코드 셀렉트박스 생성 함수 
*/
function codeTimezoneList($selectVal){
	$pdo = dbconn();
	$sql = "select timezone_root from code_timezone group by timezone_root  order by timezone_root asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			if($selectVal == $item->timezone_root){
				$selected = "selected";
			}else{
				$selected = "";
			} 
			//$opt_str_arr = explode("/",$item->timezone_root);
			$vHtml .= "<option value='".$item->timezone_root."' ".$selected."/>".$item->timezone_root."</option>";
			//$vHtml .= "<option value='".$item->timezone_root."' ".$selected."/>".$opt_str_arr[1]."</option>";
			$i++;
		}
	}
	return $vHtml;
}

/*
shop_category 공통코드 셀렉트박스 생성 함수 
: select 박스는 별도로 선언하고 option 부분만 호출 
$selectVal : 실제 선택 된 값
$code_gubun : parent_idx 컬럼의 구분값 
Author : 2023-03-18 By KGY

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<select name="">
<?=truckCodeSelectList($selectVal, $code_gubun)?>
</select>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function truckCodeSelectList($selectVal, $code_gubun){
	$pdo = dbconn();
	$sql = "select * from shop_category where 1 = 1 and parent_idx='$code_gubun' and useYN='Y' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			if($selectVal == $item->idx){//2023-03-28 컬럼명 잘못 적혀 있어 수정 KSR ms_idx -> idx 
				$selected = "selected";
			}else{
				$selected = "";
			}
			$vHtml .= "<option value='".$item->idx."' ".$selected."/>".$item->cate_name."</option>";
			$i++;
		}
	}
	return $vHtml;
}


/*
management_set 공통코드 셀렉트박스 생성 함수 
: select 박스는 별도로 선언하고 option 부분만 호출 
$selectVal : 실제 선택 된 값
$code_gubun : ms_type 컬럼의 구분값 

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<select name="">
<?=truckManagerCodeSelectList($selectVal, $code_gubun)?>
</select>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function truckManagerCodeSelectList($selectVal, $code_gubun){
	$pdo = dbconn();
	if($code_gubun === "SE0042"){//세차일 경우만 실크 까지 같이 가져옴
		$sql = "select * from management_set where 1 = 1 and ms_type in ('SE0042', 'SE0043') order by name asc";
	}else{
		$sql = "select * from management_set where 1 = 1 and ms_type='$code_gubun' order by name asc";
	}
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$selected = "";
			if($selectVal == $item->ms_idx){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$vHtml .= "<option value='".$item->ms_idx."' ".$selected."/>".$item->name."</option>";
			$i++;
		}
	}
	return $vHtml;
}
 

/*
board_category 공통코드 셀렉트박스 생성 함수 
: select 박스는 별도로 선언하고 option 부분만 호출 
$selectVal : 실제 선택 된 값
$code_gubun : parent_idx 컬럼의 구분값 

사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (S)
<select name="">
<?=boardCodeSelectList($selectVal, $code_gubun)?>
</select>
사용예시 >>>>>>>>>>>>>>>>>>>>>>>>>> (E)
*/
function boardCodeSelectList($selectVal, $code_gubun){
	$pdo = dbconn();
	$sql = "select * from board_category where 1 = 1 and parent_idx='$code_gubun' and useYN='Y' order by sort_no asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$cnt = $stmt->rowCount();
	$vHtml = "";

	if($cnt > 0){
		$i = 0;
		foreach ($row as $item) {
			$selected = "";
			if($selectVal == $item->idx){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$vHtml .= "<option value='".$item->idx."' ".$selected."/>".$item->cate_name."</option>";
			$i++;
		}
	}
	return $vHtml;
}
 

?>