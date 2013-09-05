<?php echo $this->load->view('header'); ?>
<div id="tabs">
	<ul>
    	<li><a href="#tabs-1">文件名設置</a></li>
        <li><a href="#tabs-2">自定義加密</a></li>
        <li><a href="#tabs-3">上傳大小</a></li>
        <li><a href="#tabs-4">客戶服務</a></li>
    </ul>
    <div id="tabs-1">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-1" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    	<tr>
        	<td class="td_right" style="width:222px;">資源存放文件名：</td>
            <td><input class="input_text" type="text" id="site_resources" name="site_resources" maxlength="20" value="<?php echo str_replace(base_url(), '', SITE_RESOURCES); ?>" title="公共外部資源存放文件夾，位於根目錄下，<br />必须保證填寫内容與文件夾名一致" /> SITE_RESOURCES</td>
        </tr>
        <tr>
        	<td class="td_right">前後端圖片、樣式、腳本存放文件名：</td>
            <td><input class="input_text" type="text" id="site_static" name="site_static" maxlength="20" value="<?php echo str_replace(base_url(), '', SITE_COMMON_STATIC); ?>" title="（公共、前端、後端）樣式、圖片、腳本存放文件夾，位於根目錄下，<br />必须保證填寫内容與文件夾名一致" /> SITE_COMMON_STATIC</td>
        </tr>
        <tr>
        	<td class="td_right">上傳文件存放文件名：</td>
            <td><input class="input_text" type="text" id="site_uploads" name="site_uploads" maxlength="20" value="<?php echo str_replace(base_url(), '', SITE_UPLOADS); ?>" title="公共上傳文件夾，位於根目錄下，<br />必须保證填寫内容與文件夾名一致" /> SITE_UPLOADS</td>
        </tr>
        <tr>
        	<td class="td_right">前端主題存放文件名：</td>
            <td><input class="input_text" type="text" id="site_themes" name="site_themes" maxlength="20" value="<?php echo SITE_THEMES; ?>" title="前端存放主題文件夾，位於根目錄下，<br />必须保證填寫内容與文件夾名一致" /></td>
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
        	<td class="td_right">開始密鑰：</td>
            <td><input class="input_text" type="text" id="site_encryption_key_begin" name="site_encryption_key_begin" maxlength="20" value="<?php echo SITE_ENCRYPTION_KEY_BEGIN; ?>" title="開始密鑰，運用了 helper 中的 my_md5 函数，請在第一次使用系统時設置" /></td>
        </tr>
        <tr>
        	<td class="td_right">結束密鑰：</td>
            <td><input class="input_text" type="text" id="site_encryption_key_end" name="site_encryption_key_end" maxlength="20" value="<?php echo SITE_ENCRYPTION_KEY_END; ?>" title="結束密鑰，運用了 helper 中的 my_md5 函数，請在第一次使用系统時設置" /></td>
        </tr>
        <tr>
        	<td class="td_right"></td>
            <td><input type="submit" value="提交" /></td>
        </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div id="tabs-3">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-3" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
        	<td class="td_right">上傳圖片大小：</td>
            <td><input class="input_text" type="text" id="site_upload_image_size" name="site_upload_image_size" value="<?php echo SITE_UPLOAD_IMAGE_SIZE; ?>" title="允許上傳圖片的最大值，單位 B" /> SITE_UPLOAD_IMAGE_SIZE</td>
        </tr>
        <tr>
        	<td class="td_right">上傳動畫大小：</td>
            <td><input class="input_text" type="text" id="site_upload_flash_size" name="site_upload_flash_size" value="<?php echo SITE_UPLOAD_FLASH_SIZE; ?>" title="允許上傳動畫的最大值，單位 B" /> SITE_UPLOAD_FLASH_SIZE</td>
        </tr>
        <tr>
        	<td class="td_right">上傳視頻大小：</td>
            <td><input class="input_text" type="text" id="site_upload_media_size" name="site_upload_media_size" value="<?php echo SITE_UPLOAD_MEDIA_SIZE; ?>" title="允許上傳視頻的最大值，單位 B" /> SITE_UPLOAD_MEDIA_SIZE</td>
        </tr>
        <tr>
        	<td class="td_right">上傳文件大小：</td>
            <td><input class="input_text" type="text" id="site_upload_file_size" name="site_upload_file_size" value="<?php echo SITE_UPLOAD_FILE_SIZE; ?>" title="允許上傳文件的最大值，單位 B" /> SITE_UPLOAD_FILE_SIZE</td>
        </tr>
        <tr>
        	<td class="td_right"></td>
            <td><input type="submit" value="提交" /></td>
        </tr>
    </tbody>
    </table>
    </form>
    </div>


    <div id="tabs-4">
    <form method="post">
    <input type="hidden" name="tabs" value="tabs-4" />
    <table width="100%" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="td_right">上傳圖片大小：</td>
            <td><input class="input_text" type="text" id="site_upload_image_size" name="site_upload_image_size" value="<?php echo SITE_UPLOAD_IMAGE_SIZE; ?>" title="允許上傳圖片的最大值，單位 B" /> SITE_UPLOAD_IMAGE_SIZE</td>
        </tr>
        <tr>
            <td class="td_right">上傳動畫大小：</td>
            <td><input class="input_text" type="text" id="site_upload_flash_size" name="site_upload_flash_size" value="<?php echo SITE_UPLOAD_FLASH_SIZE; ?>" title="允許上傳動畫的最大值，單位 B" /> SITE_UPLOAD_FLASH_SIZE</td>
        </tr>
        <tr>
            <td class="td_right">上傳視頻大小：</td>
            <td><input class="input_text" type="text" id="site_upload_media_size" name="site_upload_media_size" value="<?php echo SITE_UPLOAD_MEDIA_SIZE; ?>" title="允許上傳視頻的最大值，單位 B" /> SITE_UPLOAD_MEDIA_SIZE</td>
        </tr>
        <tr>
            <td class="td_right">上傳文件大小：</td>
            <td><input class="input_text" type="text" id="site_upload_file_size" name="site_upload_file_size" value="<?php echo SITE_UPLOAD_FILE_SIZE; ?>" title="允許上傳文件的最大值，單位 B" /> SITE_UPLOAD_FILE_SIZE</td>
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
</div>


<?php echo $this->load->view('footer'); ?>