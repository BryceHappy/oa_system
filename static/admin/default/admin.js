/**
所有的form都要有submit
**/
$(function (){
	// 公共
	window.onload = checkCookie;
	// window.history.go(-1) = checkCookie;

	$('input[title], textarea[title], .prompt_title[title]').tooltip({position : {my:'left+8 center'}});
	$('input[type=submit], input[type=reset]').button();
	$('.input_radio_container').buttonset();
	$('#tabs').show().tabs();
	$("#list_table").tablesorter({
		// widgets: ['zebra']
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
	});


	$(window).resize(function (){
		// 後台登錄頁
		$('#login_body').css({'width':$(window).width(), 'height':$(window).height()});
		$('#login_container').css({'left':($(window).width() - $('#login_container').width()) / 2});
		
		// 後台首頁
		$('#hcb_left, #hcb_right').css({'height':$(window).height() - 97});
		$('#hch_right, #hcb_right, #hcf_right').css({'width':$(window).width() - 223});
	});
	$(window).resize();
	
	// 後台登錄頁
	$('#login_container').draggable({containment:'#login_body', scroll:false, handle:'#lc_title'});
	
	// 後台首頁
	if($('#local_time').length > 0)
	{
		window.setInterval('get_time()', 1000);
	}
	$('.power_list').accordion({heightStyle:'content', collapsible:true});
	
	// 後台表單驗證
	$('#lc_form').submit(function (){
		if(!$('#username').val()){$('#username').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
	});
	$('#power_form').submit(function (){
		$('#power_name, #power_url, #power_site_prompt, #power_target_prompt, #power_ico').blur();
		var select_length = $('select[name="pid[]"]').length;
		if(select_length > 3){show_dialog('選擇的權限不能超過兩項'); return false;}
		if(!$('#power_name').val()){$('#power_name').focus(); return false;}
		if((select_length == 3 && $('#power_url').val() == 'default') || (select_length != 3 && $('#power_url').val() != 'default')){$('#power_url').focus(); return false;}
		if((select_length == 1 && $('input[name="power_site"]:checked').val() == 1) || (select_length != 1 && $('input[name="power_site"]:checked').val() != 1)){$('#power_site_prompt').focus(); return false;}
		if((select_length == 3 && $('input[name="power_target"]:checked').val() == 1) || (select_length != 3 && $('input[name="power_target"]:checked').val() != 1)){$('#power_target_prompt').focus(); return false;}
		if(select_length != 1 && $('#power_ico').val()){$('#power_ico').focus(); return false;}
	});
	$('#group_power_form').submit(function (){
		if(!$('#group_name').val()){$('#group_name').focus(); return false;}
		if($('input[name="power_ids[]"]:checked').length == 0){show_dialog('請選擇一項權限'); return false;}
	});
	$('#admin_form').submit(function (){
		if(!$('#username').val()){$('#username').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
		if (!$('#power_group_id').val()) {
			show_dialog('請選擇所屬權限組');
			return false;
		}
	});
	$('#pwd_form').submit(function (){
		if(!$('#old_password').val()){$('#old_password').focus(); return false;}
		if(!$('#password').val()){$('#password').focus(); return false;}
		if($('#check_password').val() != $('#password').val()){$('#check_password').focus(); return false;}
	});
	$('#client_form').submit(function (){
	});
	$('#dictionary_form').submit(function (){
	});

	$('#mobile01_form').submit(function (){
	});


	$('#table_field_form').submit(function (){
	});

	$('#mail_form').submit(function() {
		var chk = 0;
		$('input').each(function(index) {
			if ($(this).val() == '') {
				show_dialog('資料不完整');
				chk = chk + 1;
			}
		});

		if (chk > 0) {
			return false;
		}

		if (!$('#textarea').val()) {
			show_dialog('請填寫內文');
			return false;
		}
	});
	

	$('#select-all').click(function(event) {
		var selected = this.checked;
		// Iterate each checkbox
		$(':checkbox').each(function() {
			this.checked = selected;
		});

	});
});


// 獲取當前時間
function get_time()
{
	var date = new Date();
	$('#local_time').html(date.toLocaleString());
}

// 導航選中
function nav_in(obj)
{
	$('.pl_nav a').removeClass('nav_in');
	$(obj).addClass('nav_in');
	return true;
}

// 選單切换
function nav_show(obj, num)
{
	$('#hch_right a').removeClass('top_nav_in');
	$(obj).addClass('top_nav_in');
	$('.power_list').hide();
	$('#power_list_' + num).show();
}

// 對話框使用
function show_dialog(content, type, action_url, action_obj)
{
	type = typeof(type) == 'undefined' ? '' : type;
	action_url = typeof(action_url) == 'undefined' ? '' : action_url;
	action_obj = typeof(action_obj) == 'undefined' ? '' : action_obj;
	var options = {
		title     : '提示訊息',
		minHeight : 0,
		resizable : false,
		show      : 'clip',
		hide      : 'clip'
	};
	switch(type)
	{
		case 'del':
			options.buttons = {
                '刪除' : function (){
                    if(action_url)
					{
						$(this).dialog('destroy');
						$.get(action_url, function (msg){
							if(msg == 1)
							{
								show_dialog('刪除成功');
								$('#' + action_obj).fadeOut(2000, function (){$(this).remove();});
							} else {
								show_dialog('刪除失敗或未找到記錄');
							}
						});
					}
                },
                '取消' : function (){
                    $(this).dialog('close');
                }
            }
		break;
	}
	$('#submit_info').html(content).dialog(options);
	if(type != 'del')
	{	
		if($('#close_this').val())
			var close = true;

		setTimeout(function (){$('#submit_info').dialog('close')}, 2000);

		if(close)
		{	
			setTimeout(function (){ window.opener.location.reload(true)}, 400);		
			setTimeout(function (){ top.close()}, 1500);			
		}
	}
}

// 无级分类事件触发
function cate_initialize(cate_container_name, img_storage_path)
{
	$('.' + cate_container_name + ' a').click(function (){
		var obj_img = $(this).find('img');
		var img_name = obj_img.attr('src').replace(img_storage_path, '');
		var this_padding_left = parseInt($(this).parent('.' + cate_container_name).css('padding-left'));
		var child_plus = new Array();
		$(this).parents('tr').nextAll().each(function (){
			if(parseInt($(this).find('.' + cate_container_name).eq(0).css('padding-left')) > this_padding_left)
			{
				var new_img_name = '';
				if(img_name.indexOf('plus') != -1)
				{
					new_img_name = img_name.replace('plus', 'minus');
					var obj_a_img = $(this).find('.' + cate_container_name).eq(0).find('a img');
					if(obj_a_img.length > 0 && obj_a_img.attr('src').replace(img_storage_path, '').indexOf('plus') != -1)
					{
						obj_a_img.attr('src', obj_a_img.attr('src').replace('plus', 'minus'));
						child_plus[child_plus.length] = $(this).find('.' + cate_container_name).eq(0).find('a');
					}
					$(this).show();
				} else if(img_name.indexOf('minus') != -1) {
					new_img_name = img_name.replace('minus', 'plus');
					$(this).hide();
				}
				obj_img.attr('src', img_storage_path + new_img_name);
				return true;
			} else {
				return false;
			}
		});
		$(child_plus).each(function (i, n){
			this.click();
		});
	});
}

// 單選默認選中
function radio_select(name, value)
{
	$('input[name="' + name + '"]').each(function (){
		if($(this).val() == value)
		{
			$(this).attr('checked', true);
			return false;
		}
	});
}

// 權限組中權限的網站
function power_click(obj_this, n)
{
	if($(obj_this).attr('checked'))
	{
		$('#dj_' + n + ' input').removeAttr('disabled');
		$('#dj_' + n + ' span input').attr('disabled', true);
	} else {
		$('#dj_' + n + ' input').attr('disabled', true).removeAttr('checked').click();
	}
}

// 權限組默認選中權限
function default_sel(ids_str)
{
	var power_sel = ids_str.split(',');
	$(power_sel).each(function (){
		var sel_val = this;
		$('input[name="power_ids[]"]').each(function (){
			if($(this).val() == sel_val)
			{
				$(this).attr('checked', true);
				$('#dj_' + $(this).val() + ' input').removeAttr('disabled');
				$('#dj_' + $(this).val() + ' span input').attr('disabled', true);
				return false;
			}
		});
	});
}


function go_url(url)
{
    window.open(url, '', 'width=500,height=500,resizable=no,status=no,location=no,scrollbar=no,toolbar=no');
    window.onclick = setPosCookies;	
}


function setPosCookies() {

	var scrollX, scrollY;

	// 儲存Scrollbar的位置 (x, y)
	if (document.all) {
		if (!document.documentElement.scrollLeft)
			scrollX = document.body.scrollLeft;
		else
			scrollX = document.documentElement.scrollLeft;
		if (!document.documentElement.scrollTop)
			scrollY = document.body.scrollTop;
		else
			scrollY = document.documentElement.scrollTop;
	} else {
		scrollX = window.pageXOffset;
		scrollY = window.pageYOffset;
	}


	// 設定 Cookie, 名稱為頁面 http://yyyy/XXXX.php => 取XXXX用
	var url = document.location.href;
	var x_name = url.substring(url.lastIndexOf('/') + 1, url.lastIndexOf('.')) + "scrollX";
	var y_name = url.substring(url.lastIndexOf('/') + 1, url.lastIndexOf('.')) + "scrollY";
	setCookie(x_name, scrollX);
	setCookie(y_name, scrollY);
}

function setCookie(c_name, value, expiredays) {
	// 不指定expire date, 則離開browser, cookie即失效
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + expiredays);
	document.cookie = c_name + "=" + escape(value) +
		((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
}

function getCookie(c_name) {
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(c_name + "=");
		if (c_start != -1) {
			c_start = c_start + c_name.length + 1;
			c_end = document.cookie.indexOf(";", c_start);
			if (c_end == -1) {
				c_end = document.cookie.length;
			}
			return unescape(document.cookie.substring(c_start, c_end));
		}
	}
	return "";
}

function checkCookie() {
	// 取得 Cookie => (x, y)座標 
	var url = document.location.href;
	var x_name = url.substring(url.lastIndexOf('/') + 1, url.lastIndexOf('.')) + "scrollX";
	var y_name = url.substring(url.lastIndexOf('/') + 1, url.lastIndexOf('.')) + "scrollY";
	var x = getCookie(x_name);
		del_cookie(x_name);
	var y = getCookie(y_name);
		del_cookie(y_name);
	if (y == null || y == "") {
		y = 0;
	}
	if (x == null || x == "") {
		x = 0;
	}
	window.scrollTo(0, y)
}

function del_cookie(name)
{
	//刪除cookie
    document.cookie = name +'=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}


function deleteCookie(cookiename)
{
    var d = new Date();
    d.setDate(d.getDate() - 1);
    var expires = ";expires="+d;
    var name=cookiename;
    //alert(name);
    var value="";
    document.cookie = name + "=" + value + expires + "; path=/acc/html";                    
}

function clearListCookies()
{   
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++)
    {   
        var spcook =  cookies[i].split("=");
        deleteCookie(spcook[0]);
    }
    function deleteCookie(cookiename)
    {
        var d = new Date();
        d.setDate(d.getDate() - 1);
        var expires = ";expires="+d;
        var name=cookiename;
        //alert(name);
        var value="";
        document.cookie = name + "=" + value + expires + "; path=/acc/html";                    
    }
    window.location = ""; // TO REFRESH THE PAGE
}