<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>店铺公告</title>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;overflow-x:hidden}
    a {text-decoration:none;}
    .notice_topbar {height:40px; padding:3px;  background:#f9f9f9; border-bottom:1px solid #e8e8e8; font-size:16px; line-height:40px; text-align:center; color:#666;}
    .notice_topbar a {height:40px;margin-left:10px; width:15px; display:block; float:left; outline:0px; color:#999; font-size:24px;}

    .notice_addnav {height:44px; padding:5px;  border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:42px; color:#666; background:#fff;}
    .notice_list {height:50px; padding:5px; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:5px; background:#fff;}
    .notice_list .ico {height:50px; width:50px;  float:left; color:#999; }
    .notice_list .ico img { width:45px;height:45px;margin-top:3px;}
    .notice_list .info {height:50px; width:100%; float:left; margin-left:-50px;}
    .notice_list .info .inner { margin-left:55px;}
    .notice_list .info .inner .addr {height:20px; width:100%; color:#666; line-height:26px; font-size:14px; overflow:hidden;}
    .notice_list .info .inner .user {height:30px; width:100%; color:#999; line-height:30px; font-size:12px; overflow:hidden;}
    .notice_list .info .inner .user span {color:#444; font-size:16px;}
   
    .notice_addnav {height:40px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:40px; color:#666; }

    .notice_detail { width:100%;position:absolute;top:0;right:-100%;z-index:99999;display: none}
    .notice_main {height:auto;width:94%; padding:0px 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; background:#fff;}
    .notice_main .title {height:auto;; width:94%; padding:0px 3%;line-height:22px;word-break: break-all;font-size:16px;color:#333;padding:5px;}
    .notice_main .time {height:30px; width:94%; padding:0px 3%; border-bottom:1px solid #f0f0f0; line-height:22px;word-break: break-all;font-size:14px;color:#666;}
    .notice_main .detail { height:100%;width:94%; padding:0px 3%; word-break: break-all;}
    .notice_main .detail img { width:100%;}
    .notice_sub1 {height:44px; width:94%; margin:14px 3% 0px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .notice_sub2 {height:44px; width:94%; margin:14px 3% 0px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}

    .notice_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    .notice_no_menu {height:40px; width:100%; text-align:center;}
    .notice_no_nav {height:38px;padding:10px; width:100px; background:#eee; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
    #notice_loading { width:94%;padding:10px;color:#666;text-align: center;}
</style>
<script type="text/javascript" src="<?php  echo RESOURCE_ROOT;?>eshop/static/js/dist/area/cascade.js"></script>
<div id='container'></div>

<script id='tpl_notice_main' type='text/html'>
    <div class="page_topbar">
        <a href="<?php echo create_url('mobile',array('act' => 'center','do' => 'member','m'=>'eshop'));?>" class="back"><i class="fa fa-angle-left"></i></a>
        <div class="title">店铺公告</div>
    </div>
    
    <div id='notices'></div>
    <div id='detail_container'></div>
</script>

<script id='tpl_notice_list' type='text/html'>
   <%each list as value%>
   <div class="notice_list" 
        data-noticeid="<%value.id%>"
        data-noticeurl="<%value.link%>"
        >
        <div class="ico"><%if value.thumb%><img src='<%value.thumb%>' /><%else%><img src='<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/images/notice.png' /><%/if%></div>
        <div class="info">
            <div class="inner">
                <div class="addr"><%value.title%></div>
                <div class="user"><%value.createtime%></div>
            </div>
        </div>
    </div>
  <%/each%>
</script>

<script id='tpl_notice_data' type='text/html'>
    <div class="notice_detail">
          <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title">公告内容</div>
    </div>
        <div class="notice_main" >
            <div class="title"><%notice.title%></div>
            <div class="time"><%notice.createtime%></div>
            <div class="detail"></div>
        </div>
    </div>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="notice_no"><i class="fa fa-volume-up" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">暂时没有任何公告</span><br>可以去看看哪些想买的</div>
    <div class="notice_no_menu">
        <span class="notice_no_nav"  onclick="location.href='<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'index','m'=>'eshop'))?>'">随便逛逛</span>
    </div>
</script>
<script language="javascript">
    var page = 1;

        $('#container').html(tpl('tpl_notice_main'));
        function bindEvents() {
            $('.notice_list').unbind('click').click(function () {
                var noticeurl = $(this).data('noticeurl');
                if (noticeurl) {
                    location.href = noticeurl;
                    return;
                }
                var id = $(this).data('noticeid');
     location.href = "<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'notice','m'=>'eshop','op'=>'get'))?>&id="+id;
                    return;
       
            })
        }

        core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'notice','m'=>'eshop'))?>", {}, function (json) {


            if (json.result.list.length <= 0) {
                $("#notices").html(tpl('tpl_empty'));
                return;
            }
            $('#notices').html(tpl('tpl_notice_list', json.result));
            bindEvents();
            
            var loaded = false;
            var stop = true;
            $(window).scroll(function () {
                if (loaded) {
                    return;
                }
                totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
                if ($(document).height() <= totalheight) {

                    if (stop == true) {
                        stop = false;
                        $('#notices').append('<div id="notice_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                        page++;
                      
                        core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'notice','m'=>'eshop'))?>", {page: page}, function (morejson) {
                            stop = true;
                            $('#notice_loading').remove();
                            $('#notices').append(tpl('tpl_notice_list', morejson.result));
                            bindEvents();
                            if (morejson.result.list.length < morejson.result.pagesize) {
                                $('#notices').append('<div id="notice_loading">已经加载全部公告</div>');
                                loaded = true;
                                return;
                            }
                        }, true);
                    }
                }
            });


        }, false);

</script> 
<?php  $show_footer=true; $footer_action='notice'?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>