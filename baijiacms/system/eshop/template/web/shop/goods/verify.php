<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    body { width:100%;}
 
    .img-thumbnail { width:100px; height:100px;}
    .img-nickname { height:25px;line-height:25px;width:90px;margin-left:5px;margin-right:5px;position: absolute;bottom:55px;color:#fff;text-align: center;background:rgba(0,0,0,0.7)}
</style>
 
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持线下核销</label>
    <div class="col-sm-6 col-xs-6">

        <label class="radio-inline"><input type="radio" name="isverify" value="1" <?php  if(empty($item['isverify']) || $item['isverify'] == 1) { ?>checked="true"<?php  } ?>  /> 不支持</label>
        <label class="radio-inline"><input type="radio" name="isverify" value="2" <?php  if($item['isverify'] == 2) { ?>checked="true"<?php  } ?>   /> 支持</label>
     
        
    </div>
</div>   
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">核销门店选择</label>
    <div class="col-sm-9 col-xs-12 chks">

        <div class='input-group'>
            <input type="text" name="saler" maxlength="30" value="<?php  if(is_array($salers)) { foreach($salers as $saler) { ?> <?php  echo $saler['nickname'];?>; <?php  } } ?>" id="saler" class="form-control" readonly />
            <div class='input-group-btn'>
                <button class="btn btn-default" type="button" onclick="popwin = $('#modal-module-menus').modal();">选择门店</button>
            </div>
        </div>
   
     <div style="margin-top:.5em;" class="input-group multi-audio-details clear-fix" id='stores'>
         <?php  if(is_array($stores)) { foreach($stores as $store) { ?>
            <div style="height: 40px; position:relative; float: left; margin-right: 18px;" class="multi-audio-item" storeid="<?php  echo $store['id'];?>">
                <div class="input-group">
                    <input type="hidden" value="<?php  echo $store['id'];?>" name="storeids[]">
                    <input type="text" value="<?php  echo $store['storename'];?>" readonly="" class="form-control">
                    <div class="input-group-btn"><button type="button" onclick="remove_store(this)" class="btn btn-default"><i class="fa fa-remove"></i></button></div>
                    </div>
             </div>
         <?php  } } ?>
     </div>
          <span class='help-block'>如果不选择门店，则此商品支持在所有门店核销</span>

        <div id="modal-module-menus"  class="modal fade" tabindex="-1">
            <div class="modal-dialog" style='width: 920px;'>
                <div class="modal-content">
                    <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择门店</h3></div>
                    <div class="modal-body" >
                        <div class="row">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="请输入门店名称" />
                                <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_stores();">搜索</button></span>
                            </div>
                        </div>
                        <div id="module-menus" style="padding-top:5px;"></div>
                    </div>
                    <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
                </div>

            </div>
        </div>
          
    </div>
  
</div>
<script language='javascript'>
         function search_stores() {
		$("#module-menus").html("正在搜索....")
		$.get('<?php  echo $this->createWebUrl('verify/store',array('op'=>'query'))?>', {
			keyword: $.trim($('#search-kwd').val())
		}, function(dat){
			$('#module-menus').html(dat);
		});
	}
                    function remove_store(obj){
                         var storeid = $(obj).closest('.multi-audio-item').attr('storeid');
                         $('.multi-audio-item[storeid="' + storeid +'"]').remove();
                    }
	function select_store(o) {
                        if($('.multi-audio-item[storeid="' + o.id +'"]').length>0){
                            return;
                        }
                        var html ='<div style="height: 40px; position:relative; float: left; margin-right: 18px;" class="multi-audio-item" storeid="' + o.id +'">';
                html+='<div class="input-group">';
                    html+='<input type="hidden" value="' + o.id +'" name="storeids[]">';
                    html+='<input type="text" value="' + o.storename +'" readonly="" class="form-control">';
                    html+='<div class="input-group-btn"><button type="button" onclick="remove_store(this)" class="btn btn-default"><i class="fa fa-remove"></i></button></div>';
             html+='</div></div>';
                        $('#stores').append(html);
 	}
</script>
