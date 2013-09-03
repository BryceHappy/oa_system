<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define ('SN_CLIENT', 1);
define ('SN_QUOTATION', 2);
define ('SN_CONTRACT', 3);
define ('SN_ORDER', 4);
define ('SN_ATTACHMENT', 5);
define ('SN_IMAGE', 6);
define ('SN_APR', 7);
define ('SN_CASE_NUMBER', 8);
define ('SN_MAINTAIN', 9);
define ('SN_PARTNER', 10);

/**
 * 後端ADMIN模型
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */

class M_getnumber extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    
    function getSerialNumber($type, $min, $max, $ym = 0, $digits = 8, $even = false)
    {

        $v['ax'] = floor(rand($min * 100, $max * 100 + 99) / 100);
        if ($ym > 0) {
            $v['ym'] = date('ym');
            $digits -= 4;
            $f = "{$v['ym']}%0{$digits}d";
        } else {
            $f       = "%0{$digits}d";
            $v['ym'] = 0;
        }
        
        $v['type'] = $type;

		$id = $this->m_common->insert('sys_sn', $v);

        $this->db->where('type', $type);
        $this->db->where('id <', $id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get('sys_sn');

        /*
        $sql = "SELECT * FROM l_sys_sn WHERE `type` = ' AND id < $id ORDER BY id DESC";
        $query = $this->db->query($sql);
        */

        if ($query->num_rows() > 0){
        	 $row = $query->row_array(); 

            if ($row['ym'] == $v['ym']) {
                $v['ax'] += $row['ax'];
                $ax = $v['ax'];
            } else 
                $ax = $v['ax'] = $this->get_initial_number($digits, $v['ax']); // 弄得更亂

        } else // 都沒有資料
            $ax = $v['ax'] = $this->get_initial_number($digits, $v['ax']); // 弄得更亂

        if (!$even && $this->is_even($ax))
            $v['ax'] = ++$ax;

        $data = array('ax' => $v['ax']);
        
        $this->db->where('id', $id);
        $this->db->update('sys_sn', $data); 
        $sn = sprintf($f, $ax);
        return $sn;
    }
    
    function is_odd($n)
    {
        return $n & 1;
    }

    function is_even($n)
    {
        return !$this->is_odd($n);
    }

	function get_initial_number($digits, $ax)
	{
		if ($digits >= 4) // 弄得更亂
		{
			$a = pow(10, $digits - 1);
			return floor(rand($a * 8, $a * 12) / 10);
		}
		return $ax;
	}

    function getClientNumber($ary=null)
    {
        return $this->getSerialNumber(SN_CLIENT, 7, 37, 0, 7);
    }
    
    function getQuotationNumber()
    {
        return $this->getSerialNumber(SN_QUOTATION, 7, 37, 0, 7);
    }
    
    function getOrderNumber()
    {
        return $this->getSerialNumber(SN_ORDER, 7, 37, 0, 7);
    }
    
    function getContractNumber()
    {
        return $this->getSerialNumber(SN_CONTRACT, 7, 37, 0, 7);
    }
    
    function getAttachmentNumber()
    {
        return $this->getSerialNumber(SN_ATTACHMENT, 1, 1, 0, 8, true);
    }
    
    function getImageNumber()
    {
        return $this->getSerialNumber(SN_IMAGE, 1, 1, 0, 8, true);
    }
    
    function getAprNumber()
    {
        return $this->getSerialNumber(SN_APR, 7, 37, 1, 10, true);
    }
    
    function getMaintainNumber()
    {
        return 'R' . $this->getSerialNumber(SN_MAINTAIN, 11, 37, 1, 9, true);
    }
    
    function getCaseNumber()
    {
        return $this->getSerialNumber(SN_CASE_NUMBER, 7, 37, 1, 10);
    }
    
    function getPartnerNumber()
    {
        return $this->getSerialNumber(SN_PARTNER, 7, 37, 0, 6);
    }
    
    
    /**
     * 添加用戶
     * 
     * @access   public
     * @param    array    數據數組
     * @return   number   添加後的數據編號
     */
    function add($post)
    {
        $exist = $this->m_common->get_one('admin', array(
            'username' => $post['username']
        ), 'id');
        if ($exist) {
            return 'exist';
        }
        return $this->m_common->insert('admin', $post);
    }
    
    /**
     * ADMIN數據
     * 
     * @access   public
     * @param    array    條件數據
     * @return
     */
    function admin_datas($arg = array())
    {
        $this->db->select('admin.*, power_group.group_name')->from('admin')->join('power_group', 'power_group.id = admin.power_group_id');
        if (isset($arg['status'])) {
            $this->db->where('admin.status', $arg['status']);
        }
        if (isset($arg['search_key']) && $arg['search_key']) {
            $this->db->like('username', $arg['search_key']);
            $this->db->or_like(array(
                'power_group.group_name' => $arg['search_key']
            ));
        }
        if (isset($arg['limit'])) {
            $this->db->limit($this->pagination->per_page, $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0);
        }
        return isset($arg['get_count']) ? $this->db->count_all_results() : $this->db->get()->result_array();
    }
}

/* End of file m_admin.php */
/* Location: ./application/models/admin/m_admin.php */