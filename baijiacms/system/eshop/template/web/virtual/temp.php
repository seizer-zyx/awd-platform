<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
<?php  if($operation == 'post') { ?>
    <div class="main">
        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
            <input type="hidden" name="tp_id" value="<?php  echo $item['id'];?>" />
            <div class='panel'>
            	  <h3 class="custom_page_header"><?php  if(empty($_GPC['id'])) { ?>新建<?php  } else { ?>编辑 (id:<?php  echo $_GPC['id'];?>)<?php  } ?> - 虚拟物品模板 </h3>
                <div class='panel-body'>
                  
                    <?php  if(!empty($_GPC['id'])) { ?>
                        <div class="alert alert-danger">警告：当模板中已经添加数据后改变模板结构有可能导致无法使用！</div>
                    <?php  } ?>
           
                    
                        <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" > 分类</label>
                        <div class="col-sm-9 col-xs-12" style="width:707px;">
                      
                            <select name="cate" class="form-control">
                                <option value=""></option>
                                <?php  if(is_array($category)) { foreach($category as $c) { ?>
                                <option value="<?php  echo $c['id'];?>" <?php  if($item['cate']==$c['id']) { ?>selected<?php  } ?>><?php  echo $c['name'];?></option>
                                <?php  } } ?>
                            </select>
                      
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span> 模版名称</label>
                        <div class="col-sm-9 col-xs-12" style="width:707px;">
                
                            <input type="text" name="tp_title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="模版名称，例：话费充值卡" />
                     
                        </div> 
                    </div>
                     <?php  $key="key";?>
                     <?php  $name= $item['fields']['key'];?>
 	<?php include $this->template("tp_type");?>
                    <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $key => $name) { ?>
                       <?php  if($key!='key') { ?>
                            <?php include $this->template("tp_type");?>
                        <?php  } ?>
                    <?php  } } ?>
  
                    <div id="type-items"></div>
                    <?php  if($datacount<=0) { ?>
                    
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                        <div class="col-sm-9 col-xs-12">
                            <a class="btn btn-default btn-add-type" href="javascript:;" onclick="addType();"><i class="fa fa-plus" title=""></i> 增加一条键</a>
                        </div>
                    </div>
            
                      <?php  } ?>


                    

                      <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                        <div class="col-sm-9 col-xs-12">
                           
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                  
                            <a href="<?php  echo $this->createWebUrl('virtual')?>" style='margin-left:10px;'><span class="btn btn-default" style='margin-left:10px;'>返回列表</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script language='javascript'>
    var kw = 1;
    function addType() {
        $(".btn-add-type").button("loading");
        $.ajax({
            url: "<?php  echo $this->createWebUrl('virtual/temp',array('op'=>'addtype','addt'=>'type'))?>&kw="+kw,
            cache: false
        }).done(function (html) {
            $(".btn-add-type").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }
    
    function removeType(obj) {
        $(obj).parent().remove();
    } 
    
    $('form').submit(function(){
        var check = true;
        $("input[type=text]").each(function(){
            var val = $(this).val();
            if(!val){
                Tip.focus($(this),'不能为空!');
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        var o={}; // 判断重复
        $("input[mk=1]").each(function(){
            if(!(o[$(this).val()])){
                o[$(this).val()] = true;
            }else{
                var val = $(this).val();
                $("input[mk=1]").each(function(){
                   if($(this).val()==val){
                       $(this).css("border-color","#f01");
                   }else{
                       $(this).css("border-color","#ccc");
                   }
                });
                alert("啊哦，红圈里的数据 不能重复哦~！");
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        return check;
    });
 
    </script>

<?php  } else if($operation == 'display') { ?>
        <!-- 筛选区域 -->
        <div class="panel ">
        	 <h3 class="custom_page_header">虚拟物品-模板管理  <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/temp', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新模版</a>
                  </h3>
          
            <div class='panel-body'>
             
                    <table class="table">
                        <thead>
                            <tr>
                                <th style='width:50px;'>ID</th>
                                  <th style='width:100px;'>分类</th>
                                <th  style='width:250px;'>模版名称</th>
                                <th style="width:200px">已使用/总共数据</th>
                                <th >操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        	    	<?php  if(count($items)>0) { ?>
                            <?php  if(is_array($items)) { foreach($items as $item) { ?>
                                <tr>
                                    <td><?php  echo $item['id'];?></td>
                                     <td><label class='label label-primary'><?php  echo $category[$item['cate']]['name']?></label></td>
                                    <td> <?php  echo $item['title'];?></td>
                                    <td>
                                   
                                        <a href="<?php  echo $this->createWebUrl('virtual/data', array('typeid'=>$item['id']))?>" title="点击查看/编辑"><?php  echo $item['usedata'];?> / <?php  echo $item['alldata'];?> 详细</a>
                                        
                                    </td>
                                    <td>
                                        <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/temp', array('op' => 'post', 'id' => $item['id']))?>"><i class='fa fa-edit'></i>编辑</a>
                                      <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/data', array('typeid' => $item['id']))?>" title='查看已有数据'><i class='fa fa-list'></i>查看已有数据</a>
                                       <a class='btn btn-primary' href="<?php  echo $this->createWebUrl('virtual/data', array('op' => 'post', 'typeid' => $item['id']))?>" title='添加数据'><i class='fa fa-plus'></i>添加数据</a>
                                        <a class='btn btn-default'  href="<?php  echo $this->createWebUrl('virtual/temp', array('op' => 'delete', 'id' => $item['id']))?>" onclick="return confirm('确认删除此模版吗？');return false;" title='删除模板'><i class='fa fa-remove'></i>删除模板</a>
                                    </td>
                                </tr>
                            <?php  } } ?>
                            <?php  if(!empty($pager)) { ?>
                                <tr>
                                    <td colspan="4"><?php  echo $pager;?> </td>
                                </tr>
                            <?php  } ?>
                            
                            	<?php  } else { ?>
								<tr>
							<td colspan='5'>
                              <div  style='text-align: center;padding:30px;'>
                                  暂时没有任何商品!
                              </div>	</td>
						</tr>
                          <?php  } ?>
                        </tbody>
                    </table>
                </div>
            
        </div>
 
<?php  } else if($operation == 'addtype') { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span></label>
                    <div class="col-sm-9 col-xs-12" style="width:5%">
                        <a class="btn btn-default" href='javascript:;' onclick='removeType(this)'><i class='icon icon-remove fa fa-times'></i> 删除</a>
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:15%">
                        <input type="text" name="tp_kw[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="键值，例：keywords<?php  echo $kw;?>" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:40%">
                        <input type="text" name="tp_value[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="请在此输入对应的值" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:30%; ">
                        <?php  echo tpl_form_field_color('tp_color[]', '')?>
                    </div>
                </div>
<?php  } else if($operation == 'postdata') { ?>
    <form id="dataform" action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class='panel panel-default'>
            <div class='panel-heading'><?php  if(empty($_GPC['id'])) { ?>添加数据 (模板id:<?php  echo $_GPC['typeid'];?>)<?php  } else { ?>编辑数据 (模板id:<?php  echo $_GPC['typeid'];?> 数据id:<?php  echo $_GPC['id'];?>)<?php  } ?></div>
            <input type="hidden" name="typeid" value="<?php  echo $item['id'];?>"/>
            <div class='panel-body'>
                <div class="alert alert-danger"><?php  if(empty($_GPC['id'])) { ?>您正在向模板:“<?php  echo $item['title'];?> (id:<?php  echo $item['id'];?>)” 添加数据<?php  } else { ?>您正在编辑模板id:<?php  echo $_GPC['typeid'];?>数据id:<?php  echo $_GPC['id'];?>的内容<?php  } ?><br>Tips:主键自动填充只适用于以下格式：10000001(纯数字)、C00000001(一位字母开头的数字) 其他格式请手动填写或者Excel导入。</div>
                <table class="table">
                    <thead>
                        <tr>
                            <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $fields) { ?>
                            <th><?php  echo $fields['name'];?> (<?php  echo $fields['keyword'];?>) <?php  if($fields['keyword']=='key') { ?>主键 <?php  if(empty($_GPC['id'])) { ?><a style="float: right;" href="javascript:;" onclick="autonum()">自动填充</a><?php  } ?><?php  } ?></th>
                            <?php  } } ?>
                            <th style="width: 50px;">操作</th>
                        </tr>
                    </thead>
                    <tbody id="type-items">
                      <?php include $this->template("tp_data");?>
                    </tbody>
                </table>
                <?php  if(empty($_GPC['id'])) { ?>
                    <div class="input-group " style="width:260px; float: left; margin-left: 8px;">
                        <span class="input-group-addon">增加</span>
                        <input type="text" name="numlist" value="1" class="form-control" style="padding:0px; text-align: center;">
                        <span class="input-group-addon" style="border-left: 0px;">条数据</span>
                        <span class="btn btn-default btn-add-type btn-add-type2" style="float: left; border-radius: 0px 4px 4px 0px; border-left: 0px;" onclick="addType();"><i class="fa fa-plus" title="" ></i> 确认增加</span>
                    </div> 
                    <div class="col-sm-9 col-xs-12" style="float: left; width: auto; ">
                            <a class="btn btn-default btn-add-type" href="javascript:;" onclick="autonum()" style="margin-right: 10px;"><i class="fa fa-angle-double-down" title=""></i> 主键自动填充</a>
                            <a class="btn btn-primary" href="javascript:;" style="margin-right: 10px;" onclick="$('#modal-import').modal()"><i class="fa fa-plus" title=""></i> Excel导入</a>
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('virtual/import',array('op'=>'temp','id'=>$item['id']))?>" style="margin-right: 10px;" ><i class="fa fa-download" title=""></i> 下载Excel模板文件</a>
                    </div>
                <?php  } ?>
            </div>
          
                <div class='panel-footer' style="height:auto; overflow: hidden;">
                    <input type="submit" name="submit" value="保存数据" class="btn btn-primary col-lg-1"  />
                    <a class="btn btn-default btn-add-type" href="<?php  echo $this->createWebUrl('virtual',array('op'=>'list','typeid'=>$item['id']))?>" style="margin-left: 10px;"><i class="fa fa-list" title=""></i> 查看已有数据</a>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
         
        </div>
    </form>

        <div id="modal-import" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:600px;margin:0px auto;">
                 <form id="importform" class="form-horizontal form" action="<?php  echo $this->createWebUrl('virtual/import')?>" method="post" enctype="multipart/form-data">
                <input type='hidden' name='typeid' value="<?php  echo $item['id'];?>" />
                <input type='hidden' name='op' value='import' />
                     
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3>上传数据</h3>
                    </div>
                    <div class="modal-body">
                          <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style='width: 150px'>选择EXCEL:</label>
                            <div class="col-sm-9 col-xs-12" style='width: 380px'>
                                   <input type="file" name="excelfile" class="form-control" />
                            </div>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style='width: 150px'>注意:</label>
                            <div class="col-sm-9 col-xs-12" style='width: 380px'>
                                <span style="line-height: 36px; font-size: 12px;">如果遇到数据重复则将进行数据更新（在数据未使用的情况下）</span>
                            </div>
                        </div>
                        <div id="module-menus"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary span2" name="cancelsend" value="yes">确认导入</button>
                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                    </div>
                </div>
            </div>
                </form>
        </div>
<script language='javascript'>
$(function(){
    
    $('#importform').submit(function(){
        if(!$(":input[name=excelfile]").val()){
            alert("您还未选择Excel文件哦~");
            return false;
        }
    })

    $('#dataform').submit(function(){
        var check = true;
        $("input[type=text]").each(function(){
            var val = $(this).val();
            if(!val){
                Tip.focus($(this),'不能为空!');
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        var o={}; // 判断重复
        $("input[mk=1]").each(function(){
            if(!(o[$(this).val()])){
                o[$(this).val()] = true;
            }else{
                var val = $(this).val();
                $("input[mk=1]").each(function(){
                   if($(this).val()==val){
                       $(this).css("border-color","#f01");
                   }else{
                       $(this).css("border-color","#ccc");
                   }
                });
                alert("啊哦，红圈里的数据 不能重复哦~！");
                check =false;
                return false;
            }
        });
        if(!check){return false;}
        return check;
    });
})
    var kw = 1;
    function addType() {
        numlist = $("input[name=numlist]").val();
        if(numlist>50){
            alert("每次最多增加50条数据哦~");
            return false;
        }
        $(".btn-add-type2").button("loading");
        $.ajax({
            url: "<?php  echo $this->createWebUrl('virtual',array('op'=>'addtype','addt'=>'data','typeid'=>$_GPC['typeid']))?>&kw="+kw+"&numlist="+numlist,
            cache: false
        }).done(function (html) {
            $(".btn-add-type2").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }    
    function removeType(obj) {
        $(obj).parent().parent().remove();
    } 
    
    function autonum(){
        var val = $("input[mk=1]").val();
        var num =val.replace(/[^0-9]/,'')
        var num2 = 1+num;
        var eng = val.replace(num,'');
        
        
        if(!val){
            Tip.focus($("input[mk=1]"),'请先录入一个值!');
            reurun;
        }
        $("input[mk=1]").each(function(i){
            if(i>0){
                vval = 1+parseInt(num2)+i;
                str= ""+vval;
                str = str.substring(1,str.length)
                $(this).val(eng+str);
            }
        });
    }
</script>

<?php  } ?>
<?php include page("footer-base");?>
