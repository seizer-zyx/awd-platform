<?php defined('IN_IA') or exit('Access Denied');?>
<style type='text/css'>
    .province { float:left; position:relative;width:150px; height:35px; line-height:35px;border:1px solid #fff;}
    .province:hover { border:1px solid #f7e4a5;border-bottom:1px solid #fffec6; background:#fffec6;}
    .province .cityall { margin-top:10px;}
    .province ul { list-style: outside none none;position:absolute;padding:0;background:#fffec6;border:1px solid #f7e4a5;display:none;
    width:auto; width:300px; z-index:999999;left:-1px;top:32px;}
    .province ul li  { float:left;min-width:60px;margin-left:20px; height:30px;line-height:30px; }
 </style>
 <div id="modal-areas"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择区域</h3></div>
            <div class="modal-body" style='height:280px;;' > 
                
                <?php  if(is_array($areas['address']['province'])) { foreach($areas['address']['province'] as $value) { ?>
				<?php  if($value['@attributes']['name']=='请选择省份') { ?><?php  continue;?><?php  } ?>
                <div class='province'>
                     <label class='checkbox-inline' style='margin-left:20px;'>
                         <input type='checkbox' class='cityall' /> <?php  echo $value['@attributes']['name']?>
                         <span class="citycount" style='color:#ff6600'></span>
                     </label>
                    <?php  if(count($value['city'])>0) { ?>
                    <ul>
                        <?php  if(is_array($value['city'])) { foreach($value['city'] as $c) { ?>
                        <li>
                             <label class='checkbox-inline'>
                                  <input type='checkbox' class='city' style='margin-top:8px;' city="<?php  echo $c['@attributes']['name']?>" /> <?php  echo $c['@attributes']['name']?>
                            </label>
                     </li>
                        <?php  } } ?>
                    </ul>
                    <?php  } ?>
                </div>
                <?php  } } ?>
            
            </div>
            <div class="modal-footer">
                <a href="javascript:;" id='btnSubmitArea' class="btn btn-success" data-dismiss="modal" aria-hidden="true">确定</a>
                <a href="javascript:;" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
            </div>
        </div>
     </div>
</div> 
 <script language='javascript'>
    $(function(){
   
        $('.province').mouseover(function(){
              $(this).find('ul').show();
        }).mouseout(function(){
              $(this).find('ul').hide();
        });
        
        $('.cityall').click(function(){
            var checked = $(this).get(0).checked;
            var citys = $(this).parent().parent().find('.city');
            citys.each(function(){
                $(this).get(0).checked = checked;
            });
            var count = 0;
            if(checked){
                count =  $(this).parent().parent().find('.city:checked').length;
            }
            if(count>0){
               $(this).next().html("(" + count + ")")    ;
            }
            else{
                $(this).next().html("");
            }
        });
        $('.city').click(function(){
            var checked = $(this).get(0).checked;
            var cityall = $(this).parent().parent().parent().parent().find('.cityall');
          
            if(checked){
                cityall.get(0).checked = true;
            }
            var count = cityall.parent().parent().find('.city:checked').length;
            if(count>0){
               cityall.next().html("(" + count + ")")    ;
            }
            else{
                cityall.next().html("");
            }
        });    
      
    });
    
     function clearSelects(){
         $('.city').attr('checked',false).removeAttr('disabled');
         $('.cityall').attr('checked',false).removeAttr('disabled');
         $('.citycount').html('');
    }
    
    function selectAreas(){
        clearSelects();
        var old_citys = $('#areas').html().split(';');
      
                
        $('.city').each(function(){
            var parentcheck = false;
            for(var i in old_citys){
                if(old_citys[i]==$(this).attr('city')){
                    parentcheck = true;
                    $(this).get(0).checked = true;
                    break;
                }
            }
            if(parentcheck){
                $(this).parent().parent().parent().parent().find('.cityall').get(0).checked=  true;
            }
        });
        
        $("#modal-areas").modal();
        var citystrs = '';
        $('#btnSubmitArea').unbind('click').click(function(){
                   $('.city:checked').each(function(){              
                       citystrs+= $(this).attr('city') +";";
                   }); 
                   $('#areas').html(citystrs);
                   $("#selectedareas").val(citystrs);
        })
    
    }
</script>