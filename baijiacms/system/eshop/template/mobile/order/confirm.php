<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>确认订单</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef;}
    .addorder_topbar {height:34px; background:#5f6e8b; padding:15px;}
    .addorder_topbar .ico {height:34px; width:30px; line-height:34px; float:left; font-size:26px; text-align:center; color:#fff;}
    .addorder_topbar .tips {height:34px;  margin-left:10px; font-size:13px; color:#fff; line-height:17px;}
    
    .addorder_nav { height:30px; padding:5px;  background:#fff;}
    .addorder_nav .nav { padding:2px 5px 2px 5px;; border:1px solid #5f6e8b; color:#5f6e8b; background:#fff; float:left; margin-left:10px;}
    .addorder_nav .selected { border:1px solid #ff6600; color:#ff6600; }
    
    .addorder_user {height:54px;  background:#fff; padding:5px; border-bottom:1px solid #eaeaea;}
    .addorder_user .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
    .addorder_user .info .info1 {height:54px; width:100%; float:left;margin-left:-30px;margin-right:-30px;}
    .addorder_user .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
    .addorder_user .info .info1 .inner .user {height:30px; width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
    .addorder_user .info .info1 .inner .address {height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
    .addorder_user .info .ico2 {height:50px;  width:30px; line-height:65px; float:right; font-size:16px; text-align:right; color:#999;}
    
    .addorder_exp {height:42px;  background:#fff; padding:5px; border-bottom:1px solid #eaeaea; line-height:42px; font-size:16px; color:#333;}
    .addorder_exp .t1 {height:42px; width:auto; float:left;padding-left:10px;}
    .addorder_exp .t2 {height:42px; width:auto; float:right;}
    .addorder_exp .ico {height:42px; width:30px;  float:right;text-align:right;color:#999; font-size:16px;margin-top:5px; }
     
    
    .addorder_good {height:auto;padding:10px;background:#fff;  margin-top:3px; border-bottom:1px solid #eaeaea; border-top:1px solid #eaeaea;}
    .addorder_good .ico {height:6px; padding-right:5px;  line-height:36px; float:left; text-align:center;}
    .addorder_good .shop {height:36px;  padding-left:5px; border-bottom:1px solid #eaeaea; line-height:36px; font-size:18px; color:#333;}
    .addorder_good .good {height:50px; width:100%; padding:10px 0px; border-bottom:1px solid #eaeaea;}
    .addorder_good .img {height:50px; width:50px; float:left;}
    .addorder_good .img img {height:100%; width:100%;}
    .addorder_good .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .addorder_good .info .inner { margin-left:60px;margin-right:60px; }
    .addorder_good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .addorder_good .info .inner .option {height:18px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .addorder_good span { color:#666;}
    .addorder_good .price { float:right;width:60px;;height:54px;margin-left:-60px;;}
    .addorder_good .price .pnum { height:20px;width:100%;text-align:right;font-size:14px; }
    .addorder_good .price .num { height:20px;width:100%;text-align:right;}
    .addorder_good input {height:34px; width:97%; padding: 0 5px; background:#f7f7f7;  border:1px solid #e9e9e9; margin:14px 0px 0; -webkit-appearance: none; }
    .addorder_good .text {height:34px; width:100%; line-height:34px; text-align:right; font-size:16px; color:#999;}

    .addorder_price {height:auto;  background:#fff; padding:5px 10px; margin-top:5px; border-bottom:1px solid #eaeaea; border-top:1px solid #eaeaea;}
    .addorder_price .price {height:auto; width:100%; border-bottom:1px solid #eaeaea;}
    .addorder_price .price .line {height:33px; width:100%; font-size:14px; color:#666;}
    .addorder_price .price .line span {height:33px; width:auto; float:right;}
    .addorder_price .all {height:47px; width:100%; line-height:47px; font-size:16px; color:#666;}
    .addorder_price .all span {height:47px; width:auto; float:right; color:#ff771b;}
    .addorder_pay {height:60px; width:94%; background:#fff; padding:0px 3%; margin-top:5px; border-top:1px solid #eaeaea;}
    .addorder_pay span {height:60px; width:auto; margin-right:16px; float:right; line-height:60px; color:#ff771b; font-size:16px;}
    .addorder_pay .paysub {height:40px; width:auto; background:#ff771b; padding:0px 10px; margin-top:10px; border-radius:5px; color:#fff; line-height:40px; float:right;}
    .chooser {overflow: auto; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 1;}
    .chooser .address {height:50px; background:#fff; padding:10px;; border-bottom:1px solid #eaeaea;}
    .chooser .address .ico {float:left; height:50px; width:30px; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser .address .info {height:50px; width:100%;float:left;margin-left:-30px;margin-right:-30px;}
    .chooser .address .info .inner { margin-left:35px;margin-right:30px;}
    .chooser .address .info .inner .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;overflow:hidden;}
    .chooser .address .info .inner .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;overflow: hidden;}
    .chooser .address .edit {height:50px; width:30px; float:right;margin-left:-30px;text-align:center;line-height:50px;color:#666;}

    .chooser .add_address {height:44px; padding:5px; background:#fff; border-bottom:1px solid #eaeaea; line-height:44px; font-size:16px; color:#666;}

   

    .address_main {height:100%; width:100%; background:#fff;  position: fixed; top: 0px; right: -100%; z-index: 1;}
    .address_main .line {height:44px; margin: 0 5px; border-bottom:1px solid #f0f0f0; line-height:44px;}

    .address_main .line input {float:left; height:44px; width:100%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
    .address_main .line select  { border:none;height:25px;width:100%;color:#666;font-size:16px;}
    .address_main .address_sub1 {height:44px; margin:14px 5px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .address_main .address_sub2 {height:44px; margin:14px  5px; background:#ddd; border-radius:4px; text-align:center; font-size:18px; line-height:44px; color:#666; border:1px solid #d4d4d4;}
.select { -webkit-appearance: none }

    .carrier_input_info {height:auto;width:100%; background:#fff; margin-top:3px; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8;}
    .carrier_input_info .row { padding:0 10px; height:40px; background:#fff; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
    .carrier_input_info .row .title {height:40px; width:85px; line-height:40px; color:#444; float:left; font-size:16px;}
    .carrier_input_info .row .info { width:100%;float:right;margin-left:-85px; }
    .carrier_input_info .row .inner { margin-left:85px; }
    .carrier_input_info .row .inner input {height:30px; color:#666;background:transparent;margin-top:0px; width:100%;border-radius:0;padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
 
    .addorder_price .line .nav {height:22px; width:40px; background:#ccc; margin:3px 0px; float:right; border-radius:40px;}
.addorder_price .line .on {background:#4ad966;}
.addorder_price .line .nav nav {height:20px; width:20px; background:#fff; margin:1px; border-radius:20px;}
.addorder_price .line .nav .on {margin-left:19px;}
.cnum {height:20px; width:61px; border:1px solid #e2e2e2; }
.cnum .leftnav {height:20px; width:19px; float:left; border-right:1px solid #e2e2e2; background:#eee; color:#6b6b6b; text-align:center; line-height:20px; font-size:18px; font-weight:bold;}
.cnum .shownum {height:20px; width:20px; float:left;  border:0px; margin:0px; padding:0px; text-align:center;}
.cnum .rightnav {height:20px; width:19px; float:right; border-left:1px solid #e2e2e2; background:#eee; color:#6b6b6b; text-align:center; line-height:20px; font-size:18px; font-weight:bold;}

.couponcount {float:right; margin-top:5px;  margin-right: 5px; height:16px; width:16px; background:#f30; border-radius:8px; font-size:12px; color:#fff; line-height:16px; text-align: center;}

</style>
<script type="text/javascript" src="<?php  echo RESOURCE_ROOT;?>eshop/static/js/dist/area/cascade.js"></script>
<div id='carrier_container'></div>
<div id='dispatch_container'></div>
<div id='address_container'></div>
<div id='confirm_container' ></div>

<script id='tpl_address_list' type='text/html'>
    <div class="chooser choose_address" >
        <%each list as address%>
        <div class="address" 
             data-addressid='<%address.id%>'
             data-realname='<%address.realname%>'
             data-mobile='<%address.mobile%>'
             data-address='<%address.address%>'
             >
            <div class="ico" ><%if selectedAdressID==address.id%><i class="fa fa-check" style="color:#0c9"></i><%/if%></div>
            <div class="info">
                <div class='inner'>
                    <div class="name"><%address.realname%>(<%address.mobile%>)</div>
                    <div class="addr"><%address.address%></div>
                </div>
            </div>
            <div class="edit"><i class='fa fa-pencil'></i></div>
        </div>
        <%/each%>
        <div class="add_address"><i class="fa fa-plus-circle" style="margin-left:3%; margin-right:10px; line-height:44px; font-size:20px;"></i>新增收货地址</div>
    </div>
</script>

<script id='tpl_address_new' type='text/html'>
    <input type='hidden' id='edit_addressid' value="<%address.id%>" />
    <div class="address_main" >
        <div class="line"><input type="text" placeholder="收件人" id="realname" value="<?php  if(address.realname) { ?><%address.realname%><?php  } ?>" /></div>
        <div class="line"><input type="text" placeholder="联系电话"  id="mobile" value="<?php  if(address.mobile) { ?><%address.mobile%><?php  } ?>"/></div>
        
        <div class="line"><select id="sel-provance" onchange="selectCity();" class="select"><option value="" selected="true">所在省份</option></select></div>
        <div class="line"><select id="sel-city" onchange="selectcounty()" class="select"><option value="" selected="true">所在城市</option></select></div>
        <div class="line"><select id="sel-area" class="select"><option value="" selected="true">所在地区</option></select></div>
       
        <div class="line"><input type="text" placeholder="详细地址(不包含省份城市区域)"  id="address" value="<?php  if(address.address) { ?><%address.address%><?php  } ?>"/></div>
<!--        <div class="line"><input type="text" placeholder="邮政编码"  id="zipcode" value="<?php  if(address.zipcode) { ?><%address.zipcode%><?php  } ?>"/></div>-->

        <div class="address_sub1">确认</div>
        <div class="address_sub2">取消</div>
    </div>
</script>

<script id='tpl_carrier_list' type='text/html'>
    <div class="chooser choose_carrier">
        <%each carrier_list as carrier index%>
        <div class="address carrier"
             data-index='<%index%>'
             data-realname='<%carrier.storename%>'
             data-mobile='<%carrier.tel%>'
             data-address='<%carrier.address%>' 
             >
            <div class="ico" ><%if selectedCarrierIndex==index%><i class="fa fa-check" style="color:#0c9"></i><%/if%></div>
            <div class="info">
                <div class='inner'>
                    <div class="name"><%carrier.storename%>(<%carrier.tel%>)</div>
                    <div class="addr"><%carrier.address%></div>
                </div>
            </div>
        </div>
        <%/each%>
    </div>
</script>


<script id='tpl_dispatch_list' type='text/html'>
    <div class="chooser choose_dispatch">
        <%each dispatch_list as d%>
        <%if d.dispatchtype==0%>
        <div class="address dispatch"   
             data-dispatchid='<%d.id%>'
             data-dispatchname='<%d.dispatchname%>'
             data-price='<%d.price%>'

             >
            <div class="ico" ><%if selectedDispatchID==d.id%><i class="fa fa-check" style="color:#0c9"></i><%/if%></div>
            <div class="info" >
              
                <div class='inner'>
                      <div class="name" style='padding-top:10px;'><%d.dispatchname%></div>
                </div>    
                
            </div>
            <div class="ico"><i class='fa fa-angle-right'></i></div>
        </div>
        <%/if%>
        <%/each%>
    </div>
</script>


<script id='tpl_confirm_info' type='text/html'>
 <div class="page_topbar" >
     <a href="javascript:;" onclick="history.back()" class="back"  style="color: #fff;text-align:center;"><i class="fa fa-angle-left"></i></a>
    <div class="title" style="color: #fff;text-align:center;">确认订单</div>
</div>
    <input type="hidden"  id="isverify" value="<%if isverify || isvirtual || goods.type==2%>true<%else%>false<%/if%>" />
    <%if isverify || isvirtual || goods.type==2%>
     <input type="hidden"  id="dispatchtype" value="0" />
      <div class="carrier_input_info" >
            <div class="row">
                <div class='title'>联系人姓名</div>
                <div class='info'>
                        <div class='inner'><input type="text" placeholder="联系人姓名" id="carrier_input_realname" value="<%member.realname%>" style='height:35px;'/></div>
                </div>
            </div>
            <div class="row">
                <div class='title'>联系人手机</div>
                <div class='info'>
                      <div class='inner'><input type="text" placeholder="联系人手机"  id="carrier_input_mobile" value="<%member.mobile%>" style='height:35px;'/></div>
                </div>
            </div>
    </div>
    <%else%>
    <input type="hidden"  id="dispatchtype" value="0" />
    <%if carrier_list.length>0%>
    <div class="addorder_nav">
        <div class="nav selected" data-nav='0'>快递配送</div>
        <div class="nav"  data-nav='1'>上门自提</div>
    </div>
    <%/if%>
    <div class="addorder_user addorder_user_0">
        <input type='hidden' id='addressid' value='<%address.id%>' />
        <div class="info" id='address_select' <%if !address %>style='display:none'<%/if%>>
             <div class="ico"><i class="fa fa-map-marker"></i></div>
             <div class='info1'>
                 <div class='inner'>
                        <div class="user">收件人：<span id='address_realname'><%address.realname%></span>(<span id='address_mobile'><%address.mobile%></span>)</div>
                        <div class="address"><span id='address_address'><%address.address%></span></div>
                 </div>
             </div>
             <div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
        </div>
        <div class='info' id='address_new'  <%if address %>style='display:none'<%/if%>>
            <div class="ico"><i class="fa fa-plus-circle"></i></div>
            <div class='info1'>
                 <div class='inner'>
                     <div class="user" style='padding-top:8px;'>新增地址</div>  
                 </div>
            </div>
            <div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
        </div>
      
    </div>
    <%if carrier%>
    <div class="addorder_user addorder_user_1" style='display:none'>
        <input type='hidden' id='carrierindex' value='0' />
        <div class="info" id='carrier_select' >
            <div class="ico"><i class="fa fa-map-marker"></i></div>
            <div class='info1'>
                 <div class='inner'>
                     <div class="user">自提地点：<span id='carrier_realname'><%carrier.storename%></span>(<span id='carrier_mobile'><%carrier.tel%></span>)</div>
                     <div class="address"><span id='carrier_address'><%carrier.address%></span></div>
                 </div>
            </div>
            <div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
        </div>
      
    </div>
    <%/if%>
    <div class="carrier_input_info" style='display:none' >
            <div class="row">
                <div class='title'>提货人姓名</div>
                <div class='info'>
                        <div class='inner'><input type="text" placeholder="提货人姓名" id="carrier_input_realname" value="<%member.realname%>" style='height:35px;'/></div>
                </div>
            </div>
            <div class="row">
                <div class='title'>提货人手机</div>
                <div class='info'>
                      <div class='inner'><input type="text" placeholder="提货人手机"  id="carrier_input_mobile" value="<%member.mobile%>" style='height:35px;'/></div>
                </div>
            </div>
    </div>
 

    <%if dispatch%>
    <div class="addorder_exp" id='dispatch_select' >
        <input type='hidden' id='dispatchid' value='<%dispatch.id%>' />
        <div class="t1">配送方式</div>
        <div class="ico"><i class='fa fa-angle-right fa-2x'></i></div>
        <div class="t2"><span class='dispatchname'><%dispatch.dispatchname%></span> <span class='dispatchprice'><%dispatch.price%></span>元</div>
    </div>
    <%/if%>
    
    <%/if%>

    <div class="addorder_good">
        
        <%each goods as g%>
        <div class="good" data-totalmaxbuy="<%g.totalmaxbuy%>">
            
            <div class="img"  onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'"><img src="<%g.thumb%>"/></div>
            <div class='info' onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'">
                <div class='inner'>
                       <div class="name">
                           <%if g.isnodiscount=='0' && haslevel%><span style='color:red'>[折扣]</span><%/if%>
                           <%g.title%></div>     
                       <div class='option'><%if g.optionid!='0'%>规格:  <%g.optiontitle%><%/if%></div>
                </div>
            </div>
            <div class="price">
                <div class='pnum'>￥<span class='marketprice'><%g.marketprice%></span></div>
                <%if changenum%>
                <div class="cnum"><div class="leftnav">-</div><input type="text" class="shownum" value="<%g.total%>" /><div class="rightnav">+</div></div>
                <%else%>
                <div class='pnum'><span class='total'>×<%g.total%></span></div>
                <%/if%>
            </div>
        </div>
        <%/each%>
        <input type="hidden" id="goods" value="<%each goods as g%><%g.goodsid%>,<%g.optionid%>,<%g.total%>|<%/each%>"/>
        <input type="text" id="remark" placeholder="给卖家留言" />
        <div class="text">共 <span id="goodscount"><%total%></span> 件商品 合计：<span style="color:#ff771b;">￥<span class='goodsprice' style="color:#ff771b;"><%goodsprice%></span></span></div>
    </div>
    <div class="addorder_price" >
        <input type="hidden" id="weight" value="<%weight%>" />
        <div class="price" style="border:none;">
            <div class="line" style="line-height:26px;">商品金额<span>￥<span class='goodsprice'><%goodsprice%></span></span></div>
           
            <div class="line" style="line-height:26px;">+运费<span>￥<span class='dispatchprice'><%dispatchprice%></span></span></div>
            <%if discountprice>0%>
            <div class="line" style="line-height:26px;">-会员折扣(<d class='memberdiscount'><%discount%></d>折)<span>-￥<span class='discountprice'><%discountprice%></span></span></div>
            <%/if%>
		
						
            <%if saleset.showenough %>
            <div class="line" style="line-height:26px;">-单笔满 <d style='color:#ff6600'><%saleset.enoughmoney%></d> 元立减  <span>-￥<span id="deductenough_money"><%saleset.enoughdeduct%></span><span></div>
            <%/if%>
				<?php  if($hascoupon_p) { ?>
            
			<div id="coupondeduct_div" class="line" style="line-height:26px;display:none"><d id='coupondeduct_text'></d><span>-￥<span id="coupondeduct_money">0</span><span></div>
				   <?php  } ?>
            
        </div>
    </div>
	<input type="hidden" id="couponid" value="" />
	 
	 
     <div id="coupondiv" class="addorder_price" style="margin-top:5px;<%if !hascoupon%>display:none<%/if%>" >
            <div class="price" style="border:none;">
          
          <div class="line" style="line-height:32px;" id="selectcoupon">
			  <d id="couponselect">我要使用优惠券</d>
                                <div class="ico2" style="float:right;color:#999;margin-top:2px;"><i class='fa fa-angle-right fa-2x'></i></div>
                                <div class="couponcount"><%couponcount%></div>
            </div>
 
            
        </div>
      
    </div>
   
	
    <%if deductcredit>0 %>
     <div class="addorder_price" style="margin-top:5px;">
            <div class="price" style="border:none;">
            <%if deductcredit>0 %>
            <div class="line" style="line-height:26px;"><%deductcredit%> 积分可抵扣 <d style='color:#ff6600'><%deductmoney%></d> 元
                <div id='deductcredit' class="nav" on="0" credit="<%deductcredit%>" money='<%deductmoney%>'><nav></nav></div>
            </div>
            <%/if%>
	 
        </div>
      
    </div>
    <%/if%>
	
    <div class="addorder_pay">
        <div class="paysub">确认订单</div>
        <span>需付：￥<t class='totalprice'><%realprice%></t>元</span>
    </div> 
</script>
<?php  if($hascoupon_p) { ?>
<?php include $this->template('coupon/chooser',false);?>
<?php  } ?>
<script type="text/javascript">
var fromcart = 0;
  



        core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'confirm','m'=>'eshop'))?>", {id:'<?php  echo intval($_GPC['id'])?>', optionid:'<?php  echo intval($_GPC['optionid'])?>', total:'<?php  echo intval($_GPC['total'])?>',cartids:"<?php  echo $_GPC['cartids'];?>"}, function(json){

        if(json.status==-1){
            location.href=json.result.url;
            return;
        }
        $('#confirm_container').html(tpl('tpl_confirm_info', json.result));

           $('.leftnav').click(function(){
                var input =$(this).next();
                if(!input.isInt()){
                    input.val('1');
                }
                var num = parseFloat( input.val() );
                num--;
                if(num<=0){
                    num=1;
                }
                input.val(num);
                    $('#goodscount').html(num);
                marketprice = parseFloat( $(this).closest('.good').find('.marketprice').html().replace(",","") ) * num;
                $('.goodsprice').html( marketprice.toFixed(2) );
                if( $('.memberdiscount').length>0){
                                var discountprice = marketprice - parseFloat( $('.memberdiscount').html().replace(",","") ) / 10 * marketprice;
                $('.discountprice').html( discountprice.toFixed(2) );
            }
                var zt =  $('.addorder_nav .selected').data('nav') =='1';
                getDispatchPrice(zt);
                
            })
            
             $('.rightnav').click(function(){
                var maxbuy = parseInt( $(this).closest('.good').data('totalmaxbuy'));
             
                var input =$(this).prev();
                if(!input.isInt()){
                    input.val('1');
                } 
                var num = parseInt( input.val() );
                num++;
               
                if(num>maxbuy ){
                    num=maxbuy;
                    tip_show("您最多购买 " + maxbuy + " 件");
                }
                input.val(num);
                $('#goodscount').html(num);
                var marketprice = parseFloat( $(this).closest('.good').find('.marketprice').html().replace(",","") ) * num;
                $('.goodsprice').html( marketprice.toFixed(2) );
                     if( $('.memberdiscount').length>0){
                var discountprice = marketprice - parseFloat( $('.memberdiscount').html().replace(",","") ) / 10 * marketprice;
                $('.discountprice').html( discountprice.toFixed(2) );
                     }
               var zt =  $('.addorder_nav .selected').data('nav') =='1';
                getDispatchPrice(zt);
              
            });
            
     $('.shownum').blur(function(){
               
               var maxbuy = parseInt( $(this).closest('.good').data('totalmaxbuy'));
           
                var input =$(this);
                if(!input.isInt()){
                    input.val('1');
                    return;
                }
                if(parseInt(input.val())<0){
                    input.val('1');
                    return;
                }
                var num = parseInt( input.val() );
            
               
               if(num>maxbuy ){
                    num=maxbuy;
                    tip_show("您最多购买 " + maxbuy + " 件");
                }
                input.val(num);
                $('#goodscount').html(num);
                   marketprice = parseFloat( $(this).closest('.good').find('.marketprice').html().replace(",","") ) * num;
                $('.goodsprice').html( marketprice.toFixed(2) );
                     if( $('.memberdiscount').length>0){
                var discountprice = marketprice - parseFloat( $('.memberdiscount').html().replace(",","") ) / 10 * marketprice;
                $('.discountprice').html( discountprice.toFixed(2) );
                     }
          
               var zt =  $('.addorder_nav .selected').data('nav') =='1';
                getDispatchPrice(zt);
               
           })
        fromcart = json.result.fromcart;
        
 
        if (json.result.carrier_list.length > 0) {
             
            //选择快递或字提
            $('.addorder_nav .nav').click(function() {
                var nav = $(this).data('nav');
                $('.addorder_nav .nav').removeClass('selected');
                $(this).addClass('selected');
                $('.addorder_user').hide();
                $('.addorder_user_' + nav).show();
                if (nav == '1') {
                    $('.carrier_input_info').show();
                    $('.addorder_exp').hide();
                    getDispatchPrice(true);
                }
                else {
                    $('.carrier_input_info').hide();
                    $('.addorder_exp').show();
                    getDispatchPrice();
                }
                $('#dispatchtype').val(nav);
            });
            //选择自提
            $('#carrier_select').click(function() {
                json.result.selectedCarrierIndex = $("#carrierindex").val();

                $('#carrier_container').html(tpl('tpl_carrier_list', json.result));
                $(".chooser").height($(document.body).height());
                $(".choose_carrier").animate({right: "0px"}, 200);
                $('.carrier').click(function() {
                    var obj = $(this);
                    $("#carrierindex").val(obj.data('index'));
                    $("#carrier_realname").html(obj.data('realname'));
                    $("#carrier_mobile").html(obj.data('mobile'));
                    $("#carrier_address").html(obj.data('address'));
                    $(".choose_carrier").animate({right: "-100%"}, 100);
                })
            })
        }

        //选择地址 
        $('#address_select').click(function() {

            core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'address','m'=>'eshop'))?>", {}, function(addresslist_json) {
                //默认地址
                addresslist_json.result.selectedAdressID = $("#addressid").val();

                $('#address_container').html(tpl('tpl_address_list', addresslist_json.result));
                $('.address .ico,.address .info').click(function() {
                    var $this = $(this).parent();
                    $("#addressid").val($this.data('addressid'));
                    $("#address_realname").html($this.data('realname'));
                    $("#address_mobile").html($this.data('mobile'));
                    $("#address_address").html($this.data('address'));
                    $(".choose_address").animate({right: "-100%"}, 200);
                    //重新获取运费
                    getDispatchPrice();
                });
                //地址编辑
                $('.address .edit').click(function() {
                    var addressid = $(this).parent().data('addressid');
                    core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'address','m'=>'eshop'))?>", {op: 'get', id: addressid}, function(getaddress_json) {
                        $('#address_container').html(tpl('tpl_address_new', getaddress_json.result));
                        $(".chooser").height($(document.body).height());
                        $(".address_main").animate({right: "0px"}, 200);
                        var address = getaddress_json.result.address;
                        cascdeInit(address.province, address.city, address.area);
                        $('.address_sub2').click(function() {
                            $(".address_main").animate({right: "-100%"}, 200);
                        });
                        $('.address_sub1').click(function() {
                            saveAddress($(this));
                        });

                    }, true);
                })
				$(".chooser").height($(document.body).height());
                $(".choose_address").animate({right: "0px"}, 200);
                $('.add_address').click(function() {
                    addAddress($(this));
                })
            }, true);

        });


        //保存地址
        function saveAddress(obj) {
            if (obj.attr('saving') == '1') {
                return;
            }

            if ($('#realname').isEmpty()) {
                tip_show('请输入收件人!');
                return;
            }
            if (!$('#mobile').isMobile()) {
                tip_show('请输入正确的联系电话!');
                return;
            }
	   if($('#sel-provance').val()=='请选择省份'){
                    tip_show('请选择省份!');
                    return;
                }
	       if($('#sel-city').val()=='请选择城市'){
                    tip_show('请选择城市!');
                    return;
                }
		  if($('#sel-area').val()=='请选择地区'){
                    tip_show('请选择地区!');
                    return;
                }
            if ($('#address').isEmpty()) {
                tip_show('请输入详细地址!');
                return;
            }
            $('.address_sub1').html('正在处理...').attr('disabled', true);
            obj.attr('saving', '1');
            core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'address','m'=>'eshop'))?>", {
                op: 'submit',
                id: $('#edit_addressid').val(),
                addressdata: {
                    realname: $('#realname').val(),
                    mobile: $('#mobile').val(),
                    address: $('#address').val(),
                    province: $('#sel-provance').val(),
                    city: $('#sel-city').val(),
                    area: $('#sel-area').val(),
                 //   zipcode: $('#zipcode').val(),
                }
            }, function(saveaddress_json) {
                if (saveaddress_json.status == 1) {
                    $("#addressid").val(saveaddress_json.result.addressid);
                    $("#address_realname").html($('#realname').val());
                    $("#address_mobile").html($('#mobile').val());
                    $("#address_address").html($('#address').val());
                    $("#address_select").show();
                    $(".address_main").animate({right: "-100%"}, 200);
                    $('#address_new').hide();
                    getDispatchPrice();
                }
                else {
                    tip_show('保存失败,请重试');
                }
                obj.removeAttr('saving');
            }, true);

        }
        function getDispatchPrice(zt) {
            if(zt){
                  $('.dispatchprice').html('0.00');
                  calctotalprice();
                  return;
            }
            
            var goodsprice = parseFloat($('.goodsprice').html().replace(',',''));
            var discountprice =0;
            if($('.discountprice').length>0){
                 discountprice = parseFloat($(".discountprice").html().replace(',',''));
            }
            totalprice = goodsprice - discountprice;
            //重新获取运费
            var weight = $('#weight').val();

            if( $('.shownum').length>0){
                weight = parseInt(weight) * parseInt($('.shownum').val());
                totalprice = parseFloat( $('.marketprice').html() ) * parseInt($('.shownum').val());
                var goodsinfo = $('#goods').val().split('|')[0];
                var goods = goodsinfo.split(',');
                var goodsid = goods[0];
                var optionid = goods[1];
                var num = parseInt( $('.shownum').val());
                $('#goods').val(goodsid + "," + optionid +"," + num + '|');
            }
           
            core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'confirm','m'=>'eshop'))?>", {
                op: 'getdispatchprice',
                totalprice:totalprice,
                addressid: $('#addressid').val(),
                dispatchid: $('#dispatchid').val(),
                weight: weight,
	      goods: $('#goods').val()
            }, function(getjson) {
                if (getjson.status == 1) {
                    $('.dispatchprice').html(getjson.result.price);
					if(getjson.result.hascoupon){
						$('#coupondiv').show();
						$('#coupondiv .couponcount').html(getjson.result.couponcount);
						bindCouponEvents();
					}else{
						$('#couponid').val('');
						$('#couponselect').html('我要使用优惠券');
						$('#coupondiv').hide();
					}
                    calctotalprice();
                       if( $('.shownum').length>0){

					var goodsinfo = $('#goods').val().split('|')[0];
					var goods = goodsinfo.split(',');
					var goodsid = goods[0];
					var optionid = goods[1];
					var num = parseInt( $('.shownum').val());
					$('#goods').val(goodsid + "," + optionid +"," + num + '|');
				}
                   
                }
            }, false);
        }
        //新增地址
        function addAddress(obj) {

            core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'address','m'=>'eshop'))?>", {'op': 'new'}, function(addaddress_json) {

                var result = addaddress_json.result;
                $('#address_container').html(tpl('tpl_address_new', result));
                cascdeInit(result.address.province,result.address.city);
                          <?php  if($set_weixin['weixin_shareaddress']=='1'&&is_use_weixin()) {$weixin_share_address_show=true; ?>
                   wx.openAddress({
              success: function (res) {
               $("#realname").val( res.userName  );
                                            $('#mobile').val( res.telNumber );
                                            $('#address').val( res.detailInfo );
                                                     cascdeInit(res.provinceName,res.cityName,res.countryName);
              }
            });
      
                            <?php  } ?>
					$(".chooser").height($(document.body).height());
                $(".address_main").animate({right: "0px"}, 200); 
                $('.address_sub2').click(function() {
                    $(".address_main").animate({right: "-100%"}, 200);
                });
                $('.address_sub1').click(function() {
                    saveAddress($(this));
                });

            }, false);
        }

        $('#address_new').click(function() {
            addAddress($(this));
        });

        //计算总价
        function calctotalprice() {
            var goodsprice = parseFloat($('.goodsprice').html().replace(',',''));
            var dispatchprice = parseFloat($(".dispatchprice").html().replace(',',''));
            
            var discountprice =0;
            if($('.discountprice').length>0){
                 discountprice = parseFloat($(".discountprice").html().replace(',',''));
            }
	  var totalprice = goodsprice  - discountprice;
             var enoughprice =0;
            if($("#deductenough_money").length>0){
                 enoughprice = parseFloat($("#deductenough_money").html().replace(',',''));
            }
	   <?php  if($hascoupon_p) { ?>
	       totalprice = calcCouponPrice(totalprice);
	   <?php  } ?>
            totalprice = totalprice - enoughprice  + dispatchprice;
        
            var deductprice = 0;
            if($("#deductcredit").length>0){
                if($("#deductcredit").attr('on')=='1'){
                    deductprice = parseFloat( $("#deductcredit").attr('money').replace(',','') )
                 
              
                   
                } 
            }   
    
    
            totalprice = totalprice - deductprice;
            if(totalprice<=0){ 
                totalprice = 0;
            }
         
            
            $('.totalprice').html(totalprice.toFixed(2));
            return totalprice;
        }
        //选择快递
        $('#dispatch_select').click(function() {

            json.result.selectedDispatchID = $("#dispatchid").val();
            $('#dispatch_container').html(tpl('tpl_dispatch_list', json.result));
			$(".chooser").height($(document.body).height());
            $(".choose_dispatch").animate({right: "0px"}, 200);
            $('.dispatch').click(function() {
                var obj = $(this);
                $("#dispatchid").val(obj.data('dispatchid'));
                $(".dispatchname").html(obj.data('dispatchname'));
                $(".chooser").animate({right: "-100%"}, 100);
                //重新获取运费
                getDispatchPrice();

            })
        });

        //订单
        $('.paysub').click(function() {
            if ($(this).attr('submitting') == '1') {
                return;
            }
            var dispatchid = $("#dispatchid").val();
            var addressid = $("#addressid").val();
            var goods = $("#goods").val();
            var carrier_realname = $.trim( $('#carrier_input_realname').val() );
            var carrier_mobile = $.trim( $('#carrier_input_mobile').val() );
            if (goods == '') {
                tip_show("没有任何商品");
                return;
            }
            if( $("#dispatchtype").val()=='0'){
                   if (addressid == '') {
                        tip_show("请选择地址");
                        return;
                    }
                    if (dispatchid == '') {
                        tip_show("请选择配送方式");
                        return;
                    }
            } 
             if($('#isverify').val()=='true'){
                if (carrier_realname== '') {
                     tip_show("请填写联系人姓名");
                     return;
                 }
                  if (!$.isMobile(carrier_mobile)) {
                        tip_show("请填写正确手机号");
                        return;
                  }
             }
               if( $("#dispatchtype").val()=='1'){
                    if (carrier_realname== '') {
                        tip_show("请填写姓名");
                        return;
                    }
                    if (!$.isMobile(carrier_mobile)) {
                        tip_show("请填写正确手机号");
                        return;
                    }
                }
           
            $(this).attr('submitting', '1').html('提交中...');
            var data ={
                'op': 'create',
                'goods': goods,
                'dispatchtype': $("#dispatchtype").val(),
                'fromcart':fromcart,
                'cartids':"<?php  echo $_GPC['cartids'];?>",
                'remark': $("#remark").val(),
                'deduct':0,
                'deduct2':0
            };
        
             if( $("#dispatchtype").val()=='0'){
            
                 data.addressid = addressid; 
                 data.dispatchid = dispatchid;
             }
             
             if( $("#dispatchtype").val()=='1' || $('#isverify').val()=='true'){
                data.carrier = {
                    'carrier_realname': carrier_realname,
                    'carrier_mobile':carrier_mobile,
                    'realname': $('#carrier_realname').html(),
                    'mobile': $('#carrier_mobile').html(),
                    'address': $('#carrier_address').html()
                };
            }
            
            if($("#deductcredit").length>0){
                if($("#deductcredit").attr('on')=='1'){
                      data.deduct = 1;       
                }
            }
             
         
	   <?php  if($hascoupon_p) { ?>
		data.couponid = $('#couponid').val();
	  <?php  } ?>
	  
            core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'confirm','m'=>'eshop'))?>", data, function(create_json) {

                if (create_json.status == 1) {
                    location.href = "<?php  echo $this->createMobileUrl('order/pay')?>&orderid=" + create_json.result.orderid +"&openid=<?php  echo $openid;?>";
                }  else if (create_json.status == -1) {
                     $('.paysub').html('确认订单').removeAttr('submitting');
                     tip_show(create_json.result);
                }
                else {
                    $('.paysub').html('确认订单').removeAttr('submitting');
                    tip_show("生成订单失败!")
                }

            }, true);
        })
        
        //积分抵扣
        $('#deductcredit').click(function(){
               var on = $(this).attr('on')=='0'?'1':'0';
               $(this).attr('on',on);
               if(on=='1'){
                     $(this).addClass('on').find('nav').addClass('on');
               }
               else{
                     $(this).removeClass('on').find('nav').removeClass('on');
               } 
               calctotalprice();
        });
  
       <?php  if($hascoupon_p) { ?>
            bindCouponEvents();
            function calcCouponPrice(totalprice){
	  
	       $('#coupondeduct_div').hide();
	       $('#coupondeduct_text').html('');
	       $('#coupondeduct_money').html('0');
	       if($('#couponid').val()=='' ||  $('#couponid').val()=='0')   {
			  return totalprice;
	       }
	       var deduct   = parseFloat( $('#couponselect').data('deduct') );
                 var discount = parseFloat( $('#couponselect').data('discount') );
                 var backtype = parseFloat( $('#couponselect').data('backtype') );
	     
	       var deductprice = 0;
	       if(deduct>0 && backtype==0){ //抵扣
		   if(deduct>totalprice){
			   deduct=totalprice;
		   }
		   if(deduct<=0){
			   deduct = 0;
		   }
 		   deductprice = deduct;
		   totalprice-=deduct;
		   $('#coupondeduct_text').html('-优惠券优惠');
	      }else if(discount>0 && backtype==1){//打折
			  
		   deductprice = totalprice *  (1 - discount/10 );
		   if(deductprice>totalprice){
			   deductprice=totalprice;
		   }
		  if(deductprice<=0){
			   deductprice = 0;
		   }
    		   totalprice-=deductprice;		
		   $('#coupondeduct_text').html('-优惠券折扣(' + discount + '折)');
	        }
	       if(deductprice>0){
		 $('#coupondeduct_div').show();
	          $('#coupondeduct_money').html(deductprice.toFixed(2));	
	       }
	      return totalprice;
				
            }
            function bindCouponEvents(){
				$('#selectcoupon').click( function(){
                                              
                                             var money =parseFloat( $('.totalprice').html().replace(",","") ) ;	
                                             
 				     core_json("<?php echo 	create_url('mobile',array('do'=>'coupon','act'=>'util','m'=>'eshop'))?>", {op: 'query', money: money, type:0}, function (rjson) {
							if (rjson.status != 1) {
								tip_show(rjson.result);
								$('#couponid').val('');
								calctotalprice(); 
								return;
							}
							if(rjson.result.coupons.length>0){
								CouponChooser.cancelCallback = function(){
									
									$('#coupondeduct_div').hide();
									$('#coupondeduct_text').html('');
									$('#coupondeduct_money').html('0');
									calctotalprice();
									 
								}
								CouponChooser.confirmCallback = function(){
									calctotalprice();
								}
								CouponChooser.open( rjson.result );
								
							}
						}, false);
				});
		}
			
       <?php  } ?>
						  
       
    }, false);

</script>
<?php include page('footer_base');?>