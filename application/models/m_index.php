<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端首页模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_index extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	/**
	 * 用户登陸
	 * 
	 * @access   public
	 * @param    array     数组形式验证數據
	 * @return   boolean   是否登陸成功
	 */
	function login($post)
	{
		$data = $this->m_common->get_one('admin', $post);
		if($data)
		{
			if($data['status'] == 1)
			{
				$power_data = $this->m_common->get_one('power_group', array('id' => $data['power_group_id'], 'status' => 1), 'group_name, power_ids');
				$session['admin_uid']        = $data['id'];
				$session['admin_username']   = $data['username'];
				$session['admin_power_name'] = $power_data ? $power_data['group_name'] : '';
				$session['admin_power_ids']  = $power_data ? explode(',', $power_data['power_ids']) : array();
				$session['admin_login_time'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
				$this->session->set_userdata($session);
				return TRUE;
			} else {
				return 'stop';
			}
		}
		return FALSE;
	}
	
	/**
	 * 獲取登陸會話訊息
	 * 
	 * @access   public
	 * @return   array   登陸會話訊息
	 */
	function get_session()
	{
		$session['admin_uid']        = $this->session->userdata('admin_uid');
		$session['admin_username']   = $this->session->userdata('admin_username');
		$session['admin_power_name'] = $this->session->userdata('admin_power_name');
		$session['admin_power_ids']  = $this->session->userdata('admin_power_ids');
		$session['admin_login_time'] = $this->session->userdata('admin_login_time');
		return $session;
	}
	
	/**
	 * 注销登陸會話訊息
	 * 
	 * @access   public
	 * @return   array   登陸會話訊息
	 */
	function logout()
	{
		$session['admin_uid']        = '';
		$session['admin_username']   = '';
		$session['admin_power_name'] = '';
		$session['admin_power_ids']  = '';
		$session['admin_login_time'] = '';
		$this->session->unset_userdata($session);
		return TRUE;
	}
	
	/**
	 * 獲取選單數據
	 * 
	 * @access   public
	 * @param    string   選單類型 left = 左邊選單，right = 右邊選單
	 * @return   array    選單數據
	 */
	function get_menu($type)
	{
		$admin_power_ids = $this->session->userdata('admin_power_ids');
		if(!$admin_power_ids)
		{
			return array();
		}
		$power = $this->db->select('*')->from('power')->where(array('power_site' => ($type == 'left' ? 2 : 3), 'pid' => 0, 'status' => 1))->where_in('id', $admin_power_ids)->order_by('rank', 'asc')->get()->result_array();
		foreach($power as $p_num => $p_data)
		{
			$pd_sub = $this->db->select('*')->from('power')->where(array('power_site' => 1, 'pid' => $p_data['id'], 'status' => 1))->where_in('id', $admin_power_ids)->order_by('rank', 'asc')->get()->result_array();
			foreach($pd_sub as $ps_num => $ps_data)
			{
				$pd_sub[$ps_num]['sub_power'] = $this->db->select('*')->from('power')->where(array('power_site' => 1, 'pid' => $ps_data['id'], 'status' => 1))->where_in('id', $admin_power_ids)->order_by('rank', 'asc')->get()->result_array();
			}
			$power[$p_num]['sub_power'] = $pd_sub;
		}
		return $power;
	}
	
	/**
	 * 檢查是否具有訪問權限
	 * 
	 * @access   public
	 * @param    string    權限名稱
	 * @return   boolean   是否
	 */
	function check_power($power_name)
	{
		$power_data = $this->m_common->get_one('power', array('power_name' => $power_name, 'status' => 1), 'id');
		if($power_data && in_array($power_data['id'], $this->session->userdata('admin_power_ids')))
		{
			return TRUE;
		}
		return FALSE;
	}
}

/* End of file m_index.php */
/* Location: ./application/models/admin/m_index.php */