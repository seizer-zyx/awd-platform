<?php defined('IN_IA') or exit('Access Denied');?>
<!-- 订单改价 -->
        <div id="modal-changeprice" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <form class="form-horizontal form" action="<?php  echo $this->createWebUrl('order')?>" method="post" enctype="multipart/form-data">
                <input type='hidden' name='id' value="<?php  echo $item['id'];?>" />
                <input type='hidden' name='op' value='deal' />
				<input type='hidden' id='changeprice-orderprice' value="<?php  echo $item['price']-$item['dispatchprice']?>"/> 
				<input type='hidden' id='changeprice-dispatchprice' value="<?php  echo $item['dispatchprice'];?>"/> 
                <input type='hidden' name='to' value='confirmchangeprice' />
            <div class="modal-dialog"  style="width:750px;margin:0px auto;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3>订单改价</h3>
                    </div>
                    <div class="modal-body">
                 
                        <div class="form-group">
                   
                            <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
								<table class='table'>
									<tr>
										<th style='width:200px;'>商品名称</th>
										<th style='width:150px;'>单价</th>
										<th style='width:80px;'>数量</th>
										<th style='width:100px;'>小计</th>
										<th style='width:100px;'>加价或减价</th>
										<th style='width:100px;'>运费</th>
									</tr>
									<?php  if(is_array($order_goods)) { foreach($order_goods as $key => $goods) { ?>
									<tr>
										<td><?php  echo $goods['title'];?></td>
										<td class='realprice'><?php  echo number_format($goods['oldprice']/$goods['total'],2)?></td>
										<td><?php  echo $goods['total'];?></td>
										<td>
											<?php  echo $goods['realprice'];?>
											<?php  if($goods['realprice']!=$goods['oldprice']) { ?>
											<label class='label label-danger'>改价</label>
											<?php  } ?>
										</td>
										
										<td valign="top" >
											<input type='text' class='form-control changeprice_orderprice' name="changegoodsprice[<?php  echo $goods['id'];?>]"  /></td>
										
										<?php  if($key==0) { ?>
										<td valign="top" rowspan='<?php  echo count($order_goods)?>' style='vertical-align: top' >
											<input type='text' class='form-control' id='changeprice_dispatchprice' value="<?php  echo $item['dispatchprice'];?>" name='changedispatchprice' />
											<a href='javascript:;' onclick="$(this).prev().val('0');mc_calc()">直接免运费</a>
										</td>
										<?php  } else { ?>
										<td>&nbsp;</td>
										<?php  } ?>
									</tr>
									<?php  } } ?>
									<tr>
										<td colspan='2'></td>
										<td colspan='' style='color:green'>应收款</td>
										<td colspan='' style='color:green'><?php  echo $item['price'];?></td>
										<td colspan='2'  style='color:red'>改价后价格不能小于0元</td>
									</tr>
									 
								</table>
                            </div>
                        </div>
				     <div class="form-group">
                              
                                    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
                                        <div class="form-control-static">
											
                                        </div>
                                    </div>
                        </div>
                   
						     <div class="form-group">
                              
                                    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
                                        <div class="form-control-static">
										 
<b>购买者信息</b>  <?php  echo $item['addressdata']['address'];?> <?php  echo $item['addressdata']['realname'];?> <?php  echo $item['addressdata']['mobile'];?><br/>
<b>买家实付</b>： <span id='orderprice'><?php  echo $item['price']-$item['dispatchprice']?></span> + <span id='dispatchprice'><?php  echo $item['dispatchprice'];?></span> <span id='changeprice'></span> = <span id='lastprice'><?php  echo $item['price'];?></span><br/>
<b>买家实付</b> = 原价 + 运费 + 涨价或减价<br/><br/>
<b><span style='color:red'>*</span>该订单最多支持99次改价，您已经修改 <span style='color:red'><?php  echo $item['ordersn2'];?></span> 次<br/>
                                        </div>
                                    </div>
                        </div>
                   
                        <div id="module-menus"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary span2" name="confirmchange" value="yes" onclick='return mc_check()'>确认改价</button>
                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
