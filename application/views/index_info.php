<?php echo $this->load->view('header'); ?>
<div class="inde_info_div">
	<div class="iid_title">平台訊息</div>
    <div>
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
        	<td width="25%">網站域名</td>
            <td width="25%"><?php echo $_SERVER['SERVER_NAME']; ?></td>
            <td width="25%">平台版本</td>
            <td width="25%">CI <?php echo CI_VERSION; ?></td>
            
        </tr>
        <tr>
        	<td width="25%">腳本語言</td>
            <td width="25%">PHP <?php echo PHP_VERSION; ?></td>
            <td width="25%">資料庫</td>
            <td width="25%">MYSQL <?php echo $this->db->version(); ?></td>
        </tr>
    </tbody>
    </table>
    </div>
</div>
<div class="inde_info_div">
	<div class="iid_title">用戶資訊</div>
    <div>
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td width="25%">目前用戶</td>
            <td width="25%"><?php echo $user_data['admin_username']; ?></td>
            <td width="25%">所屬群組</td>
            <td width="25%"><?php echo $user_data['admin_power_name']; ?></td>
        </tr>
        <tr>
        	<td width="25%">登錄 IP</td>
            <td width="25%"><?php echo $this->input->ip_address(); ?></td>
            <td width="25%">登錄時間</td>
            <td width="25%"><?php echo $user_data['admin_login_time']; ?></td>
        </tr>
    </tbody>
    </table>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>