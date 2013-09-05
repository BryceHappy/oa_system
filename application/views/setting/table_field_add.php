<?php $this->load->view('header'); ?>

<form id="table_field_form" method="post">
<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0">
<tbody>
        <tr class="ui-widget-header">
        <td width="35%">資料欄位名稱</td>
        <td width="15%">輸出 <input type='button' name='select' onClick='select_all();' value='全選'></td>
    </tr>
    <?php
    $i=0;
    foreach($datas as $data):
        if($data['2'] == 1)
            $check = 'CHECKED';
        else
            $check = '';
    ?>
    <tr>
        <TD><? echo $data['0'] ?></TD>
        <TD><input class="input_checkbox" type="checkbox" name="table_field[]" value="<?php echo $data['0']; ?>" <? echo $check ?>></TD>
    </tr>
<?php $i++ ;endforeach; ?>

</tbody>
</table>
<!-- <input type="hidden" name="db_table_id" value="<?php echo $db_table_id; ?>"> -->
<input type="submit" value="提交" />
</form>

<?php $this->load->view('footer'); ?>