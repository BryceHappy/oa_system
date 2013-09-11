<?php echo $this->load->view('header'); ?>
<div id="tabs">
	<ul>
    	<li><a href="#tabs-1">基本設定</a></li>
    </ul>
    <div id="tabs-1">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-3" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="td_right">註冊協議：</td>
            <td><? $this->ckeditor->editor("my_ckeditor",SITE_REG_AGREEMENT); ?>SITE_REG_AGREEMENT</td>
        </tr>
        <tr>
            <td class="td_right"></td>
            <td><input type="submit" value="提交" /></td>
        </tr>
    </tbody>
    </table>
    </form>
    </div>
</div>

<?php echo $this->load->view('footer'); ?>