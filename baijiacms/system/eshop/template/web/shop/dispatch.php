<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
<?php  if($operation == 'display') { ?>
<form action="" method="post">
<div class="main panel">
		<h3 class="custom_page_header">配送方式  
                        <a class='btn btn-default' href="<?php  echo $this->createWebUrl('shop/dispatch',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加配送方式</a>
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                     
                     
                        <input name="submit" type="submit" class="btn btn-primary" value="保存排序">
                    </h3>
	
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:50px;">ID</th>
                    <th style="width:80px;">显示顺序</th>
                    <th>配送方式名称</th>
                    <th>计费方式</th>
                    <th>首重(首件)价格</th>
                    <th>续重(续件)价格</th>
                    <th>状态</th>
                    <th>默认快递</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody><?php  if(count($list)>0) { ?>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['id'];?></td>
                    <td>
                      
                        <input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>">
                   
                    </td>
                    <td><?php  echo $item['dispatchname'];?></td>
                    <?php  if($item['calculatetype']==0) { ?>
                    <td>按重量计费</td>
                    <td><?php  echo $item['firstprice'];?></td>
                    <td><?php  echo $item['secondprice'];?></td>
                    <?php  } else { ?>
                    <td>按件计费</td>
                    <td><?php  echo $item['firstnumprice'];?></td>
                    <td><?php  echo $item['secondnumprice'];?></td>
                    <?php  } ?>

                    <td><label class='label  label-default <?php  if($item['enabled']==1) { ?>label-info<?php  } ?>' ><?php  if($item['enabled']==1) { ?>显示<?php  } else { ?>隐藏<?php  } ?></label></td>
                    <td><label class='label  label-default <?php  if($item['isdefault']==1) { ?>label-info<?php  } ?>' ><?php  if($item['isdefault']==1) { ?>是<?php  } else { ?>否<?php  } ?></label></td>
                    <td style="text-align:left;">
                        <a href="<?php  echo $this->createWebUrl('shop/dispatch', array('op' => 'post', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="修改"><i class="fa fa-pencil"></i></a>
                      <a href="<?php  echo $this->createWebUrl('shop/dispatch', array('op' => 'delete', 'id' => $item['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认删除此配送方式?')" title="删除"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php  } } ?>
               <?php  } else { ?>
								<tr>
							<td colspan='9'>
                              <div  style='text-align: center;padding:30px;'>
                                  暂时没有配送方式!
                              </div>	</td>
						</tr>
                          <?php  } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
</form>
<script>
    require(['bootstrap'], function ($) {
        $('.btn').hover(function () {
            $(this).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });
</script>

<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
        <input type="hidden" name="id" value="<?php  echo $dispatch['id'];?>" />
 
        <div class="panel ">

            
              <h3 class="custom_page_header">   配送方式设置</h3>
            <div class="panel-body">
            	  <input type="hidden" name="displayorder" value="<?php  echo $dispatch['displayorder'];?>" />
            	  <?php  if(false) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12">
                            <input type="text" name="displayorder" class="form-control" value="<?php  echo $dispatch['displayorder'];?>" />
                   
                        
                    </div>
                </div>
                  <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>配送方式名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" id='dispatchname' name="dispatchname" class="form-control" value="<?php  echo $dispatch['dispatchname'];?>" />
                       
                        
                    </div>
                </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否为默认快递模板</label>

                <div class="col-sm-9 col-xs-12">
                    <label class='radio-inline'>
                        <input type='radio' name='isdefault' id="isdefault1" value='1' <?php  if($dispatch['isdefault']==1) { ?>checked<?php  } ?> /> 是
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='isdefault' id="isdefault0" value='0' <?php  if($dispatch['isdefault']==0) { ?>checked<?php  } ?> /> 否
                    </label>
                   
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">计费方式</label>

                <div class="col-sm-9 col-xs-12">
                    <label class='radio-inline'>
                        <input type='radio' name='calculatetype' value='0' <?php  if($dispatch['calculatetype']==0) { ?>checked<?php  } ?> /> 按重量计费
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='calculatetype' value='1' <?php  if($dispatch['calculatetype']==1) { ?>checked<?php  } ?> /> 按件计费
                    </label>
                   
                </div>
            </div>

                <div class="form-group dispatch0" style='display:none'>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">物流公司</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type='hidden' name='expressname' value='<?php  echo $dispatch['expressname'];?>'/>
                        <select name='express' class="form-control input-medium">
                            <option value="" data-name="其他快递">其他快递</option>
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
                        <span class="help-block">如果您选择了常用快递，则客户可以订单中查询快递信息，如果缺少您想要的快递，您可以联系我们! </span>
                        
                    </div>
                </div>
             
              <div class="form-group dispatch0" >
                         <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送区域</label>
                    <div class="col-sm-9 col-xs-12">
                   
                        <table>
                            <thead>
                            <tr>
                                <th style="height:40px;width:400px;">运送到</th>
			                    <th class="show_h" style="width:120px;">首重(克)</th>
			                    <th class="show_h" style="width:120px;">首费(元)</th>
			                    <th class="show_h" style="width:120px;">续重(克)</th>
			                    <th class="show_h" style="width:120px;">续费(元)</th>


			                    <th class="show_n" style="width:120px;">首件(个)</th>
			                    <th class="show_n" style="width:120px;">运费(元)</th>
			                    <th class="show_n" style="width:120px;">续件(个)</th>
			                    <th class="show_n" style="width:120px;">续费(元)</th>
                                <th style="width:120px;">管理</th>
                            </tr>
                            </thead>
                            <tbody id='tbody-areas'>
                            <tr>
                                <td style="padding:10px;">全国 [默认运费]</td>
                    <td class="show_h text-center">
                        <input type="number" value="<?php echo empty($dispatch['firstweight'])?1000:$dispatch['firstweight']?>" class="form-control" name="default_firstweight" style="width:100px;"></td>
                  
                    <td class="show_h text-center">
                        <input type="text" value="<?php  echo $dispatch['firstprice'];?>" class="form-control" name="default_firstprice"  style="width:100px;"></td>
                    
                    <td class="show_h text-center">
                        <input type="number" value="<?php echo empty($dispatch['secondweight'])?1000:$dispatch['secondweight']?>" class="form-control" name="default_secondweight"  style="width:100px;"></td>
                  
                    <td class="show_h text-center">
                        <input type="text" value="<?php  echo $dispatch['secondprice'];?>" class="form-control" name="default_secondprice"  style="width:100px;"></td>


                    <td class="show_h"></td>

                    <td class="show_n text-center">
                     
                        <input type="number" value="<?php echo empty($dispatch['firstnum'])?1:$dispatch['firstnum']?>" class="form-control" name="default_firstnum" style="width:100px;"></td>
                 
                    <td class="show_n text-center">
                  
                        <input type="text" value="<?php  echo $dispatch['firstnumprice'];?>" class="form-control" name="default_firstnumprice"  style="width:100px;"></td>
                  
                    <td class="show_n text-center">
                    
                        <input type="number" value="<?php echo empty($dispatch['secondnum'])?1:$dispatch['secondnum']?>" class="form-control" name="default_secondnum"  style="width:100px;"></td>
                  
                    <td class="show_n text-center">
                    
                        <input type="text" value="<?php  echo $dispatch['secondnumprice'];?>" class="form-control" name="default_secondnumprice"  style="width:100px;"></td>
                

                    <td class="show_n"></td>
                            </tr>
                            <?php  if(is_array($dispatch_areas)) { foreach($dispatch_areas as $row) { ?>
                               <?php  $random = random(16);?>
                               <?php include $this->template('tpl/dispatch', TEMPLATE_INCLUDEPATH);?>
                            <?php  } } ?>
                            </tbody>
                        </table>
                   
                          <a class='btn btn-default' href="javascript:;" onclick='addArea(this)'><span class="fa fa-plus"></span> 新增配送区域</a>
                         <span class='help-block show_h' <?php  if($dispatch['type']==1) { ?>style='display:block'<?php  } ?>>根据重量来计算运费，当物品不足《首重重量》时，按照《首重费用》计算，超过部分按照《续重重量》和《续重费用》乘积来计算</span>
		     <span class='help-block show_n' <?php  if($dispatch['type']==0) { ?>style='display:block'<?php  } ?>>根据件数来计算运费，当物品不足《首件数量》时，按照《首件费用》计算，超过部分按照《续件数量》和《续件费用》乘积来计算</span>
                       
                        
                    </div>
                        
                    </div>
                  </div>
             <div class="form-group dispatch1" style='display:none'>
                         <label class="col-xs-12 col-sm-3 col-md-2 control-label">自提地址设置</label>
                    <div class="col-sm-9 col-xs-12">
                   
                        <table>
                            <thead>
                            <tr>
                                <th style="width:320px;">公司地址</th>
                                <th style="width:120px;">联系人</th>
                                <th style="width:120px;">联系电话</th>
                                <th style="width:120px;">取货时间</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id='tbody-carriers'>
                                <?php  if(is_array($dispatch_carriers)) { foreach($dispatch_carriers as $row) { ?>
                                   <?php  $random = random(16);?>
                                   <?php include $this->template('tpl/carrier', TEMPLATE_INCLUDEPATH);?>
                                <?php  } } ?>
                            </tbody>
                        </table>
                       
                        <a class='btn btn-default' style='margin-top:10px;' href="javascript:;" onclick='addCarrier(this)'><span class="fa fa-plus"></span> 新增自提地点</a>
                    
                    </div>
                    </div>
         
            
        
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
                    <div class="col-sm-9 col-xs-12">
                   
                        <label class='radio-inline'>
                            <input type='radio' name='enabled' value=1' <?php  if($dispatch['enabled']==1) { ?>checked<?php  } ?> /> 是
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='enabled' value=0' <?php  if($dispatch['enabled']==0) { ?>checked<?php  } ?> /> 否
                        </label>
                         
                    </div>
                </div>
            <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
              
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return formcheck()" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
              
                       <input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default col-lg-1" />
                    </div>
            </div>
            
            
            </div>
        </div>
     
    </form>
</div>
<style type='text/css'>
    .province { float:left; position:relative;width:150px; height:35px; line-height:35px;border:1px solid #fff;}
    .province:hover { border:1px solid #f7e4a5;border-bottom:1px solid #fffec6; background:#fffec6;}
    .province .cityall { margin-top:10px;}
    .province ul { list-style: outside none none;position:absolute;padding:0;background:#fffec6;border:1px solid #f7e4a5;display:none;
    width:auto; width:300px; z-index:999999;left:-1px;top:32px;}
    .province ul li  { float:left;min-width:60px;margin-left:20px; height:30px;line-height:30px; }
 </style>
 <div id="modal-areas"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择区域</h3></div>
            <div class="modal-body" style='height:280px;;' > 
                
                <?php  if(is_array($areas['address']['province'])) { foreach($areas['address']['province'] as $value) { ?>
				<?php  if($value['@attributes']['name']=='请选择省份') { ?>
				<?php  continue;?>
				<?php  } ?>
                <div class='province'>
                     <label class='checkbox-inline' style='margin-left:20px;'>
                         <input type='checkbox' class='cityall' /> <?php  echo $value['@attributes']['name']?>
                         <span class="citycount" style='color:#ff6600'></span>
                     </label>
                    <?php  if(count($value['city'])>0) { ?>
                    <ul>
                        <?php  if(is_array($value['city'])) { foreach($value['city'] as $c) { ?>
                        <li>
                             <label class='checkbox-inline'>
                                  <input type='checkbox' class='city' style='margin-top:8px;' city="<?php  echo $c['@attributes']['name']?>" /> <?php  echo $c['@attributes']['name']?>
                            </label>
                     </li>
                        <?php  } } ?>
                    </ul>
                    <?php  } ?>
                </div>
                <?php  } } ?>
            
            </div>
            <div class="modal-footer">
                <a href="javascript:;" id='btnSubmitArea' class="btn btn-success" data-dismiss="modal" aria-hidden="true">确定</a>
                <a href="javascript:;" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
            </div>
        </div>
     </div>
</div> 
<script language='javascript'>
    function show_type(flag){
        if (flag == 1) {
            $('.show_h').hide();
            $('.show_n').show();
        } else {
            $('.show_h').show();
            $('.show_n').hide();
        }
    }
    $(function(){
        show_type(<?php  echo $dispatch['calculatetype']?>);

        $(':radio[name=calculatetype]').click(function(){
            var val = $(this).val();
            show_type(val);
        })
        $(':radio[name=dispatchtype]').click(function(){
            var val = $(this).val();
            $(".dispatch0,.dispatch1").hide();
            $(".dispatch" + val ).show();
        })
      
        $("select[name=express]").change(function(){
              var obj = $(this);
                var sel = obj.find("option:selected");
                $(":input[name=expressname]").val(sel.data("name"));
        });
        <?php  if(!empty($dispatch['express'])) { ?>
           $("select[name=express]").val("<?php  echo $dispatch['express'];?>");
        <?php  } ?>

   
        $('.province').mouseover(function(){
              $(this).find('ul').show();
        }).mouseout(function(){
              $(this).find('ul').hide();
        });
        
        $('.cityall').click(function(){
            var checked = $(this).get(0).checked;
            var citys = $(this).parent().parent().find('.city');
            citys.each(function(){
                $(this).get(0).checked = checked;
            });
            var count = 0;
            if(checked){
                count =  $(this).parent().parent().find('.city:checked').length;
            }
            if(count>0){
               $(this).next().html("(" + count + ")")    ;
            }
            else{
                $(this).next().html("");
            }
        });
        $('.city').click(function(){
            var checked = $(this).get(0).checked;
            var cityall = $(this).parent().parent().parent().parent().find('.cityall');
          
            if(checked){
                cityall.get(0).checked = true;
            }
            var count = cityall.parent().parent().find('.city:checked').length;
            if(count>0){
               cityall.next().html("(" + count + ")")    ;
            }
            else{
                cityall.next().html("");
            }
        });    
      
    });
    function getCurrents(withOutRandom){
        var citys = "";
        $('.citys').each(function(){
             var crandom = $(this).prev().val();
             if(withOutRandom && crandom==withOutRandom){
                 return true;
             }
             citys+=$(this).val();
        });
        return citys;
    }
     function addCarrier(btn){
        $(btn).button('loading');
        $.ajax({
            url:"<?php  echo $this->createWebUrl('shop/dispatch',array('op'=>'tpl1'))?>",
            dataType:'json',
            success:function(json){
                $(btn).button('reset');
                 $('#tbody-carriers').append(json.html);
            }
        });
    }
    var current = '';
    function addArea(btn){
        $(btn).button('loading');
        $.ajax({
            url:"<?php  echo $this->createWebUrl('shop/dispatch',array('op'=>'tpl'))?>",
            dataType:'json',
            success:function(json){
                $(btn).button('reset');
                current = json.random;
              
                $('#tbody-areas').append(json.html);
                $('#tbody-areas tr').last().hide();
                 clearSelects();
                
                $("#modal-areas").modal();
                var currents = getCurrents();
                currents = currents.split(';');
                var citystrs = "";
                $('.city').each(function(){
                    var parentdisabled =false;
                    for(var i in currents){
                        if(currents[i]!='' && currents[i]==$(this).attr('city')){
                            $(this).attr('disabled',true);
                            $(this).parent().parent().parent().parent().find('.cityall').attr('disabled',true);
                        }
                    }
                  
                });
                $('#btnSubmitArea').unbind('click').click(function(){
                      $('.city:checked').each(function(){              
                         citystrs+= $(this).attr('city') +";";
                      });
                      $('.' + current + ' .cityshtml').html(citystrs);
                      $('.' + current + ' .citys').val(citystrs);
                      $('#tbody-areas tr').last().show(); 
                })
                        var calculatetype1 = $('input[name="calculatetype"]:checked ').val();
                        show_type(calculatetype1);
            }
        })
    }
    function clearSelects(){
          $('.city').attr('checked',false).removeAttr('disabled');
         $('.cityall').attr('checked',false).removeAttr('disabled');
         $('.citycount').html('');
    }
    function editArea(btn){
        current = $(btn).attr('random');
        clearSelects();
        var old_citys = $(btn).prev().val().split(';');
      
                
        $('.city').each(function(){
            var parentcheck = false;
            for(var i in old_citys){
                if(old_citys[i]==$(this).attr('city')){
                    parentcheck = true;
                    $(this).get(0).checked = true;
                    break;
                }
            }
            if(parentcheck){
                $(this).parent().parent().parent().parent().find('.cityall').get(0).checked=  true;
            }
        });
        
        $("#modal-areas").modal();
        var citystrs = '';
        $('#btnSubmitArea').unbind('click').click(function(){
                   $('.city:checked').each(function(){              
                     citystrs+= $(this).attr('city') +";";
                   });
                   $('.' + current + ' .cityshtml').html(citystrs);
                   $('.' + current + ' .citys').val(citystrs);


        })
           var currents = getCurrents(current);
                currents = currents.split(';');
                var citys = "";
                $('.city').each(function(){
                    var parentdisabled =false;
                    for(var i in currents){
                        if(currents[i]!='' && currents[i]==$(this).attr('city')){
                            $(this).attr('disabled',true);
                            $(this).parent().parent().parent().parent().find('.cityall').attr('disabled',true);
                        }
                    }
                  
                });
    }
    function formcheck() {
        if ($("#dispatchname").isEmpty()) {
            Tip.focus("dispatchname", "请填写配送方式名称!", "top");
            return false;
        }
        return true;
    }
</script>

<?php  } ?>
<?php include page("footer-base");?>