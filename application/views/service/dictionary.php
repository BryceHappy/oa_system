<?php $this->load->view('header'); ?>
<form id="search_form" method="<? echo $method; ?>">
    <span class="input_radio_container"><input type="radio" id="radio1" name="status" value="1" /><label for="radio1">正常</label><input type="radio" id="radio2" name="status" value="2" /><label for="radio2">關閉</label></span> <input type="text" class="input_text" name="search_key" value="<?php echo $search_key; ?>" /> <input type="submit" value="搜尋" />
<BR><BR><input type='button' value=' 回上一頁 ' class='go_back_button' onclick="window.history.go(-1)">
</form>

<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0">
<tbody>
	<tr class="ui-widget-header">
    	<td width="5%">序號</td>
    	<td>名稱</td>
        <td width="15%">操作</td>
    </tr>
    <?php foreach($datas as $n => $data): ?>
    <tr id="tr_dict_<?php echo $data['id']; ?>">
    	<td><? echo $data['id']; ?></td>
        <td><?php echo str_replace($search_key, '<span class="have_search_key">' . $search_key . '</span>', $data['value']); ?></td>
        <td><a href="<?php echo site_url('service/dictionary/edit/' . $data['id']); ?>" onclick="window.open(this.href, '', 'width=500,height=500,resizable=no,status=no,location=no,scrollbar=no,toolbar=no'); return false;" ><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/edit.gif" alt="編輯" /></a> <a href="javascript:void(0);" onClick="return show_dialog('確定刪除該紀錄嗎？', 'del', '<?php echo site_url('service/dictionary/del/' . $data['id']); ?>', 'tr_user_<?php echo $data['id']; ?>');" title="刪除"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/del.gif" alt="刪除" /></a></td>
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