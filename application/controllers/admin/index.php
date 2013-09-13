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
	}
	
	function index()
	{
	
		$view_datas['title'] = '後台首頁';
		$view_datas['power_left'] = $this->m_index->get_menu('left');
		$view_datas['power_right'] = $this->m_index->get_menu('right');

		$this->load->view('index', $view_datas);
	}
	
	/**
	 * 管理員登入
	 */
	function login()
	{
		$view_datas['title'] = '使用者登入';
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
		{
			$this->load->helper('my_md5');
			$post['username'] = $this->input->post('username');
			$post['password'] = str_md5($this->input->post('password'));

			$action = $this->m_index->login($post);
			if($action === 'stop')
			{
				$post['password'] = $this->input->post('password');
				$view_datas['submit_info'] = array('title' => '該用戶權限已關閉', 'object_value' => $post);
			} else if($action) {
				redirect('admin/index/index');
			} else {
				$post['password'] = $this->input->post('password');
				$view_datas['submit_info'] = array('title' => '使用者或密碼錯誤', 'object_value' => $post);
			}
		}
		$this->load->view('login', $view_datas);
	}
	
	/**
	 * 管理員退出
	 */
	function logout()
	{
		$this->m_index->logout();
		redirect('c_index/index');
	}
	
	/**
	 * 後台首頁信息
	 */
	function index_info()
	{
		$view_datas['title'] = '後台首頁訊息';
		$view_datas['user_data'] = $this->m_index->get_session();
		$this->load->view('index_info', $view_datas);
	}

	function mobile01()
	{
		$view_datas['title'] = '話題';
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
		{
			$post = $this->input->post();
			foreach ($post['title'] as $key => $value)
			{
				$id = $this->m_common->get_one_field('url_table',array('url' => $post['url'][$key]),'id');
				// print_r($id);
				if ($id == 1)
				{
					$data['title'] = $value;
					$data['url'] =  $post['url'][$key];
					$data['note'] = "source: mobile01";
					$this->m_common->insert('url_table',$data);
					unset($data);
				}
			}
			$view_datas['excute'] = 0;
		}

		if(!isset($view_datas['excute']))
			$view_datas['excute'] = 1;

		$ch = curl_init();
		$options = array(CURLOPT_URL => 'www.mobile01.com',
		CURLOPT_HEADER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT => "Google Bot",
		CURLOPT_FOLLOWLOCATION => true
		);
		curl_setopt_array($ch, $options);
		$output = curl_exec($ch);
		curl_close($ch);
		preg_match('/<div[^>]*id="hot-posts"[^>]*>(.*?) <\/div>/si',$output,$match); 
		$match[0] = str_replace("<a href=\"", "<a href=\"http://www.mobile01.com/", $match[0]);
		// $match[0] = str_replace('\n', "", $match[0]);
		$view_datas['content'] = str_replace(" t", " target=_new t",$match[0]);
		$this->load->view('admin/mobile01', $view_datas);
	}
}

/* End of file index.php */
/* Location: ./application/controllers/admin/index.php */