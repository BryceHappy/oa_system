<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端系统設置控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Setting extends A_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->file_name = 'setting/';
		$this->load->model('admin/m_tables');
	}
	
	/**
	 * 公共設置
	 */
	function index()
	{
		$this->the_setting('公共設置', 'index', 'config_common');
	}
	
	/**
	 * 網站設置
	 */
	function site()
	{
		$this->the_setting('網站設置', 'site', 'config_site');
	}
	
	/**
	 * 後台設置
	 */
	function admin()
	{
		$this->the_setting('後台設置', 'admin', 'config_site_admin');
	}
	
	/**
	 * 公共代码
	 * 
	 * @access   private
	 * @param    string    权限名称
	 * @param    string    控制器名
	 * @param    string    操作表名
	 */
	private function the_setting($power_title, $controller, $table)
	{
		$view_datas['title'] = $this->check_power($power_title);
		if($this->input->get('act') == 'succeed')
		{
			$view_datas['submit_info'] = array('title' => '更新成功');
		} else if($this->input->get('act') == 'failed') {
			$view_datas['submit_info'] = array('title' => '資料未修改或更新失敗');
		}
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
		{
			$post = $this->input->post();
			$tabs = $post['tabs'];
			unset($post['tabs']);
			$action = $this->m_common->update($table, $post);
			if($action)
			{
				redirect(site_url('admin/setting/' . $controller) . '?act=succeed#' . $tabs);
			} else {
				redirect(site_url('admin/setting/' . $controller) . '?act=failed#' . $tabs);
			}
		}
		$this->load->view($this->file_name . $controller, $view_datas);
	}

	function get_table()
	{
		$view_datas['title'] = '資料表管理';

		//先把資料庫更新
		$this->m_common->insert_db_table();

        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status'] = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;

        $this->load->helper('my_page');
        $config['page_query_string'] = true;
        // get this function name =  __FUNCTION__ 
        $config['base_url'] = site_url('admin/setting/'.__FUNCTION__) . '?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows'] = $this->m_tables->db_table_datas_url(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status));
        $config['uri_segment'] = 4;
		$config['per_page'] = 10;
        $view_datas['pages'] = page_links($config);
        $view_datas['url'] = base_url().'index.php/'.'admin/setting/get_table_field/';
        $view_datas['datas'] = $this->m_tables->db_table_datas_url(array('limit' => TRUE, 'search_key' => $search_key, 'status' => $status));
        // $view_datas['levle_1'] = $this->uri->uri_string();
		$offset = $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0;
		
		//set excel config
		$to_excel_config['per_page'] = $config['per_page'];
		$to_excel_config['offset'] = $offset;
		$to_excel_config['status'] = $status;
		$to_excel_config['search_key'] = ($search_key ? $search_key : 0);

		// $to_excel_str ='';
		// $to_excel_str .= "page_".$config['per_page'];
		// $to_excel_str .= "__offset_".$offset;
		// $to_excel_str .= "__status_".$status;
		// $to_excel_str .= "__key_".($search_key ? $search_key : 0);
		
        $view_datas['excel_url'] = $this->m_common->combine_excel_str($to_excel_config);
        $view_datas['method'] = 'GET';
        $this->load->view($this->file_name.'table_list', $view_datas);
	}

	function get_table_field()
	{
		
		$view_datas['title'] = '資料欄位管理';
		$table = 'db_table_field';

        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status'] = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;

        $this->load->helper('my_page');
        $config['page_query_string'] = true;
        // get this function name =  __FUNCTION__ 
        $config['base_url'] = site_url('admin/setting/'.__FUNCTION__) . '?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows'] = $this->m_tables->datas_url(array('get_count' => TRUE, 'table' => $table, 'search_key' => $search_key, 'status' => $status));
        $config['uri_segment'] = 4;
		$config['per_page'] = 10;
        $view_datas['pages'] = page_links($config);
        $view_datas['url'] = base_url().'index.php/'.'admin/setting/get_table_field/';
        $view_datas['datas'] = $this->m_tables->datas_url(array('limit' => TRUE, 'table' => $table, 'search_key' => $search_key, 'status' => $status));
        // $view_datas['levle_1'] = $this->uri->uri_string();
		$offset = $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0;
		
		//set excel config
		$to_excel_config['per_page'] = $config['per_page'];
		$to_excel_config['offset'] = $offset;
		$to_excel_config['status'] = $status;
		$to_excel_config['search_key'] = ($search_key ? $search_key : 0);
		
        $view_datas['excel_url'] = $to_excel_config;
        $view_datas['method'] = 'GET';
        $this->load->view($this->file_name.'table_field_list', $view_datas);
	}
}

/* End of file setting.php */
/* Location: ./application/controllers/admin/setting.php */