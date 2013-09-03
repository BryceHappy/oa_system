<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends A_Controller
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
        $view_datas['status'] = $status = $this->input->post('status') ? $status = $this->input->post('status') : 1;
        $view_datas['search_key'] = $search_key = $this->input->post('search_key') ? $search_key = $this->input->post('search_key') : '';
        
        $config['base_url'] = base_url().'welcome/index/';
        $config['total_rows'] = $this->m_dict->dict_type_datas(array('get_count' => TRUE, 'search_key' => $search_key, 'status' => $status));
        $config['per_page']='20';
        $config['full_tag_open']='<p>';
        $config['next_link'] ="下一頁";
        $config['full_tag_close']='</p>';
        $config['prev_link'] = "上一頁";
        $this->pagination->initialize($config);
// print_r($config);
        $view_datas['datas'] = $this->m_dict->dict_type_datas(array('limit' => array($config['per_page'],  $this->uri->segment(3)), 'search_key' => $search_key, 'status' => $status));
 
        $this->load->view($this->file_name.'dict', $view_datas);
    }

}