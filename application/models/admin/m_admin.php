<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端管理员模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_admin extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 添加用户
	 * 
	 * @access   public
	 * @param    array    数据数组
	 * @return   number   添加后的数据编号
	 */
	function add($post)
	{
		$exist = $this->m_common->get_one('admin', array('username' => $post['username']), 'id');
		if($exist)
		{
			return 'exist';
		}
		return $this->m_common->insert('admin', $post);
	}
	
	/**
	 * 管理员数据
	 * 
	 * @access   public
	 * @param    array    条件数据
	 * @return
	 */
	function admin_datas($arg = array())
	{
		$this->db->select('admin.*, power_group.group_name')->from('admin')->join('power_group', 'power_group.id = admin.power_group_id');
		if(isset($arg['status']))
		{
			$this->db->where('admin.status', $arg['status']);
		}
		if(isset($arg['search_key']) && $arg['search_key'])
		{
			$this->db->like('username', $arg['search_key']);
			$this->db->or_like(array('power_group.group_name' => $arg['search_key']));
		}
		if(isset($arg['limit']))
		{
			$this->db->limit($this->pagination->per_page, $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0);
		}
		return isset($arg['get_count']) ? $this->db->count_all_results() : $this->db->get()->result_array();
	}
}

/* End of file m_admin.php */
/* Location: ./application/models/admin/m_admin.php */