<?php $this->load->view('header'); ?>
<form id="client_form" method="post">
<table width="100%" cellpadding="0" cellspacing="0">
<tbody>

    <tr>
    	<td class="td_right">客戶名稱：</td>
        <td><input class="input_text" type="text" name="client_name" id="client_name" title="不能和現有客戶名稱相同" /></td>
    </tr>
    <tr>
    	<td class="td_right">統一編號：</td>
        <td><input class="input_text" type="text" name="biz_number" id="biz_number"  /></td>
    </tr>
    <tr>
        <td class="td_right">發票抬頭：</td>
        <td><input class="input_text" type="text" name="invoice_title" id="invoice_title"  /></td>
    </tr>
    <tr>
        <td class="td_right">客戶類別：</td>
        <td>
            <select  name="client_type" id="client_type">
                <?php foreach ($client_type as $key => $value):?>
                        <option value='<? echo $value['id']; ?>'><? echo $value['value']; ?></option>
                <?php endforeach ?>
            </select> 
        </td>
    </tr>
    <tr>
        <td class="td_right">客戶來源：</td>
        <td>
            <select  name="source" id="source">
                <?php foreach ($source as $key => $value):?>
                        <option value='<? echo $value['id']; ?>'><? echo $value['value']; ?></option>
                <?php endforeach ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="td_right">負責人：</td>
        <td><input class="input_text" type="text" name="person_in_charge" id="person_in_charge" /></td>
    </tr>
    <tr>
        <td class="td_right">公司電話：</td>
        <td><input class="input_text" type="text" name="tel" id="tel"/></td>
    </tr>
    <tr>
        <td class="td_right">公司傳真：</td>
        <td><input class="input_text" type="text" name="fax" id="fax"  /></td>
    </tr>
    <tr>
        <td class="td_right">公司地址：</td>
        <td><input class="input_text" type="text" name="address_id" id="address_id"  /></td>
    </tr>
    <tr>
        <td class="td_right">公司網站：</td>
        <td><input class="input_text" type="text" name="url" id="url"  /></td>
    </tr>
        <tr>
        <td class="td_right">主要聯絡人：</td>
        <td><input class="input_text" type="text" name="main_contact" id="main_contact" /></td>
    </tr>


    <tr>
    	<td class="td_right">客戶等級：</td>
        <td class="input_radio_container">
                <?php $i=0;  foreach ($source as $key => $value):?>
                <? $i++; $radio = 'radio'.$i;  ?>
                        <input type="radio" id="<? echo $radio; ?>" name="ranking" value="<? echo $value['id']; ?>" /><label for="<? echo $radio; ?>"><? echo $value['value']; ?></label>
                <?php endforeach ?>
            &nbsp;&nbsp;<span id="ranking_prompt" class="prompt_title" title="若當前權限屬於第一级别，则選擇選單左側或選單右側，否则選擇内部"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right">客戶狀態：</td>
        <td class="input_radio_container">
                <?php  foreach ($status as $key => $value):?>
                <? $i++; $radio = 'radio'.$i;  ?>
                        <input type="radio" id="<? echo $radio; ?>" name="status" value="<? echo $value['id']; ?>" /><label for="<? echo $radio; ?>"><? echo $value['value']; ?></label>
                <?php endforeach ?>
            &nbsp;&nbsp;<span id="status_prompt" class="prompt_title" title="若當前權限屬於第一级别，则選擇選單左側或選單右側，否则選擇内部"><img src="<?php echo SITE_ADMIN_STATIC; ?>/images/ico_tanhao.png" /></span></td>
    </tr>
    <tr>
    	<td class="td_right"></td>
        <td><input type="submit" value="送出" /></td>
    </tr>
</tbody>
</table>
</form>

<?php $this->load->view('footer'); ?>