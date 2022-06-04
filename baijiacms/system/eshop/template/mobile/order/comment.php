<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>评价</title>
<link href="<?php  echo RESOURCE_ROOT;?>eshop/static/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css"/>
<style type="text/css">
    body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
 
    .comment_sub1 {height:44px; margin:14px 5px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .comment_sub2 {height:44px; margin:14px 5px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}

    .comment_good {height:auto;padding:10px;background:#fff;  margin-top:16px; border-bottom:1px solid #eaeaea; border-top:1px solid #eaeaea;}
    .comment_good .good {height:65px;  padding:5px 0px; border-bottom:1px solid #eaeaea;}
    .comment_good .good  .img {height:50px; width:50px; float:left;}
    .comment_good .good .img img {height:100%; width:100%;}
    .comment_good .good  .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
    .comment_good .good  .info .inner { margin-left:60px;margin-right:60px; }
    .comment_good .good .info .inner .name {height:32px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
    .comment_good .good  .info .inner .option {height:18px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
    .comment_good .good  span { color:#666;}
    .comment_good .good  .price { float:right;width:60px;;height:54px;margin-left:-60px;;}
    .comment_good .good  .price .pnum { height:18px;width:100%;text-align:right;font-size:14px; }
    .comment_good .good  .price .num { height:18px;width:100%;text-align:right;}
    .comment_good .good  .price .pcomment { color:#ff6600;}

    .comment_good .text {height:34px; line-height:34px; text-align:right; font-size:16px; color:#999;}
    
    .comment_main {height:250px;padding:5px;   margin-top:14px; background:#fff; }
    .comment_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;}
    .comment_main .line span {float:left;width:80px;}
    .comment_main .line input {float:left; height:44px; width:72%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
    .comment_main .line select  {float:left; border:none;height:25px;width:72%;color:#666;font-size:16px;margin-top:10px;}
    .comment_main .line1 {width:100%; height:80px; color:#666; font-size:13px;}
    textarea {height:60px;line-height:22px; width:100%;padding:5px;font-size:13px; background:#fff; padding-left:2%; border:1px solid #e9e9e9; margin:14px 0px 0; -webkit-appearance: none;} 

    .comment_main .pic { border:1px solid #e9e9e9;width:100%;height:40px;border-radius:5px;color:#999;padding:3px;line-height:35px;font-size:13px;padding-left:10px;}
    .comment_main .pic span {float:left;width:150px;}
    .comment_main .pic .plus { float:right;width:30px;height:30px;border:1px solid #e9e9e9; color:#dedede;; font-size:18px;line-height:30px;text-align:center;}
    .comment_main .pic .plus i { left:7px;top:7px;}
    .comment_main .pic .images {float: right; width:auto;height:30px;}
    .comment_main .pic .images .img { float:left; position:relative;width:30px;height:30px;border:1px solid #e9e9e9;margin-right:5px;}
   .comment_main .pic .images .img img { position:absolute;top:0; width:100%;height:100%;}
    .comment_main .pic .images .img .minus { position:absolute;color:red;width:8px;height:12px;top:-15px;right:-1px;}

</style>
<link href="<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/js/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php  echo RESOURCE_ROOT;?>eshop/mobile/default/static/js/star-rating.js" type="text/javascript"></script>
<script src="<?php  echo RESOURCE_ROOT;?>eshop/static/js/dist/ajaxfileupload.js?v=9" type="text/javascript"></script>

<div id='container'></div>

<script id='comment_info' type='text/html'>
    <div id='comment_div'>
     <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title"><%if order.iscomment==0%>评价<%/if%><%if order.iscomment==1%>追加评价<%/if%></div>
    </div>


        <div class="comment_good">
            <%each goods as g%>
            <div class="good">

                    <div class="img"  onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'"><img src="<%g.thumb%>"/></div>
                    <div class='info' onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'">
                        <div class='inner'>
                               <div class="name"><%g.title%></div>     
                               <div class='option'><%if g.optionid!='0'%>规格:  <%g.optiontitle%><%/if%></div>
                        </div>
                    </div>
                    <div class="price">
                        <div class='pnum'><span class='marketprice'>￥<%g.price%></span></div>
                        <div class='pnum'><span class='total'>×<%g.total%></span></div>
                        <div class='pnum pcomment'>评价</div>
                    </div>
                </div>
           
            <div class="comment_main" 
                 data-ogid='<%g.id%>'
                 data-goodsid='<%g.goodsid%>'
                 style='height:200px;display:none' 
                 >
                <%if order.iscomment==0%>
                <div class="line"> <input value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" ></div>
                <%/if%>
                <div class="line1"><textarea placeholder='说点什么吧~~'></textarea></div>
                <div class="line" style='border:none'> 
                    <div class="pic">
                        晒图(最多5张)
                        <div class="plus" style="position:relative"><i class="fa fa-plus" style="position:absolute;"></i>
                            <input type="file" name='imgFile<%g.id%>' id='imgFile<%g.id%>' style="position:absolute;width:30px;height:30px;-webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;" /></div>
                        <div class="images"></div>
                    </div>
                </div>
            
        </div>
 
            <%/each%>
        </div>
        <form action='' method="post" >
            <div class="comment_main" data-ogid='0'>
                <%if order.iscomment==0%>
                <div class="line"> <input id="level"  value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" ></div>
                <%/if%>
                <div class="line1"><textarea id='content' placeholder='说点什么吧~~'></textarea></div>
                <div class="line1"> 
                    <div class="pic">
                        晒图(最多5张)
                        <div class="plus" style="position:relative"><i class="fa fa-plus" style="position:absolute;"></i>
                            <input type="file" name='imgFile0' id='imgFile0' style="position:absolute;width:30px;height:30px;-webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;" /></div>
                        <div class="images"></div>
                    </div>
                </div> </div>
    </div>
    <div class="comment_sub1" id='comment_submit'>提交评论</div>
</div>
</form>
        
</script>
<script id="tpl_img" type="text/html">
    <div class='img' data-img='<%filename%>'>
       <img src='<%url%>' />
       <div class='minus'><i class='fa fa-minus-circle'></i></div>
   </div>
</script>

<script language="javascript">


    var orderid = "<?php  echo $_GPC['orderid'];?>";



        core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>", {op: 'comment', orderid: orderid}, function(json) {
            if(json.status==1){
               $('#container').html(tpl('comment_info', json.result));    
            }
            else{
                tip_message( json.result, "<?php  echo $this->createMobileUrl('order/detail',array('id'=>$_GPC['orderid']))?>",'error');
                return;
            }
            
            if (json.result.order.status == 3) {
                document.title = "评价";
            }
            else {
                document.title = "追加评价";
            }

            $(".rating").rating({});

$('.pcomment').click(function(){
    
    if($(this).attr('open')){
        $(this).closest('.good').next().slideUp(100);
        $(this).removeAttr('open')
    }
    else{
        $('.comment_main[data-ogid!=0]').hide();
        $(this).closest('.good').next().slideDown(100);
        $(this).attr('open','1');
    }
    
})
            $('.plus input').change(function() {

                tip_show('正在上传');
                var comment =$(this).closest('.comment_main');
                var ogid = comment.data('ogid');
                
                $.ajaxFileUpload({
                    url: "<?php echo 	create_url('mobile',array('do'=>'util','act'=>'uploader','m'=>'eshop'))?>",
                    data: {file: "imgFile" + ogid},
                    secureuri: false, 
                    fileElementId: 'imgFile'+ ogid, 
                    dataType: 'json', 
                    success: function(res, status) {
                  
                        var obj = $(tpl('tpl_img', res));
                        $('.images',comment).append(obj);
                        $('.minus',comment).click(function() {
                         
                            core_json("<?php echo 	create_url('mobile',array('do'=>'util','act'=>'uploader','m'=>'eshop'))?>", {op: 'remove', file: $(obj).data('img')}, function(rjson) {
                                if (rjson.status == 1) {
                                    $(obj).remove();
                                }
                                $('.plus',comment).show();
                            }, false, true);
                        });

                        if ($('.img',comment).length >= 5) {
                            $('.plus',comment).hide();
                        }
                    }, error: function(data, status, e) {
                   
                        tip_show('上传失败!');
                    }
                });
            });
 
            $('#comment_submit').click(function() {
                
             
                if ($(this).attr('saving') == '1') {
                    return;
                }
                if($("#level").length>0 && $("#level").val()=='0'){
                    tip_show('请选择评分');
                    return;
                }
                 if($.trim( $("#content").val() )==''){
                    tip_show('您不说点什么~');
                    $('#content').focus();
                    return;
                }
                $(this).html('正在处理...').attr('saving', 1);
             
                var c0 = $('.comment_main[data-ogid=0]');
                var cimages = [];
                c0.find(".img").each(function(){
                   cimages.push($(this).data('img'));
                });
                var comments = [];
             
                $('.comment_main[data-ogid!=0]').each(function(){
                    var level = $(this).find('.rating').val();
                    if(level=='0'){
                        level = c0.find('.rating').val();
                    }
                    var content = $(this).find('textarea').val();
                    if(content==''){
                        content = c0.find('textarea').val();
                    }
                    var images = [];
                    $(this).find('.img').each(function(){
                       images.push($(this).data('img'));
                    });
                    if(images.length<=0){
                         images = cimages;
                    }
                    comments.push({goodsid:$(this).data('goodsid'),level: level, content:content,images:images});
                })
               
                core_json("<?php echo 	create_url('mobile',array('do'=>'order','act'=>'op','m'=>'eshop'))?>", {
                    op: 'comment',
                    orderid: orderid,
                    comments: comments
                }, function(postjson) {
                    if (postjson.status == 1) {
                       // history.back();
                       
                       location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'detail','m'=>'eshop'))?>&id="+orderid;
                       //location.href ="<?php  echo referer()?>";
                    }
                    else {
                        $(this).html('提交评论').removeAttr('saving');
                        tip_show('操作失败');
                    }
                }, true);

            });
 


        }, false);


</script>

<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>