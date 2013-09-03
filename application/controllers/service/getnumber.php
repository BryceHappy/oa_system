<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 後端首頁控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Getnumber extends A_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->file_name = 'service/';
		$this->load->model('service/m_getnumber');
	}

	function index()
	{
		$view_datas['ClientNumber'] = $this->m_getnumber->getClientNumber();
		$view_datas['ContractNumber'] = $this->m_getnumber->getCaseNumber();
		$this->load->view($this->file_name.'index',$view_datas);
	}
}