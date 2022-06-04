<?php defined('IN_IA') or exit('Access Denied');?><?php include page("header-base");?>
<?php  if($operation == 'post') { ?>
    <form id="dataform" action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class='panel '>
        	     <h3 class="custom_page_header">    <?php  echo $item['title'];?>模板中<?php  if(empty($_GPC['id'])) { ?>添加数据 <?php  } else { ?>编辑数据 <?php  } ?>  
        	     	
                            <a class="btn btn-primary" href="javascript:;" style="margin-right: 10px;" onclick="$('#modal-import').modal();"><i class="fa fa-plus" title=""></i> Excel导入</a>
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('virtual/import',array('op'=>'temp','id'=>$item['id']))?>" style="margin-right: 10px;" ><i class="fa fa-download" title=""></i> 下载Excel模板文件</a>
        	     	 <a class="btn btn-default " href="<?php  echo $this->createWebUrl('virtual/data',array('typeid'=>$item['id']))?>" style="margin-left: 10px;"><i class="fa fa-list" title=""></i> 查看已有数据</a>
                 </h3>
            <input type="hidden" name="typeid" value="<?php  echo $item['id'];?>"/>
            <div class='panel-body'>
                <div class="alert alert-info">数据格式：主键自动填充只适用于以下格式：00000001(纯数字)、C00000001(字母开头数字结尾) 其他格式请手动填写或者Excel导入。</div>
                <table class="table">
                    <thead>
                        <tr>
                            <?php  if(is_array($item['fields'])) { foreach($item['fields'] as $key => $name) { ?>
                            <th><?php  echo $name;?> (<?php  echo $key;?>) <?php  if($key=='key') { ?>主键 <?php  if(empty($_GPC['id'])) { ?><a class='btn btn-default btn-add-type' style="float: right;" href="javascript:;" onclick='autonum()' >自动填充</a><?php  } ?><?php  } ?></th>
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
                        <span class="btn btn-default btn-add-type2" style="float: left; border-radius: 0px 4px 4px 0px; border-left: 0px;" onclick="addType();"><i class="fa fa-plus" title="" ></i> 1.确认增加</span>
                    </div> 
                    <div class="col-sm-9 col-xs-12" style="float: left; width: auto; ">
                            <a class="btn btn-default btn-add-type" onclick='autonum()' href="javascript:;" style="margin-right: 10px;"><i class="fa fa-angle-double-down" title=""></i> 2.主键自动填充</a>
                      
                    </div>
                <?php  } ?>
            </div>
            
                <div class='panel-footer' style="height:auto; overflow: hidden;">
                  
                    <input type="submit" name="submit" value="保存数据" class="btn btn-primary col-lg-1"  />
           
                     
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
        if(!$.isInt(numlist)){
            alert("请填写要添加的条数~");
            return false;
        }
        if(numlist>100){
            alert("每次最多增加100条数据哦~");
            return false;
        }
        $.ajax({
            url: "<?php  echo $this->createWebUrl('virtual/temp',array('op'=>'addtype','addt'=>'data','typeid'=>$_GPC['typeid']))?>&kw="+kw+"&numlist="+numlist,
            cache: false
        }).done(function (html) {
            $("#type-items").append(html);
        });
        kw++;
    }    
    function removeType(obj) {
        $(obj).parent().parent().remove();
    } 
   
    function autonum(){
        var val =$.trim( $(":input[mk=1]:first").val() );
        if(val==''){
            Tip.focus($(":input[mk=1]:first"),'请先录入一个值!');
            return;
        }
 
        
        var num =val.replace(/[^0-9]/,'') ;
        var eng = val.replace(num,''); //14162  
        $.ajax({
             url: "<?php  echo $this->createWebUrl('virtual/data')?>",
             data: { op:'autonum', num: num ,len: $(":input[mk=1]").length -1,typeid:"<?php  echo $_GPC['typeid'];?>" },
             type: "POST",
             dataType:"json",
             success: function(arr){
                 for(var i in arr){
                     $(":input[mk=1]:eq(" + i + ")").val(eng+ arr[i] );
                 }
             }
         })
    }
</script>

<?php  } else if($operation == 'display') { ?>
        <!-- 筛选区域 -->
        <div class="panel">
                 <h3 class="custom_page_header">     <?php  echo $type['title'];?>模板-查看已有数据
                 	  <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/temp')?>"><i class="fa fa-reply"></i> 返回列表</a> 
                    <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/data', array('op' => 'post','typeid'=>$_GPC['typeid']))?>"><i class="fa fa-plus"></i> 添加数据</a>
               
                    <a class='btn btn-primary' href="<?php  echo $this->createWebUrl('virtual/export', array('typeid'=>$_GPC['typeid']))?>"><i class="fa fa-download"></i> 导出已使用数据</a>
             
                 	</h3>
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form">
                    <input type="hidden" name="mod" value="site" />
                    <input type="hidden" name="m" value="eshop" />
                    <input type="hidden" name="do" value="virtual" />
                    <input type="hidden" name="act" value="data" />
                    <input type="hidden" name="op" value="display" />
                    <input type="hidden" name="typeid" value="<?php  echo $type['id'];?>" />
                    
                <input type="hidden" name="beid" value="<?php echo $GLOBALS['_CMS']['beid'];?>" />
                      <div class="form-group">
                	  
                             <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">使用状态</label>
                             
                               <div class="col-sm-4">   <select class='form-control' name='status'>
                                <option value=''></option>
                                <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>未使用</option>
                                <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>已使用</option>
                            </select> 	</div>
                      <div class="col-sm-6">      <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    	</div>
                 
                </div>
                    
                </form>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th style='width:50px;'>编号</th>
                           <th>
                            
                            <?php  if(is_array($type['fields'])) { foreach($type['fields'] as $key => $name) { ?>
                                    <?php  echo $name;?> (<?php  echo $key;?>)/
                            <?php  } } ?></th>
                            <th style='text-align: center;width:80px;'>状态</th>
                            <th style='width:150px;'>购买粉丝</th>
                            <th style='width:180px;'>姓名/手机</th>
                            <th style='width:150px;'>购买时间</th>
                            <th style='width:220px;'>订单号</th>
                            <th style='width:80px;'>购买价格</th>
                            <th>辑编 / 删除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($items)) { foreach($items as $item) { ?>
                            <tr>
                                <td><?php  echo $item['id'];?></td>
                            
                                
                                    <td>
                                            <?php  $datas = iunserializer($item['fields'])?>
                                <?php  if(is_array($type['fields'])) { foreach($type['fields'] as $key => $name) { ?>
                                        <?php  echo $datas[$key];?>/
                                        <?php  } } ?>
                                    </td>
                                
                                <td style='width:60px; text-align: center'>
                                    <?php  if(empty($item['openid'])) { ?><span style="color:green">未使用</span><?php  } else { ?><span style="color:red;">已使用</span><?php  } ?>
                                </td> 
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?>
                                    <img src='<?php  echo tomedia($item['avatar'])?>' style='width:30px;height:30px;padding:1px;border:1px solid #ccc' /> <?php  echo $item['nickname'];?>
                                    <?php  } ?>
                                </td>
                                  <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?>
                                    <?php  echo $item['realname'];?>/<?php  echo $item['mobile'];?>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><?php  echo date('Y-m-d H:i',$item['usetime'])?><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?>
                                    <a href="<?php  echo $this->createWebUrl('order',array('op'=>'detail','id'=>$item['orderid']))?>" target='_blank'> [<?php  echo $item['orderid'];?>]<?php  echo $item['ordersn'];?></a>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?><span style="width: 100%">-</span><?php  } else { ?><?php  echo $item['price'];?><?php  } ?>
                                </td>
                                <td>
                                    <?php  if(empty($item['openid'])) { ?>
                                       <a class='btn btn-default' href="<?php  echo $this->createWebUrl('virtual/data', array('op' => 'post', 'id' => $item['id'],'typeid'=>$item['typeid']))?>" title="编辑"><i class='fa fa-edit'></i></a>
                                        <a class='btn btn-default'  href="<?php  echo $this->createWebUrl('virtual/data', array('op' => 'delete','typeid'=>$item['typeid'],'id' => $item['id']))?>" onclick="return confirm('确认删除此条数据吗？');return false;" title='删除'><i class='fa fa-remove'></i></a>
                                    <?php  } ?>
                                </td>
                            </tr>
                        <?php  } } ?>
                        <?php  if(!empty($pager)) { ?>
                            <tr>
                                <td colspan="<?php  echo $colspan+7?>"><?php  echo $pager;?></td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
           
        </div>
 
<?php  } ?>
<?php include page("footer-base");?>