<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
    .verify {position:relative;}
    .verify .close { color:#fff;position:absolute;top:10px;right:10px;}
    .verify img { width:250px;height:250px; position:absolute; top:100px; left:50%;margin-left:-125px;}
    .verify .text {position:absolute;width:250px; top: 360px; color:#fff; color:#fff; font-size:16px;left:50%;margin-left:-125px;text-align:center;}
    .verify .btn {position:absolute;padding:5px;width:220px; left:50%;margin-left:-110px; top: 420px;   height:30px;  background:#f49c06; border-radius:4px; text-align:center; font-size:14px; line-height:30px; color:#fff;}
    
    .verify .title {position:absolute;width:250px; top: 100px; color:#f49c06; ;left:50%;margin-left:-125px;text-align: center;font-size:32px;}
    .verify .code {position:absolute; top: 200px;width:100%;color:#fff;text-align: center;font-size:34px;}
    .verify .tip{position:absolute;width:250px; top: 300px; color:#fff;  font-size:16px;left:50%;margin-left:-125px;text-align: center;}
</style>
<div id='cover' >
    <div class="verify">
        <div class="close" onclick='VerifyHandler.close()'><i class="fa fa-close fa-2x"></i></div>
        <div class="verify_qrcode" >
            <img src="<?php  echo WEBSITE_ROOT;?>/assets/eshop/static/mobile/static/images/qrloading.jpg" />
            <div class="text">请将此二维码出示给店员</div>
            <div class="btn" onclick=" $('.verify_qrcode').hide();$('.verify_verifycode').show();">无法扫描？</div>
        </div>
        <div class="verify_verifycode"  style="display:none">
            <div class="title">订单消费码</div>
            <div class="code" id="verifycode"></div>
            <div class="tip">请将消费码出示给店员</div>
             <div class="btn" onclick=" $('.verify_qrcode').show();$('.verify_verifycode').hide();">返回二维码</div>
        </div>
    </div>
</div>
<script language='javascript'>
     
    var VerifyHandler = {
         verifytimer: 0,
         verify:function(orderid){
       
                       $('#cover').show();

                       core_json('<?php echo 	create_url('mobile',array('do'=>'verify','act'=>'qrcode','m'=>'eshop'))?>',{id:orderid},function(json){
                             if(json.status==0){
                                 tip_show(json.result);
                                 return;
                             }
                             $('#cover').find('img').attr('src',json.result.qrcode);
                             $('#verifycode').html( json.result.verifycode);
                             VerifyHandler.verifytimer = setInterval(function(){
                                 VerifyHandler.check(orderid);
                             },1000);
                       },true,true); 
           
         },check:function(orderid){
             
             
                core_json('<?php echo 	create_url('mobile',array('do'=>'verify','act'=>'check','m'=>'eshop'))?>',{id:orderid},function(json){
                      if(json.status==0){
                          return; 
                      }
                      clearInterval( VerifyHandler.verifytimer);
                      tip_message('扫描核销完成!',"<?php  echo $this->createMobileUrl('order/detail',array('id'=>$_GPC['id']))?>",'success');
                },false,true);
     
         },close:function(){
            clearInterval(this.verifytimer);
            $('.verify_qrcode').show();
            $('.verify_verifycode').hide();
            $('#cover').hide();
         }
    }
</script>