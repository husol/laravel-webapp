<?php
// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/HUS/common_helper.php"
// ]

// Chạy cmd : composer dumpautoload
// IMPORTANT FUNCTIONS

if (!function_exists("mlog")) {
    function mlog($content, $override = false, $filename = '/tmp/debug') {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $openType = $override ? 'w' : 'a';
        if (!$handle = @fopen($filename, $openType)) {
            $result = 3; //"Cannot open file ($filename)";
        }
        //if(empty($content)) $content = var_export($content, true);
        if (empty($content) || is_array($content) || is_object($content)) {
            $content = print_r($content, true);
        }
        $content = date('Y-m-d H:i:s') . "  $content \n\n";

        // Write $somecontent to our opened file.
        if (@fwrite($handle, $content) === FALSE) {
            $result = 2; //"Cannot write to file ($filename)";
        } else {
            $result = 1; //"Success, wrote ($somecontent) to file ($filename)";
        }
        @fclose($handle);
        return $result;
    }
}

function dataConvert($var) {
    $ascii = '';
    $length = strlen($var);
    for ($iterator = 0; $iterator < $length; $iterator ++) {
        $char = $var{$iterator};
        $charCode = ord($char);
        if ($charCode < 128) {

            $ascii .= $char;

        } else if ($charCode >> 5 == 6) {

            $byteOne = ($charCode & 31);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteTwo = ($charCode & 63);

            $charCode = ($byteOne * 64) + $byteTwo;

            $ascii .= sprintf('\u%04s', dechex($charCode));

        } else if ($charCode >> 4 == 14) {

            $byteOne = ($charCode & 31);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteTwo = ($charCode & 63);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteThree = ($charCode & 63);

            $charCode = ((($byteOne * 64) + $byteTwo) * 64) + $byteThree;

            $ascii .= sprintf('\u%04s', dechex($charCode));

        } else if ($charCode >> 3 == 30) {

            $byteOne = ($charCode & 31);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteTwo = ($charCode & 63);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteThree = ($charCode & 63);

            $iterator ++;

            $char = $var{$iterator};

            $charCode = ord($char);

            $byteFour = ($charCode & 63);

            $charCode = ((((($byteOne * 64) + $byteTwo) * 64) + $byteThree) * 64) + $byteFour;

            $ascii .= sprintf('\u%04s', dechex($charCode));
        }
    }
    return $ascii;
}

function ajaxOutData($resultData = true) {
    ob_start("ob_gzhandler");

    header('Content-Type: application/json; charset=utf-8');

    $outPut = is_string($resultData) ? dataConvert($resultData) : $resultData;

    echo json_encode($outPut);
    ob_end_flush();
    die();
}

function getController($str, $parram = 'name') {
    $controllerArr = explode('\\', $str);
    $controller = end($controllerArr);
    list($controllerName, $action) = explode('@', $controller);

    if ($parram == 'name') {
        return $controllerName;
    }

    return $action;
}

/*
@Author: Khoa
-- Usage: We can sort an array by many fields we want
    $data: Your multiple array data which needs sorting
    $sortCriteria: Add as many fields as you want.
        Ex: $sortCriteria = array('field1' => array(SORT_DESC, SORT_STRING), 'field3' => array(SORT_DESC, SORT_NUMERIC));
    $type: type of elements in $data, default is 'array', else: object
    $keepIndex: Keep index after sorting or not, default is true
*/
function sortArrayByKey($data, $sortCriteria, $keepIndex = false, $type = 'array') {
    $argsSort = '';
    $dataSort = array();
    $dataWithIndex = array();
    foreach ($sortCriteria as $field => $sortInfo) {
        foreach ($data as $key => $val) {
            if($type == 'array') {
                $value = str_replace(array("%", ","), array('',''), $val[$field]);
            } else {
                $value = str_replace(array("%", ","), array('',''), $val->$field);
            }
            //backup index here
            if($keepIndex) {
                $dataWithIndex["index_$key"] = $val;
            }

            $dataSort[$field][$key] = strtolower($value);
        }
        $argsSort .= sprintf('$dataSort["%s"], %s, %s, ', $field, $sortInfo[0], $sortInfo[1]);
    }
    //Sort data with index or not
    eval('array_multisort('.$argsSort.($keepIndex ? '$dataWithIndex' : '$data').');');

    //Now we return the result with index or not
    $dataSort = array();
    if ($keepIndex) {
        foreach ($dataWithIndex as $key => $value) {
			$dataSort[substr($key, 6)] = $value;
		}
    } else {
        foreach ($data as $value) {
			$dataSort[] = $value;
		}
    }

    return $dataSort;
}

// END IMPORTANT FUNCTIONS

//UTF-8 encoding:
function stripUnicode($str) {
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER) {// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}

function getRole($user) {
    if($user != null) {
        $userInfo = json_decode($user->info);
        if(isset($userInfo->role)) {
            return $userInfo->role;
        }
    }
    return json_decode('{"role":{"vtb":"false","vbc":"false","sch":"false","cse":"false","isAdmin":"false","tci3":"false","tci4":"false","tci5":"false"}}');
}
?>