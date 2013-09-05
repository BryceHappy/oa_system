<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 公共控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Common extends A_Controller
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

    function print_excel()
    {
        $table_name = $this->uri->segment(3);
        $config = $this->m_common->parsing_criteria($this->uri->segment(4));
        $search_key = urldecode(isset($config['key']) ? $search_key = $config['key'] : 0);
        $status = isset($config['status']) ? $status = $config['status'] : '';
        // $table_name = 'db_table';

        $tmp_query_table_id = $this->m_common->get_one('db_table',array('name' => $table_name),'id');
        $print_field = $this->m_common->get_one_field('db_table_field',array('db_table_id' => $tmp_query_table_id['id'], 'print' => '1'),'field_name');

        $limit[0] = isset($config['page']) ? $config['page'] : 1;
        $limit[1] = isset($config['offset']) ? $config['offset'] : 0;

        return $this->m_common->to_excel(array('table_name' =>$table_name ,'limit' => $limit, 'search_key' => $search_key, 'status' => $status , 'field' => $print_field));
    }
}

/* End of file common.php */
/* Location: ./application/controllers/common.php */