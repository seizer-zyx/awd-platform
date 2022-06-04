<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>佣金明细</title>
<style type="text/css">
body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#eee; font-family:'微软雅黑'; -moz-appearance:none;}
a {text-decoration:none;}
.log_top {height:44px; width:100%;  background:#f8f8f8;  border-bottom:1px solid #e3e3e3;}
.log_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}
.log_top .num { float:right;color:#666;height:44px;line-height:44px;padding-right:5px;}
    
.log_menu {height:44px; background:#fff;}
.log_menu .nav {height:44px; width:20%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}
.log_menu .navon {height:42px; color:#ff771b; border-bottom:2px solid #ff771b;}

.log_title {height:40px; padding:5px; line-height:50px; font-size:16px; color:#666;}

.log_list {height:70px; padding:10px; background:#fff;margin-top:10px;}
.log_list .left {height:40px; width:100%; float:left; color:#999; margin-right:-20%;font-size:14px;}
.log_list .left .inner { width:100%;margin-right:-20%}
.log_list .left span {color:#666; font-size:14px; line-height:28px;}
.log_list .right {height:40px; width:20%; float:right; font-size:14px; text-align:right; line-height:18px; margin-left:-20%;}
.log_list .right span {color:#f90;}
.log_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
#log_loading { padding:10px;color:#666;text-align: center;}

    .detail_good {height:auto;padding:10px;background:#fff;  border-top:1px solid #eaeaea; }
    .detail_good .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}
    .detail_good .shop {height:36px; width:90%; padding-left:10%;  line-height:36px; font-size:18px; color:#333;}
    .detail_good .good {height:50px; width:100%; padding:10px 0px; }
    .detail_good .img {height:50px; width:50px; float:left;}
    .detail_good .img img {height:100%; width:100%;}
    .detail_good .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .detail_good .info .inner { margin-left:60px;margin-right:60px; }
    .detail_good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .detail_good .info .inner .option {height:16px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .detail_good span { color:#666;}
    .detail_good .price { float:right;width:60px;;height:54px;margin-left:-60px;;}
    .detail_good .price .pnum { height:20px;width:100%;text-align:right;font-size:14px; }
    .detail_good .price .num { height:20px;width:100%;text-align:right;color:#ff6600}
    
    
</style>


<div id='container'></div>

<script id='tpl_log' type='text/html'>
    <div class="log_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> 申请详情: <%apply.applyno%></div>
</div>
  <div id='order_container'>
  </div>

</script>
<script id='tpl_order' type='text/html'>
        
    <%each list as order%>
  <div class="log_list">
    <div class="left"><div class='inner'>
               订单编号: <%order.ordersn%> <br> 订单金额: <%order.goodsprice%> 元 <br>
                申请佣金: <%order.ordercommission%> 元 <br/>
                审核通过佣金: <%order.orderpay%> 元 
                </div></div>
    
   </div>
    <div class='detail_good'>
        <%each order.goods as g%>
   <div class="good">
            <div class="img"  onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'"><img src="<%g.thumb%>"/></div>
            <div class='info' onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'">
                <div class='inner'>
                       <div class="name" <%if g.status==-1%>style='height:16px;'<%/if%>><%g.title%></div>     
                       <div class='option'>佣金: <%g.commission%> 元 </div>
                       <%if g.status==-1%>
                         <div class='option'>理由: <%g.content%> </div>
                       <%/if%>
                       
                </div>
            </div>
            <div class="price">
                <div class='pnum'><span class='marketprice'><%g.level%>级</span></div>
                <div class='pnum'><span class='num'><%g.statusstr%></span></div>
            </div>
        </div>
      <%/each%>
    </div>
    <%/each%>
    
</script>
<script id='tpl_empty' type='text/html'>
    <div class="log_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br>c<span style="line-height:18px; font-size:16px;">没有相关订单~</span></div>
</script>

<script language="javascript">
    var page = 1;
   var current_status = '';


    core_json('<?php echo 	create_url('mobile',array('do'=>'commission','act'=>'log','m'=>'eshop'))?>', {'op':'detail','id':"<?php  echo $_GPC['id'];?>"}, function (json) {
          if (json.status=='0') {
               tip_message(json.result,"<?php  echo $this->createMobileUrl('commission/log')?>",'error');
               return;
          }
          var result = json.result;
         $('#container').html(tpl('tpl_log',result));
          page = 1; current_status = '';
           getOrders(current_status);
    });
  
  
function bindScroller(){
    
      
    
        //加载更多
        var loaded = false;
        var stop = true;
        $(window).scroll(function () {
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false;
                    $('#order_container').append('<div id="log_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core_json('<?php echo 	create_url('mobile',array('do'=>'commission','act'=>'log','m'=>'eshop'))?>', {'op':'detail_order','id':"<?php  echo $_GPC['id'];?>",status:status, page: page}, function (morejson) {
                        stop = true;
                        $('#log_loading').remove();
                        $("#order_container").append(tpl('tpl_order', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $("#order_container").append('<div id="log_loading">已经加载完全部订单</div>');
                            loaded = true;
                            $(window).scroll = null;
                            return;
                        }
                    }, true);
                }
            }
        });
}
        function getOrders(status) {
            $('.log_menu .nav').removeClass('navon');
            $('.log_menu .nav[data-status=\'' + status + '\']').addClass('navon');
            core_json('<?php echo 	create_url('mobile',array('do'=>'commission','act'=>'log','m'=>'eshop'))?>', {'op':'detail_order','id':"<?php  echo $_GPC['id'];?>",status:status, page: page}, function (json) {
              
                if (!json.result.list.length) {
                    $('#order_container').html(tpl('tpl_empty'));
                    return;
                }
                $('#order_container').html(tpl('tpl_order', json.result));
         
                bindScroller();
            }, true);
        }
 


</script>
<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?> 