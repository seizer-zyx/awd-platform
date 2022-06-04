<?php defined('IN_IA') or exit('Access Denied');?>
<!-- 关闭原因 -->
<div id="modal-close" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:600px;margin:0px auto;">
	<form class="form-horizontal form" action="<?php  echo $this->createWebUrl('order')?>" method="post" enctype="multipart/form-data">
		<input type='hidden' name='id' value='' />
		<input type='hidden' name='op' value='deal' />
		<input type='hidden' name='to' value='close' />
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h3>关闭订单</h3>
				</div>
				<div class="modal-body">
					<label>关闭订单原因</label>
					<textarea style="height:150px;" class="form-control" name="reson" autocomplete="off"></textarea>
					<div id="module-menus"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="close" value="yes">关闭订单</button>
					<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- 确认发货 -->
<div id="modal-confirmsend" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:600px;margin:0px auto;">
	<form class="form-horizontal form" action="<?php  echo $this->createWebUrl('order')?>" method="post" enctype="multipart/form-data">
		<input type='hidden' name='id' value='' />
		<input type='hidden' name='op' value='deal' />
		<input type='hidden' name='to' value='confirmsend' />
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h3>快递信息</h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-xs-10 col-sm-3 col-md-3 control-label">收件人信息</label>
						<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
							<div class="form-control-static">
								收  件 人: <span class="realname"></span> / <span class="mobile"></span><br>
								收货地址: <span class="address"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-10 col-sm-3 col-md-3 control-label">快递公司</label>
						<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
							<select class="form-control" name="express" id="express">
								<option value="" data-name="">其他快递</option>
								<option value="shunfeng" data-name="顺丰">顺丰</option>
								<option value="shentong" data-name="申通">申通</option>
								<option value="yunda" data-name="韵达快运">韵达快运</option>
								<option value="tiantian" data-name="天天快递">天天快递</option>
								<option value="yuantong" data-name="圆通速递">圆通速递</option>
								<option value="zhongtong" data-name="中通速递">中通速递</option>
								<option value="ems" data-name="ems快递">ems快递</option>
								<option value="huitongkuaidi" data-name="汇通快运">汇通快运</option>
								<option value="quanfengkuaidi" data-name="全峰快递">全峰快递</option>
								<option value="zhaijisong" data-name="宅急送">宅急送</option>
								<option value="aae" data-name="aae全球专递">aae全球专递</option>
								<option value="anjie" data-name="安捷快递">安捷快递</option>
								<option value="anxindakuaixi" data-name="安信达快递">安信达快递</option>
								<option value="biaojikuaidi" data-name="彪记快递">彪记快递</option>
								<option value="bht" data-name="bht">bht</option>
								<option value="baifudongfang" data-name="百福东方国际物流">百福东方国际物流</option>
								<option value="coe" data-name="中国东方（COE）">中国东方（COE）</option>
								<option value="changyuwuliu" data-name="长宇物流">长宇物流</option>
								<option value="datianwuliu" data-name="大田物流">大田物流</option>
								<option value="debangwuliu" data-name="德邦物流">德邦物流</option>
								<option value="dhl" data-name="dhl">dhl</option>
								<option value="dpex" data-name="dpex">dpex</option>
								<option value="dsukuaidi" data-name="d速快递">d速快递</option>
								<option value="disifang" data-name="递四方">递四方</option>
								<option value="fedex" data-name="fedex（国外）">fedex（国外）</option>
								<option value="feikangda" data-name="飞康达物流">飞康达物流</option>
								<option value="fenghuangkuaidi" data-name="凤凰快递">凤凰快递</option>
								<option value="feikuaida" data-name="飞快达">飞快达</option>
								<option value="guotongkuaidi" data-name="国通快递">国通快递</option>
								<option value="ganzhongnengda" data-name="港中能达物流">港中能达物流</option>
								<option value="guangdongyouzhengwuliu" data-name="广东邮政物流">广东邮政物流</option>
								<option value="gongsuda" data-name="共速达">共速达</option>
								<option value="hengluwuliu" data-name="恒路物流">恒路物流</option>
								<option value="huaxialongwuliu" data-name="华夏龙物流">华夏龙物流</option>
								<option value="haihongwangsong" data-name="海红">海红</option>
								<option value="haiwaihuanqiu" data-name="海外环球">海外环球</option>
								<option value="jiayiwuliu" data-name="佳怡物流">佳怡物流</option>
								<option value="jinguangsudikuaijian" data-name="京广速递">京广速递</option>
								<option value="jixianda" data-name="急先达">急先达</option>
								<option value="jjwl" data-name="佳吉物流">佳吉物流</option>
								<option value="jymwl" data-name="加运美物流">加运美物流</option>
								<option value="jindawuliu" data-name="金大物流">金大物流</option>
								<option value="jialidatong" data-name="嘉里大通">嘉里大通</option>
								<option value="jykd" data-name="晋越快递">晋越快递</option>
								<option value="kuaijiesudi" data-name="快捷速递">快捷速递</option>
								<option value="lianb" data-name="联邦快递（国内）">联邦快递（国内）</option>
								<option value="lianhaowuliu" data-name="联昊通物流">联昊通物流</option>
								<option value="longbanwuliu" data-name="龙邦物流">龙邦物流</option>
								<option value="lijisong" data-name="立即送">立即送</option>
								<option value="lejiedi" data-name="乐捷递">乐捷递</option>
								<option value="minghangkuaidi" data-name="民航快递">民航快递</option>
								<option value="meiguokuaidi" data-name="美国快递">美国快递</option>
								<option value="menduimen" data-name="门对门">门对门</option>
								<option value="ocs" data-name="OCS">OCS</option>
								<option value="peisihuoyunkuaidi" data-name="配思货运">配思货运</option>
								<option value="quanchenkuaidi" data-name="全晨快递">全晨快递</option>
								<option value="quanjitong" data-name="全际通物流">全际通物流</option>
								<option value="quanritongkuaidi" data-name="全日通快递">全日通快递</option>
								<option value="quanyikuaidi" data-name="全一快递">全一快递</option>
								<option value="rufengda" data-name="如风达">如风达</option>
								<option value="santaisudi" data-name="三态速递">三态速递</option>
								<option value="shenghuiwuliu" data-name="盛辉物流">盛辉物流</option>
								<option value="sue" data-name="速尔物流">速尔物流</option>
								<option value="shengfeng" data-name="盛丰物流">盛丰物流</option>
								<option value="saiaodi" data-name="赛澳递">赛澳递</option>
								<option value="tiandihuayu" data-name="天地华宇">天地华宇</option>
								<option value="tnt" data-name="tnt">tnt</option>
								<option value="ups" data-name="ups">ups</option>
								<option value="wanjiawuliu" data-name="万家物流">万家物流</option>
								<option value="wenjiesudi" data-name="文捷航空速递">文捷航空速递</option>
								<option value="wuyuan" data-name="伍圆">伍圆</option>
								<option value="wxwl" data-name="万象物流">万象物流</option>
								<option value="xinbangwuliu" data-name="新邦物流">新邦物流</option>
								<option value="xinfengwuliu" data-name="信丰物流">信丰物流</option>
								<option value="yafengsudi" data-name="亚风速递">亚风速递</option>
								<option value="yibangwuliu" data-name="一邦速递">一邦速递</option>
								<option value="youshuwuliu" data-name="优速物流">优速物流</option>
								<option value="youzhengguonei" data-name="邮政包裹挂号信">邮政包裹挂号信</option>
								<option value="youzhengguoji" data-name="邮政国际包裹挂号信">邮政国际包裹挂号信</option>
								<option value="yuanchengwuliu" data-name="远成物流">远成物流</option>
								<option value="yuanweifeng" data-name="源伟丰快递">源伟丰快递</option>
								<option value="yuanzhijiecheng" data-name="元智捷诚快递">元智捷诚快递</option>
								<option value="yuntongkuaidi" data-name="运通快递">运通快递</option>
								<option value="yuefengwuliu" data-name="越丰物流">越丰物流</option>
								<option value="yad" data-name="源安达">源安达</option>
								<option value="yinjiesudi" data-name="银捷速递">银捷速递</option>
								<option value="zhongtiekuaiyun" data-name="中铁快运">中铁快运</option>
								<option value="zhongyouwuliu" data-name="中邮物流">中邮物流</option>
								<option value="zhongxinda" data-name="忠信达">忠信达</option>
								<option value="zhimakaimen" data-name="芝麻开门">芝麻开门</option>
							</select>
							<input type='hidden' name='expresscom' id='expresscom' />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-10 col-sm-3 col-md-3 control-label">快递单号</label>
						<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
							<input type="text" name="expresssn" class="form-control" />
						</div>
					</div>
					<div id="module-menus"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary span2" name="confirmsend" value="yes">确认发货</button>
					<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- 取消发货 -->
<div id="modal-cancelsend" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:600px;margin:0px auto;">
	<form class="form-horizontal form" action="<?php  echo $this->createWebUrl('order')?>" method="post" enctype="multipart/form-data">
		<input type='hidden' name='id' value='' />
		<input type='hidden' name='op' value='deal' />
		<input type='hidden' name='to' value='cancelsend' />
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h3>取消发货</h3>
				</div>
				<div class="modal-body">
					<label>取消发货原因</label>
					<textarea style="height:150px;" class="form-control" name="cancelreson" autocomplete="off"></textarea>
					<div id="module-menus"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary span2" name="cancelsend" value="yes">取消发货</button>
					<a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- 驳回退款 -->
<div id="modal-refund" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:620px;margin:0px auto;">
	<form class="form-horizontal form" action="<?php  echo $this->createWebUrl('order')?>" method="post" enctype="multipart/form-data">
		<input type='hidden' name='id' value='' />
		<input type='hidden' name='op' value='deal' />
		<input type='hidden' name='to' value='refund' />
		<div class="modal-dialog">
			<div class="modal-content"  >
				<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>处理退款申请</h3></div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-xs-10 col-sm-3 col-md-3 control-label">处理结果</label>
						<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
							<label class='radio-inline'>
								<input type='radio' value='0' name='refundstatus' checked>暂不处理
							</label> 
							<label class='radio-inline'>
								<input type='radio' value='-1' name='refundstatus'>驳回申请
							</label>
							<label class='radio-inline'>
								<input type='radio' value='1' name='refundstatus'>退款到余额
							</label>
							<label class='radio-inline'>
								<input type='radio' value='2' name='refundstatus'>手动退款
							</label> 
							<span class="help-block">如有余额抵扣： 会返回金额到商城用户余额</span>
							<span class="help-block">如有积分抵扣： 会返回积分到商城用户积分</span>
							<span class="help-block">手动退款： 订单会完成退款处理，您用其他方式进行退款</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-10 col-sm-3 col-md-3 control-label">驳回原因</label>
						<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
							<textarea class="form-control" name="refundcontent" ></textarea>
						</div>
					</div>
					<div id="module-menus"></div>
				</div>
				<div class="modal-footer"><button type="submit" class="btn btn-primary span2" name="refund" value="yes">确认</button><a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a></div>
			</div>
		</div>
	</form>
</div>
<div id='changeprice_container'>

</div>

<script language='javascript'>
	$(function () {

		$("#express").change(function () {
			var obj = $(this);
			var sel = obj.find("option:selected").attr("data-name");
			$("#expresscom").val(sel);
		});
	});
	function changePrice(orderid) {

		$.ajax({
			url: "<?php  echo $this->createWebUrl('order/list',array('op'=>'deal','to'=>'changepricemodal'))?>&id=" + orderid,
			success: function (html) {
				if (html == -1) {
					alert('订单不能改价!');
					return;
				}
				$('#changeprice_container').html(html);
				$('#modal-changeprice').modal().on('shown.bs.modal', function () {
					mc_init();
				})

			}
		})
	}
	var order_price = 0;
	var dispatch_price = 0;
	function mc_init() {
		order_price = parseFloat($('#changeprice-orderprice').val());
		dispatch_price = parseFloat($('#changeprice-dispatchprice').val());
		$('input', $('#modal-changeprice')).blur(function () {
			if($.isNumber($(this).val())){
				mc_calc();
			}
		});

	}

	function mc_calc() {
		 
		var change_dispatchprice = parseFloat($('#changeprice_dispatchprice').val());
		if(!$.isNumber($('#changeprice_dispatchprice').val())){
			 change_dispatchprice = dispatch_price;
		}
		var dprice = change_dispatchprice;
		if (dprice <= 0) {
			dprice = 0;
		} 
		$('#dispatchprice').html(dprice.toFixed(2));
 
		var oprice = 0;
		$('.changeprice_orderprice').each(function () { 
			var p = 0;
			if ($.trim($(this).val()) != '') {
				p = parseFloat($.trim($(this).val()));
			}
			oprice += p;
		});
		if(Math.abs(oprice)>0){
			if (oprice < 0) {
				$('#changeprice').css('color', 'red');
				$('#changeprice').html( " - " + Math.abs(oprice));
			} else {
				$('#changeprice').css('color', 'green');
				$('#changeprice').html( " + " + Math.abs(oprice));
			}
		}
		var lastprice =  order_price + dprice + oprice;
		
		$('#lastprice').html( lastprice.toFixed(2) );

	}
	function mc_check(){
		var can = true;
		var lastprice = 0;
		 $('.changeprice_orderprice').each(function () { 
			 if( $.trim( $(this).val())==''){
				 return true;
			 }
			var p = 0;
			if ( !$.isNumber($(this).val())) {
				$(this).select();
				alert('请输入数字!');
				can =false;
				return false;
			}
			var val  = parseFloat( $(this).val() );
			if(val<=0 && Math.abs(val) > parseFloat( $(this).parent().prev().html())) {
				$(this).select();
				alert('单个商品价格不能优惠到负数!');
				can =false;
				return false;
			}
			lastprice+=val;
		});
		var op = order_price + dispatch_price+ lastprice;
		if( op <0){
			alert('订单价格不能小于0元!');
			return false;
		}
		if(!can){
			return false;
		}
		return true;
	}

</script>
                                                              
<script language="javascript">
	function send(btn){
		var modal =$('#modal-confirmsend');
		var itemid = $(btn).parent().find('.itemid').val();
			modal.find(':input[name=id]').val( itemid );
			var addressdata  = eval('(' +$(btn).parent().find('.addressdata').val()+')');
			modal.find('.realname').html(addressdata.realname);
			modal.find('.mobile').html(addressdata.mobile);
			modal.find('.address').html(addressdata.address);
	}
</script> 

<!-- 查看物流 -->
<div id="modal-express" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:620px;margin:0px auto;">
	 
		<div class="modal-dialog">
			<div class="modal-content" >
				<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>查看物流</h3></div>
				<div class="modal-body" style='max-height:500px;overflow: auto;' >
					<div class="form-group">
						<p class='form-control-static' id="module-menus-express"></p>
					</div>
				</div>
				<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
			</div>
		</div>
 
</div>
<script language='javascript'>
	function express_find(btn,orderid){
		$(btn).button('loading');
		$.ajax({
			url: "<?php  echo $this->createWebUrl('order/list',array('op'=>'deal','to'=>'express'))?>&id=" + orderid,
			cache:false,
			success:function(html){
				$('#module-menus-express').html(html);
				$('#modal-express').modal();
				$(btn).button('reset');
			}
		})
	}
	
</script>