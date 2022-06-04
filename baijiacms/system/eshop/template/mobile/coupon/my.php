<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>我的优惠券</title>
<link rel="stylesheet" type="text/css" href="<?php  echo WEBSITE_ROOT;?>/assets/eshop/static/mobile/static/coupon/images/style.css">
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#eee; font-family:'微软雅黑'; -moz-appearance:none;overflow-x: hidden; }
    a {text-decoration:none;}

    .tab {height:30px; font-size:13px;background:#fff;padding-right: -2px;}
    .nav {height:30px;border-bottom:2px solid #fff;  width:33.3%;  background:#fff; color:#666; text-align:center; line-height:30px; float:left;}
    .navon { border-bottom:2px solid #ff6801;  }
    .no {height:100px; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    #coupon_loading { padding:10px;color:#666;text-align: center;}
   .coupon_no {height:100px;  margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
   .coupon_menu {height:60px; width:100%; }
   .coupon_no_nav {height:38px; background:#eee; margin:0px 3%; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
   .coupon_more { height:40px; line-height:40px; font-size:14px;color:#232323; margin:10px; border-radius: 5px; background-repeat:no-repeat; border:1px solid #232323; text-align: center; }
</style>
<div class="page_topbar">
	<a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
	<div class="title">我的优惠券</div>
</div>

<div class="tab">
    <div class="nav <?php  if($used==0 && $past!=1) { ?>navon<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('coupon/my')?>'">未使用</div>
    <div class="nav <?php  if($used==1 && $past!=1) { ?>navon<?php  } ?>"  onclick="location.href='<?php  echo $this->createMobileUrl('coupon/my',array('used'=>1))?>'">已使用</div>
    <div class="nav <?php  if($past==1) { ?>navon<?php  } ?>"  onclick="location.href='<?php  echo $this->createMobileUrl('coupon/my',array('past'=>1))?>'">已过期</div>
</div>
<?php  if(empty($set['closecenter'])) { ?>
<div class="coupon_more" onclick="location.href = '<?php  echo $this->createMobileUrl('coupon/center')?>'"><i class="fa fa-gift"></i> 赶紧去领券中心看看更多优惠券~</div>
<?php  } ?>
<div id='container'></div>


<script id='tpl_empty' type='text/html'>
	<div class="coupon_no"><i class="fa fa-credit-card" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您还没有优惠券~</span></div>
</script>
<script id='tpl_list' type='text/html'>
<%each list as coupon%>
<div class="coupon_item" onclick="location.href = '<?php  echo $this->createMobileUrl('coupon/mydetail')?>&id=<%coupon.id%>'">
          <div class='bg cside side side-left'></div>
	<div class="cthumb" <%if coupon.thumb==''%>style="width:8px;"<%/if%>> <%if coupon.thumb %><img src='<%coupon.thumb%>' /><%/if%></div>
	<div class="cinfo" >
		<div class="inner" >
			<div class="name"><%coupon.couponname%></div>
			<div class="time">
			<%if coupon.timestr==''%>
			永久有效
			<%else%>
			<%if coupon.past%>已过期<%else%>
			有效期 <%coupon.timestr%>
			<%/if%>
			<%/if%></div>
		</div>
	</div>
	 <div class="cright"> 
		   <div class="bg png png-<%coupon.css%>"></div>
		   <div class="bg sideleft side side-<%coupon.css%>"></div> 
		   <div class="rinfo" >
			   <div class='rinner <%coupon.css%>'>
				 <div class="price"><%if coupon.backpre%>￥<%/if%><span><%coupon._backmoney%></span></div>
				 <div class="type"><%coupon.backstr%></div> 
			   </div> 
		 </div>
		   <div class="bg sideright side side-<%coupon.css%>"></div>
		
	</div>

</div>
<%/each%>
</script>

<script language='javascript'>
var page = 1;

	  
	 core_json("<?php echo 	create_url('mobile',array('do'=>'coupon','act'=>'my','m'=>'eshop'))?>", {page:page, used:'<?php  echo $_GPC['used'];?>',past:'<?php  echo $_GPC['past'];?>'}, function(json) {
                
                    if (json.result.list.length <= 0) {
                        $("#container").html(tpl('tpl_empty'));
                        return;
                    }
                    $("#container").html(tpl('tpl_list', json.result));
                  
                     var loaded = false;
                      var stop=true; 
                      $(window).scroll(function(){ 
                          if(loaded){
                              return;
                          }
                            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
                            if($(document).height() <= totalheight){ 
                                
                                if(stop==true){ 
                                    stop=false; 
                                    $('#container').append('<div id="coupon_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core_json("<?php echo 	create_url('mobile',array('do'=>'coupon','act'=>'my','m'=>'eshop'))?>", {page:page, used: '<?php  echo $_GPC['used'];?>',past:'<?php  echo $_GPC['past'];?>'}, function(morejson) {  
                                        stop = true;
                                        $('#coupon_loading').remove();
                                        $("#container").append(tpl('tpl_list', morejson.result));
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                            $('#container').append('<div id="coupon_loading">已经加载全部优惠券</div>');
                                            loaded = true;
                                            return;
                                        }
                                    },true); 
                                } 
                            } 
                        });
                }, false);
		
 
</script>


<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>