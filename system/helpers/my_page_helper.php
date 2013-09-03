<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 实现分页
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 * 
 * @access   public
 * @param    array    分页配置参数
 * @return   string   分页代码
 */
function page_links($config = array())
{
    $config['full_tag_open']='<p id=page_container>';
    $config['first_link'] = "<img src=".base_url()."resources/images/first.png  src='第一頁'>";
    $config['last_link'] = "<img src=".base_url()."resources/images/last.png src='最末頁'>";
    $config['next_link'] = "<img src=".base_url()."resources/images/next.png src='下一頁'>";
    $config['prev_link'] = "<img src=".base_url()."resources/images/prev.png src='上一頁'>";
    $config['full_tag_close']='</p>';
	$CI = &get_instance();
    $CI->load->library('pagination');
	$CI->pagination->initialize($config);
	return $CI->pagination->create_links();
}

/* End of file my_page_helper.php */
/* Location: ./application/helpers/my_page_helper.php */