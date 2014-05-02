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
        <td><input class="input_text" type="text" name="power_name" id="power_name" title="不能和現有選單名稱相同" value="<?php echo $edit_data['power_name']; ?>" /></td>
    </tr>
    <tr>
    	<td class="td_right">選單路徑：</td>
        <td><input class="input_text" type="text" name="power_url" id="power_url" value="<?php echo $edit_data['power_url']; ?>" title="本系統權限分為三個等級，若目前權限屬於第三個等級時，<br />則填寫成 admin/setting/index 的路徑，否則保留 default" /></td>
    </tr>
    <tr>
    	<td class="td_right">權限位置：</td>
        <td class="input_radio_container"><input type="radio" id="radio1" name="power_site" value="1" checked="checked" /><label for="radio1">内部</label><input type="radio" id="radio2" name="power_site" value="2" /><label for="radio2">選單左側</label><input type="radio" id="radio3" name="power_site" value="3" /><label for="radio3">還單右側</label>&nbsp;&nbsp;<span id="power_site_prompt" class="prompt_title" title="若目前權限屬於第一個等級時，則選擇選單左側或還單右側，否則選擇内部"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">目標視窗：</td>
        <td class="input_radio_container"><input type="radio" id="radio4" name="power_target" value="1" checked="checked" /><label for="radio4">本頁</label><input type="radio" id="radio5" name="power_target" value="2" /><label for="radio5">内嵌框架</label><input type="radio" id="radio6" name="power_target" value="3" /><label for="radio6">新窗口</label>&nbsp;&nbsp;<span id="power_target_prompt" class="prompt_title" title="若目前權限屬於第三個等級時，則選擇内嵌框架或新窗口，否則選擇本頁"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">权限图标：</td>
        <td><input class="input_text" type="text" name="power_ico" id="power_ico" title="若目前權限屬於第一個等級時，則可填寫成 images/ico_set.png 的路径，否則不填，<br />位於 <?php echo SITE_ADMIN_STATIC; ?> 下" value="<?php echo isset($edit_data['power_ico']) ? $edit_data['power_ico'] : ''; ?>" /></td>
    </tr>
    <tr>
    	<td class="td_right">權限圖示：</td>
        <td class="input_radio_container"><input type="radio" id="radio7" name="status" value="1" /><label for="radio7">正常</label><input type="radio" id="radio8" name="status" value="2" /><label for="radio8">關閉</label></td>
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
stepless_classification('sel_list_show', 'pid[]', '<?php echo base_url(); ?>admin/power/get_cate/', <?php echo $edit_data['pid']; ?>, '/<?php echo $edit_data['id']; ?>');
radio_select('power_site', '<?php echo $edit_data['power_site']; ?>');
radio_select('power_target', '<?php echo $edit_data['power_target']; ?>');
radio_select('status', '<?php echo $edit_data['status']; ?>');
</script>
<?php $this->load->view('footer'); ?>