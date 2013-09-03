<?php $this->load->view('header'); ?>
<table id="list_table" width="100%" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
    	<td width="5%">群組狀態</td>
    	<td>群組名稱</td>
        <td width="30%">選單路徑</td>
        <td width="10%">權限位置</td>
        <td width="10%">目標窗口</td>
        <td width="10%">操作</td>
    </tr>
    <?php foreach($power_datas as $n => $data): ?>
    <tr id="tr_power_<?php echo $data['id']; ?>">
    	<td><?php if($data['status'] == 1): ?><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_key_open.png" title="正常" /><?php else: ?><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_key_close.png" title="关闭" /><?php endif; ?></td>
    	<td class="power_left" style="padding-left:<?php echo $data['level'] * 24, 'px'; ?>;">
		<?php if(isset($power_datas[$n - 1])): ?>
			<?php if(isset($data['last_one'])): ?>
				<?php if(isset($data['have_child'])): ?>
                <a href="javascript:void(0);"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_minus_3.gif" /></a>
				<?php else: ?>
                <img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_short_3.gif" />
				<?php endif; ?>
			<?php else: ?>
				<?php if(isset($data['have_child'])): ?>
                <a href="javascript:void(0);"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_minus_2.gif" /></a>
				<?php else: ?>
                <img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_short_2.gif" />
				<?php endif; ?>
			<?php endif; ?>
		<?php else: ?>
			<?php if(isset($data['last_one'])): ?>
				<?php if(isset($data['have_child'])): ?>
                <a href="javascript:void(0);"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_minus_5.gif" /></a>
				<?php else: ?>
                <img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_short_4.gif" />
				<?php endif; ?>
			<?php else: ?>
				<?php if(isset($data['have_child'])): ?>
                <a href="javascript:void(0);"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_minus_1.gif" /></a>
				<?php else: ?>
                <img src="<?php echo SITE_ADMIN_STATIC; ?>/images/tree_short_1.gif" />
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php if($data['power_ico']): ?><img class="ico_img" src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?>
		<?php echo $data['power_name']; ?></td>
        <td><?php echo $data['power_url'] == 'default' ? '' : $data['power_url']; ?></td>
        <td><?php echo $data['power_site'] == 1 ? '內部' : ($data['power_site'] == 2 ? '選單左側' : '選單右側'); ?></td>
        <td><?php echo $data['power_target'] == 1 ? '本頁' : ($data['power_target'] == 2 ? '内嵌框架' : '新窗口'); ?></td>
        <td><a href="<?php echo site_url('admin/power/edit/' . $data['id']); ?>" title="編輯"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/edit.gif" alt="編輯" /></a> <?php if(isset($data['have_child'])): ?><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/del_gray.gif" alt="不可删除" title="不可删除" /><?php else: ?><a href="javascript:void(0);" onClick="return show_dialog('確定刪除該紀錄嗎？', 'del', '<?php echo site_url('admin/power/del/' . $data['id']); ?>', 'tr_power_<?php echo $data['id']; ?>');" title="删除"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/del.gif" alt="删除" /></a><?php endif; ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
<script type="text/javascript">
cate_initialize('power_left', '<?php echo SITE_ADMIN_STATIC, '/images/'; ?>');
</script>
<?php $this->load->view('footer'); ?>