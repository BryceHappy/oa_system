<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 公共控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Common extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		exit('Directory access is forbidden.');
	}
	
	/**
	 * 在线编辑器文件上传
	 */
	function editor_upload()
	{
		require_once str_replace(base_url(), '', SITE_RESOURCES) . '/kindeditor/php/upload_json.php';
	}
	
	/**
	 * 在线编辑器文件管理
	 */
	function editor_manager()
	{
		require_once str_replace(base_url(), '', SITE_RESOURCES) . '/kindeditor/php/file_manager_json.php';
	}
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */