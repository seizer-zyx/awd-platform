<?php defined('IN_IA') or exit('Access Denied');?>
<?php include page('header_base');?>
<?php include page('header_plus');?>
<title>我的购物车</title>
<style type="text/css">
body {<?php if(is_mobile()){?>margin:0px;<?php }?>background:#f8f8f8;}
.cart_no {height:40px; width:100%;  padding-top:180px; margin:50px 0px;}
.cart_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}

.cart_top {height:44px; width:97%;  background:#f8f8f8;padding:5px;padding:5px;   border-bottom:1px solid #e3e3e3;}
.cart_top .title {margin-left: 5px;height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#666;}
.cart_top .nav {height:30px; width:auto;background:#fff; padding:0px 10px; border:1px solid #e3e3e3; border-radius:5px; float:right; line-height:30px; margin:6px 0px 0px 16px; color:#666; font-size:14px;}
.cart_main { height:auto;margin-bottom:100px; }
.cart_good {height:80px;  padding:10px 0px; border-bottom:1px solid #e3e3e3;}

.cart_good .ico {height:20px; width:30px; text-align: center; margin-top:25px; float:left;font-size:24px;z-index:2;position: relative;}

.cart_good .img {height:80px; width:80px;  float:left;z-index:88;z-index:2;position: relative;}
.cart_good .img img {height:100%; width:100%}

.cart_good .info {height:80px; width:100%; float:left;margin-left: -110px;margin-right:-100px;position: relative;}
.cart_good .info .inner { margin-left:120px;margin-right:100px;}
.cart_good .info .inner .name {height:40px; width:100%; line-height:20px; color:#666;  font-size:14px;overflow:hidden}
.cart_good .info .inner .optionsel {height:30px; width:50%; float:left; line-height:30px; font-size:14px; color:#999; border-bottom:1px solid #999;}
.cart_good .info .inner .optionsel .content { float:left;width:100%;overflow:hidden;height:30px;}
.cart_good .info .inner .optionsel .content .cinner { margin-right: 20px;}
.cart_good .info .inner .optionsel .cico { float:right;width:20px;text-align:center;margin-left:-20px;height:30px;line-height: 30px;}
.cart_good .other {position:relative;height:80px; width:80px; ;float:right;margin-left:-100px;margin-right: 10px;z-index:2;position: relative;}
.cart_good .other .price,.cart_good .other .price1 { width:100%;height:20px;text-align:right;color:#666;font-size:14px; }
.cart_good .other .price1 { text-decoration:line-through;color:#999;}
.cart_good .other .num {height:28px; width:80px; border:1px solid #e2e2e2; margin-top:5px;}
.cart_good .other .num .leftnav {height:28px; width:25px; float:left; border-right:1px solid #e2e2e2; background:#eee; color:#6b6b6b; text-align:center; line-height:24px; font-size:20px; font-weight:bold;}
.cart_good .other .num .shownum {height:28px; width:26px; float:left; border:0px; margin:0px; padding:0px; text-align:center;}
.cart_good .other .num .rightnav {height:28px; width:25px; float:right; border-left:1px solid #e2e2e2; background:#eee; color:#6b6b6b; text-align:center; line-height:24px; font-size:20px; font-weight:bold;}

.cart_pay {margin-bottom:50px;float:left;height:54px; <?php if(is_mobile()){?>width:94%; padding: 0 3%;border-top:1px solid #e1e1e1; <?php }else{?>width:100%;<?php }?>background:#eee;  position:fixed; bottom:0px; }
.cart_pay .all {height:54px; width:100px;  float:left; line-height:50px; font-size:14px; color:#999; }
.cart_pay .all i { font-size:24px;margin-top:15px; float:left;}
.cart_pay .all .t { float:left;margin-left:5px;}
.cart_pay .paysub {height:40px; width:auto; padding:0px 10px; background:#e43a3d; float:right; border-radius:5px; font-size:14px; line-height:40px; color:#fff; margin-top:7px;}
.cart_pay .disabled { background:#ccc;}
.cart_pay .text {height:40px; width:auto; float:right; line-height:20px; color:#666; font-size:14px; margin:7px 20px 0px;}
.cart_pay .text span {color:#e43a3d;}

.cart_count {height:40px; padding:0 3px; text-align:right; color:#bbb; font-size:14px; line-height:40px;}
.cart_count span {color:#666;}
.cart_top .disabled { color:#ccc;}
 

.card_no {height:100px;  margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
.card_no_menu {height:40px; width:100%;}
.card_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}



</style>
<div id='options'></div>
<div id='container'></div>
<script id='option_info' type='text/html'>
 <div class="good_choose_layer"></div>
    <div class="good_choose"  style="margin-bottom:50px">
        <div class="info">
             <div class="left">
                 <img id="chooser_img" src="<%goods.thumb%>"/>
             </div>
             <div class="right">
                   <div class="price">￥<span id='option_price'><%goods.marketprice%></span></div>
                   <div class="stock">库存:<span id='option_stock'><%goods.total%></span>件</span> </div>
                   <div class="option">请选择规格</div>
             </div>
            <div class="close" onClick="choose2(true)"><i class="fa fa-remove-o"></i></div>
        </div>
        <div class="other">
            <input type='hidden' id='optionid' value='' />
                <%each specs as spec%>
                <input type='hidden' name="optionid[]" class='optionid optionid_<%spec.id%>' value="" title="<%spec.title%>">
                <div class="spec"><%spec.title%></div>
                <div class="spec_items options_<%spec.id%>"  title="<%spec.title%>">
                      <%each spec.items as o%>
                      <div class="option option_<%spec.id%>" specid='<%spec.id%>' oid="<%o.id%>" sel='false' title='<%o.title%>' thumb='<%o.thumb%>'><%o.title%></div>
                     <%/each%>
                </div>
                <%/each%>
 
        </div>
        <div class="close" onClick="closechoose()"><i class="fa fa-times-circle-o"></i></div>
        <div class="sub <%if specs.length>0%>disabled<%/if%>" onClick="choose2()" style="bottom:50px">确认</div>
    </div>
 </script>   
 <script id='cart_empty' type='text/html'>
     <div class="cart_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> 购物车(0)</div>
</div>
 <div class="card_no"><i class="fa fa-shopping-cart" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">购物车是空的</span></div>
<div class="card_no_menu">
   	<div class="card_no_nav" onclick="location.href='<?php  echo $this->createMobileUrl('member')?>'">个人中心</div>
        <div class="card_no_nav"  onclick="location.href='<?php  echo $this->createMobileUrl('shop')?>'">去逛逛</div>
 </div>


     </script>
<script id='cart_list' type='text/html'>
<div class="cart_top">
    <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> 购物车(<%total%>)</div>
      <?php if(is_login_account()){?>
        <div class="nav" id='tofavorite'>移至收藏夹</div><?php }else{ ?> <div id='tofavorite'></div><?php }?>
        <div class="nav" id='removecart'>删除</div>
</div>

    <div class="cart_main">
          <%each list as value%>
             <div class="cart_good" 
                        data-cartid="<%value.id%>" 
                        data-marketprice="<%value.marketprice%>" 
                        data-goodsid="<%value.goodsid%>" 
                        sel='1' 
                        data-maxbuy='<%value.maxbuy%>' 
                        data-stock='<%value.stock%>'>
                 <div class="ico"><i class="fa fa-check-circle-o" style="color:#0C9;"></i></div>
                 <div class="img" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.goodsid%>'"><img src="<%value.thumb%>"/></div>
                 <div class="info">
                     <div class='inner' >
            	      <div class="name" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.goodsid%>'"><%value.title%></div>
                        <%if value.optionid!='0'%>
                         <div class="optionsel">
                            <div class='content'>
                                <div class="cinner"><%if optiontitle %><%value.optiontitle%><%else%>未选规格<%/if%></div>
                            </div>
                            <div class="cico"><i class="fa fa-angle-down"></i></div>
                        </div>
                        <%/if%>
                      
                    </div>
                 </div>
                     <div class="other">
                           <div class="price"><%value.marketprice%></div>  
                           <div class="price1"><span class='line'><%value.productprice%></span></div>  
                           <div class="num"><div class="leftnav">-</div><input type="text" class="shownum" value="<%value.total%>" /><div class="rightnav">+</div>
                    </div>
                </div>
            </div>
       
        <%/each%>
        <div class="cart_count">共 <span class='total'><%total%></span> 件商品 合计: ￥<span class='totalprice'><%totalprice%></span></div>
    </div>
    <div class="cart_pay" style="<?php if(is_mobile()==false){?>max-width: 750px;<?php }?>">
        <div class="all" sel="1"><i class="fa fa-check-circle-o" style="color:#0C9;"></i> <span class='t'>全选</span></div>
        <div class="paysub <%if total<=0%>disabled<%/if%>">结算(<span class='total'><%total%></span>)</div>
        <div class="text">合计：<span>￥<span  class='totalprice'><%totalprice%></span></span><br><span style="color:#999; font-size:14px;">不含运费</span></div>
    </div>
</script>
<script language="javascript">
    function choose(){
                       $('.good_choose_layer').fadeIn(200);
	     $('.good_choose').fadeIn(200);
             $('.good_choose_layer').click(function(){
                 closechoose();
             })
	}
                function closechoose(){
                      $('.good_choose_layer').fadeOut(100);
                      $('.good_choose').fadeOut(100); 
                }
	function choose2(direct){
	    
                          
	}
        
    function setSelect(obj, sel,isall){
            if(sel=='1'){
                         obj.find('i').addClass('fa-circle-o').removeClass('fa-check-circle-o').css('color', '#999');
                    }
                    else{
                         obj.find('i').removeClass('fa-circle-o').addClass('fa-check-circle-o').css('color', '#0c9');
                    }
                    sel =sel==1?0:1;
                    if(!isall){
                        obj.parent().attr('sel',sel);
                   }
                   else{
                        obj.attr('sel',sel);
                   }
                   calcprice();
    }
    function calcprice(){
           var total = 0;
            var totalprice = 0;
          
        $(".cart_good").each(function(){
            var $this = $(this);
            var sel = $this.attr('sel')=='1';
            if(sel){
               
                var num = $this.find('.shownum').val();
                
                if(isNaN(num)){
                   num = 1;
                }
                 $this.find('.shownum').val(num);
                 total+=parseInt(num);
                totalprice+= parseFloat( $this.find('.shownum').val() ) * parseFloat($this.data('marketprice'));
            }
     
        });
        
           
            $('.total').html(total);
            $('.totalprice').html(totalprice.toFixed(2));
            
            if(total<=0){
                $(".paysub").addClass('disabled');
                    $("#tofavorite").addClass('disabled');
                    $("#removecart").addClass('disabled');
            }
            else{
                $(".paysub").removeClass('disabled');
                $("#tofavorite").removeClass('disabled');
                $("#removecart").removeClass('disabled');
            }
        return total;
    }
    
	function option_sel(hasoption){
	var ret= {
		no: "",
		all: []
	};
	if(!hasoption){
		return ret;
	}
			$(".optionid").each(function(){
				ret.all.push($(this).val());
				if($(this).val()==''){
					ret.no = $(this).attr("title");
					return false;
				}
	})
	return ret;
}


      
        core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{},function(json){
            if(json.result.total<=0){
               $('#container').html(  tpl('cart_empty') );
                return;
            }
           $('#container').html(  tpl('cart_list',json.result) );
           
          var bh = $(document.body).height()/1.3 - 50;
          $('.good_choose').css('max-height',bh); 
          $('.good_choose .other').css('max-height',bh-175);
          
           $(".cart_good .names,.cart_good .img").click(function(){
                var goodsid = $(this).closest('.cart_good').data('goodsid');
                
                location.href="<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'detail','m'=>'eshop'))?>&id="+goodsid;
           });
           
           $(".ico").click(function(){
                    setSelect($(this),$(this).parent().attr('sel'))
           });
           $('.shownum').blur(function(){
               
               var maxbuy = parseInt( $(this).closest('.cart_good').data('maxbuy'));
               var stock = parseInt( $(this).closest('.cart_good').data('stock'));
           
                var input =$(this);
                if(!input.isInt()){
                    input.val('1');
                    return;
                }
                if(parseInt(input.val())<0){
                    input.val('1');
                    return;
                }
                var num = parseInt( input.val() );
            
               
               if(num>maxbuy && maxbuy>0){
                    num=maxbuy;
                    tip_show("您最多购买 " + maxbuy + "件");
                }
                else if(stock!='-1' && stock!='' && num>stock){
                    num=stock;
                    tip_show("您最多购买 " + stock + "件");
                }
                input.val(num);
            
                core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'updatenum',id:$(this).closest('.cart_good').data('cartid'),goodsid:$(this).closest('.cart_good').data('goodsid'), total:num},null,true,true);
                calcprice();
                
               
           })
            $(".all").click(function(){
                    
                   var $this = $(this);
                   var sel = $this.attr('sel');
                    
                   $(".ico").each(function(){
                       setSelect($(this),sel)
                    });
                   setSelect($(this),sel,true);
                    
            });
            
            $('.leftnav').click(function(){
                
                var input =$(this).next();
                if(!input.isInt()){
                    input.val('1');
                }
                var num = parseFloat( input.val() );
                num--;
                if(num<=0){
                    num=1;
                }
                input.val(num);
          
                core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'updatenum',id:$(this).closest('.cart_good').data('cartid'),goodsid:$(this).closest('.cart_good').data('goodsid'), total:num},null,true,true);
                calcprice();
            })
            
             $('.rightnav').click(function(){
                var maxbuy = parseInt( $(this).closest('.cart_good').data('maxbuy'));
               var stock = parseInt( $(this).closest('.cart_good').data('stock'));
             
                var input =$(this).prev();
                if(!input.isInt()){
                    input.val('1');
                } 
                var num = parseInt( input.val() );
                num++;
               
                if(num>maxbuy && maxbuy>0){
                    num=maxbuy;
                    tip_show("您最多购买 " + maxbuy + "件");
                }
                else if(stock!='-1' && stock!='' && num>stock){
                    num=stock;
                    tip_show("您最多购买 " + stock + "件");
                }
                input.val(num);
   
                core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'updatenum',id:$(this).closest('.cart_good').data('cartid'),goodsid:$(this).closest('.cart_good').data('goodsid'), total:num},null,true,true);
                calcprice();
            });
      
            $('.optionsel').click(function(){
                var id = $(this).closest('.cart_good').data('cartid');
                var goodsid = $(this).closest('.cart_good').data('goodsid');                
                 core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'selectoption',id:id,goodsid:goodsid},function(json){
  
                     $('#options').html(  tpl('option_info',json.result) );
                     $('.good_choose').data('cartid', id);
                     $('.good_choose').data('goodsid',goodsid);
                  
                     choose();
                     var options = json.result.options;
                     
                     if(options.length>0) {
                       
                        var cartspecs = json.result.cartspecs;
                        var cartoption = json.result.cartoption;
                        $("#optionid").val(json.result.cartoption.id);
                        $(".spec_items").each(function(i){
                            $(this).find('.option[oid=' +cartspecs[i] + ']' ).addClass('on');
                        });
                        var stock =0;
			var marketprice = 0;
			var productprice = 0;
			
				var len = options.length;
				for(var i=0;i<len;i++) {
					var o = options[i];
                                      
					if( o.specs==cartoption.specs){
						optionid = o.id;
						stock = o.stock;
						marketprice = o.marketprice;
						productprice = o.productprice;
						break;
					}
                                                                           }
					if(stock==0){
					   $('.sub').addClass('disabled').html('库存不足,无法购买');
					}
					else{
					     $('.sub').removeClass('disabled').html('确认');
					}
                               
				 
				
		     	$("#option_price").html(marketprice);	
		     	$("#option_stock").html(stock);	
                        
            
                       $(".spec_items .option").click(function() {
			 var specid = $(this).attr("specid");
			 var oid = $(this).attr("oid");
			$(".optionid_"+specid).val(oid);
		var temp_specid=(parseInt(specid)+1);
		var temp_spec=$(".options_" + temp_specid + "  .option");
		if(temp_spec!=null)
		{
				temp_spec.removeClass("on").attr("sel", "false");
		}
		
		temp_specid=(parseInt(temp_specid)+1);
		temp_spec=$(".options_" + temp_specid + "  .option");
		if(temp_spec!=null)
		{
				temp_spec.removeClass("on").attr("sel", "false");
		}
		
		temp_specid=(parseInt(temp_specid)+1);
		temp_spec=$(".options_" + temp_specid + "  .option");
		if(temp_spec!=null)
		{
				temp_spec.removeClass("on").attr("sel", "false");
		}
				
			$(".options_" + specid + "  .option").removeClass("on").attr("sel", "false");
			$(this).addClass("on").attr("sel", "true");
	      var titles='已选: ';
			     $('.spec_items').each(function(){
                                  if($(this).find('.on').length>0){
			        titles+= $(this).find('.on').attr('title')+";";   
                            }
			     });
                             
                             $('.good_choose .info .right .option').html(titles);
         var thumb = $(this).attr('thumb');
         if(thumb!=''){
             $("#chooser_img").attr('src',thumb);
         }
         else{
             
             $("#chooser_img").attr('src',json.result.goods.thumb);
         }
			var optionid = "";
			var stock =0;
			var marketprice = 0;
			var productprice = 0;
			 var ret = option_sel(json.result.options.length>0);
  
			if(ret.no==''){
				var len = options.length;
				for(var i=0;i<len;i++) {
					var o = options[i];
					var ids = ret.all.join("_");
					if( o.specs==ids){
						optionid = o.id;
						stock = o.stock;
						marketprice = o.marketprice;
						productprice = o.productprice;
						break;
					}
					
				}
			   $("#optionid").val(optionid); 
			    
				if(stock!="-1"){
				      $("#stockcontainer").html("库存:<span id='stock'>" + stock + "</span>");
				}
				else{
				       $("#stockcontainer").html("<span id='stock'></span>");
				}
				if(ret.no==''){
					if(stock==0){
					   $('.sub').addClass('disabled').html('库存不足,无法购买');
					}
					else{
					     $('.sub').removeClass('disabled').html('确认');
					}
				} 
				 
				
		     	$("#option_price").html(marketprice);	
		     	$("#option_stock").html(stock);	
				 
			}
		});
                                }
                  
                        $('.sub').click(function(){

                            if($("#optionid").val()==''){
                                return;
                            }
                            var id = $(this).closest('.good_choose').data('cartid');
                            var goodsid = $(this).closest('.good_choose').data('goodsid');
                            var optionid = $('#optionid').val();


                            core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'setoption',id:id,goodsid:goodsid,optionid:optionid},function(json){
                                  if(json.status==1){
                                       closechoose();
                                        
                                       $('.cart_good[data-cartid=' + id + ']').find('.cinner').html(json.result.optiontitle);
                                 }
                                 else{
                                     tip_show(json.result);
                                 }

                            },true);

                        });
                    
                
                 },true);
                
            });
            
                
                      
                        $("#tofavorite").click(function(){
                            
                            var ids = [];
                            $('.cart_good[sel=1]').each(function(){
                                ids.push($(this).data('cartid'));
                            })
                            if(ids.length<=0){
                                tip_show('未选择商品');
                                return;
                            }
                           tip_confirm('确认将这些商品移至收藏夹?',function(){
                              $('.cart_good').attr('del',0);
                               core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'tofavorite',ids:ids},function(json){
                                    if(json.status==1)  {
                                         for(var i in ids){
                                            $('.cart_good[data-cartid=' + ids[i]+ ']').attr('del',1).fadeOut(500,function(){
                                                $('.cart_good[data-cartid=' + ids[i]+ ']').remove();
                                            })
                                        }
                                        if($('.cart_good[del=0]').length<=0){
                                             $('#container').html(  tpl('cart_empty') );
                                        }
                                         else{
                                            calcprice();    
                                        }
                                    }
                                    else{
                                        tip_show('移动失败');
                                    }
                               },true,true);
                           });
                        })
                   
                        $('#removecart').click(function(){
                            var ids = [];
                            $('.cart_good[sel=1]').each(function(){
                                ids.push($(this).data('cartid')) ;
                            })
                            if(ids.length<=0){
                                tip_show('未选择商品');
                                return;
                            }
                           tip_confirm('确认从购物车删除这些商品?',function(){
                               $('.cart_good').attr('del',0);
                               core_json("<?php echo 	create_url('mobile',array('do'=>'shop','act'=>'cart','m'=>'eshop'))?>",{'op':'remove',ids:ids},function(json){
                                    if(json.status==1)  {
                                        for(var i in ids){
                                            
                                            $('.cart_good[data-cartid=' + ids[i]+ ']').attr('del',1).fadeOut(500,function(){
                                                $('.cart_good[data-cartid=' + ids[i]+ ']').remove();
                                            })
                                        }
                                       if($('.cart_good[del=0]').length<=0){
                                             $('#container').html(  tpl('cart_empty') );
                                        }
                                        else{
                                            calcprice();    
                                        }
                                        
                                    }
                                    else{
                                        tip_show('删除失败');
                                    }
                               },true,true);
                               
                           });
                            
                        });
                     
                        $('.paysub').click(function(){
                            
                          var total =  calcprice();
                          if(total<=0){
                              return;
                          }
                          var ids = [];
                          $('.cart_good[sel=1]').each(function(){
                               ids.push($(this).data('cartid'));
                          })
                          
                          location.href = "<?php echo 	create_url('mobile',array('do'=>'order','act'=>'confirm','m'=>'eshop'))?>&cartids="+ids.join(',');
                        })
                            
                    
            
       });

</script>

<?php  $show_footer=true;$footer_current='cart'?>
<?php include page('footer_menu');?>
<?php include page('footer_base');?>