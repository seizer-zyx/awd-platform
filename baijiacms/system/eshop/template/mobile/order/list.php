<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>我的订单</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; -moz-appearance:none; -webkit-appearance: none;}
    .order_topbar {height:44px; width:100%; background:#fff; border-bottom:1px solid #e3e3e3;}
    .order_topbar .nav {height:44px; <?php  if($_GPC['status']!=4) { ?>width:20%;<?php  } else { ?>width:50%;<?php  } ?> line-height:44px; text-align:center; font-size:14px; float:left; color:#666;}
    .order_topbar .on {height:42px; color:#ff771b; border-bottom:2px solid #ff771b;}
    .order_noinfo {height:20px; width:150px; background:url(img/order_img1.png) top center no-repeat; margin:50px auto 0px; padding-top:100px; line-height:20px; font-size:14px; text-align:center; color:#c9c9c9;}
    .order_main {height:auto; width:94%; background:#fff; padding:0px 3%; margin-top:16px; border-bottom:1px solid #e2e2e2; border-top:1px solid #e2e2e2;}
    .order_main .title {height:42px; width:100%; border-bottom:1px solid #e2e2e2; font-size:14px; line-height:42px; color:#666;}
    .order_main .title span {height:42px; width:auto; float:right; color:#ff771b;}
   

    .order_main .good {height:50px; width:100%; padding:10px 0px; border-bottom:1px solid #eaeaea;}
    .order_main .good .img {height:50px; width:50px; float:left;}
    .order_main .good  .img img {height:100%; width:100%;}
    .order_main .good  .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .order_main .good .info .inner { margin-left:60px;margin-right:60px; }
    .order_main .good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .order_main .good .info .inner .option {height:18px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .order_main .good span { color:#666;}
    .order_main .good  .price { float:right;width:60px;;height:54px;margin-left:-60px;;}
    .order_main .good  .price .pnum { height:20px;width:100%;text-align:right;font-size:14px; }
    .order_main .good  .price .num { height:20px;width:100%;text-align:right;}
    .order_main .info1 {height:42px; width:100%; border-bottom:1px solid #e2e2e2; font-size:14px; color:#999; line-height:42px; text-align:right;}
    .order_main .info1 span {color:#666;}

    .order_main .sub {height:50px; width:100%;}
    .order_main .sub1 {height:30px; width:auto; padding:0px 10px; border:1px solid #ff771b; float:right; border-radius:5px; line-height:30px; font-size:14px; margin:10px 5px 10px 0px; color:#fff; background:#ff771b;}
    .order_main .sub2 {height:30px; width:auto; padding:0px 10px; border:1px solid #5f6e8b; float:right; border-radius:5px; line-height:30px; font-size:14px; margin:10px 5px 10px 0px; color:#5f6e8b;}
    select { width:80px;height:30px;position:absolute;left:0; filter:alpha(Opacity=0); opacity: 0;-webkit-appearance: none;background:#fff; -webkit-tap-highlight-color: transparent };
    .order_no {height:40px; width:100%;  padding-top:180px; margin:50px 0px;}

    .order_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    .order_no_menu {height:40px; width:100%; text-align:center;}
    .order_no_nav {height:38px;padding:10px; width:100px; background:#eee; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
    #order_loading { width:94%;padding:10px;color:#666;text-align: center;}

</style>
<div id='container' ></div>
<script id='tpl_order_list' type='text/html'>
    <div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <div class="title">我的订单</div>
</div>
    <div class="order_topbar">
        <?php  if($_GPC['status']!=4) { ?>
        <div class="nav <?php  if($_GPC['status']=='') { ?>on<?php  } ?>" data-status="">全部</div>
        <div class="nav <?php  if($_GPC['status']=='0') { ?>on<?php  } ?>" data-status="0">待付款</div>
        <div class="nav <?php  if($_GPC['status']=='1') { ?>on<?php  } ?>"  data-status="1">待发货</div>
        <div class="nav <?php  if($_GPC['status']=='2') { ?>on<?php  } ?>"  data-status="2">待收货</div>
        <div class="nav <?php  if($_GPC['status']=='3') { ?>on<?php  } ?>"  data-status="3">已完成</div>
        <?php  } else { ?>
        <div class="nav <?php  if($_GPC['status']=='') { ?>on<?php  } ?>" data-status="">其他订单</div>
        <div class="nav <?php  if($_GPC['status']=='4') { ?>on<?php  } ?>"  data-status="3">退款订单</div>
        <?php  } ?>
    </div>
    <div id='order_container' ></div>
</script>
<script id='tpl_order' type='text/html'>
    <%each list as order%>
    <div class="order_main" data-orderid="<%order.id%>">
        <div class="title">订单号：<%order.ordersn%><span><%order.statusstr%></span></div>
        <%each order.goods as g%>      
        <div class="good">
            <div class="img"  onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%order.id%>'"><img src="<%g.thumb%>"/></div>
            <div class='info' onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%order.id%>'">
                <div class='inner'>
                       <div class="name"><%g.title%></div>     
                       <div class='option'><%if g.optionid!='0'%>规格:  <%g.optiontitle%><%/if%></div>
                </div>
            </div>
            <div class="price">
                <div class='pnum'><span class='marketprice'>￥<%g.price%></span></div>
                <div class='pnum'><span class='total'>×<%g.total%></span></div>
            </div>
        </div>
        <%/each%>
        <div class="info1">共 <%order.goodscount%> 件商品&nbsp;实付：<span>￥<%order.price%></span></div>
        <div class="sub">
            <%if order.status==0%>
			<%if order.paytype!=3%>
            <div class="sub1" onclick="location.href='<?php  echo $this->createMobileUrl('order/pay')?>&orderid=<%order.id%>&openid=<?php  echo $openid;?>'">付款</div>
			<%/if%>
            <div class="sub2 order_cancel" style='position:relative;width:56px;'>
                <span style='position:absolute;display:block;width:56px;'>取消订单</span>
                <select>
                    <option value="">不取消了</option>
                    <option value="我不想买了">我不想买了</option>
                    <option value="信息填写错误，重新拍">信息填写错误，重新拍</option>
                    <option value="同城见面交易">同城见面交易</option>
                    <option value="其他原因">其他原因</option>
                    </select>
            </div>
            <%/if%>
          <%if order.status==1 && order.isverify=='1' && order.verifyied!='1'%>
          <div class="sub2" style="float:left;" onclick="VerifyHandler.verify('<%order.id%>')"><i class="fa fa-qrcode"></i> 确认使用</div>
          <%/if%>
        
            <%if order.status==2%>
                    <div class="sub1 order_complete">确认收货</div>
					<%if order.expresssn %>
                   <div class="sub2 order_express">查看物流</div>
				   <%/if%> 

            <%/if%>
            <%if order.status==3 && order.iscomment==0%>
                   <div class="sub2 order_comment">评价</div>
            <%/if%>
            <%if order.status==3 && order.iscomment==1%>
                   <div class="sub2 order_comment">追加评价</div>
            <%/if%>
            <%if order.status==3 || order.status==-1%>
                   <div class="sub2 order_delete">删除订单</div>
            <%/if%>
               <%if order.canrefund%>
                    <%if order.refundid!=0%>
                    <div class="sub1 order_refund">退款申请中</div>
                    <%else%>
                    <div class="sub1 order_refund">申请退款</div>
                  <%/if%>
            <%/if%>
      

        </div>
    </div>
    <%/each%>
    
</script>
<script id='tpl_empty' type='text/html'>
    <div class="order_no"><i class="fa fa-file-text-o" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有相关订单</span><br>可以去看看哪些想买的</div>
    <div class="order_no_menu">

        <span class="order_no_nav"  onclick="location.href='<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'index','m'=>'eshop'))?>'">随便逛逛</span>
    </div>
</script>

<?php include page('verify/pop',false);?>

<script language='javascript'>

    var page = 1;

        
             function bindEvents(){
                
                    $('.order_main .good').unbind('click').click(function() {

                        var orderid = $(this).closest('.order_main').data('orderid');
                        location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'detail','m'=>'eshop'))?>&id="+orderid;

                    });
                    
            
                    $(".order_cancel").find('select').unbind('change').change(function() {
                        var reason = $(this).val();
                        var orderid = $(this).closest('.order_main').data('orderid');

                        if (reason != '') {
                        	
                            core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>", {'op': 'cancel', orderid: orderid, reason: reason}, function(json) {

                                if (json.status == 1) {
                                    $(".order_main[data-orderid='" + orderid + "']").remove();
                                }
                                else {
                                    tip_show(json.result);
                                }
                            }, true);
                        }
                    });
 
                    $('.order_refund').unbind('click').click(function() {

                        var orderid = $(this).closest('.order_main').data('orderid');
                        location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>&op=refund&orderid="+orderid;

                    });
  $('.order_express').unbind('click').click(function() {

                        var orderid = $(this).closest('.order_main').data('orderid');
                          location.href ="<?php echo 	create_url('mobile',array('do'=>'order','act'=>'express','m'=>'eshop'))?>&id="+orderid;

                    });
                 
                         $(".order_complete").unbind('click').click(function(){
                              var orderid = $(this).closest('.order_main').data('orderid');
                              tip_confirm('确认您已经收货?',function(){

                                 core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{'op':'complete', orderid:orderid},function(json){
                                         if(json.status==1){
                                              location.reload();
                                              return;
                                         }
                                         tip_show(json.result);
                                     },true);
                               });
                         });
                      
                         $(".order_comment").unbind('click').click(function(){
                               var orderid = $(this).closest('.order_main').data('orderid');
                                     location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>&op=comment&orderid="+orderid;
                         });
                     
                         $(".order_delete").unbind('click').click(function(){
                         	  tip_confirm('确认删除此订单?',function(){
                              var orderid = $(this).closest('.order_main').data('orderid');
                                 core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{'op':'delete', orderid:orderid},function(json){

                                      if(json.status==1){
                                          $(".order_main[data-orderid='" + orderid + "']").remove();
                                           return;
                                       }
                                      tip_show(json.result);
                                 },true);
                                          });
                         });
             }
             core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'list','m'=>'eshop'))?>", {page:page, status: '<?php  echo $_GPC['status'];?>'}, function(json) {

                    $("#container").html(tpl('tpl_order_list'));
                    $('.nav').click(function() {
                        var status = $(this).data('status');
                        location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'list','m'=>'eshop'))?>&status="+status;
                    })
                    if (json.result.list.length <= 0) {
                        $("#order_container").html(tpl('tpl_empty'));
                        return;
                    }
                    $("#order_container").html(tpl('tpl_order', json.result));
                    bindEvents();
                    
                  
                    var loaded = false;
                      var stop=true; 
                      $(window).scroll(function(){ 
                          if(loaded){
                              return;
                          }
                            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
                            if($(document).height() <= totalheight){ 
                                
                                if(stop==true){ 
                                    stop=false; 
                                    $('#order_container').append('<div id="order_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'list','m'=>'eshop'))?>", {page:page, status: '<?php  echo $_GPC['status'];?>'}, function(morejson) {  
                                        stop = true;
                                        $('#order_loading').remove();
                                        $("#order_container").append(tpl('tpl_order', morejson.result));
                                        bindEvents();
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                            $('#order_container').append('<div id="order_loading">已经加载全部订单</div>');
                                            loaded = true;
                                            return;
                                        }
                                    },true); 
                                } 
                            } 
                        });
                }, false);
      

</script>


<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>
