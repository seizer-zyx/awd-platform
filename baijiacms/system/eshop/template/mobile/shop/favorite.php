<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>我的收藏</title>
<style type="text/css">
body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#f8f8f8; -moz-appearance:none;}
.favorite_no {height:40px;  padding-top:100px; margin:50px 0px;}
.favorite_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
.favorite_top {height:44px; background:#f8f8f8; padding:5px; border-bottom:1px solid #e3e3e3;}
.favorite_top .title { margin-left: 5px;height:44px; width:auto; float:left; font-size:16px; line-height:44px; color:#666;}
.favorite_top .nav {height:30px; width:auto; background:#fff; padding:0px 10px; border:1px solid #e3e3e3; border-radius:5px; float:right; line-height:30px; margin:6px 0px 0px 16px; color:#666; font-size:14px;}
.favorite_main {height:auto; width:100%;background:#fff; border-bottom:1px solid #e3e3e3;}
.favorite_good {height:80px; width:100%; padding:10px 0px; border-bottom:1px solid #e3e3e3;}
.favorite_good .ico {margin-left:10px;height:20px; width:30px;  float:left ; font-size:24px;margin-top:25px;color:#666;z-index:2;position: relative;}
.favorite_good .img {height:80px; width:80px; float:left;z-index:2;position: relative;}
.favorite_good .img img {height:100%; width:100%}
.favorite_good .info {height:80px; width:100%; float:left;margin-left:-120px;margin-right:-30px;position: relative;}
.favorite_good .info .inner {margin-left:130px;margin-right:30px;}
.favorite_good .info .inner .name {height:40px; width:100%; line-height:20px; color:#666; overflow:hidden; font-size:14px;}
.favorite_good .info .inner .other {height:30px; width:100%; margin-top:10px;}
.favorite_good .info .inner .other .price {height:30px; width:auto; float:left; line-height:30px; font-size:14px; color:#666; overflow:hidden; color:red;}
.favorite_good .info .inner .other .price span {color:#666;font-size:12px;text-decoration: line-through}
.favorite_good .right { float:right;width:30px;height:20px;margin-left:-30px; color:#666;font-size:18px;margin-top:25px;text-align:center;z-index:2;position: relative;}
.favorite_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
.favorite_no_menu {height:40px; width:100%;}
.favorite_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
#favorite_loading { padding:10px;color:#666;text-align: center;}
</style>
<div id='container'></div>
<script id='favorite_empty' type='text/html'>
     <div class="favorite_no"><i class="fa fa-heart" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">您没有收藏过任何商品</span><br>主人快去给我找点东西吧</div>
<div class="favorite_no_menu">
   <div class="favorite_no_nav" onclick="location.href='<?php  echo $this->createMobileUrl('member')?>'">个人中心</div>
        <div class="favorite_no_nav"  onclick="location.href='<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'index','m'=>'eshop'))?>'">去逛逛</div>
 </div>
</script>
<script id="favorite_main" type="text/html">
      <div class="favorite_top">
        <div class="title" onclick='history.back()'> <i class='fa fa-chevron-left'></i> 我的收藏(<%total%>)</div>
        <div class="nav" id="removefavorite">删除</div>
    </div>
    <div class="favorite_main"></div>
</script>
<script id='favorite_list' type='text/html'>
   
  
        <%each list as value%> 
        <div class="favorite_good" data-favoriteid="<%value.id%>" sel='0'>
            <div class="ico"><i class="fa fa-circle-o" ></i></div>
            <div class="img" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.goodsid%>'"><img src="<%value.thumb%>"/></div>
            <div class="info" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.goodsid%>'">
                <div class="inner">
                    <div class="name"><%value.title%></div>
                      <div class="other">
                             <div class="price">￥<%value.marketprice%> <span>￥<%value.productprice%><span></div>
                      </div>
                </div>
            </div>
            <div class="right remove">
                <i class="fa fa-times"></i>
            </div>
        </div>
      <%/each%>
 
</script>
<script language='javascript'>
    var page= 1;
 
    function setSelect(obj, sel){
            if(sel=='1'){
                         obj.find('i').addClass('fa-circle-o').removeClass('fa-check-circle-o').css('color', '#666');
                    }
                    else{
                         obj.find('i').removeClass('fa-circle-o').addClass('fa-check-circle-o').css('color', '#0c9');
                    }
                    sel =sel==1?0:1;
                    obj.parent().attr('sel',sel);
               
                    calctotal();
    }
    function calctotal(){
           var total = 0;
        $(".favorite_good").each(function(){
            var $this = $(this);
            var sel = $this.attr('sel')=='1';
            if(sel){
                total++;
            }
        });
           if(total<=0){
                $("#removefavorite").addClass('disabled');
            }
            else{
                $("#removefavorite").removeClass('disabled');
            }

        return total;
    }
    
   
       
     
        function bindEvents(){
                               
                                  $(".ico").unbind('click').click(function(){
                                           setSelect($(this),$(this).parent().attr('sel'))
                                  });

                              
                                $('.remove').click(function(){
                                          var ids = [ $(this).closest('.favorite_good').data('favoriteid') ];
                                          removeFavorite(ids); 
                                   });

                     }

                     function removeFavorite(ids){
                        if(ids.length<=0){
                                   tip_show('未选择商品');
                                   return;
                               }
                              tip_confirm('确认从我的收藏删除这些商品?',function(){
                                           $('.favorite_good').attr('del',0);
                                           
                                           core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'favorite','m'=>'eshop'))?>",{'op':'remove',ids:ids},function(json){
                                                if(json.status==1)  {
                                                    for(var i in ids){
                                                        $('.favorite_good[data-favoriteid=' + ids[i]+ ']').attr('del',1).fadeOut(500,function(){
                                                            $('.favorite_good[data-favoriteid=' + ids[i]+ ']').remove();
                                                        })
                                                    }
                                                   if($('.favorite_good[del=0]').length<=0){
                                                        $('#container').html(  tpl('favorite_empty') );
                                                   }
                                                   else{
                                                       calctotal();    
                                                   }
                                                }
                                                else{
                                                    tip_show('删除失败');
                                                }
                                           },true);

                            });
                  }
                  
       
        core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'favorite','m'=>'eshop'))?>",{},function(json){

               
                      
                    if(json.result.total<=0){
                        $('#container').html(  tpl('favorite_empty') );
                         return;
                     }
                     
                     $('#container').html(  tpl('favorite_main',json.result) );
                 
                     $('#removefavorite').click(function(){
                            var ids = [];
                            $('.favorite_good[sel=1]').each(function(){
                                ids.push($(this).data('favoriteid')) ;
                            });
                            removeFavorite(ids);
                     });
                     
                     
                     $('.favorite_main').html(  tpl('favorite_list',json.result) );
                    bindEvents();
              
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
                                    $('.favorite_main').append('<div id="favorite_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'favorite','m'=>'eshop'))?>", {page:page}, function(morejson) {  
                                        stop = true;
                                        $('#favorite_loading').remove();
                                        $(".favorite_main").append(tpl('favorite_list', morejson.result));
                                        bindEvents();
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                          
                                            $('.favorite_main').append('<div id="favorite_loading">已经加载完全部收藏</div>');
                                            loaded = true;
                                            $(window).scroll = null;
                                            return;
                                        }
                                    },true); 
                                } 
                            } 
                        });
            
                  
              
                     
         },false);

</script>
<?php  $show_footer=true;?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>
