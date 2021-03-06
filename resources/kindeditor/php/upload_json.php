<?php
/**
 * KindEditor PHP
 *
 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
 *
 */

require_once dirname(__FILE__) . '/JSON.php';

$php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']) . '/';



//文件保存目錄路径
$save_path = $php_path . '../../../' . str_replace(base_url(), '', SITE_UPLOADS) . '/';
// $root_path = '/uploads';
//文件保存目錄URL
$save_url = $php_url . '../../../' . str_replace(base_url(), '', SITE_UPLOADS) . '/';
// $root_url = base_url().'/uploads';
//定义允許上傳的文件扩展名
$ext_arr = array(
	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
	'flash' => array('swf', 'flv'),
	'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);

$save_path = realpath($save_path) . '/';

//PHP上傳失败
if (!empty($_FILES['imgFile']['error'])) {
	switch($_FILES['imgFile']['error']){
		case '1':
			$error = '超過php.ini允許的大小。';
			break;
		case '2':
			$error = '超過表單允許的大小。';
			break;
		case '3':
			$error = '圖片只有部分被上傳。';
			break;
		case '4':
			$error = '请選擇圖片。';
			break;
		case '6':
			$error = '找不到臨時目錄。';
			break;
		case '7':
			$error = '寫文件到硬碟出錯誤。';
			break;
		case '8':
			$error = 'File upload stopped by extension。';
			break;
		case '999':
		default:
			$error = '未知錯誤誤。';
	}
	alert($error);
}

//有上傳文件时
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//服务器上臨時文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("请選擇文件。");
	}
	//检查目錄
	if (@is_dir($save_path) === false) {
		alert("上傳目錄不存在。");
	}
	//检查目錄寫權限
	if (@is_writable($save_path) === false) {
		alert("上傳目錄没有寫權限。");
	}
	//检查是否已上傳
	if (@is_uploaded_file($tmp_name) === false) {
		alert("上傳失败。");
	}
	//检查目錄名
	$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
	if (empty($ext_arr[$dir_name])) {
		alert("目錄名不正确。");
	}
	switch($dir_name)
	{
		case 'image':
			$max_size = SITE_UPLOAD_IMAGE_SIZE;
		break;
		case 'flash':
			$max_size = SITE_UPLOAD_FLASH_SIZE;
		break;
		case 'media':
			$max_size = SITE_UPLOAD_MEDIA_SIZE;
		break;
		case 'file':
			$max_size = SITE_UPLOAD_FILE_SIZE;
		break;
		default:
			// 最大文件大小，1 M
			$max_size = 1048576;
		break;
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("上傳文件大小超過限制。");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
		alert("上傳文件扩展名是不允許的扩展名。\n只允許" . implode(",", $ext_arr[$dir_name]) . "格式。");
	}
	//创建文件夹
	if ($dir_name !== '') {
		$save_path .= $dir_name . "/";
		$save_url .= $dir_name . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
	}
	$ymd = date("Ymd");
	$save_path .= $ymd . "/";
	$save_url .= $ymd . "/";
	if (!file_exists($save_path)) {
		mkdir($save_path);
	}
	//新文件名
	$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
	//移动文件
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("上傳文件失败。");
	}
	@chmod($file_path, 0644);
	$file_url = base_url().$save_url . $new_file_name;

	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
