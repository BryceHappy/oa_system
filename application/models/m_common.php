<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 網站公用程式
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class M_common extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	function get_session()
	{
		$session['admin_uid']        = $this->session->userdata('admin_uid');
		$session['admin_username']   = $this->session->userdata('admin_username');
		return $session;
	}
	
	/**
	 * 获取单条数据
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    条件数组
	 * @param    string   查询字段
	 * @return   array    一维数据数组
	 */
	function get_one($table, $where = array(), $fields = '*')
	{

		if($where)
		{
			$this->db->where($where);
		}
		return $this->db->select($fields)->from($table)->get()->row_array();
	}


	/**
	 * 獲取全部TABLE
	 * 
	 * @access   public
	 * @return   array    TABLE名稱
	 */
	function insert_db_table()
	{	
		$table_name = 'db_table';
		$all_table = $this->db->list_tables();
		$db_tables = $this->get_all($table_name,'','name');


		foreach ($all_table as $table)
		{
			if (count($db_tables) > 0)
			{
				$count = 0;
			   foreach ($db_tables as $db_table_value)
			   {
				   	if ($table == $db_table_value['name']) 
				   	{
				   		$count++; 
				   	}
			   }

			   if($count == 0)
			   {
			   		$data['name'] = $table;
		   			$this->insert($table_name,$data);
			   }

			} else {
				$data['name'] = $table;
				$this->insert($table_name,$data);
			}
		}
	}

	/**
	 * 获取多条数据
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    条件数组
	 * @param    string   查询字段
	 * @return   array    多维数据数组
	 */
	function get_all($table, $where = array(), $fields = '*')
	{
		if($where)
		{
			$this->db->where($where);
		}
		return $this->db->select($fields)->from($table)->get()->result_array();
	}
	
	/**
	 * 取得多筆row中的單一欄位
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    条件数组
	 * @param    string   查询字段
	 * @return   array    多维数据数组
	 */
	function get_one_field($table, $where = array(), $fields)
	{
		if(!is_array($fields))
		{
			if($where)
			{
				$this->db->where($where);
			}
			$result_ary =  $this->db->select($fields)->from($table)->get()->result_array();
			foreach ($result_ary as $data)
			{
				$tmp[] = $data[$fields];
			}
		} else {
			$tmp = "陣列不適用此function";
		}
		return $tmp;
	}

	/*
	 * 添加数据
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    数据数组
	 * @return   number   添加的记录 ID
	 */
	function insert($table, $post)
	{
		$session = $this->get_session();
		$post['creator'] = $session['admin_uid'];
		$post['cdate'] = date("Y-m-d H:i:s");
		$this->db->insert($table, $post);
		return $this->db->insert_id();
	}
	
	/*
	 * 删除数据
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    条件数组
	 * @return   number   影响行数
	 */
	function delete($table, $where)
	{
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}
	
	/*
	 * 更新数据
	 * 
	 * @access   public
	 * @param    string   表名
	 * @param    array    数据数组
	 * @param    array    条件数组
	 * @return   number   影响行数
	 */
	function update($table, $post, $where = array())
	{
		if($where)
		{
			$this->db->where($where);
		}
		$session = $this->get_session();
		$post['modifier'] = $session['admin_uid'];
		$post['mdate'] = date("Y-m-d H:i:s");
		$this->db->update($table, $post);
		return $this->db->affected_rows();
	}

	// http://ellislab.com/codeigniter/user-guide/database/helpers.html
	function lastid()
	{
		return $this->db->insert_id();	
	}
	
	//http://www.codeigniter.org.tw/user_guide/database/fields.html
	function get_field($table_name)
	{
		return $fields = $this->db->list_fields($table_name);
	}

	function get_dict($dictType_name)
	{
		//先找字典種類 row_array 只取單筆
        $dictQuery = $this->db->get_where('dict_type', array('name' => $dictType_name))->row_array();

        //找到所有字典 result_array 取出為一個陣列
        $this->db->select('id,value');
        $dictionaryQuery = $this->db->get_where('dictionary', array('type_id' => $dictQuery['id']))->result_array();

        return $dictionaryQuery;
	}

	function to_excel($arg = array())
	{
		if(isset($arg['field']))
		{	
			if (is_array($arg['field']))
			{
				foreach ($arg['field'] as $field_value)
				{
					if (isset($field))
					{
						$field .= ','.$field_value;
					} else {
						$field = $field_value;
					}
				}
			} else {
				$field = $arg['field'];
			}

		} else {
			$field = '*';
		}

		$this->db->select($field)->from($arg['table_name']);
		
		if(isset($arg['status']) && $arg['search_key'])
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
		$query = $this->db->get();
		// print_r($query->result_array());
		// print_r($this->input->get($this->pagination->query_string_segment));
		// exit;
		return $this->result_print_excel($query);
	}

	/* 組合excel string
	 * 
	 * 
	 * @access   public
	 * @param    array   設定檔的字串：per_page、offset、status、search_key
	 * @return   string  輸出字串
	 */
	function combine_excel_str($ary=array())
	{
		$to_excel_str ='';
		$to_excel_str .= "page_".$ary['per_page'];
		$to_excel_str .= "__offset_".$ary['offset'];
		$to_excel_str .= "__status_".$ary['status'];
		$to_excel_str .= "__key_".$ary['search_key'];
		return $to_excel_str;
	}

	/* 輸出EXCEL
	 * 
	 * 
	 * @access   public
	 * @param    string   資料表名
	 * @return   .EXCEL   輸出EXCEL表
	 */
	function print_excel_table($table_name)
    {
        $query = $this->db->get($table_name);
 
        if(!$query)
            return false;
 
        // Starting the PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		
 		$name = $table_name.'_'.date('YmdHis');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }


	/* 輸出EXCEL
	 * 
	 * 
	 * @access   public
	 * @param    object   已query後的結果(object)
	 * @return   .EXCEL   輸出EXCEL表
	 */
	function result_print_excel($query)
    {
        // $query = $this->db->get($table_name);
 
        if(!$query)
            return false;
 
        // Starting the PHPExcel library
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		
 		$name = date('YmdHis');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }


	function parsing_criteria($pairs)
	{
	    $criteria = array();
        $pairs = explode("__",$pairs);
        foreach($pairs as $row){
            $array_row = explode("_",$row);
            $criteria[$array_row[0]] = $array_row[1];
        }
	    return $criteria;
	}
}

/* End of file m_common.php */
/* Location: ./application/models/m_common.php */