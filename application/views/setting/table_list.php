<?php $this->load->view('header'); ?>
<form id="search_form" method="<? echo $method ?>">
    <span class="input_radio_container"><input type="radio" id="radio1" name="status" value="1" /><label for="radio1">正常</label><input type="radio" id="radio2" name="status" value="2" /><label for="radio2">關閉</label></span> <input type="text" class="input_text" name="search_key" value="<?php echo $search_key; ?>" /> <input type="submit" value="搜尋" />
<BR><BR><input type="button" class='r_button' value="列印" onclick="window.location='<?php echo site_url('admin/setting/print_excel'.'/'.$excel_url); ?>';" />  
</form>
<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
<thead>     
	<tr class="ui-widget-header">
    	<th width="10%">序號</th>
    	<th>名稱</th>
        <th width="15%">備註</th>
        <th width="15%">操作</th>
    </tr>
</thead>
<tbody>
    <?php foreach($datas as $n => $data): ?>
    <tr id="tr_table_<?php echo $data['id']; ?>">
    	<td><? echo $data['id']; ?></td>
        <td><a href="<?php echo site_url('admin/setting/get_table_field/' . $data['id']); ?>" onClick="setPosCookies();" title="檢視欄位"><?php echo str_replace($search_key, '<span class="have_search_key">' . $search_key . '</span>', $data['name']); ?></a></td>
        <td><? echo $data['note']; ?></td>
        <td><a href="<?php echo site_url('admin/setting/table_edit/' . $data['id']); ?>" onclick="window.open(this.href, '', 'width=500,height=500,resizable=no,status=no,location=no,scrollbar=no,toolbar=no'); window.onclick = setPosCookies; return false;"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/edit.gif" alt="編輯" /></a> <a href="javascript:void(0);" onClick="return show_dialog('確定刪除該紀錄嗎？', 'del', '<?php echo site_url('admin/admin/del/' . $data['id']); ?>', 'tr_user_<?php echo $data['id']; ?>');" title="刪除"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/del.gif" alt="刪除" /></a></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $pages; ?>
<script type="text/javascript">
page_location('center');
radio_select('status', '<?php echo $status; ?>');
</script>
<?php $this->load->view('footer'); ?>