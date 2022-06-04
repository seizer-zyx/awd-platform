<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php include page("system_header");?>
<script>
	function changeattach(attdiv)
	{
	document.getElementById("div_local").style.display="none";
		document.getElementById("div_ftp").style.display="none";
				document.getElementById("div_ftp2").style.display="none";
			document.getElementById("div_oss").style.display="none";
			
					if(attdiv==0)
		{
			document.getElementById("div_local").style.display="block";
		}
			
		if(attdiv==1)
		{
			document.getElementById("div_ftp").style.display="block";
			document.getElementById("div_ftp2").style.display="block";
			document.getElementById("div_oss").style.display="none";
		}
			if(attdiv==2)
		{
				document.getElementById("div_ftp").style.display="none";
				document.getElementById("div_ftp2").style.display="none";
			document.getElementById("div_oss").style.display="block";
		}
	}
	</script>
     <form  method="post" class="form-horizontal form">
 <div class="panel ">
        
            <h3 class="custom_page_header">   附件设置   </h3>
       <div class="panel-body">
       	
       	
       	       	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">图片压缩比例<br/>（推荐80%）</label>
                    <div class="col-sm-9 col-xs-12">
                    	    <label class="radio-inline">
                       			<input type="radio" name="image_compress_openscale" value="0" <?php  if(empty($settings['image_compress_openscale'])) { ?>checked="true"<?php  } ?>> 关闭
            </label><label class="radio-inline">
          <input type="radio" name="image_compress_openscale" value="1" <?php  if(!empty($settings['image_compress_openscale'])) { ?>checked="true"<?php  } ?>>开启
       	  </label><label class="radio-inline"> <input type="text" name="image_compress_scale" style="width:50px" value="<?php  echo $settings['image_compress_scale'];?>" />%
					</label>
					
                   <span class="help-block">图片压缩功能需先安装ImageMagick-6.9版本</span>
                    </div>
                </div>
                
       	     	       	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">远程附件</label>
                    <div class="col-sm-9 col-xs-12">
                     <label class="radio-inline"><input type="radio" name="system_isnetattach" onchange="changeattach(0)"  value="0" <?php  if(empty($settings['system_isnetattach'])) { ?>checked="true"<?php  } ?>> 本地
        </label> <label class="radio-inline"> <input type="radio" name="system_isnetattach" onchange="changeattach(1)" value="1" <?php  if($settings['system_isnetattach'] == 1) { ?>checked="true"<?php  } ?>> FTP
       </label> <label class="radio-inline"> &nbsp;&nbsp; <input type="radio" name="system_isnetattach" onchange="changeattach(2)" value="2" <?php  if($settings['system_isnetattach'] == 2) { ?>checked="true"<?php  } ?>> 阿里云OSS 
        </label>
                    </div>
                </div>
                     <div id="div_local">
                     			 <div class="form-group">
											    <label class="col-xs-12 col-sm-3 col-md-2 control-label">本地附件地址：</label>
                    <div class="col-sm-9 col-xs-12">
															<input type="text" name="system_base_attachurl" class="form-control" value="<?php echo $settings['system_base_attachurl'];?>" />
								<span class="help-block">域名格式:http://www.baijiacms.com/，空则默认采用店铺域名。</span>
										</div>
									</div>
                     </div>	
                
                
                <div id="div_ftp">

                            	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>远程附件服务器域名地址</label>
                    <div class="col-sm-9 col-xs-12">
                       	<input type="text" name="system_ftp_attachurl" class="form-control"  value="<?php echo $settings['system_ftp_attachurl'];?>" />
									 <span class="help-block">域名格式如：http://www.baijiacms.com/</span>
                   
                    </div>
                </div>
                
                
                 	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;IP</label>
                    <div class="col-sm-9 col-xs-12">
                       	<input type="text" name="system_ftp_ip" class="form-control"  value="<?php echo $settings['system_ftp_ip'];?>" />
										</div>
                </div>
                
                   	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;端口</label>
                    <div class="col-sm-9 col-xs-12">
                       	<input type="text" name="system_ftp_port" class="form-control"  value="<?php echo $settings['system_ftp_port'];?>" />
										</div>
                </div>
                
                  	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;SSL</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline">	 <input type="radio" name="system_ftp_ssl" value="0" <?php  if(empty($settings['system_ftp_ssl'])) { ?>checked="true"<?php  } ?>> 关闭
          </label> <label class="radio-inline"><input type="radio" name="system_ftp_ssl" value="1" <?php  if($settings['system_ftp_ssl'] == 1) { ?>checked="true"<?php  } ?>> 开启
           </label>
										</div>
                </div>
                
                    	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;PASV模式</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class="radio-inline">	    <input type="radio" name="system_ftp_pasv" value="0" <?php  if(empty($settings['system_ftp_pasv'])) { ?>checked="true"<?php  } ?>> 关闭
        </label>    <label class="radio-inline">	  <input type="radio" name="system_ftp_pasv" value="1" <?php  if($settings['system_ftp_pasv'] == 1) { ?>checked="true"<?php  } ?>> 开启
        </label>
										</div>
                </div>
                
                 	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;用户名</label>
                    <div class="col-sm-9 col-xs-12">
                      			<input type="text" name="system_ftp_username"  class="form-control"  value="<?php echo $settings['system_ftp_username'];?>" />
										
										</div>
                </div>
                
                 	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;密码</label>
                    <div class="col-sm-9 col-xs-12">
                      			<input type="text" name="system_ftp_passwd"  class="form-control"  value="<?php echo $settings['system_ftp_passwd'];?>" />
										</div>
                </div>
                
                 	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;超时时间</label>
                    <div class="col-sm-9 col-xs-12">
                      			<input type="text" name="system_ftp_timeout"  class="form-control"  value="<?php echo $settings['system_ftp_timeout'];?>" />
										</div>
                </div>
                
                 	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">FTP&nbsp;&nbsp;文件夹路径</label>
                    <div class="col-sm-9 col-xs-12">
                      			<input type="text" name="system_ftp_ftproot"  class="form-control"  value="<?php echo $settings['system_ftp_ftproot'];?>" />
										</div>
                </div>
                
                
                </div><div id="div_oss">

                    	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">OSS所属地域</label>
                    <div class="col-sm-9 col-xs-12">
                     
                     					<select  class="form-control" name="system_oss_endpoint"> 
				                 <option value="oss-cn-hangzhou.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-hangzhou.aliyuncs.com'){echo "selected";} ?> >华东 1 (杭州)</option>
                  	                 <option value="oss-cn-shanghai.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-shanghai.aliyuncs.com'){echo "selected";} ?>>华东 2 (上海)</option>
                  	                      <option value="oss-cn-qingdao.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-qingdao.aliyuncs.com'){echo "selected";} ?>>华北 1 (青岛)</option>
                  	                 <option value="oss-cn-beijing.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-beijing.aliyuncs.com'){echo "selected";} ?>>华北 2 (北京)</option>
                  	                      <option value="oss-cn-shenzhen.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-shenzhen.aliyuncs.com'){echo "selected";} ?>>华南 1 (深圳)</option>
                  	                 <option value="oss-cn-hongkong.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-hongkong.aliyuncs.com'){echo "selected";} ?>>香港数据中心</option>
                  	                        <option value="oss-us-west-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-us-west-1.aliyuncs.com'){echo "selected";} ?>>美国硅谷数据中心</option>
                  	                       <option value="oss-us-east-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-us-east-1.aliyuncs.com'){echo "selected";} ?>>美国弗吉尼亚数据中心</option>
                  	                         <option value="oss-ap-southeast-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-ap-southeast-1.aliyuncs.com'){echo "selected";} ?>>亚太（新加坡）数据中心</option>
                  	                   </select>
                     </div>
                </div>
                
                
                    	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">OSS外网域名</label>
                    <div class="col-sm-9 col-xs-12">
                     <input type="text" name="system_oss_attachurl" class="form-control"  value="<?php echo $settings['system_oss_attachurl'];?>" />
										 <span class="help-block">域名格式如：http://www.baijiacms.com/</span>
										</div>
                </div>
                
                	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">Access Key ID</label>
                    <div class="col-sm-9 col-xs-12">
                     <input type="text" name="system_oss_access_id" class="form-control"  value="<?php echo $settings['system_oss_access_id'];?>" />
										 </div>
                </div>
                
                	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">Access Key Secret</label>
                    <div class="col-sm-9 col-xs-12">
                     <input type="text" name="system_oss_access_key" class="form-control"  value="<?php echo $settings['system_oss_access_key'];?>" />
										 </div>
                </div>
                
                	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">Bucket名称</label>
                    <div class="col-sm-9 col-xs-12">
                     <input type="text" name="system_oss_bucket" class="form-control"  value="<?php echo $settings['system_oss_bucket'];?>" />
										 </div>
                </div>
                
                </div>
                
                    	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1">
                            
                              <input type="submit" name="testsubmit"  id="div_ftp2" value="连接测试" class="btn btn-default col-lg-1">
                      </div>
            </div>
            	
                
</div>
</div>
</form>
<script>
	changeattach(<?php echo intval($settings['system_isnetattach']);?>);
	</script>
<?php include page("footer-base");?>