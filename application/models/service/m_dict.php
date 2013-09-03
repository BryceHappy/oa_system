<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端管理员模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_dict extends CI_Model
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
	function dictionary_datas($arg = array())
	{

		$this->db->select('*')->from('dictionary');
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
			$this->db->limit($arg['limit'][0], $arg['limit'][1] ? $arg['limit'][1] : 0);
		}
		return isset($arg['get_count']) ? $this->db->count_all_results() : $this->db->get()->result_array();
	}
	
	/**
	 * 管理员数据
	 * 
	 * @access   public
	 * @param    array    条件数据
	 * @return
	 */
	function dict_type_datas($arg = array())
	{

		$this->db->select('*')->from('dict_type');
		if(isset($arg['status']))
		{
			$this->db->where('status', $arg['status']);
		}
		if(isset($arg['search_key']) && $arg['search_key'])
		{
			$this->db->like('name', $arg['search_key']);
		}
		if(isset($arg['limit']))
		{
			$this->db->limit($arg['limit'][0], $arg['limit'][1] ? $arg['limit'][1] : 0);
		}

		if(isset($arg['get_count']))
		{
			return $this->db->count_all_results();
		} else {
			return $this->db->get()->result_array();	
		}
			
		
	}

	function to_excel($arg = array())
	{

		$this->db->select('*')->from($arg['table_name']);
		
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
			// $this->db->limit($this->pagination->per_page, $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0);
			$this->db->limit($arg['limit'][0],$arg['limit'][1]);
		}
		
		$this->load->model('m_common');
		$query = $this->db->get();
		// print_r($query->result_array());
		// print_r($this->input->get($this->pagination->query_string_segment));
		// exit;
		return $this->m_common->result_print_excel($query);
	}

	function dict_type_datas_url($arg = array())
	{

		$this->db->select('*')->from('dict_type');
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


	function dictionary_datas_url($arg = array())
	{

		$this->db->select('*')->from('dictionary');
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
