<?php echo $this->load->view('header'); ?>
<div id="tabs">
	<ul>
    	<li><a href="#tabs-1">基本設定</a></li>
        <li><a href="#tabs-2">主題設定</a></li>
    </ul>
    <div id="tabs-1">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-1" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    	<tr>
        	<td class="td_right">後台名稱：</td>
            <td><input class="input_text" type="text" id="site_admin_name" name="site_admin_name" maxlength="50" value="<?php echo SITE_ADMIN_NAME; ?>" title="您的後台名稱" /> SITE_ADMIN_NAME</td>
        </tr>
        <tr>
        	<td class="td_right">後台 LOGO：</td>
            <td><input class="input_text" type="text" id="site_admin_logo" name="site_admin_logo" maxlength="50" value="<?php echo str_replace(SITE_ADMIN_STATIC . '/', '', SITE_ADMIN_LOGO); ?>" title="您的後台 LOGO，位于 <?php echo SITE_ADMIN_STATIC; ?> 下" /> SITE_ADMIN_LOGO</td>
        </tr>
        <tr>
        	<td class="td_right"></td>
            <td><input type="submit" value="提交" /></td>
        </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div id="tabs-2">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-2" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    	<tr>
        	<td class="td_right">後台主題名稱：</td>
            <td><input class="input_text" type="text" id="site_admin_theme" name="site_admin_theme" maxlength="20" value="<?php echo SITE_ADMIN_THEME; ?>" title="您的後台主題名稱，位于 application/views 下，<br />必须保证填写内容与文件夹名一致" /></td>
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