<?php $this->load->view('header'); ?>
<form id="search_form" method="<? echo $method; ?>">
<input type="text" class="input_text" name="search_key" value="<?php echo $search_key; ?>" /> <input type="submit" value="搜尋" />
<BR><BR>   
<input type="button" class='r_4_button' value="管理輸出" onclick="window.open('<? echo $add_url; ?>', '', 'width=500,height=300,resizable=no,status=no,location=no,scrollbar=no,toolbar=no'); window.onclick = setPosCookies; return false;" />｜<input type="button" class='r_button' value="列印" onclick="window.location='<?php echo site_url('common/print_excel'.'/'.$excel_url); ?>';" />

</form>
<BR>
<a href="<? echo $h_url['level_1_url']; ?>" >資料表管理</a>
<BR>
<table id="list_table" style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0" class="tablesorter">
<thead>     
	<tr class="ui-widget-header">
    	<th width="10%">序號</th>
    	<th>名稱</th>
        <th width="15%">備註</th>
        <th width="15%">輸出</th>
    </tr>
</thead>
<tbody>
    <?php foreach($datas as $n => $data): ?>
    <tr id="tr_table_<?php echo $data['id']; ?>">
    	<td><? echo $data['id']; ?></td>
        <td><a href="<?php echo site_url('admin/tables/table_field_edit/' . $data['id']); ?>" onclick="window.open(this.href, '', 'width=500,height=600,resizable=no,status=no,location=no,scrollbar=no,toolbar=no'); window.onclick = setPosCookies; return false;"><?php echo str_replace($search_key, '<span class="have_search_key">' . $search_key . '</span>', $data['field_name']); ?></a></td>
        <td><? echo $data['note']; ?></td>
        <td><? echo $data['img']; ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo $pages; ?>
<script type="text/javascript">
page_location('center');
</script>
<?php $this->load->view('footer'); ?>