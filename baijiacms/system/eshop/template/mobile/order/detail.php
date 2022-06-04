<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>订单详情</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; -moz-appearance:none;}


    .detail_topbar {height:64px; background:#5f6e8b; padding:15px;}
    .detail_topbar .ico {height:64px; width:30px; line-height:34px; float:left; font-size:26px; text-align:center; color:#fff;}
    .detail_topbar .tips {height:54px;  margin-left:10px; font-size:13px; color:#fff; line-height:17px;}
    
    
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
    
    .detail_good {height:auto;padding:10px;background:#fff;margin-top:3px; border-top:1px solid #eaeaea;}
    .detail_good .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}
    .detail_good .shop {height:36px; width:90%; border-bottom:1px solid #eaeaea; line-height:36px; font-size:18px; color:#333;}
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
    .detail_price .shop {height:36px; width:90%; border-bottom:1px solid #eaeaea; line-height:36px; font-size:18px; color:#333;}
    .detail_price .price {height:auto; width:100%; }
    .detail_price .price .line {height:26px; width:100%; font-size:13px; color:#666; line-height:26px;}
    .detail_price .price .line span {height:26px; width:auto; float:right;}
    
   
    .detail_pay {height:60px; width:94%; background:#fff; padding:0px 3%;  border-top:1px solid #eaeaea;position:fixed;bottom:0px}
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
.store {height:65px;  background:#fff; padding:5px; border-bottom:1px solid #eaeaea;}
.store .info .ico { float:left;  height:50px; width:30px; line-height:30px; font-size:16px; text-align:center; color:#666}
.store .info .info1 {height:54px; width:100%; float:left;margin-left:-30px;margin-right:-60px;}
.store .info .info1 .inner { margin-left:30px;margin-right:60px;overflow:hidden;}
.store .info .info1 .inner .user {height:25px; width:100%; font-size:14px; color:#333; line-height:25px;overflow:hidden;}
.store .info .info1 .inner .tel {height:20px; width:100%; font-size:13px; color:#999; line-height:20px;overflow:hidden;}
.store .info .info1 .inner .address {height:20px; width:100%; font-size:13px; color:#999; line-height:20px;overflow:hidden;}
.store .info .ico2 {height:50px; width:30px;padding-top:15px; float:right; font-size:24px; text-align:center; color:#ccc;}
.store .info .ico3 {height:50px; width:30px;padding-top:15px; float:right; font-size:24px; text-align:center; color:#ccc;} 
.store_title {height:44px; width:94%; overflow: hidden; background:#fff; padding:0px 3%; margin-top:5px; border-bottom:1px solid #eaeaea; border-top:1px solid #eaeaea; line-height:44px; color:#666; font-size:14px;} 
.store_more {height:20px;  background:#fff; font-size:14px; color:#999; line-height:20px; padding:5px; border-bottom:1px solid #eaeaea; text-align: center;}
.page_topbar .nav { position:absolute;right:5px;;color:#333;}

.detail_good .text { padding:10px; color:#666;font-size:13px;}





</style>
<div id='container'></div>

<script id='tpl_detail' type='text/html'>
<div class="page_topbar">
    <a href="<?php  echo $this->createMobileUrl('order')?>" class="back"><i class="fa fa-angle-left"></i></a>
    <%if order.status==1 && order.isverify=='1' && order.verifyied!='1'%><a href="javascript:;" class="btn" onclick="VerifyHandler.verify('<?php  echo $_GPC['id'];?>')"><i class="fa fa-qrcode"></i></a><%/if%>
    <div class="title">订单详情</div>
</div>
<div style="background:#fff; ">
 <div class="store_title"  style="width:90%;margin-top:0px;margin-bottom:0px;padding-bottom: 0px; border-bottom: 0px;border-bottom: 1px solid #eaeaea;">
   订单状态： 
            <%if order.status>=0&&order.refundid!=0%>
              退款申请中
         <%else%>
        
   <%if order.status==0 && order.paytype!=3%>等待付款<%/if%>
	<%if order.paytype==3 && order.status==0%>货到付款，等待发货<%/if%>
        <%if order.status==1%><%if order.isvirtual==1%>买家已付款,等待商家发货<%else%>买家已付款,等待取货<%/if%><%/if%>
        <%if order.status==2 %>卖家已发货,等待买家收货<%/if%>
           <%if order.status==3%>交易已完成<%/if%>
        <%if order.status==-1%>交易已关闭<%/if%>
    </div>   <%/if%>  </div>
    
    <%if order.status>=0||order.status==-1 %>
  <div style="background:#fff; padding-top: 25px;">
<div  style="    border-top: 1px solid #E5E5E5;
    line-height: 1.6em;
    font-size: 14px;text-align:center">
     <span class="weui-loadmore__tips" style="   position: relative;
    top: -0.9em;
    padding: 0 .55em;
    background-color: #FFFFFF;<%if order.status<=0%>color: #999999;<%else%>color: green;<%/if%> ">
     <%if order.status==0 && order.paytype!=3%><i class="fa fa-circle-thin" style="margin-right:5px"></i>等待付款<%/if%>
	<%if order.paytype==3 && order.status==0%><i class="fa fa-circle-thin"  style="margin-right:5px"></i>货到付款，等待发货<%/if%>
	        <%if order.status>=1%><i class="fa fa-check"  style="margin-right:5px"></i>买家已付款<%/if%>
	            <%if order.status==-1%><i class="fa fa-close"  style="margin-right:5px"></i>已关闭<%/if%>
    </span>
    
            <span class="weui-loadmore__tips" style=" margin-left:20px;   position: relative;
    top: -0.9em;
    padding: 0 .55em;
    background-color: #FFFFFF;
    <%if order.status<=0%>color: #999999;<%else%>color: green;<%/if%>">
    <%if order.status==0%><i class="fa fa-circle-thin" style="margin-right:5px"></i>等待付款 <%/if%>
    <%if order.status==1 %><i class="fa fa-circle" style="margin-right:5px"></i>等待卖家发货<%/if%>
    <%if order.status>=2 %><i class="fa fa-check" style="margin-right:5px"></i>卖家已发货<%/if%>
            <%if order.status==-1%><i class="fa fa-close"  style="margin-right:5px"></i>已关闭<%/if%>
   </span>
    
     
            <span class="weui-loadmore__tips" style=" margin-left:20px;   position: relative;
    top: -0.9em;
    padding: 0 .55em;
    background-color: #FFFFFF;
  <%if order.status<=0%>color: #999999;<%else%><%if order.status<=1%>color: #999999;<%else%>color: green;<%/if%><%/if%>">
  <%if order.status==0%><i class="fa fa-circle-thin" style="margin-right:5px"></i>等待付款<%/if%>
  <%if order.status==1 %><i class="fa fa-circle-thin" style="margin-right:5px"></i>等待卖家发货<%/if%>
  <%if order.status==2 %><i class="fa fa-circle" style="margin-right:5px"></i>等待买家收货<%/if%>
    <%if order.status==3 %><i class="fa fa-check" style="margin-right:5px"></i>已完成<%/if%>
    <%if order.status==-1%><i class="fa fa-close"  style="margin-right:5px"></i>已关闭<%/if%>
  </span>
        </div>
    </div>
    <%/if%>
 
    <%if order.isverify==1%>
    <div class="store_title" onclick="showStores(this)" show="1" >适用的门店
         <i class="fa fa-angle-down" style="float:right; line-height:44px; font-size:26px;"></i>
    </div>
  
    
      <div class="stores">
      <%each stores as store index%>
     <%if index<=1%>
     <div class="store" >
             <div class="info">
             <div class="ico"><i class="fa fa-building-o"></i></div>
             <div class='info1'>
                 <div class='inner'>
                     <div class="user"><%store.storename%></div>
                     <div class="address">地址: <%store.address%></div>
                     <div class="tel">电话: <%store.tel%></div>
                 </div>
             </div>
             <a href="http://api.map.baidu.com/marker?location=<%store.lat%>,<%store.lng%>&title=<%store.storename%>&name=<%store.storename%>&content=<%store.address%>&output=html"><div class="ico2"><i class='fa fa-map-marker'></i></div></a>
             <a href="tel:<%store.tel%>"><div class="ico3" ><i class='fa fa-phone'></i></div></a>
        </div>
       </div>
     <%/if%>
     <%/each%> 
         <div id='store_more' style="display:none">
      <%each stores as store index%>
     <%if index>1%>
     <div class="store" >
             <div class="info">
             <div class="ico"><i class="fa fa-building-o"></i></div>
             <div class='info1'>
                 <div class='inner'>
                     <div class="user"><%store.storename%></div>
                     <div class="address">地址: <%store.address%></div>
                     <div class="tel">电话: <%store.tel%></div>
                 </div>
             </div>
             <a href="http://api.map.baidu.com/marker?location=<%store.lat%>,<%store.lng%>&title=<%store.storename%>&name=<%store.storename%>&content=<%store.address%>&output=html"><div class="ico2"><i class='fa fa-map-marker'></i></div></a>
             <a href="tel:<%store.tel%>"><div class="ico3" ><i class='fa fa-phone'></i></div></a>
        </div>
       </div>
     <%/if%>
     <%/each%> 
         </div>
    <%if stores.length>=3%>
     <div class="store_more" onclick="$('#store_more').show();$(this).remove()">显示更多 <i class="fa fa-angle-double-down"></i></div>
     <%/if%> 
      </div>
    
   
    <%else%>

 
 <%if order.dispatchtype==1%>
 <div class="detail_user">
     <input type='hidden' id='carrierindex' value='0' />
    <div class="info" id='carrier_select' >
        <div class="ico"><i class="fa fa-map-marker"></i></div>
            <div class='info1'>
                 <div class='inner'>
                     <div class="user">自提地点：<span id='carrier_realname'><%carrier.realname%></span>(<span id='carrier_mobile'><%carrier.mobile%></span>)</div>
                     <div class="address"><span id='carrier_address'><%carrier.address%></span></div>
                 </div>
         </div>
    </div>
</div>
 <%/if%>
 <%/if%>
<div class="detail_good">
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
 <%if order.virtual_str!=''%>
<div class="detail_good" style='margin-bottom:10px;'>
    <div class="ico"><i class="fa fa-cubes" style="color:#666; font-size:20px;"></i></div>
    <div class="shop">发货信息</div>
    <div class='text'><%=order.virtual_str%></div>
</div> 
 
 <%/if%>
<div class="detail_price" >
    <input type="hidden" id="weight" value="<%weight%>" />
    <div class="price">
        <div class="line">商品小计:<span>￥<span class='goodsprice'><%order.goodsprice%></span></span></div>
        	
        <div class="line">运费:<span>￥<span class='dispatchprice'><%order.olddispatchprice%></span></span></div>
      
	
        <%if order.discountprice>0%>
        <div class="line">会员折扣:<span>-￥<span class='discountprice'><%order.discountprice%></span></span></div>
        <%/if%>
        <%if order.deductprice>0%>
        <div class="line">积分抵扣:<span>-￥<span class='deductprice'><%order.deductprice%></span></span></div>
        <%/if%>
    
 <%if order.changeprice!=0%>
        <div class="line">改价优惠:<span><%if order.changeprice>0%>+<%/if%>￥<span class='changeprice2'><%order.changeprice%></span></span></div>
        <%/if%>
        <%if order.changedispatchprice!=0%>
        <div class="line">运费改价:<span><%if order.changedispatchprice>0%>+<%/if%>￥<span class='changedispatchprice2'><%order.changedispatchprice%></span></span></div>
        <%/if%>
        
		
        <div class="line">实付费(含运费):<span><span class='dispatchprice' style='color:#ff6600'>￥<%order.price%></span></span></div>
      </div> 
</div>

    <div class="detail_price" style="margin-top:5px;">
    <div class="shop"><i class="fa fa-cubes" style="color:#666; font-size:20px;"></i>订单详情</div>
    <div class="price" style="padding-top:10px;">
     <div class="line">订单号:<span><%order.ordersn%></span></div>
      <%if order.isverify==1 || order.virtual!='0'%>
        <div class="line">联系人:<span><%carrier.carrier_realname%></span></div>
         <div class="line">联系电话:<span><%carrier.carrier_mobile%></span></div>
     <%/if%>
      <%if order.addressid!=0%>
        <div class="line">收件人:<span><%address.realname%></span></div>
        <div class="line">联系电话:<span><%address.mobile%></span></div>
        <div class="line">收件地址:<span><%address.address%></span></div>
     <%/if%>
              
     <div class="line">订单创建时间:<span><%order.createtime%></span></div>
         <%if order.status==3%>
     <div class="line">交易完成时间:<span><%order.finishtime%></span></div>
        <%/if%>
    </div>
    </div>
    
    

  
     <div style="height:40px;"></div>
     
<div class="detail_pay">
      <%if order.status==0%>
	  <%if order.paytype!=3%>
		<div class="paysub" onclick="location.href ='<?php  echo $this->createMobileUrl('order/pay')?>&orderid=<%order.id%>&openid=<?php  echo $openid;?>'">付款</div>
           <%/if%>
           <div class="paysub1 order_cancel" style='position:relative;width:63px;'>
               <span style='position:absolute;display:block;width:70px;top:-10px;color:#5f6e8b'>取消订单</span>
           <select>
               <option value="">不取消了</option>
               <option value="我不想买了">我不想买了</option>
               <option value="信息填写错误，重新拍">信息填写错误，重新拍</option>
               <option value="同城见面交易">同城见面交易</option>
               <option value="其他原因">其他原因</option>
           </select>
             </div>
      <%/if%>
  
      
      <%if order.status==2%>
             <div class="paysub order_complete">确认收货</div>
			 <%if order.expresssn %>
             <div class="paysub1 order_express">查看物流</div>
			 <%/if%>
      <%/if%>
      <%if order.status==3 && order.iscomment==0%>
             <div class="paysub1 order_comment">评价</div>
      <%/if%>
      <%if order.status==3 && order.iscomment==1%>
             <div class="paysub1 order_comment">追加评价</div>
      <%/if%>
      <%if order.status==3  || order.status==-1%>
             <div class="paysub1 order_delete">删除订单</div>
      <%/if%>
      <%if order.canrefund%>
         <%if order.refundid!=0%>
               <div class="paysub order_refund">退款申请中</div>
         <%else%>
               <div class="paysub order_refund">申请退款</div>
         <%/if%>
      <%/if%> 
       <%if order.isverify=='1' %>
              <%if order.verified!='1'%>
                      <%if order.status==1%>
                       <div class="paysub1" onclick="VerifyHandler.verify('<?php  echo $_GPC['id'];?>')" style='float:left'><i class="fa fa-qrcode"></i> 确认使用</div>
                       <%/if%>
            <%/if%>
      <%/if%>
</div>
</script>
<?php include $this->template('verify/pop',false);?>

<script type="text/javascript">
     function showStores(obj){
        if($(obj).attr('show')=='1'){
            $(obj).next('div').slideUp(100);
            $(obj).removeAttr('show').find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
        }
        else{
            $(obj).next('div').slideDown(100);
            $(obj).attr('show','1').find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
        }
    }

    
        core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'detail','m'=>'eshop'))?>",{id:'<?php  echo $_GPC['id'];?>'},function(json){
                 
                 if(json.status==0){
                     tip_message('订单已取消或不存在，无法查看!',"<?php  echo $this->createMobileUrl('order')?>" ,'error');
                     return;
                 }
                 $('#container').html(  tpl('tpl_detail',json.result) );
                 $("#verifycode").html( json.result.order.verifycode);
                 $(".order_cancel").find('select').change(function(){
                        var reason = $(this).val();

                        if(reason!=''){
                        	
                             core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{'op':'cancel', orderid:'<?php  echo $_GPC['id'];?>',reason:reason},function(json){

                                 if(json.status==1){
                                      location.href =  "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'list','m'=>'eshop'))?>";
                                      return;
                                 }
                                 else{
                                      tip_show(json.result);
                                 }
                             },true);
                        }
                 });
             
                 $('.order_refund').click(function(){
                 	
                       location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>&op=refund&orderid=<?php  echo $_GPC['id'];?>";
                  });
                    $('.order_express').click(function(){
                    	
                       location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'express','m'=>'eshop'))?>&id=<?php  echo $_GPC['id'];?>";
                  });
                
                 $(".order_complete").click(function(){
  
                      tip_confirm('确认您已经收货?',function(){
                      
                         core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{'op':'complete', orderid:'<?php  echo $_GPC['id'];?>'},function(json){
                                 if(json.status==1){
                                      location.reload();
                                      return;
                                 }
                                 tip_show(json.result);
                             },true);
                       });
                 });
               
                 $(".order_comment").click(function(){
                 	
                             location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>&op=comment&orderid=<?php  echo $_GPC['id'];?>";
                 });
            
                 $(".order_delete").click(function(){
                 	   tip_confirm('确认删除此订单?',function(){
                         core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{'op':'delete', orderid:'<?php  echo $_GPC['id'];?>'},function(json){

                              if(json.status==1){
                              	
                                   location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'list','m'=>'eshop'))?>";
                                   return;
                               }
                              tip_show(json.result);
                         },true);    
                         });
                 });

         },false);

</script>

<?php  $show_footer=false;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>
