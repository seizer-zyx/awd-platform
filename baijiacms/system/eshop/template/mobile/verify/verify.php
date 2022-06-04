<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>订单核销</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; -moz-appearance:none;}


    .detail_topbar {height:44px; background:#5f6e8b; padding:15px;}
    .detail_topbar .ico {height:44px; width:30px; line-height:34px; float:left; font-size:26px; text-align:center; color:#fff;}
    .detail_topbar .tips {height:34px;  margin-left:10px; font-size:13px; color:#fff; line-height:17px;}
    
    
    .detail_user {height:54px;  background:#fff; padding:5px; border-bottom:1px solid #eaeaea;}
    .detail_user .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
    .detail_user .info .info1 {height:54px; width:100%; float:left;margin-left:-30px;margin-right:-30px;}
    .detail_user .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
    .detail_user .info .info1 .inner .user {height:30px; width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
    .detail_user .info .info1 .inner .address {height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
    .detail_user .info .ico2 {height:50px; width:30px;padding-top:15px; float:right; font-size:16px; text-align:right; color:#999;}

    .detail_exp {height:42px; width:94%; background:#fff; padding:0px 3%; border-bottom:1px solid #eaeaea; line-height:42px; font-size:16px; color:#333;}
    .detail_exp .t1 {height:42px; width:auto; float:left;}
    .detail_exp .t2 {height:42px; width:auto; float:right;}
    .detail_exp .ico {height:42px; width:10%; float:right;text-align:right;color:#999; font-size:16px;margin-top:5px; }
    
    .detail_good {height:auto;padding:10px;background:#fff;  margin-top:16px; border-top:1px solid #eaeaea;}
    .detail_good .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}
    .detail_good .shop {height:36px; width:90%; padding-left:10%; border-bottom:1px solid #eaeaea; line-height:36px; font-size:18px; color:#333;}
    .detail_good .good {height:50px; width:100%; padding:10px 0px; border-bottom:1px solid #eaeaea;}
    .detail_good .img {height:50px; width:50px; float:left;}
    .detail_good .img img {height:100%; width:100%;}
    .detail_good .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .detail_good .info .inner { margin-left:60px;margin-right:60px; }
    .detail_good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .detail_good .info .inner .option {height:16px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .detail_good span { color:#666;}
    .detail_good .price { float:right;width:60px;;height:54px;margin-left:-60px;;}
    .detail_good .price .pnum { height:20px;width:100%;text-align:right;font-size:14px; }
    .detail_good .price .num { height:20px;width:100%;text-align:right;}
    
    .detail_price {height:auto; padding:10px; padding-bottom:20px;  background:#fff;   }
    .detail_price .price {height:auto; width:100%; }
    .detail_price .price .line {height:26px; width:100%; font-size:13px; color:#666; line-height:26px;}
    .detail_price .price .line span {height:26px; width:auto; float:right;}
   
    .detail_pay {height:60px; width:94%; background:#fff; padding:0px 3%; margin-top:30px; border-top:1px solid #eaeaea;position:fixed;bottom:0px}
    .detail_pay span {height:60px; width:auto; margin-right:16px; float:right; line-height:60px; color:#ff771b; font-size:16px;}
    .detail_pay .paysub {height:38px; width:auto;margin-left:5px; background:#ff771b; padding:0px 10px; margin-top:10px; border-radius:5px; color:#fff; line-height:38px; float:right;}
    
    .detail_pay .paysub1 {height:38px; width:auto; margin-left:5px;background:#fff; padding:0px 10px; margin-top:10px; border-radius:5px; color:#5f6e8b; line-height:38px; float:right;border:1px solid #5f6e8b;}
       
       
    .chooser {height: 100%; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 1;}
    .chooser .address {height:50px; width:94%; background:#fff; padding:10px 3%; border-bottom:1px solid #eaeaea;}
    .chooser .address .ico {height:50px; width:10%; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser .address .info {height:50px; width:77%; margin-right:3%; float:left;}
    .chooser .address .info .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;}
    .chooser .address .info .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;}
    .chooser .address .edit {height:50px; width:10%; float:left; }

    .chooser .add_address {height:44px; width:94%; background:#fff; padding:0px 3%; border-bottom:1px solid #eaeaea; line-height:44px; font-size:16px; color:#666;}
    
    .detail_nav { height:30px; width:94%;padding:10px;}
    .detail_nav .nav { padding:2px 5px 2px 5px;; border:1px solid #5f6e8b; color:#5f6e8b; background:#fff; float:left; margin-left:10px;}
    .detail_nav .selected { border:1px solid #ff6600; color:#ff6600; }
    
.address_main {height:100%; width:94%; background:#fff; padding:0px 3%;  position: fixed; top: 0px; right: -100%; z-index: 1;}
.address_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;}

.address_main .line input {float:left; height:44px; width:100%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
.address_main .line select  { border:none;height:25px;width:100%;color:#666;font-size:16px;}
.address_main .address_sub1 {height:44px; width:94%; margin:14px 3% 0px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.address_main .address_sub2 {height:44px; width:94%; margin:14px 3% 0px; background:#ddd; border-radius:4px; text-align:center; font-size:18px; line-height:44px; color:#666; border:1px solid #d4d4d4;}
select { width:100px;height:40px;position:absolute;left:0; -webkit-appearance: none;background:#fff; -webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;};
 
.stores {overflow:hidden;background:#fff;}
.store {height:54px;  background:#fff; padding:5px; border-bottom:1px solid #eaeaea;}
.store .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
.store .info .info1 {height:54px; width:100%; float:left;margin-left:-30px;margin-right:-30px;}
.store .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
.store .info .info1 .inner .user {height:30px; width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
.store .info .info1 .inner .address {height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
.store .info .ico2 {height:50px; width:30px;padding-top:15px; float:right; font-size:13px; text-align:center; color:#999;}
.store_title {height:44px; width:94%; overflow: hidden; background:#fff; padding:0px 3%; margin-top:14px; border-bottom:1px solid #eaeaea; border-top:1px solid #eaeaea; line-height:44px; color:#666; font-size:14px;} 
.page_topbar .nav { position:absolute;right:5px;;color:#333;}
</style>
<div id='container'></div>

<script id='tpl_detail' type='text/html'>
<div class="page_topbar">
    <a href="<?php echo create_url('mobile',array('act' => 'center','do' => 'member','m'=>'eshop'));?>" class="back" ><i class="fa fa-angle-left"></i></a>
    <div class="title">订单核销</div>
</div>
<div class="detail_topbar">
    <div class="ico"><i class="fa fa-file-text-o"></i></div>
    <div class="tips">
        <%if order.status==0%>等待付款<%/if%>
        <%if order.status==1%>买家已付款<%/if%>
        <%if order.status==2%>卖家已发货<%/if%>
        <%if order.status==3%>交易完成<%/if%>
        <%if order.status==-1%>交易关闭<%/if%>
        <br>
        <span>订单金额(含运费): ￥<%order.price%><span><br/>
        <span>运费: ￥<%order.dispatchprice%><span><br/></div>
</div>
 
    
    <div class="detail_user">
        <div class="info" >
            <div class="ico"><i class="fa fa-user"></i></div>
                <div class='info1'>
                     <div class='inner'>
                         <div class="user">联系人:  <%carrier.carrier_realname%></div>
                         <div class="address">联系电话: <span id='carrier_address'><%carrier.carrier_mobile%></span></div>
                     </div>
                 </div>
            </div>
          </div>
    </div>
    
     
 
<div class="detail_good">
    <div class="ico"><i class="fa fa-gift" style="color:#666; font-size:20px;"></i></div>
    <div class="shop"><%set.name%></div>
    <%each goods as g%>
     <div class="good">
            <div class="img"  onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'"><img src="<%g.thumb%>"/></div>
            <div class='info' onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'">
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
</div>
<div class="detail_price" >
    <input type="hidden" id="weight" value="<%weight%>" />
    <div class="price">
        <div class="line">商品金额:<span>￥<span class='goodsprice'><%order.goodsprice%></span></span></div>
        <div class="line">运费:<span>￥<span class='dispatchprice'><%order.dispatchprice%></span></span></div>
        <%if order.discountprice>0%>
        <div class="line">会员折扣:<span>-￥<span class='discountprice'><%order.discountprice%></span></span></div>
        <%/if%>
        <div class="line">实付费(含运费):<span><span class='dispatchprice' style='color:#ff6600'>￥<%order.price%></span></span></div>
      </div>
</div>
    <%if order.status==3%>
    <div class="detail_price" style="margin-top:15px;height:80px;">
    <div class="price" style="padding-top:10px;">
     <div class="line">订单号:<span><%order.ordersn%></span></div>
     <div class="line">交易完成时间:<span><%order.finishtime%></span></div>
    </div>
    </div>
     <%/if%>
     <div style="height:80px;"></div>
     
<div class="detail_pay">
      <%if order.verified!=1%>
             <div class="paysub order_complete">确认使用</div>
        <%else%>
             <div class="paysub1">已使用</div>
      <%/if%>
</div>
</script>
 
<script type="text/javascript">
  

         
        core_json('<?php echo 	create_url('mobile',array('do'=>'verify','act'=>'detail','m'=>'eshop'))?>',{id:'<?php  echo $_GPC['id'];?>'},function(json){
              
                 if(json.status==0){
                     tip_message(json.result,"<?php echo 	create_url('mobile',array('do'=>'member','act'=>'center','m'=>'eshop'))?>" ,'error');
                     return;
                 }
                 $('#container').html(  tpl('tpl_detail',json.result) );
                 
                 $(".order_complete").click(function(){
  
                      tip_confirm('确认已使用?',function(){
                      
                         core_json('<?php echo 	create_url('mobile',array('do'=>'verify','act'=>'complete','m'=>'eshop'))?>',{id:'<?php  echo $_GPC['id'];?>'},function(json){
                                 if(json.status==1){
                                    tip_message('操作成功, 请返回微信, 无需其他操作!',"" ,'success',"WeixinJSBridge.call('closeWindow');");
                                    return;
                                 }
                                 tip_message(json.result,'','error',"WeixinJSBridge.call('closeWindow');");
                             },true,true);
                       });
                 });
                

         },false);

</script>
<?php  $show_footer=false;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>