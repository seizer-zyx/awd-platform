<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
<form id="setform"  action="" method="post" class="form-horizontal form">
    <div class='panel'>
    
	 <h3 class="custom_page_header"> 通知设置</h3>
        <div class='panel-body'>
 <div class='alert alert-info'>
     默认为全部开启，用户在会员中心可自行设置是否开启, 模板消息自动替换变量
 </div>
               <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">任务处理通知</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="weixin_templateid" class="form-control" value="<?php  echo $set['weixin_templateid'];?>" />
            <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div>
        </div>
    </div>
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为分销商通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_becometitle" class="form-control" value="<?php  echo $set['weixin_commission_becometitle'];?>" />
                    <div class="help-block">标题，默认"成为分销商通知"</div>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_become" class="form-control" ><?php  echo $set['weixin_commission_become'];?></textarea>
                     模板变量: [昵称] [时间]
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">新增下级通知</label>
                <div class="col-sm-9 col-xs-12">
                     <input type="text" name="weixin_commission_agent_newtitle" class="form-control" value="<?php  echo $set['weixin_commission_agent_newtitle'];?>" />
                     <div class="help-block">标题，默认"新增下线通知"</div>
                </div>
            </div>
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12"> 
                    <textarea  name="weixin_commission_agent_new" class="form-control" ><?php  echo $set['weixin_commission_agent_new'];?></textarea>
                    <div class='help-block'>模板变量: [昵称] [时间]</div>
                </div>
            </div>
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">下级付款通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_order_paytitle" class="form-control" value="<?php  echo $set['weixin_commission_order_paytitle'];?>" />
                    <div class="help-block">标题，默认"下级付款通知"</div>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_order_pay" class="form-control" ><?php  echo $set['weixin_commission_order_pay'];?></textarea>
                    	<div class="help-block">模板变量 [昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间]</div>
					<div class="help-block">注意: 此 [佣金金额] ，不代表上级用户会立即获得，为可能获得的佣金金额</div>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">下级确认收货通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_order_finishtitle" class="form-control" value="<?php  echo $set['weixin_commission_order_finishtitle'];?>" />
                    <div class="help-block">标题，默认"下级确认收货通知"</div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_order_finish" class="form-control" ><?php  echo $set['weixin_commission_order_finish'];?></textarea>
					<div class="help-block">模板变量 [昵称] [订单编号] [订单金额] [商品详情] [佣金金额] [时间]</div>
					<div class="help-block">注意: 此 [佣金金额] ，不代表上级用户会立即获得，为可能获得的佣金金额</div>
                </div>
            </div>
 
               <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现申请提交通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_applytitle" class="form-control" value="<?php  echo $set['weixin_commission_applytitle'];?>" />
                    <div class="help-block">标题，默认"提现申请提交通知"</div>
                </div>
            </div> 
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_apply" class="form-control" ><?php  echo $set['weixin_commission_apply'];?></textarea>
                    模板变量 [昵称] [时间] [金额] [提现方式]
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现申请审核完成通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_checktitle" class="form-control" value="<?php  echo $set['weixin_commission_checktitle'];?>" />
                    <div class="help-block">标题，默认"提现申请审核完成通知"</div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_check" class="form-control" ><?php  echo $set['weixin_commission_check'];?></textarea>
                    模板变量 [昵称] [提现方式]  [金额] [时间] 
                </div>
            </div>
            
            
               <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">佣金打款通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_paytitle" class="form-control" value="<?php  echo $set['weixin_commission_paytitle'];?>" />
                    <div class="help-block">标题，默认"佣金打款通知"</div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_pay" class="form-control" ><?php  echo $set['weixin_commission_pay'];?></textarea>
                    模板变量 [昵称] [提现方式] [金额] [时间] 
                </div>
            </div>
                
               
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销商等级升级通知</label>
                <div class="col-sm-9 col-xs-12">
                      <input type="text" name="weixin_commission_upgradetitle" class="form-control" value="<?php  echo $set['weixin_commission_upgradetitle'];?>" />
                     <div class="help-block">标题，默认"分销商等级升级通知"</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <textarea  name="weixin_commission_upgrade" class="form-control" ><?php  echo $set['weixin_commission_upgrade'];?></textarea>
                     模板变量: [昵称] [旧等级]  [旧一级分销比例] [旧二级分销比例] [旧三级分销比例] [新等级] [新一级分销比例] [新二级分销比例] [新三级分销比例]  [时间]
                </div>
            </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
        </div>
</form>
<?php include page("footer-base");?>