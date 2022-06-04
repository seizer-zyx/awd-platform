<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
  
  <div class="panel ">
  	   	<h3 class="custom_page_header">关注日志</h3>
        <div class="panel-body">
            <form  method="get" class="form-horizontal" role="form">
                <input type="hidden" name="mod" value="site" />
                <input type="hidden" name="m" value="eshop" />
                <input type="hidden" name="do"  value="poster" />
                <input type="hidden" name="act" value="log" />
                <input type="hidden" name="id" value="<?php  echo $_GPC['id'];?>" />
                <input type="hidden" name="beid" value="<?php echo $GLOBALS['_CMS']['beid'];?>" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">推荐人</label>
                    <div class="col-sm-3">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可搜索推荐人昵称/姓名/手机号">
                    </div>
                    
                     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">扫码人</label>
                    <div class="col-sm-3">
                        <input class="form-control" name="keyword1" id="" type="text" value="<?php  echo $_GPC['keyword1'];?>" placeholder="可搜索扫码人昵称/姓名/手机号">
                    </div>
                </div>
             <div class="form-group">
                    <label class="col-xs-2 col-sm-2 col-md-2 col-lg-1 control-label">关注时间</label>
                    
                    <div class="col-sm-5">
                    <div class='input-group'>
                        <div class='input-group-addon'>
                            <label class='radio-inline' style='margin-top:-7px;'>
                                <input type='radio' value='0' name='searchtime' <?php  if(empty($_GPC['searchtime'])) { ?>checked<?php  } ?>>不搜索
                            </label>
                            <label class='radio-inline'  style='margin-top:-7px;'>
                                <input type='radio' value='1' name='searchtime' <?php  if($_GPC['searchtime']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                        </div>
                    	<?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
					
                     </div>
                       
            			</div>
            			    <div class="col-xs-3">
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    </div>
                	</div>
                  
                  
            </form>
        </div>


            <form action="" method="post" onsubmit="return formcheck(this)">
            <div class='panel-heading'>
                关注记录 (人数: <?php  echo $total;?>)
            </div>
         <div class='panel-body'>
   
            <table class="table">
                <thead>
                    <tr>
                        <th>推荐人信息</th>
                        <th>推荐人奖励</th>
                        <th>关注者信息</th>
                        <th>关注者奖励</th>
                        <th>关注时间</th>
                        <th>操作</th>
                    </tr>
                </thead> 
                <tbody>  
                 <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><img src='<?php  echo $row['avatar'];?>' onerror="this.src='<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/images/tx.png'" style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?>
                        (<?php  echo $row['realname'];?>/<?php  echo $row['mobile'];?>)
                        <br/> <label class='label label-danger'>推荐关注人数: <?php  echo $row['times'];?></label>
                        </td>
                        <td>
                            <?php  if(!empty($row['reccredit'])) { ?>+积分: <?php  echo $row['reccredit'];?><br/><?php  } ?>
                            <?php  if($row['recmoney']>0) { ?>+余额: <?php  echo $row['recmoney'];?><br/><?php  } ?>
                        </td>
                        <td><img src='<?php  echo $row['avatar1'];?>' onerror="this.src='<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/images/tx.png'" style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname1'];?>
                        (<?php  echo $row['realname1'];?>/<?php  echo $row['mobile1'];?>)</td>
                            <td>
                            <?php  if(!empty($row['subcredit'])) { ?>+积分: <?php  echo $row['subcredit'];?><br/><?php  } ?>
                            <?php  if($row['submoney']>0) { ?>+余额: <?php  echo $row['submoney'];?><br/><?php  } ?>
                        </td>
                        <td><?php  echo date('Y-m-d H:i',$row['createtime'])?></td>
                        <td><a class='btn btn-default' href="<?php  echo $this->createWebUrl('poster/log',array('id'=>$row['posterid'],'keyword'=>$row['nickname']))?>" title='吸引关注列表'><i class='fa fa-users'></i></a></td>
                    </tr>
                    <?php  } } ?>
                </tbody>
            </table>
  <?php  echo $pager;?>
         </div>
     </div>
         </form>
<?php include page("footer-base");?>
