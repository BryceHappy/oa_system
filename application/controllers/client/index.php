<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 後端首頁控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Index extends A_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->file_name = 'client/';
		$this->load->model('m_common');
	}

	function index()
	{
		$view_datas['ClientNumber'] = $this->m_getnumber->getClientNumber();
		$view_datas['ContractNumber'] = $this->m_getnumber->getCaseNumber();
		$this->load->view($this->file_name.'index',$view_datas);
	}

	function add_user()
	{

		$view_datas['title'] = '新增客戶';
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
		{
			print_r($this->input->post());
			exit;
			$this->load->helper('my_md5');
			$temp_pwd = $this->input->post('password');
			$post['username']       = $this->input->post('username');
			$post['password']       = str_md5($temp_pwd);
			$post['power_group_id'] = $this->input->post('power_group_id');
			$action = $this->m_admin->add($post);
			if($action === 'exist')
			{
				$post['password'] = $temp_pwd;
				$view_datas['submit_info'] = array('title' => '用戶名已存在', 'object_value' => $post);
			} else if($action) {
				$view_datas['submit_info'] = array('title' => '增加成功');
			} else {
				$view_datas['submit_info'] = array('title' => '增加失敗');
			}
		}
		$view_datas['client_type'] = $this->m_common->get_dict('客戶類別');
		$view_datas['source'] = $this->m_common->get_dict('客戶來源');
		$view_datas['status'] = $this->m_common->get_dict('客戶狀態');
		$view_datas['ranking'] = $this->m_common->get_dict('客戶等級');

		$this->load->view($this->file_name . 'add_client', $view_datas);
	}
	
}