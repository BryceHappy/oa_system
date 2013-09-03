<?php echo $this->load->view('header'); ?>
<style type="text/css">
body{background-color:#c8c8c8; padding:0px;}
.nav_title{display:none;}
</style>
<div id="home_container">
	<div id="hc_header">
    	<div id="hch_left"><a href="<?php echo site_url('admin/index/index'); ?>"><img src="<?php echo SITE_ADMIN_LOGO; ?>" /></a></div>
        <div id="hch_right">
        	<div id="hchr_left">
            <?php foreach($power_left as $n => $data): ?>
            	<?php if($data['power_url'] == 'default' && $data['power_target'] == 1): ?>
                <!-- 内部切换 -->
                <a href="javascript:void(0);" onClick="return nav_show(this, <?php echo $data['id']; ?>);" class="top_nav<?php echo !$n ? ' top_nav_in' : ''; ?>"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 1): ?>
                <!-- 当前页 -->
                <a href="<?php echo site_url($data['power_url']); ?>" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 2): ?>
                <!-- iframe 加载 -->
                <a href="<?php echo site_url($data['power_url']); ?>" target="home_iframe" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 3): ?>
                <!-- 新窗口 -->
                	<a href="<?php echo site_url($data['power_url']); ?>" target="_blank" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
            <div id="hchr_right">
            <?php foreach($power_right as $n => $data): ?>
            	<?php if($data['power_url'] == 'default' && $data['power_target'] == 1): ?>
                <!-- 内部切换 -->
                <a href="javascript:void(0);" onClick="return nav_show(this, <?php echo $data['id']; ?>);" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 1): ?>
                <!-- 当前页 -->
                <a href="<?php echo site_url($data['power_url']); ?>" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 2): ?>
                <!-- iframe 加载 -->
                	<a href="<?php echo site_url($data['power_url']); ?>" target="home_iframe" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php elseif($data['power_url'] != 'default' && $data['power_target'] == 3): ?>
                <!-- 新窗口 -->
                	<a href="<?php echo site_url($data['power_url']); ?>" target="_blank" class="top_nav"><?php if($data['power_ico']): ?><img src="<?php echo SITE_ADMIN_STATIC, '/', $data['power_ico']; ?>" /><?php endif; ?><?php echo $data['power_name']; ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
                <a href="<?php echo site_url(); ?>" target="_blank" class="top_nav"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_index.png" />站点首页</a>
                <a href="<?php echo site_url('admin/index/logout'); ?>" class="top_nav"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_exit.png" />退出</a>
            </div>
        </div>
        <div class="cls"></div>
    </div>
    <div id="hc_body">
    	<div id="hcb_left">
        	<?php foreach($power_left as $n => $data): ?>
            <?php
            	if($data['power_url'] != 'default')
				{
					continue;
				}
			?>
            <div id="power_list_<?php echo $data['id']; ?>" class="power_list"<?php if(!$n): ?> style="display:block;"<?php endif; ?>>
            	<?php foreach($data['sub_power'] as $sub_n => $sub_data): ?>
            	<h3><?php echo $sub_data['power_name']; ?></h3>
                <div class="pl_nav">
                	<?php foreach($sub_data['sub_power'] as $sub_sub_data): ?>
                    <div><a href="<?php echo site_url($sub_sub_data['power_url']); ?>" onClick="return nav_in(this);" target="<?php echo $sub_sub_data['power_target'] == 3 ? '_blank' : 'home_iframe'; ?>"><?php echo $sub_sub_data['power_name']; ?></a></div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            <?php foreach($power_right as $n => $data): ?>
            <?php
            	if($data['power_url'] != 'default')
				{
					continue;
				}
			?>
            <div id="power_list_<?php echo $data['id']; ?>" class="power_list">
            	<?php foreach($data['sub_power'] as $sub_n => $sub_data): ?>
            	<h3><?php echo $sub_data['power_name']; ?></h3>
                <div class="pl_nav">
                	<?php foreach($sub_data['sub_power'] as $sub_sub_data): ?>
                    <div><a href="<?php echo site_url($sub_sub_data['power_url']); ?>" onClick="return nav_in(this);" target="<?php echo $sub_sub_data['power_target'] == 3 ? '_blank' : 'home_iframe'; ?>"><?php echo $sub_sub_data['power_name']; ?></a></div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div id="hcb_right"><iframe id="home_iframe" name="home_iframe" src="<?php echo site_url('admin/index/index_info'); ?>" frameborder="0" width="100%" height="100%"></iframe></div>
        <div class="cls"></div>
    </div>
    <div id="hc_footer">
    	<div id="hcf_left"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/dell.png"></div>
        <div id="hcf_right">
        	<div id="hcfr_time"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_time.png" /> <span id="local_time"></span></div>
        </div>
        <div class="cls"></div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>