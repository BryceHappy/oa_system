<?php $this->load->view('header'); ?>
<form id="pwd_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
    <tr>
    	<td class="td_right">舊密碼：</td>
        <td><input class="input_text" type="password" name="old_password" id="old_password" title="您當前的密碼" /></td>
    </tr>
    <tr>
    	<td class="td_right">新密碼：</td>
        <td><input class="input_text" type="password" name="password" id="password" title="您的新密碼" /></td>
    </tr>
    <tr>
    	<td class="td_right">確認新密碼：</td>
        <td><input class="input_text" type="password" id="check_password" title="您上方輸入的新密碼" /></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="送出" /></td>
    </tr>
</tbody>
</table>
</form>
<?php $this->load->view('footer'); ?>