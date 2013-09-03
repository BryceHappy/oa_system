<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 後端首頁控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Dict extends A_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->file_name = 'service/';
        $this->load->model('service/m_dict');
    }

	function index()
    {
        $view_datas['title'] = '資料字典';
        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status'] = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;

        $this->load->helper('my_page');
        $config['page_query_string'] = true;
        // get this function name =  __FUNCTION__ 
        $config['base_url'] = site_url('service/dict/'.__FUNCTION__) . '?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows'] = $this->m_dict->dict_type_datas_url(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status));
        $config['uri_segment'] = 4;
		$config['per_page'] = 10;
        $view_datas['pages'] = page_links($config);
        $view_datas['url'] = base_url().'index.php/'.$this->file_name.'dictionary/type/';
        $view_datas['datas'] = $this->m_dict->dict_type_datas_url(array('limit' => TRUE, 'search_key' => $search_key, 'status' => $status));
        // $view_datas['levle_1'] = $this->uri->uri_string();
		$offset = $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0;
		$to_excel_str ='';
		$to_excel_str .= "page_".$config['per_page'];
		$to_excel_str .= "__offset_".$offset;
		$to_excel_str .= "__status_".$status;
		$to_excel_str .= "__key_".($search_key ? $search_key : 0);
		
        $view_datas['excel_url'] = $to_excel_str;
        $view_datas['method'] = 'GET';
        $this->load->view($this->file_name.'dict', $view_datas);
    }

    function index_bk()
    {

        $view_datas['title'] = '資料字典';
        $view_datas['status'] = $status = $this->input->post('status') ? $status = $this->input->post('status') : 1;
        $view_datas['search_key'] = $search_key = $this->input->post('search_key') ? $search_key = $this->input->post('search_key') : '';
        $this->load->helper('my_page');
		
        $config['base_url'] = site_url('service/dict/index/');
        $config['total_rows'] = $this->m_dict->dict_type_datas(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status));
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['full_tag_open']='<p>';
        $config['next_link'] ="下一頁";
        $config['full_tag_close']='</p>';
        $config['prev_link'] = "上一頁";
		$view_datas['pages'] = page_links($config);
		
		$view_datas['excel']['per_page'] = $config['per_page'];
		$view_datas['excel']['status'] = $status;
		$view_datas['excel']['search_key'] = $search_key ? $search_key : 0;
		$view_datas['excel']['offset'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$view_datas['excel']['print_excel'] = 1;
		
        $view_datas['url'] = site_url($this->file_name.'dictionary/type/');
		$view_datas['datas'] = $this->m_dict->dict_type_datas(array('limit' => array($config['per_page'],  $this->uri->segment(4)), 'search_key' => $search_key, 'status' => $status));
		$view_datas['total_count'] =  $config['total_rows'];
        $this->load->view($this->file_name.'dict', $view_datas);
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
	
	function create_excel($arg = array())
	{
		return;
	}

    function edit()
    {
        $edit_id = $this->uri->segment(4);
        $view_datas['edit_data'] = $this->m_common->get_one('dict_type', array('id' => $edit_id));

        if($view_datas['edit_data'])
        {
            $view_datas['title'] = '編輯資料字典母項目';
            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
            {
                $post['name'] = $this->input->post('name');
                $post['note'] = $this->input->post('note');
                $post['status'] = $this->input->post('status');
                $action = $this->m_common->update('dict_type', $post, array('id' => $edit_id));
                $view_datas['edit_data'] = array_merge($view_datas['edit_data'], $post);
                if($action)
                {
                    $view_datas['submit_info'] = array('title' => '編輯成功');
                } else {
                    $view_datas['submit_info'] = array('title' => '資料未修改或更新失敗');
                }
            }
            $this->load->view($this->file_name . 'dict_edit', $view_datas);
        } else {
            redirect('admin/admin/index');
        }
    }
	
	
	
	function print_excel()
	{
		$config = $this->parsing_criteria($this->uri->segment(4));
		$search_key = urldecode(isset($config['key']) ? $search_key = $config['key'] : 0);
        $status = isset($config['status']) ? $status = $config['status'] : 1;
		$table_name = 'dict_type';
		
		$limit[0] = isset($config['page']) ? $config['page'] : 1;
		$limit[1] = isset($config['offset']) ? $config['offset'] : 0;
		
     	return $this->m_dict->to_excel(array('table_name' =>$table_name ,'limit' => $limit, 'search_key' => $search_key, 'status' => $status));
	}
}