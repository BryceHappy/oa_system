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
        <td><input class="input_text" type="text" name="power_name" id="power_name" title="不能和现有权限名相同" value="<?php echo $edit_data['power_name']; ?>" /></td>
    </tr>
    <tr>
    	<td class="td_right">選單路徑：</td>
        <td><input class="input_text" type="text" name="power_url" id="power_url" value="<?php echo $edit_data['power_url']; ?>" title="本系统权限分为三个级别，若当前权限属于第三级别时，<br />则填写如 admin/setting/index 的路径，否则保留 default" /></td>
    </tr>
    <tr>
    	<td class="td_right">權限位置：</td>
        <td class="input_radio_container"><input type="radio" id="radio1" name="power_site" value="1" checked="checked" /><label for="radio1">内部</label><input type="radio" id="radio2" name="power_site" value="2" /><label for="radio2">菜单左侧</label><input type="radio" id="radio3" name="power_site" value="3" /><label for="radio3">菜单右侧</label>&nbsp;&nbsp;<span id="power_site_prompt" class="prompt_title" title="若当前权限属于第一级别，则选择菜单左侧或菜单右侧，否则选择内部"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">目標視窗：</td>
        <td class="input_radio_container"><input type="radio" id="radio4" name="power_target" value="1" checked="checked" /><label for="radio4">本页</label><input type="radio" id="radio5" name="power_target" value="2" /><label for="radio5">内嵌框架</label><input type="radio" id="radio6" name="power_target" value="3" /><label for="radio6">新窗口</label>&nbsp;&nbsp;<span id="power_target_prompt" class="prompt_title" title="若当前权限属于第三级别，则选择内嵌框架或新窗口，否则选择本页"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">权限图标：</td>
        <td><input class="input_text" type="text" name="power_ico" id="power_ico" title="若当前权限属于第一级别，则可填写如 images/ico_set.png 的路径，否则不填，<br />位于 <?php echo SITE_ADMIN_STATIC; ?> 下" value="<?php echo isset($edit_data['power_ico']) ? $edit_data['power_ico'] : ''; ?>" /></td>
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