<?php $this->load->view('header'); ?>
<form id="power_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
    	<td class="td_right">左選單權限：</td>
        <td id="sel_list_show"></td>
    </tr>
    <tr>
    	<td class="td_right">選單名稱：</td>
        <td><input class="input_text" type="text" name="power_name" id="power_name" title="不能和现有權限名相同" /></td>
    </tr>
    <tr>
    	<td class="td_right">選單路徑：</td>
        <td><input class="input_text" type="text" name="power_url" id="power_url" value="default" title="本系统權限分為三個級別，若當前權限屬於第三級別時，<br />則填寫如 admin/setting/index 的路徑，否則保留 default" /></td>
    </tr>
    <tr>
    	<td class="td_right">權限位置：</td>
        <td class="input_radio_container"><input type="radio" id="radio1" name="power_site" value="1" checked="checked" /><label for="radio1">内部</label><input type="radio" id="radio2" name="power_site" value="2" /><label for="radio2">選單左側</label><input type="radio" id="radio3" name="power_site" value="3" /><label for="radio3">選單右側</label>&nbsp;&nbsp;<span id="power_site_prompt" class="prompt_title" title="若當前權限屬於第一级别，则选择選單左側或選單右側，否则选择内部"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">目標視窗：</td>
        <td class="input_radio_container"><input type="radio" id="radio4" name="power_target" value="1" checked="checked" /><label for="radio4">本頁</label><input type="radio" id="radio5" name="power_target" value="2" /><label for="radio5">内嵌框架</label><input type="radio" id="radio6" name="power_target" value="3" /><label for="radio6">新視窗</label>&nbsp;&nbsp;<span id="power_target_prompt" class="prompt_title" title="若當前權限屬於第三级别，则选择内嵌框架或新視窗，否则选择本頁"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">權限圖示：</td>
        <td><input class="input_text" type="text" name="power_ico" id="power_ico" title="若當前權限屬於第一級別，則可填寫如 images/ico_set.png 的路徑，否則不填，<br />位於 <?php echo SITE_ADMIN_STATIC; ?> 下" /></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="送出" /></td>
    </tr>
</tbody>
</table>
</form>
<script type="text/javascript" src="<?php echo SITE_RESOURCES; ?>/my/lib_ajax_cate.js"></script>
<script type="text/javascript">
stepless_classification('sel_list_show', 'pid[]', '<?php echo base_url(); ?>admin/power/get_cate/', 0);
</script>
<?php $this->load->view('footer'); ?>