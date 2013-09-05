<?php $this->load->view('header'); ?>
<form id="table_fields_form" method="post">
<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
<thead>     
    <tr class="ui-widget-header">
        <th width="10%">資料欄位名稱</th>
        <th width="15%">中文名稱</th>
    </tr>
</thead>
<tbody>
    <tr>
    	<td class="td_right"><? echo $edit_data['field_name']?></td>
        <td><input class="input_text" type="text" name="note" id="note"  value="<?php echo $edit_data['note']; ?>" /></td>
    </tr>
</tbody>
</table>
<input id='close_this' type='hidden' value='1'>
<input type="submit" value="送出" />
</form>
<script type="text/javascript" src="<?php echo SITE_RESOURCES; ?>/my/lib_ajax_cate.js"></script>
<script type="text/javascript">
radio_select('status', '<?php echo $edit_data['status']; ?>');
</script>
<?php $this->load->view('footer'); ?>