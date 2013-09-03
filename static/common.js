/**
 * 公共脚本
 * @author      lensic [mhy]
 * @link        http://www.lensic.cn/
 * @copyright   Copyright (c) 2013 - , lensic [mhy].
 */

/**
 * 分页位置
 * 
 * @access   public
 * @param    string   默认为居左对齐，center = 居中对齐，right = 居右对齐
 */
function page_location(location)
{
	if(location == 'center')
	{
		$('.page_container').width($('.page_style').width());
	} else if(location == 'right') {
		$('.page_style').css('float', 'right');
	}
}

/**
 * 清除分页最后一个链接的 margin-right
 */
$(function (){
	$('.page_style a').eq($('.page_style a').length - 1).css('margin-right', 0);
});