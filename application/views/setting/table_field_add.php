<?php $this->load->view('header'); ?>
<BR>
<form id="table_field_form" method="post" name="table_field_form">
<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0">
<tbody>
        <tr class="ui-widget-header">
        <td width="35%">資料欄位名稱</td>
        <td width="15%">輸出 <input type='checkbox' value="全選" class='c_1_buttoon' id='select-all'></td>
    </tr>
    <? foreach($datas as $data): ?>
    <tr>
        <TD><? echo $data['0'] ?></TD>
        <TD><input class="input_checkbox" type="checkbox" name="table_field[]" value="<?php echo $data['0']; ?>" <?php echo $data['3'] ?> ></TD>
    </tr>
<? endforeach; ?>

</tbody>
</table>
<!-- <input type="hidden" name="db_table_id" value="<?php echo $db_table_id; ?>"> -->
<input id='close_this' type='hidden' value='1'>
<input type="submit" value="送出" />
</form>

<?php $this->load->view('footer'); ?>