<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dictionary extends A_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->file_name = 'service/';
        $this->load->model('service/m_dict');
    }


    function index($id)
    {
        $view_datas['title'] = '資料字典細項';

        //上一層的ID
        $segment = $this->uri->segment(4);
        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status'] = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;

        $this->load->helper('my_page');
        $config['page_query_string'] = true;
    	$config['base_url'] = site_url('service/dictionary/'.__FUNCTION__).'/'.$id. '/index?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows'] = $this->m_dict->dictionary_datas_url(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status, 'type' => $segment));
        $config['per_page']='10';
        $config['uri_segment'] = 5;
		$view_datas['pages'] = page_links($config);
        $view_datas['datas'] = $this->m_dict->dictionary_datas_url(array('limit' => TRUE, 'search_key' => $search_key, 'status' => $status, 'type' => $segment));
        $view_datas['method'] = 'GET';
        $this->load->view($this->file_name.'dictionary', $view_datas);
    }

    function index_bk($id)
    {
        $view_datas['title'] = '資料字典細項';

        //上一層的ID
        $segment = $this->uri->segment(4);

        $last_level_url = $this->file_name."dict/".$segment; 

        $view_datas['status'] = $status = $this->input->post('status') ? $status = $this->input->post('status') : 1;
        $view_datas['search_key'] = $search_key = $this->input->post('search_key') ? $search_key = $this->input->post('search_key') : '';
     

        $this->load->helper('my_page');
    	$config['base_url'] = base_url().'service/dictionary/index/'.$id.'/';	;
        $config['total_rows'] = $this->m_dict->dictionary_datas(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status, 'type' => $segment));
        $config['per_page']='20';
        $config['uri_segment'] = 5;
        $config['full_tag_open']='<p>';
        $config['next_link'] ="下一頁";
        $config['full_tag_close']='</p>';
        $config['prev_link'] = "上一頁";
        
		$view_datas['pages'] = page_links($config);
        $view_datas['datas'] = $this->m_dict->dictionary_datas(array('limit' => array($config['per_page'],  $this->uri->segment(5)), 'search_key' => $search_key, 'status' => $status, 'type' => $segment));
 
        $this->load->view($this->file_name.'dictionary', $view_datas);
    }

    function edit()
    {
        $edit_id = $this->uri->segment(4);
        $view_datas['edit_data'] = $this->m_common->get_one('dictionary', array('id' => $edit_id));

        if($view_datas['edit_data'])
        {
            $view_datas['title'] = '編輯資料字典細項';
            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
            {
                $post['value'] = $this->input->post('value');
                $post['status'] = $this->input->post('status');
                $action = $this->m_common->update('dictionary', $post, array('id' => $edit_id));
                $view_datas['edit_data'] = array_merge($view_datas['edit_data'], $post);
                if($action)
                {
                    $view_datas['submit_info'] = array('title' => '編輯成功');
                } else {
                    $view_datas['submit_info'] = array('title' => '資料未修改或更新失敗');
                }
            }
            $this->load->view($this->file_name . 'dictionary_edit', $view_datas);
        } else {
            redirect('admin/admin/index');
        }
    }

}