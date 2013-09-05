<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 后端系统設置控制器
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */
class Tables extends A_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->file_name = 'setting/';
        $this->load->model('admin/m_tables');
    }
    
    function get_table()
    {
        $dir        = basename(__DIR__);
        $controller = strtolower(__CLASS__);
        $path       = $dir . '/' . $controller . '/' . __FUNCTION__;
        
        $view_datas['title'] = '輸出資料表管理';
        
        //先把資料庫更新
        $this->m_common->insert_db_table();

        //set table
        $table = 'db_table';
        
        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status']     = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;
        
        $this->load->helper('my_page');
        $config['page_query_string'] = true;
        // get this function name =  __FUNCTION__ 
        $config['base_url']          = site_url($path) . '?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows']        = $this->m_tables->db_table_datas_url(array(
            'table' => $table,
            'get_count' => TRUE,
            'search_key' => $search_key,
            'status' => $status
        ));
        $config['uri_segment']       = 4;
        $config['per_page']          = 10;
        $view_datas['pages']         = page_links($config);

        $view_datas['url']           = site_url('admin/tables/get_table_field/');
        $view_datas['datas']         = $this->m_tables->db_table_datas_url(array(   
            'table' => $table,
            'limit' => TRUE,
            'search_key' => $search_key,
            'status' => $status
        ));

        $offset                      = $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0;
        
        //set excel config
        $to_excel_config['per_page']   = $config['per_page'];
        $to_excel_config['offset']     = $offset;
        $to_excel_config['status']     = $status;
        $to_excel_config['search_key'] = ($search_key ? $search_key : 0);
        
        $view_datas['excel_url'] = $table.'/'.$this->m_common->combine_excel_str($to_excel_config);
        $view_datas['method']    = 'GET';
        $this->load->view($this->file_name . 'table_list', $view_datas);
    }
    
    function get_table_field($db_table_id)
    {
        $db_table_id = $this->uri->segment(4);
        //set path
        $dir        = basename(__DIR__);
        $controller = strtolower(__CLASS__);
        $path       = $dir . '/' . $controller . '/' . __FUNCTION__ . '/' . $db_table_id;
        
        //set table
        $table = 'db_table_field';
        $this->m_tables->insert_db_table_field($db_table_id);
        $tb_name             = $this->m_common->get_one('db_table', array(
            'id' => $db_table_id
        ));
        $view_datas['title'] = '輸出資料欄位管理 - ' . $tb_name['name'];
        
        $view_datas['search_key'] = $search_key = $this->input->get('search_key');
        $view_datas['status']     = $status = $this->input->get('status') ? $status = $this->input->get('status') : 1;
        
        //set page config
        $this->load->helper('my_page');
        $config['page_query_string'] = true;
        $config['base_url']          = site_url($path) . '?status=' . $status . ($search_key ? '&search_key=' . $search_key : '');
        $config['total_rows']        = $this->m_tables->datas_url(array(
            'get_count' => TRUE,
            'table' => $table,
            'search_key' => $search_key,
            'where' => array(
                'db_table_id' => $db_table_id,
            )
        ));
        $config['uri_segment']       = 4;
        $config['per_page']          = 10;
        
        //set excel config
        $offset                        = $this->input->get($this->pagination->query_string_segment) ? $this->input->get($this->pagination->query_string_segment) : 0;
        $to_excel_config['per_page']   = $config['per_page'];
        $to_excel_config['offset']     = $offset;
        $to_excel_config['status']     = $status;
        $to_excel_config['search_key'] = ($search_key ? $search_key : 0);
        $view_datas['excel_url']       = $tb_name['name'].'/'.$this->m_common->combine_excel_str($to_excel_config);
        
        $view_datas['pages']   = page_links($config);
        $view_datas['add_url'] = site_url('admin/tables/add_table_field/' . $tb_name['id']);
        $view_datas['datas']   = $this->m_tables->datas_url(array(
            'limit' => TRUE,
            'table' => $table,
            'search_key' => $search_key,
            'where' => array(
                'db_table_id' => $db_table_id,
            )
        ));
        $view_datas['method']  = 'GET';
        $this->load->view($this->file_name . 'table_field_list', $view_datas);
    }

    function add_table_field($db_table_id)
    {
        $tb_name             = $this->m_common->get_one('db_table', array(
            'id' => $db_table_id
        ));
        $view_datas['title'] = '新增輸出資料欄位 - ' . $tb_name['name'];
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            
            //get input data
            $temp_post = $this->input->post();
            
            //set config
            $tmp_updata_data['table'] = 'db_table_field';
            $tmp_updata_data['where'] = array(
                'db_table_id' => $db_table_id
            );
            $tmp_updata_data['value'] = array(
                'print' => '0'
            );
            
            $chk_table_data = $this->m_common->get_all($tmp_updata_data['table'], $tmp_updata_data['where']);
            
            //update db_table_field
            if (count($chk_table_data) > 0) {
                $this->m_common->update($tmp_updata_data['table'], $tmp_updata_data['value'], $tmp_updata_data['where']);
            }
            
            //有選的話
            if (count($temp_post['table_field']) > 0) {
                foreach ($temp_post['table_field'] as $field_name) {
                    $data['field_name']  = $field_name;
                    $data['db_table_id'] = $db_table_id;
                    $chk_data            = $this->m_common->get_all($tmp_updata_data['table'], $data);
                    
                    $data['print'] = 1;
                    //避免重覆增加
                    if (count($chk_data) == 0) {
                        $action = $this->m_common->insert($tmp_updata_data['table'], $data);
                    } else {
                        $this->m_common->update($tmp_updata_data['table'], array(
                            'print' => $data['print']
                        ), array(
                            'field_name' => $field_name,
                            'db_table_id' => $db_table_id
                        ));
                        $action = true;
                    }
                    unset($data);
                }
            } else {
                $action = flase;
            }
            
            $view_datas['submit_info'] = $action ? array(
                'title' => '增加成功'
            ) : array(
                'title' => '增加失敗'
            );
        }
        
        $this_tb_field             = $this->m_common->get_field($tb_name['name']);
        $view_datas['datas']       = $this->m_tables->chkeck_data($db_table_id, $this_tb_field);
        $view_datas['db_table_id'] = $db_table_id;
        $this->load->view($this->file_name . 'table_field_add', $view_datas);
    }


    function table_field_edit($db_table_field_id)
    {
        $table_name = 'db_table_field';
        $view_datas['edit_data'] = $this->m_common->get_one($table_name, array('id' => $db_table_field_id),'field_name,note');

        if($view_datas['edit_data'])
        {
            $view_datas['title'] = '編輯資料 - '.$view_datas['edit_data']['field_name'];
            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
            {
                $post['note'] = $this->input->post('note');
                $action = $this->m_common->update($table_name, $post, array('id' => $db_table_field_id));
                $view_datas['edit_data'] = array_merge($view_datas['edit_data'], $post);
                if($action)
                {
                    $view_datas['submit_info'] = array('title' => '編輯成功');
                } else {
                    $view_datas['submit_info'] = array('title' => '資料未修改或更新失敗');
                }
            }
            $this->load->view($this->file_name . 'table_field_edit', $view_datas);
        } else {
            redirect('admin/admin/index');
        }
    }

}

/* End of file setting.php */
/* Location: ./application/controllers/admin/setting.php */