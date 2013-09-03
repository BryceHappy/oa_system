<?php $this->load->view('header'); ?>
<form method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
    <tr>
    	<td class="td_right">用户名：</td>
        <td><?php echo $edit_data['username']; ?></td>
    </tr>
    <tr>
    	<td class="td_right">密碼：</td>
        <td><input class="input_text" type="text" name="password" title="密碼為空時保留原有密碼" /></td>
    </tr>
    <tr>
    	<td class="td_right">所屬權限組：</td>
        <td><select id="power_group_id" name="power_group_id" class="select"><?php foreach($power_group as $data): ?><option value="<?php echo $data['id']; ?>"><?php echo $data['group_name']; ?></option><?php endforeach; ?></select></td>
    </tr>
    <tr>
    	<td class="td_right">管理員狀態：</td>
        <td class="input_radio_container"><input type="radio" id="radio1" name="status" value="1" /><label for="radio1">正常</label><input type="radio" id="radio2" name="status" value="2" /><label for="radio2">關閉</label></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="提交" /></td>
    </tr>
</tbody>
</table>
</form>
<script type="text/javascript">
$('#power_group_id').val('<?php echo $edit_data['power_group_id']; ?>');
radio_select('status', '<?php echo $edit_data['status']; ?>');
</script>
<?php $this->load->view('footer'); ?>