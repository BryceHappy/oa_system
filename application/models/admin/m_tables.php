<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端管理员模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_tables extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function db_table_datas_url($arg = array())
	{

		$this->db->select('*')->from('db_table');
		if(isset($arg['status']))
		{
			$this->db->where('status', $arg['status']);
		}
		if(isset($arg['search_key']) && $arg['search_key'])
		{
			$this->db->like('name', $arg['search_key']);
			$this->db->or_like('id', $arg['search_key']);
		}

		if(isset($arg['limit']))
		{
			$this->db->limit($this->pagination->per_page, $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0);
		}
		return isset($arg['get_count']) ? $this->db->count_all_results() : $this->db->get()->result_array();
	}


	function db_table_field_datas_url($arg = array())
	{

		$this->db->select('*')->from('db_table_field');
		if(isset($arg['type']))
		{
			$this->db->where(array('status' => $arg['status'], 'type_id' => $arg['type']));
		}
		if(isset($arg['search_key']) && $arg['search_key'])
		{
			$this->db->like('value', $arg['search_key']);
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