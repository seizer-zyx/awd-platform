<?php
			
			if(!empty($_GP['username'])&&!empty($_GP['password']))
			{
			$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  username = :username and password=:password" , array(':username' => $_GP['username'],':password'=> md5($_GP['password'])));
			}
			if(empty($account['id'])&&$_GP['op']=='loginkey'&&!empty($_GP['loginkey']))
			{
				
			$loginkey=$_GP['loginkey'];
				$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  loginkey=:loginkey" , array(':loginkey' => $loginkey));
				if(!empty($account['id']))
				{
					mysqld_update('user',array('loginkey'=>''),array('id'=>$account['id']));
				}
			}
				if(!empty($account['id']))
			{
				unset($account['password']);
				if(!empty($account['is_admin']))
				{
						$_SESSION[WEB_SESSION_ACCOUNT]=$account;
						
						if($_GP['op']=='loginkey'&&!empty($_GP['loginkey']))
						{
							
						 header("location:".create_url('site',array('act' => 'public','do' => 'shop_index','beid'=> $_CMS['beid']))) ;	
						 exit;	
						}
						
								header("location:".create_url('site', array('act' => 'manager','do' => 'main')));
								exit;
				}else
				{
				
					$store = getStoreBeid($account['beid']);
   
					if(empty($store['id']))
					{
						message("没有找到相关店铺");	
					}
					if($_CMS['beid']!=$store['id'])
					{
							$loginkey=date('YmdHis') . random(6, 1);
		mysqld_update('user',array('loginkey'=>$loginkey),array('id'=>$account['id']));
				header("location:".'http://'.$store['website'].'/'.create_url('mobile', array('beid'=>$store['id'],'act' => 'public','do' => 'login','op'=>'loginkey','loginkey'=>$loginkey)));
	exit;
						
					}
					
					$_SESSION[WEB_SESSION_ACCOUNT]=$account;
				
					if($_GP['op']=='loginkey'&&!empty($_GP['loginkey']))
						{
							
						 header("location:".create_url('site',array('act' => 'public','do' => 'shop_index','beid'=> $_CMS['beid']))) ;	
						 exit;	
						}
				
				 header("location:".create_url('site', array('act' => 'public','do' => 'shop_index')));
				 exit;	
				}
		}else
		{
			
					message('用户名密码错误！','refresh','error');	
			
			}