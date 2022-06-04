<?php defined('IN_IA') or exit('Access Denied');?> <style type='text/css'>
    .multi-item { height:110px;float:left;position:relative;}
     .img-thumbnail { width:100px;height:100px}
     .img-nickname { position: absolute;bottom:0px;line-height:25px;height:25px;
                    color:#fff;text-align:center;width:100px;top-25px;background:rgba(0,0,0,0.8);}
     .multi-img-details { padding:5px;}
</style>
     <div class='panel panel-default spec_item' id='spec_<?php  echo $spec['id'];?>' >
         <div class='panel-body'>
	<input name="spec_id[]" type="hidden" class="form-control spec_id" value="<?php  echo $spec['id'];?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">规格名</label>
	<div class="col-sm-9 col-xs-12">
         
			<input name="spec_title[<?php  echo $spec['id'];?>]" type="text" class="form-control  spec_title" value="<?php  echo $spec['title'];?>" placeholder="(比如: 颜色)"/>
                      
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">规格项</label>
	<div class="col-sm-9 col-xs-12">
			<div id='spec_item_<?php  echo $spec['id'];?>' class='spec_item_items'>
			<?php  if(is_array($spec['items'])) { foreach($spec['items'] as $specitem) { ?>
                        <?php include $this->template("/tpl/spec_item");?>
  
			<?php  } } ?>
			</div>
		</div>
	</div>   
          <div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<a href="javascript:;" id="add-specitem-<?php  echo $spec['id'];?>" specid='<?php  echo $spec['id'];?>' class='btn btn-info add-specitem' onclick="addSpecItem('<?php  echo $spec['id'];?>')"><i class="fa fa-plus"></i> 添加规格项</a>
				<a href="javascript:void(0);" class='btn btn-danger' onclick="removeSpec('<?php  echo $spec['id'];?>')"><i class="fa fa-plus"></i> 删除规格</a>
			</div>
		 
	</div>
   </div> 
</div>