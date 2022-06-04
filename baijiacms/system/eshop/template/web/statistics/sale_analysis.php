<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
<style type="text/css">
	.num { position:absolute; left:10px;color:#000;font-weight:bold;}
	.progress { position: relative; }
</style>
<div class="panel panel-default">
   <h3 class="custom_page_header"> 销售指标 </h3>
    <div class='panel-body'>
        <div class="form-group">
            <div class="col-sm-8 col-lg-9 col-xs-12">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th  style='width:150px;'>订单总金额</th>
                            <th  style='width:150px;'>总会员数</th>
                            <th>会员消费率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php  echo $orderprice;?></td>
                            <td><?php  echo $member_count;?></td>
                                <td><?php $percent=round( $orderprice/($member_count==0?1:$member_count),2);?>
			<?php  if($percent>1) { ?><?php  $percent+=100?><?php  } else { ?><?php  $percent*=100?><?php  } ?>
                             <div class="progress">
                                 <div style="width: <?php  echo $percent;?>%;" class="progress-bar progress-bar-success"><span class='num'><?php echo empty($percent)?'':$percent.'%'?></span></div>
                              </div>
                            </td>  
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8 col-lg-9 col-xs-12">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th style='width:150px;'>订单总金额</th>
                            <th style='width:150px;'>总访问次数</th>
                            <th>访问转化率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php  echo $orderprice;?></td>
                            <td><?php  echo $viewcount;?></td>
                           <td><?php $percent=round( $orderprice/($viewcount==0?1:$viewcount),2);?>
			<?php  if($percent>1) { ?><?php  $percent+=100?><?php  } else { ?><?php  $percent*=100?><?php  } ?>
                                <div class="progress">
                                    <div style="width: <?php  echo $percent;?>%;" class="progress-bar progress-bar-info"><span class='num'><?php echo empty($percent)?'':$percent.'%'?></span></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
     
        <div class="form-group">
            <div class="col-sm-8 col-lg-9 col-xs-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style='width:150px;'>总订单数</th>
                            <th style='width:150px;'>总访问次数</th>
                            <th>订单转化率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php  echo $ordercount;?></td>
                            <td><?php  echo $viewcount;?></td>
                           <td><?php $percent=round( $ordercount/($viewcount==0?1:$viewcount),2);?>
			<?php  if($percent>1) { ?><?php  $percent+=100?><?php  } else { ?><?php  $percent*=100?><?php  } ?>
                                <div class="progress">
                                    <div style="width: <?php  echo $percent;?>%;" class="progress-bar progress-bar-danger"><span class='num'><?php echo empty($percent)?'':$percent.'%'?></span></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-8 col-lg-9 col-xs-12">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th style='width:150px;'>消费会员数</th>
                            <th style='width:150px;'>总会员数</th>
                            <th>会员消费率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php  echo $member_buycount;?></td>
                            <td><?php  echo $member_count;?></td>
                          <td><?php $percent=round( $member_buycount/($member_count==0?1:$member_count),2);?>
			<?php  if($percent>1) { ?><?php  $percent+=100?><?php  } else { ?><?php  $percent*=100?><?php  } ?>
                                <div class="progress">
                                    <div style="width: <?php  echo $percent;?>%;" class="progress-bar progress-bar-striped"><span class='num'><?php echo empty($percent)?'':$percent.'%'?></span></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      <div class="form-group">
        <div class="col-sm-8 col-lg-9 col-xs-12">
            <table class="table table-hover" >
                <thead>
                    <tr>
                        <th style='width:150px;'>总订单数</th>
                        <th style='width:150px;'>总会员数</th>
                        <th>订单购买率</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php  echo $ordercount;?></td>
                        <td><?php  echo $member_count;?></td>
                        <td><?php $percent=round( $ordercount/($member_count==0?1:$member_count),2);?>
			<?php  if($percent>1) { ?><?php  $percent+=100?><?php  } else { ?><?php  $percent*=100?><?php  } ?>
                            <div class="progress">
                                <div style="width: <?php  echo $percent;?>%;" class="progress-bar progress-bar-warning"><span class='num'><?php echo empty($percent)?'':$percent.'%'?></span></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php include page("footer-base");?>