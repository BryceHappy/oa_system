<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 公共函数
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */

/**
 * 加载全局文件 css，jquery，js
 * 
 * @access   public
 * @return   string   html 代码字符串
 */
function load_common()
{
	$load = '';
	$load .= '<link type="text/css" rel="stylesheet" href="' . SITE_COMMON_STATIC . '/common.css" />' . "\n";
	$load .= '<link type="text/css" rel="stylesheet" href="' . SITE_RESOURCES . '/jquery-ui.css" />' . "\n";
	$load .= '<script type="text/javascript" src="' . SITE_RESOURCES . '/jquery.js"></script>' . "\n";
	$load .= '<script type="text/javascript" src="' . SITE_RESOURCES . '/jquery-ui.js"></script>' . "\n";
	$load .= '<script type="text/javascript" src="' . SITE_RESOURCES . '/tablesorter.js"></script>' . "\n";
	$load .= '<script type="text/javascript" src="' . SITE_RESOURCES . '/tablesorter.widgets.min.js"></script>' . "\n";
	$load .= '<script type="text/javascript" src="' . SITE_COMMON_STATIC . '/common.js"></script>' . "\n";
	return $load;
}

/**
 * 打印数据
 * 
 * @access   public
 * @param    array     数据数组
 * @die      boolean   是否终止执行
 */
function print_datas($datas, $die = TRUE)
{
	echo '<pre>';
	print_r($datas);
	$die ? die() : '';
}

/* End of file my_common_helper.php */
/* Location: ./application/helpers/my_common_helper.php */