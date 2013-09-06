<?php echo $this->load->view('header'); ?>
<style type="text/css">
body{background-color:#c8c8c8; padding:0px;}
.nav_title{display:none;}
</style>
<div id="login_body">
    <div id="login_container">
        <div id="lc_title"><img src="<?php echo SITE_ADMIN_LOGO; ?>" /> - 後台管理登入</div>
        <form id="lc_form" method="post">
        <table width="100%" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td class="td_right">用戶名：</td>
                <td><input class="input_text" type="text" id="username" name="username" title="您的用戶名" maxlength="20" /></td>
            </tr>
            <tr>
                <td class="td_right">密碼：</td>
                <td><input class="input_text" type="password" id="password" name="password" title="您的密碼" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="送出" /> <input type="reset" value="取消" /></td>
            </tr>
        </tbody>
        </table>
        </form>
        <div id="lc_power">Power By <a id="link_author" class="a_color" href="#" target="_blank">Bryce</a></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>