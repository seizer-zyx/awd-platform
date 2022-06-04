<?php defined('IN_IA') or exit('Access Denied');?><!-- 预览 start -->
<div id="modal-module-menus3"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 413px;'>
        <div class="fe-phone">
            <div class="fe-phone-left"></div>
            <div class="fe-phone-center">
                <div class="fe-phone-top"></div>
                <div class="fe-phone-main">
                    <iframe style="border:0px; width:342px; height:600px; padding:0px; margin: 0px;" src=""></iframe>
                </div>
                <div class="fe-phone-bottom" style="overflow:hidden;">
                    <div style="height:52px; width: 52px; border-radius: 52px; margin:20px 0px 0px 159px; cursor: pointer;" data-dismiss="modal" aria-hidden="true" title="点击关闭"></div>
                </div>
            </div>
            <div class="fe-phone-right"></div>
        </div>
    </div>
</div>
<!-- 预览 end -->    

<!-- choose hrefurl start -->
<div id="floating-link"  class="modal fade" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择链接</h3></div>
            <div class="modal-body" >
                <ul class="nav nav-tabs">
                    <li id="fe-tab-link-nav-1" class="active"><a href="javascript:switchtab('fe-tab-link',1);">商城页面</a></li>
                    <li id="fe-tab-link-nav-2"><a href="javascript:switchtab('fe-tab-link',2);">商品链接</a></li>
                    <li id="fe-tab-link-nav-3"><a href="javascript:switchtab('fe-tab-link',3);">公告链接</a></li>
                    <li id="fe-tab-link-nav-4"><a href="javascript:switchtab('fe-tab-link',4);">商品分类</a></li>
                </ul>
                <div>
                    <div class="fe-tab-link" id="fe-tab-link-1" style="display: block;">
                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 商城页面链接</h4>
                        </div>
                        <div id="fe-tab-link-li-11" class="btn btn-default" ng-click="chooseLink(1, 11)" data-href="<?php  echo $this->createMobileUrl('shop/index')?>">商城首页</div>
                        <div id="fe-tab-link-li-12" class="btn btn-default" ng-click="chooseLink(1, 12)" data-href="<?php  echo $this->createMobileUrl('shop/category')?>">分类导航</div>
                        <div id="fe-tab-link-li-13" class="btn btn-default" ng-click="chooseLink(1, 13)" data-href="<?php  echo create_url('mobile',array('act'=>'index','do'=>'goods','m'=>'eshop'))?>">全部商品</div>
                        <div id="fe-tab-link-li-14" class="btn btn-default" ng-click="chooseLink(1, 14)" data-href="<?php  echo $this->createMobileUrl('shop/notice')?>">公告页面</div>
                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 会员中心链接</h4>
                        </div>
                        <div id="fe-tab-link-li-21" class="btn btn-default" ng-click="chooseLink(1, 21)" data-href="<?php  echo create_url('mobile',array('act'=>'shopwap','do'=>'membercenter'))?>">会员中心</div>
                        <div id="fe-tab-link-li-22" class="btn btn-default" ng-click="chooseLink(1, 22)" data-href="<?php  echo create_url('mobile',array('act'=>'list','do'=>'order','m'=>'eshop'))?>">我的订单</div>
                        <div id="fe-tab-link-li-23" class="btn btn-default" ng-click="chooseLink(1, 23)" data-href="<?php  echo $this->createMobileUrl('shop/cart')?>">我的购物车</div>
                        <div id="fe-tab-link-li-24" class="btn btn-default" ng-click="chooseLink(1, 24)" data-href="<?php  echo $this->createMobileUrl('shop/favorite')?>">我的收藏</div>
                        <div id="fe-tab-link-li-25" class="btn btn-default" ng-click="chooseLink(1, 25)" data-href="<?php  echo $this->createMobileUrl('shop/history')?>">我的足迹</div>
                        <div id="fe-tab-link-li-26" class="btn btn-default" ng-click="chooseLink(1, 26)" data-href="<?php  echo create_url('mobile',array('act'=>'recharge','do'=>'member','m'=>'eshop'))?>">会员充值</div>
                        <div id="fe-tab-link-li-27" class="btn btn-default" ng-click="chooseLink(1, 27)" data-href="<?php  echo create_url('mobile',array('act'=>'log','do'=>'member','m'=>'eshop'))?>">余额明细</div>
                        <div id="fe-tab-link-li-28" class="btn btn-default" ng-click="chooseLink(1, 28)" data-href="<?php  echo create_url('mobile',array('act'=>'withdraw','do'=>'member','m'=>'eshop'))?>">余额提现</div>
                        <div id="fe-tab-link-li-29" class="btn btn-default" ng-click="chooseLink(1, 29)" data-href="<?php  echo $this->createMobileUrl('shop/address')?>">我的收货地址</div>
                        
                        <?php  if(p('commission')) { ?>
                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 分销链接</h4>
                        </div>
                        
                        <div id="fe-tab-link-li-31" class="btn btn-default" ng-click="chooseLink(1, 31)" data-href="<?php  echo $this->createMobileUrl('commission')?>">分销中心</div>
                        <div id="fe-tab-link-li-34" class="btn btn-default" ng-click="chooseLink(1, 34)" data-href="<?php  echo $this->createMobileUrl('commission/withdraw')?>">佣金提现</div>
                        <div id="fe-tab-link-li-35" class="btn btn-default" ng-click="chooseLink(1, 35)" data-href="<?php  echo $this->createMobileUrl('commission/order')?>">分销订单</div>
                        <div id="fe-tab-link-li-36" class="btn btn-default" ng-click="chooseLink(1, 36)" data-href="<?php  echo $this->createMobileUrl('commission/team')?>">我的团队</div>
                        <div id="fe-tab-link-li-37" class="btn btn-default" ng-click="chooseLink(1, 37)" data-href="<?php  echo $this->createMobileUrl('commission/log')?>">佣金明细</div>
                        <?php  } ?>
                        
						
		    <?php  if(p('coupon')) { ?>
                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 超级券链接</h4>
                        </div>
                        
                        <div id="fe-tab-link-li-40" class="btn btn-default" ng-click="chooseLink(1, 40)" data-href="<?php  echo $this->createMobileUrl('coupon/center')?>">优惠券领取中心</div>
		    <div id="fe-tab-link-li-41" class="btn btn-default" ng-click="chooseLink(1, 41)" data-href="<?php  echo $this->createMobileUrl('coupon/my')?>">我的优惠券</div>
                        <?php  } ?>
                        
                        
                        
                    </div>

                    <div class="fe-tab-link" id="fe-tab-link-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" value="" id="select-good-kw" placeholder="请输入商品名称进行搜索">
                            <span class="input-group-btn"><button type="button" class="btn btn-default" ng-click="ajaxselect('good');" id="selectgood">搜索</button></span>
                        </div>
                        <div ng-repeat="good in temp.good">
                            <div class="fe-tab-link-line" style='height:60px;line-height:60px;float:left;width:100%;'>
                                <div class="fe-tab-link-sub"><a href="javascript:;" ng-click="chooseLink(2, good.id)">选择</a></div>
                                <div style="float:left;">
	                            	<img src="{{good.thumb}}" style='width:50px;height:50px;padding:1px;border:1px solid #ccc' />
	                            </div>
                            
                                <div class="fe-tab-link-text" style="float:left" id="fe-tab-link-li-{{good.id}}" 
                                	data-href="<?php  echo $this->createMobileUrl('shop/detail')?>&id={{good.id}}"
                                	>
                                	 
                                	{{good.title}}(现价:{{good.marketprice}}&nbsp;&nbsp;原价:{{good.productprice}})</div>
                                 </div>
                            
                        </div> 
                    </div>

                    <div class="fe-tab-link" id="fe-tab-link-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" value="" id="select-notice-kw" placeholder=请输入公告标题进行搜索>
                            <span class="input-group-btn"><button type="button" class="btn btn-default" ng-click="ajaxselect('notice');" id="selectgood">搜索</button></span>
                        </div>
                        <div ng-repeat="notice in temp.notice">
                            <div class="fe-tab-link-line">
                                <div class="fe-tab-link-sub"><a href="javascript:;" ng-click="chooseLink(3, notice.id)">选择</a></div>
                                <div class="fe-tab-link-text" id="fe-tab-link-li-{{notice.id}}" data-href="notice id:{{notice.id}}">{{notice.title}}</div>
                            </div>
                        </div> 
                        <p ng-show="temp.notice == ''" style="padding:0px; margin-top: 120px; font-size: 16px; color: #aaa; text-align: center;">抱歉， 一个公告也没有找到~换个关键词试试~</p>
                    </div>
                    <?php    $categorys = pdo_fetchall("SELECT id,name,parentid FROM " . tablename('eshop_category') . " WHERE enabled=:enabled and uniacid= :uniacid  ", array(
        ':uniacid' => $_W['uniacid'],
        ':enabled' => '1'
    )); ?>
                    <div class="fe-tab-link" id="fe-tab-link-4">
                        <?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
                        <?php  if(empty($category['parentid'])) { ?>
                        <div class="fe-tab-link-line">
                            <div class="fe-tab-link-sub"><a href="javascript:;" ng-click="chooseLink(4, <?php  echo $category['id'];?>)">选择</a></div>
                            <div class="fe-tab-link-text" id="fe-tab-link-li-<?php  echo $category['id'];?>" data-href="<?php  echo $this->createMobileUrl('shop/list',array('pcate'=>$category['id']))?>"><?php  echo $category['name'];?></div>
                        </div>
                        <?php  if(is_array($categorys)) { foreach($categorys as $category2) { ?>
                        <?php  if($category2['parentid']==$category['id']) { ?>
                        <div class="fe-tab-link-line">
                            <div class="fe-tab-link-sub"><a href="javascript:;" ng-click="chooseLink(4, <?php  echo $category2['id'];?>)">选择</a></div>
                            <div class="fe-tab-link-text" id="fe-tab-link-li-<?php  echo $category2['id'];?>" data-href="<?php  echo $this->createMobileUrl('shop/list',array('pcate'=>$category['id'],'ccate'=>$category2['id']))?>"><span style='height:10px; width: 10px; margin-left: 10px; margin-right: 10px; display:inline-block; border-bottom: 1px dashed #ddd; border-left: 1px dashed #ddd;'></span><?php  echo $category2['name'];?></div>
                        </div>
                        <?php  if(is_array($categorys)) { foreach($categorys as $category3) { ?>
                        <?php  if($category3['parentid']==$category2['id']) { ?>
                        <div class="fe-tab-link-line">
                            <div class="fe-tab-link-sub"><a href="javascript:;" ng-click="chooseLink(4, <?php  echo $category3['id'];?>)">选择</a></div>
                            <div class="fe-tab-link-text" id="fe-tab-link-li-<?php  echo $category3['id'];?>" data-href="<?php  echo $this->createMobileUrl('shop/list',array('pcate'=>$category['id'],'ccate'=>$category2['id'],'tcate'=>$category3['id']))?>"><span style='height:10px; width: 10px; margin-left: 30px; margin-right: 10px; display:inline-block; border-bottom: 1px dashed #ddd; border-left: 1px dashed #ddd;'></span><?php  echo $category3['name'];?></div>
                        </div>
                        <?php  } ?>
                        <?php  } } ?>
                        <?php  } ?>
                        <?php  } } ?>
                        <?php  } ?>
                        <?php  } } ?>
                    </div>
                  
                    
                </div>
            </div>
            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
        </div>
    </div>
</div>
<!-- choose hrefurl end -->    

<!-- choose good start -->
<div id="floating-good"  class="modal fade" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择商品</h3></div>
            <div class="modal-body" >
                <div class="row" style="padding:0px 15px;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="" id="secect-kw" placeholder="请输入商品名称进行查询筛选" />
                        <span class='input-group-btn'><button type="button" class="btn btn-default" ng-click="selectgood(focus);" id="selectgood">搜索</button></span>
                    </div>
                </div>
                <div id="module-menus" style="padding-top:5px; overflow: auto;max-height:500px;">
                    <div ng-repeat="good in selectGoods">
                        <div style="height:177px; width:137px; float: left; padding: 5px; margin: 5px; background: #f4f4f4; margin-top: 5px;" ng-click="pushGood(focus, good.id)">
                            <div style="height: 127px; width: 127px; background: #eee; float: left; position: relative; cursor: pointer;">
                                <img src="{{good.img}}" width="100%" height="100%" />
                                <div style="height: 24px; width: 127px; background: rgba(0,0,0,0.3); position: absolute; bottom:0px; left: 0px; color:#fff; font-size: 12px; line-height: 24px;">￥{{good.pricenow}}<span style="text-decoration: line-through; margin-left:4px;">￥{{good.priceold}}</span></div>
                            </div>
                            <div style="height: 40px; width: 127px; font-size: 13px; line-height: 20px; text-align: center; overflow: hidden;">{{good.name}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
        </div>
    </div>
</div>

<!-- choose good end -->  
