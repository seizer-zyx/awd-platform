<?php defined('IN_IA') or exit('Access Denied');exit;?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>成为分销商</title>
<style type="text/css">
body {<?php if(is_mobile()){?>margin:0px;<?php }?>font-family:'微软雅黑'; background:#f4f4f4;}
.top {overflow:hidden}
.top img { width:100%;}
a{ text-decoration: none;}
.main { padding:5px 12px;}
.main .text {height:20px; font-size:14px; line-height:20px; color:#666;}
.main .text span {color:#f6914b;}

.main .text1 {padding:5px; font-size:14px; line-height:20px; color:#666;}
.main .text1 span {color:#f6914b;}


.main .input {height:36px; margin:14px 10px 0 0;background:#fff;border-radius:5px;}
.main .input input {width:100%;  height:36px; border:0px; outline:none; font-size:15px; color:#999;}

.main .sub {height:40px; background:#e53c39; margin-top:14px; border-radius:5px; text-align:center; line-height:40px; color:#fff; font-size:16px;}
.main .title {height:30px; margin-top:20px; font-size:12px; line-height:30px; color:#666;}
.vip_main {height:62px; background:#fff; border-radius:4px;}
.vip_main .vip {height:36px; padding:12px; border-bottom:1px solid #f1f1f1; overflow:hidden; font-size:12px; color:#999;}
.vip_main .vip .ico1 {height:36px; width:36px; background:#32cd32; border-radius:18px; color:#fff; font-size:20px; line-height:36px; text-align:center; float:left;}
.vip_main .vip .ico2 {height:36px; width:36px; background:#fece00; border-radius:18px; color:#fff; font-size:22px; line-height:40px; text-align:center; float:left;}
.vip_main .vip .text {height:36px; margin-left:12px; float:left;}
.vip_main .vip .text .t1 {height:18px; font-size:15px; color:#666; line-height:18px;}
.vip_main .vip .text .t2 {height:18px; font-size:13px; color:#999; line-height:18px;}


.ok {height:200px; padding-top:65px;}
.ok .ico {height:65px; width:65px; margin:auto; border:3px solid #32cd32; border-radius:55px; color:#32cd32; font-size:50px; text-align:center; line-height:65px;}
.ok .text {height:20px; margin-top:30px; font-size:16px; color:#666; line-height:20px; text-align:center;}
.ok .sub {height:32px; width:145px; background:#e53c39; margin:20px auto; border-radius:20px; color:#fff; line-height:32px; text-align:center; font-size:16px;}


</style>

<div id='container'></div>
<script id='tpl_main' type='text/html'>
	<div class="top">
        <img src="<?php  echo WEBSITE_ROOT;?>assets/eshop/static/mobile/static/commission/images/bg.png" />
        </div>
 
	<div class="main">
                   <%if status==0%>
	<div class="text">欢迎加入<span><%shop_set.name%></span>，请填写申请信息</div>
	<div class="text">邀请人：<span><%if agent%><%agent.nickname%><%else%>总店<%/if%></span> (请核对)</div>
	<div class="input"><input type="text" id='realname' placeholder="请填写真实姓名，用于结算" value="<?php  echo $member['realname'];?>" /></div>
	<div class="input"><input type="text" id='mobile' placeholder="请填写手机号码方便联系"  value="<?php  echo $member['mobile'];?>"/></div>
	<div class="input"><input type="text" id='weixin' placeholder="请填写微信号"  value="<?php  echo $member['weixin'];?>"/></div>
	<div class="sub" id="submit">申请成为分销商</div>
                   <%/if%>
                   <%if status==1%>
	<div class="text1">本店累计消费满 <span><%ordercount%></span> 次，
                       才可成为&lt;<%shop_set.name%>&gt;购物中心分销商，您已消费 <span><%order%></span> 次，请继续努力！</div>
                  <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/list')?>'"><i class='fa fa-shopping-cart'></i> 继续去购物</div>
                   <%/if%>
                   <%if status==2%>
                   <div class="text1">本店累计消费满 <span><%moneycount%></span> 元，
                       才可成为&lt;<%shop_set.name%>&gt;购物中心分销商，您已消费 <span><%money%></span> 元，请继续努力！</div>
	   <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/list')?>'"><i class='fa fa-shopping-cart'></i> 继续去购物</div>
                   <%/if%>
                     <%if status==3%>
                   <div class="text1">本店需购买商品【<%goods.title%>】才可成为&lt;<%shop_set.name%>&gt;购物中心分销商，请现在去购买吧！</div>
	   <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%goods.id%>'"><i class='fa fa-shopping-cart'></i> 现在就去购买</div>
                   <%/if%>
        
		<div class="vip_main">
        	
            <div class="vip">
            	<div class="ico2"><i class="fa fa-cny"></i></div>
                <div class="text"><div class="t1">销售分红</div><div class="t2">成为分销员后，您可以享受平台营业额的分红收益</div></div>
            </div>
        </div>
</div>
</script>
<script id="tpl_ok" type="text/html">

    <div class="ok">
    <div class="ico"><i class="fa fa-check"></i></div>
      <%if member.status=='1'%>
        <div class="text">您的申请已经审核通过！</div>
       <a href="<?php  echo $this->createMobileUrl('shop')?>"><div class="sub">去商城逛逛</div></a>
      <%else%>
      <%if member.agentblack=='0'%>
         <div class="text">您的申请已经提交，请等待审核！</div>
         <%else%>
          <div class="text">禁止访问，请联系客服！</div>
         <%/if%>
         
         <a href="<?php  echo $this->createMobileUrl('shop')?>"><div class="sub">去商城逛逛</div></a>
       <%/if%>
    </div>
</script>
<script language="javascript">
   
        
        core_json('<?php echo 	create_url('mobile',array('do'=>'commission','act'=>'register','m'=>'eshop'))?>',{mid:"<?php  echo $mid;?>"},function(json){
           var result = json.result;
   
   if(result.status==4){
	     $('#container').html(  tpl('tpl_ok',result) );    
		 return;
   }
  
           if(result.member.isagent=='1'){
               $('#container').html(  tpl('tpl_ok',result) );    
               return;
           }
           $('#container').html(  tpl('tpl_main',result) );
           $('#submit').click(function(){
               if($('#realname').isEmpty()){
                   tip_show('请填写您的姓名!');
                   return;
               }
               if(!$('#mobile').isMobile()){
                   tip_show('请填写正确手机号!');
                   return;
               }
               if($('#weixin').isEmpty()){
                   tip_show('请填写微信号!');
                   return;
               }
               var data = {
                   'agentid':"<?php  echo $_GPC['shareid'];?>",
                   'realname': $('#realname').val(),
                   'mobile': $('#mobile').val(),
                   'weixin': $('#weixin').val()
               };
               core_json('<?php echo 	create_url('mobile',array('do'=>'commission','act'=>'register','m'=>'eshop'))?>',data,function(pjson){
                   var result = pjson.result;
                   if(pjson.status==0){
                       tip_show(pjson.result);
                       return;
                   }
          
                   result.member.status = result.status;
                   $('#container').html(  tpl('tpl_ok',result) );    
                   
               },true,true);
           });
        },false);

</script>
<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?> 