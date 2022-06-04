<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>申请退款</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    .refund_addnav {height:44px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:42px; color:#666; background:#fff;}
    .refund_addnav {height:40px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:40px; color:#666; }
.refund_main {height:auto;width:94%; padding:0px 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; background:#fff;}
.refund_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;}

.refund_main .line .label { float:left;width:70px;}
.refund_main .line .info { float:right; width:100%; margin-left:-75px;text-align: right;overflow:hidden;height:44px;}
.refund_main .line .info .inner { color:#666;margin-left:75px;}

.refund_main .line input {float:left; height:44px; width:100%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
.refund_main .line select  {float:left; border:none;height:25px;width:100%;color:#666;font-size:16px;margin-top:10px;}
.refund_sub1 {height:44px; width:94%; margin:14px 3% 0px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.refund_sub2 {height:44px; width:94%; margin:14px 3% 0px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}

.refund_main .line1 {width:100%;  line-height:25px; color:#666;overflow:hidden; font-size:13px;word-break: break-all;}
</style>
<div id='container'></div>

<script id='refund_edit' type='text/html'>
     <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title"><%if refund%>修改退款申请<%else%>申请退款<%/if%></div>
    </div>
 <div class="refund_main" >
        <input type='hidden' id='refundid' value="<%refund.id%>"/>
        <div class="line">
            <div class="label">退款原因</div>
            <div class="info">
                <div class="inner">
                <select id="reason">
                     <option value="不想要了" <%if refund.reason=='不想要了'%>selected<%/if%>>不想要了</option>
                     <option value="卖家缺货" <%if refund.reason=='卖家缺货'%>selected<%/if%>>卖家缺货</option>
                     <option value="拍错了/订单信息错误" <%if refund.reason=='拍错了/订单信息错误'%>selected<%/if%>>拍错了/订单信息错误</option>
                     
                </select>
                </div>
            </div>
        </div>
        <div class="line"><div class="label">退款金额</div><div class="info"><div class="inner"><input type="text" id="price" value="<%order.refundprice%>" readonly/></div></div></div>
        <div class="line"><div class="label">退款说明</div><div class="info"><div class="inner"><input type="text" id="content" placeholder="选填" value="<%if refund.content%><%refund.content%><%/if%>"/></div></div></div>
        
        <?php  if(!empty($tradeset['refundcontent'])) { ?>
            <div class="line1"><?php  echo $tradeset['refundcontent'];?></div>
        <?php  } ?>
       
   
        
    </div>
    <div class="refund_sub1" id='refund_submit'>确认</div>
</script>

<script id='refund_info' type='text/html'>
  
      <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title">查看退款申请</div>
    </div>
    
    <div class="refund_main" >
        <div class="line">等待商家处理退款申请</div>
        <div class="line1">如果商家同意： 申请将达成，并由商家退款到你账户余额</div>
        <div class="line1">如果商家发货： 申请将关闭，关闭后可以再次发起退款</div>
        <div class="line1">如果商家未处理：请及时与商家联系</div>
    </div>

    <div class="refund_main" >
        <div class="line">协商详情</div>
        <div class="line1">退款类型：仅退款</div>
        <div class="line1">退款原因：<%refund.reason%></div>
        <div class="line1">退款说明：<%refund.content%></div>
        <div class="line1" >申请时间：<%refund.createtime%></div>
    </div>
    
    <div class="refund_sub1" id='refund_change'>修改退款申请</div>
    <div class="refund_sub2"  id='refund_cancel'>取消退款申请</div>
</script>

<script language="javascript">
 
    var orderid = "<?php  echo $_GPC['orderid'];?>";
    
       
           core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{op:'refund',orderid:orderid},function(json){
               
                    if(json.status==0){
                        tip_message(json.result,"<?php  echo $this->createMobileUrl('order')?>",'error');
                        return;
                    }

                    if(json.result.refund){
                         $('#container').html(  tpl('refund_info',json.result) );    
                     
                          $('#refund_change').click(function(){
                                 $('#container').html(  tpl('refund_edit',json.result) );    
                                 bindEdit();
                         });
                   
                         $('#refund_cancel').click(function(){
                                    if($(this).attr('saving')=='1'){
                                        return;
                                    }
                                     $(this).html('正在处理...').attr('saving',1);
                                     core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{
                                         op:'refund',
                                         cancel:'true',
                                         id:$('#refundid').val(),
                                         orderid:orderid 
                                      },function(canceljson){
                                          if(canceljson.status==1){
                                          	
                                              location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'detail','m'=>'eshop'))?>&id="+orderid;
                                          }
                                          else{
                                              $(this).html('取消退款申请').removeAttr('saving');
                                              tip_show(canceljson.result);
                                          }
                                     },true);

                                })
                    }
                    else{
                         $('#container').html(  tpl('refund_edit',json.result) );
                         bindEdit();
                    }
                   function bindEdit(){
                       
                            $('#refund_submit').click(function(){
                               if($(this).attr('saving')=='1'){
                                   return;
                               }
                                $(this).html('正在处理...').attr('saving',1);
                                core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>",{
                                    op:'refund',
                                    id:$('#refundid').val(),
                                    orderid:orderid,
                                    refunddata: {
                                        reason: $('#reason').val(),
                                        content: $('#content').val()
                                    }
                                 },function(postjson){
                                     if(postjson.status==1){
                                     	
                                          location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'detail','m'=>'eshop'))?>&id="+orderid;
                                     }
                                     else{
                                         tip_show(postjson.result);
                                         $(this).html('确认').removeAttr('saving');
                                         
                                     }
                                },true);

                           });
                  }
                   
                   
           },false);

</script>

<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>