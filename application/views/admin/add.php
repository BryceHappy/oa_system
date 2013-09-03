<?php $this->load->view('header'); ?>
<form id="admin_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
    <tr>
    	<td class="td_right">用戶名：</td>
        <td><input class="input_text" type="text" name="username" id="username" title="不能和現有用戶名相同" maxlength="20" /></td>
    </tr>
    <tr>
    	<td class="td_right">密碼：</td>
        <td><input class="input_text" type="text" name="password" id="password" title="用戶登陸後台的密碼"  /></td>
    </tr>
    <tr>
    	<td class="td_right">所屬群組：</td>
        <td><select id="power_group_id" name="power_group_id" class="select"><option value="">请选择</option><?php foreach($power_group as $data): ?><option value="<?php echo $data['id']; ?>"><?php echo $data['group_name']; ?></option><?php endforeach; ?></select></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="提交" /></td>
    </tr>
</tbody>
</table>
</form>

<?php $this->load->view('footer'); ?>