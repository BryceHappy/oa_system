<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后端权限管理模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_power extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 添加权限
	 * 
	 * @access   public
	 * @param    array     数据数组
	 * @return   boolean   成功与否
	 */
	function add($post)
	{
		if($this->m_common->get_one('power', array('power_name' => $post['power_name'])))
		{
			return FALSE;
		}
		$rank = $this->db->select_max('rank')->from('power')->where(array('pid' => $post['pid'], 'power_site' => $post['power_site']))->get()->row_array();
		$post['rank'] = $rank['rank'] + 5;
		$insert_id = $this->m_common->insert('power', $post);
		if($insert_id)
		{
			$super_power_group = $this->m_common->get_one('power_group', array('id' => 1));
			$this->m_common->update('power_group', array('power_ids' => $super_power_group['power_ids'] . ',' . $insert_id), array('id' => 1));
			$power_data_session = $this->session->userdata('admin_power_ids');
			$power_data_session[] = $insert_id;
			$session['admin_power_ids'] = $power_data_session;
			$this->session->set_userdata($session);
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * 获取权限数据并实现分类树数据
	 * 
	 * @access   public
	 * @param    array    条件参数集
	 * @return   array    处理后形成的一维数据数组
	 */
	function power_datas($arg = array())
	{
		$this->load->helper('my_tree');
		isset($arg['status']) ? $this->db->where('status', $arg['status']) : '';
		return classify_tree($this->db->select('*')->from('power')->order_by('rank', 'asc')->get()->result_array());
	}
	
	/**
	 * 删除权限所在权限组的数据
	 * 
	 * @access   public
	 * @param    number   数据编号
	 */
	function del($del_id)
	{
		$group_datas = $this->m_common->get_all('power_group');
		foreach($group_datas as $data)
		{
			$power = explode(',', $data['power_ids']);
			$find_key = array_search($del_id, $power);
			if($find_key !== '')
			{
				unset($power[$find_key]);
				$this->m_common->update('power_group', array('power_ids' => implode(',', $power)), array('id' => $data['id']));
			}
		}
	}
	
	/**
	 * 编辑权限
	 * 
	 * @access   public
	 * @param    array    数据数组
	 * @param    number   数据编号
	 * @return   array    数据更新情况
	 */
	function edit($post, $edit_id)
	{
		if($this->m_common->get_one('power', array('power_name' => $post['power_name'], 'id <>' => $edit_id)))
		{
			return 'exist';
		}
		$p_data = $this->m_common->get_one('power', array('id' => $post['pid']));
		if($p_data && $p_data['status'] != 1)
		{
			$post['status'] = $p_data['status'];
		}
		if($post['status'] != 1)
		{
			$this->load->helper('my_children');
			$children_ids = children_ids($edit_id, 'power');
			if($children_ids)
			{
				$this->db->where_in('id', $children_ids)->update('power', array('status' => $post['status']));
			}
		}
		$return = array('affected_rows' => $this->m_common->update('power', $post, array('id' => $edit_id)), 'status' => $post['status']);
		return $return;
	}
	
	/**
	 * 添加权限组
	 * 
	 * @access   public
	 * @param    array    数据数组
	 * @return   number   添加成功返回的编号值
	 */
	function group_add($post)
	{
		$exist = $this->m_common->get_one('power_group', array('group_name' => $post['group_name']));
		if($exist)
		{
			return 'exist';
		}
		return $this->m_common->insert('power_group', $post);
	}
	
	/**
	 * 权限组数据
	 * 
	 * @access   public
	 * @return   array    数据数组
	 */
	function group_datas()
	{
		$datas = $this->m_common->get_all('power_group');
		foreach($datas as $n => $data)
		{
			$datas[$n]['use_count'] = $this->db->where('power_group_id', $data['id'])->count_all_results('admin');
		}
		return $datas;
	}
	
	/**
	 * 编辑权限组
	 * 
	 * @access   public
	 * @param    array    数据数组
	 * @param    number   数据编号
	 * @return   number   更新条数
	 */
	function group_edit($post, $edit_id)
	{
		$exist = $this->m_common->get_one('power_group', array('group_name' => $post['group_name'], 'id <> ' => $edit_id));
		if($exist)
		{
			return 'exist';
		}
		return $this->m_common->update('power_group', $post, array('id' => $edit_id));
	}
}

/* End of file m_power.php */
/* Location: ./application/models/admin/m_power.php */