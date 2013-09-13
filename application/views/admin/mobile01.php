<?php $this->load->view('header'); ?>

<form id="mobile01_form" method="post">
<table  style="margin:20px 0px;" width="100%" cellpadding="0" cellspacing="0" id='mobile_list'>
<thead>
    <tr class="ui-widget-header">
        <td width="60%">主題</td>
        <td width="40%">網址</td>
    </tr>
</thead>
<tbody>

</tbody>

</table>
<input type="submit" value="提交" />

</form>


<div id="content" style="display:none">
<?php echo $content; ?>
<input type="hidden" name="excute" value="<? echo $excute ?>" id="excute">
</div>

<script type="text/javascript">

$(document).ready(function() {
    var i=1;
    $("#hot-posts li a").each(function() {
        var input_url = $('<input type="text" name=url['+i+'] id="url" value='+$(this).attr('href')+' size="60">');
        var input_title = $('<input type="text" name=title['+i+'] id="title"  value="'+$(this).text()+'" readonly size="60">');

        $("#mobile_list").find('tbody')
        .append($('<tr>')
            .append($('<td>').attr("id","title_value_"+i)
                .append(input_title)
                    ,$('<td>').attr("id","url_value_"+i)
                .append(input_url)
                )
            );   
        i++;
    });

    if ($("#excute").val() == 1 )
    {
        $('#mobile01_form').submit();    
    }
    
});

</script>
<?php $this->load->view('footer'); ?>