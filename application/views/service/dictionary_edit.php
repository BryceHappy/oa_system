<?php $this->load->view('header'); ?>
<form id="dictionary_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>

    <tr>
    	<td class="td_right">名稱：</td>
        <td><input class="input_text" type="text" name="value" id="value"  value="<?php echo $edit_data['value']; ?>" /></td>
    </tr>

    <tr>
    	<td class="td_right">狀態：</td>
        <td class="input_radio_container"><input type="radio" id="radio1" name="status" value="1" /><label for="radio1">有效</label><input type="radio" id="radio2" name="status" value="2" /><label for="radio2">無效</label></td>
    </tr>
    <tr>
    	<td class="td_right"><input id='close_this' type='hidden' value='1'></td>
        <td><input type="submit" value="送出" /></td>
    </tr>
</tbody>
</table>
</form>
<script type="text/javascript" src="<?php echo SITE_RESOURCES; ?>/my/lib_ajax_cate.js"></script>
<script type="text/javascript">
radio_select('status', '<?php echo $edit_data['status']; ?>');
</script>
<?php $this->load->view('footer'); ?>