<?php

        $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
        	if($operation=='delete')
			{
				$store =getStoreBeid(intval($_GP['id']));
    
			   	 	mysqld_update('system_store',array("deleted"=>1),array('id'=>$store['id']));
						message("关闭成功！",WEBSITE_ROOT."index.php?mod=site&act=manager&do=store&op=display","success");
			}
            if($operation=='post')
        {
        	
        	$store = getStoreBeid(intval($_GP['id']));
  
            
        	   if (checksubmit('submit')) {
		       if(empty($_GP['website']))
		       {
		       	message("请输入相关域名");	
		       }
		       
		       	if (strexists($_GP['website'], 'http://') || strexists($_GP['website'], 'https://')|| strexists($_GP['website'], '/')) {
	   	message("绑定域名不能包含http://等字样，格式应是:www.baidu.com");	
	}
        	$website_store = mysqld_select("SELECT * FROM " . table('system_store')." where `deleted`=0 and `website`=:website",array(":website"=>$_GP['website']));
    			$data=array('sname'=>$_GP['sname'],'is_system'=>0,
				'isclose'=>
				intval($_GP['isclose']));
			
       $data['website']=$_GP['website'];
      $document_root = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
$document_root =str_replace("//","/",$document_root);
if(empty($document_root)||substr($document_root, -1)!='/')
{
		$document_root=$document_root. '/';
}
       if(empty($_GP['fullwebsite']))
       {
       	 $data['fullwebsite']=str_replace('http://'.$_GP['website'].'/','http://'.$_GP['website'].'/','http://'.$_GP['website'].$document_root);
       }else
       {
      	   	 
       	 $data['fullwebsite']=$_GP['fullwebsite'];
       }
		
                
                if(!empty($website_store['id'])&&$website_store['id']!=$store['id'])
                {
                	
                message("绑定的站点域名已存在！请更换其他域名");	
                }
               
                
                
		
				  if(	empty($store['id']))
					   {
					   	$data['createtime']=time();
        		mysqld_insert('system_store',$data);
        		  $store_id = mysqld_insertid();
        if(!empty($store_id))
        {
        refreshBeSetting($store_id,array('name'=>$data['sname']),'shop');
      }
          message("添加成功",create_url('site', array('act' => 'manager','do' => 'store','op'=>'display')),"success");
    
        	}else
        	{
    
        			mysqld_update('system_store',$data,array('id'=>$store['id']));
        message("修改成功",create_url('site', array('act' => 'manager','do' => 'store','op'=>'display')),"success");
        	}
        	

        	
						}
        			include page('store_post');
        }
        if($operation=='display')
        {
        	           $pindex = max(1, intval($_GP['page']));
            $psize = 20;

            	
            	 if (!empty($_GP['sname'])) {
                $selectCondition .= " AND store.sname  LIKE '%{$_GP['sname']}%'";
            }
            
     
            	
            
        		 $selectCondition.=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
						    
        	 	$store_list = mysqld_selectall("SELECT store.* FROM " . table('system_store')." store where store.`deleted`=0 ".$selectCondition);
       
       
      
            
            
           $total = mysqld_selectcolumn("SELECT count(*) FROM " . table('system_store')." store  where store.`deleted`=0 ".$selectCondition);
            $pager = pagination($total, $pindex, $psize);
            
        			include page('store_display');
        	
        }