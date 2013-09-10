<?php $this->load->view('header'); ?>

<form id="mail_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>
    <tr>
    	<td class="td_right" width="40%" >收件人：</td>
        <td><input class="input_text" type="text" name="who" id="who" /></td>
    </tr>
    <tr>
        <td class="td_right">收件人信箱：</td>
        <td><input class="input_text" type="text" name="to" id="to"  value="bryce.happy@gmail.com" /></td>
    </tr>
    <tr>
        <td class="td_right">主旨：</td>
        <td><input class="input_text" type="text" name="subject" id="subject"  /></td>
    </tr>
    <tr>
        <td class="td_right">內文：</td>
        <td><textarea class="textarea" id="body" name="body" title="內文"></textarea></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="送出" /></td>
    </tr>
</tbody>
</table>
</form>
<script type="text/javascript" src="<?php echo SITE_RESOURCES; ?>/kindeditor/kindeditor-all-min.js"></script>

<script type="text/javascript">
KindEditor.ready(function (K){
	var options = 
	{
		width : '600px',
		height : '380px',
		allowFileManager : true,
		uploadJson : '<?php echo base_url().'common/editor_upload'; ?>',
		fileManagerJson : '<?php echo base_url().'common/editor_manager'; ?>'
	};
	var editor = K.create('#body', options);
});
</script>
<?php $this->load->view('footer'); ?>