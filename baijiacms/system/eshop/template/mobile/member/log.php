<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title><?php  if($trade && $trade['withdraw']==1) { ?>余额明细<?php  } else { ?>充值记录<?php  } ?></title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
    .credit_list {height:60px; width:94%; background:#fff; padding:10px 3%;margin-top:5px;}
    
    .credit_list .info {height:60px; width:70%; float:left;  font-size:16px; color:#666; line-height:20px; text-align:left;}
    .credit_list .info span {font-size:14px; color:#999;}
    .credit_list .num {height:60px; border-left:1px solid #eaeaea; width:20%;line-height:40px; float:right; text-align:right; font-size:16px; color:#666;}
    .credit_list .num span {font-size:14px; color:#999;}
    .credit_tab {height:30px; margin:5px; border:1px solid #ff6801; border-radius:5px; overflow:hidden;font-size:13px;background:#fff;padding-right: -2px;}
    .credit_nav {height:30px; width:50%;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .credit_navon {color:#fff; background:#ff6801;}
    .credit_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #credit_loading { padding:10px;color:#666;text-align: center;}

</style>
<div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title"><?php  if($trade && $trade['withdraw']==1) { ?>余额明细<?php  } else { ?>充值记录<?php  } ?></div>
</div>

<?php  if($trade && $trade['withdraw']==1) { ?>
<div class="credit_tab">
    <div class="credit_nav <?php  if($_GPC['type']==0) { ?>credit_navon<?php  } ?>" data-type='0' >充值记录</div>
    <div class="credit_nav <?php  if($_GPC['type']==1) { ?>credit_navon<?php  } ?>"  data-type='1'>提现记录</div>
</div>
<?php  } ?>

<div id='container'></div>

<script id='tpl_log' type='text/html'>
    <%each list as log%>
    <div class="credit_list">
        <div class="info">
            <span>
              单号: <%log.logno%> <br/> <%if log.type==0%>金额: <%/if%> 
                <%if log.type==1%>提现金额: <%/if%> 
                <%if log.type==2%>佣金打款: <%/if%> 
                <%log.money%> 元 <br/>时间:<span><%log.createtime%></span></span>
          </div>
        <div class="num">
            <%if log.status==0%> 
            <span><%if log.type==0%>未充值<%else%>申请中<%/if%></span>
           <%/if%>
           <%if log.status==1%>
            <span>   
                <%if log.type==0%>充值成功<%/if%> 
                <%if log.type==1%>提现成功<%/if%> 
                <%if log.type==2%>打款成功<%/if%> 
            </span>
           <%/if%>
           <%if log.status==-1%>
            <span><%if log.type==1%>提现失败<%/if%></span>
         <%/if%>
           <%if log.status==3%>
            <span><%if log.type==0%>充值退款<%/if%></span>
           <%/if%>
           
        </div>
    </div>
    <%/each%>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="credit_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">暂时没有任何记录~</span></div>
</script>

<script language="javascript">
    var page = 1;
    var scrolled = false;
   var current_type = "<?php  echo intval($_GPC['type'])?>";


function bindScroller(){
        var loaded = false;
        var stop = true;
  
        $(window).scroll(function () {
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false; scrolled = true;
                    $('#container').append('<div id="credit_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core_json("<?php echo 	create_url('mobile',array('do'=>'member','act'=>'log','m'=>'eshop'))?>", {type:current_type,page: page}, function (morejson) {
                        stop = true;
                        $('#credit_loading').remove();
                        $("#container").append(tpl('tpl_log', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $("#container").append('<div id="credit_loading">已经加载完全部记录</div>');
                            loaded = true;
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getLog(type) {
            $('.credit_nav').removeClass('credit_navon');
            $('.credit_nav[data-type=' + type + ']').addClass('credit_navon');
            core_json("<?php echo 	create_url('mobile',array('do'=>'member','act'=>'log','m'=>'eshop'))?>", {type:type,page: page}, function (json) {
               if (json.result.list.length <= 0) {
                    $('#container').html(tpl('tpl_empty'));
                    return;
                }
                $('#container').html(tpl('tpl_log', json.result));
                bindScroller();
            }, true);
        }
        $('.credit_nav').unbind('click').click(function () {
            page = 1; current_type = $(this).data('type')
            getLog(current_type);

        });
        getLog(current_type);

</script>

<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>
