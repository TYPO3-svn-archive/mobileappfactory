<?php
class phonegapbuild{
	
	function getPlatforms(){
		return array('pgb');
	}
	
	function loadPlatform($platform){
		
		if ($platform=='pgb'){
			include_once(dirname(__FILE__).'/pgbmodule.php');
			return new PhonegapBuildModule();
		}
	}
	
	function queueInfo($creator,$buildID){
		include_once(dirname(__FILE__).'/PhoneGapBuildAPI.php');
		$pgbapi=new PhoneGapBuildAPI($creator->config['phonegapBuild']['user'],$creator->config['phonegapBuild']['password']);
		$info=$pgbapi->getApps(false);
		$info=$pgbapi->getApp($buildID);
		
		$res=array();
		$res['buildID']=$buildID;
		$res['version']=$info['version'];
		$res['title']=$info['title'];
		$res['icon']=$pgbapi->getIcon($buildID,$info['icon']['filename']);
		
		$res['info']=print_r($pgbapi->cache,true);
		
		foreach($info['status'] as $platform=>$state){
			if ($state=='pending')
				$res['platforms'][$platform]['state']=1;
			else if ($state=='error'){
				$res['platforms'][$platform]['state']=3;
				$res['platforms'][$platform]['error']=$info['error'][$platform];
			} else if 	($state=='complete'){
				$res['platforms'][$platform]['state']=2;
				$res['platforms'][$platform]['link']=$pgbapi->downloadApp($buildID,$platform);// pgbService.$info['download'][$platform];
			} else	if ($state=='' && $platform=='ios'){
				$res['platforms'][$platform]['state']=3;
				$res['platforms'][$platform]['error']='Missing IOS signing keys, please check on build.phonegap.com';
			} else	if ($state==''){
				$res['platforms'][$platform]['state']=4;
				$res['platforms'][$platform]['error']='State unknown, check on build.phonegab.com';
			}
			
			
		}
		return $res;
	}
	
	function sendToBuildQueue($creator,$dst){
		$creator->msg('Phonegapbuild begin','');
		include_once(dirname(__FILE__).'/CreateZipFile.php');
		include_once(dirname(__FILE__).'/PhoneGapBuildAPI.php');
		
		if ($creator->debug)
			$creator->msg('Phonegap buildqueue dest:',$dst);
		$configFile=file_get_contents(dirname(__FILE__).'/config.xml');
		//$creator->msg('Phonegap build config template:'.$configFile);
		$configFile=str_replace('#name#',$creator->appConfig['name'],$configFile);
		$configFile=str_replace('#id#',$creator->appConfig['id'],$configFile);
		$configFile=str_replace('#version#',$creator->appConfig['version'],$configFile);
		$configFile=str_replace('#description#',$creator->appConfig['description'],$configFile);
		$icons='';
		$iconDir=$dst.'/zip/www/icons';
		if (!file_exists($iconDir))
			mkdir($iconDir,0770,true);
		
		foreach($creator->appConfig['icons'] as $icon){
			$fileName=$creator->getFileName($icon['location']).'.'.$creator->getFileExtension($icon['location']);
			//$creator->msg('icon',print_r($icon['location'],true),2);
			copy($icon['location'],$iconDir.'/'.$fileName);
			$icons.="<icon src='icons/".$fileName."' width='".$icon['width']."' height='".$icon['height']."' />\n";
		}
		
		$configFile=str_replace('#icons#',$icons,$configFile);
		
		if ($creator->appConfig['splash']){
			$fileName=$creator->getFileName($creator->appConfig['splash']).'.'.$creator->getFileExtension($creator->appConfig['splash']);
			copy($creator->appConfig['splash'],$iconDir.'/'.$fileName);
			$configFile=str_replace('#splash#','icons/'.$fileName,$configFile);
		}
		
		$author=$creator->appConfig['author'];
		if ($author)
			$author.=' - ';
		$author.=$creator->appConfig['company'];
		$configFile=str_replace('#author#',$author,$configFile);
		
		$configFile=str_replace('#support#',$creator->appConfig['support'],$configFile);
		$configFile=str_replace('#www#',$creator->appConfig['www'],$configFile);
		
		
		$permissions="";
		foreach ($creator->frameworkInfo['permissions'] as $key=>$value){
			if ($key=='geolocation')
				$permissions.='<feature name="http://api.phonegap.com/1.0/geolocation"/>'."\n";
			if ($key=='battery')
				$permissions.='<feature name="http://api.phonegap.com/1.0/battery"/>'."\n";
			if ($key=='camera')
				$permissions.='<feature name="http://api.phonegap.com/1.0/camera"/>'."\n";
			if ($key=='contacts')
				$permissions.='<feature name="http://api.phonegap.com/1.0/contacts"/>'."\n";
			if ($key=='file')
				$permissions.='<feature name="http://api.phonegap.com/1.0/file"/>'."\n";
			if ($key=='media')
				$permissions.='<feature name="http://api.phonegap.com/1.0/media"/>'."\n";
			if ($key=='network')
				$permissions.='<feature name="http://api.phonegap.com/1.0/network"/>'."\n";
			if ($key=='notification')
				$permissions.='<feature name="http://api.phonegap.com/1.0/notification"/>'."\n";
				
		}
		if (!$permissions)
			$permissions='<preference name="permissions" value="none"/>';
		$configFile=str_replace('#permissions#',$permissions,$configFile);	
		
		if ($creator->debug)
			$creator->msg('Phonegap build config:',$configFile);
		
		$configFile=str_replace('#permisions#',$permisions,$configFile);
		file_put_contents($dst.'/zip/config.xml',$configFile);
		
		$createZipFile=new CreateZipFile; 
		//$createZipFile->zipDirectory($dst.'/zip','');
		$createZipFile->get_files_from_folder($dst.'/zip/','');
		$zipFile=$dst.'/app.zip';
		$fd=fopen($zipFile, "wb");
		$out=fwrite($fd,$createZipFile->getZippedfile());
		fclose($fd); 
		
		//$creator->msg('Phonegap build user',$creator->config['phonegapBuild']['user']);
		$pgbapi=new PhoneGapBuildAPI($creator->config['phonegapBuild']['user'],$creator->config['phonegapBuild']['password']);
		
		if ($creator->appConfig['buildID'])
			$pgbapi->deleteApp($creator->appConfig['buildID']);
		
		$pgbApp=$pgbapi->getApp($creator->appConfig['buildID']);
		
		
		
		if ($pgbApp){
			$creator->msg('phonegapbuild ', 'update app:'.$pgbApp['id']);
			$pgbapi->updateAppWithZip($pgbApp['id'],$creator->appConfig['name'],$creator->appConfig['id'],$creator->appConfig['version'],$zipFile);
		}else{
			$creator->msg('phonegapbuild ', 'create new app:'.$pgbApp['id']);
			$pgbApp=$pgbapi->createAppWithZip($creator->appConfig['name'],$creator->appConfig['id'],$creator->appConfig['version'],$zipFile);
		}
		$rcode=$pgbapi->error['0']['http_code'];
		$res=$pgbApp['id'];
		if ($rcode=='200' || $rcode=='201'){
			$rcode='response code '.$rcode.' (ok)';
			//$creator->msg('phonegapbuild',print_r($pgbapi->error['0']['msg'],true),2);
		}else{
			$rcode='response code '.$rcode.' (failed)';
			$creator->msg('phonegapbuild',print_r($pgbapi->error['0']['msg'],true),1);
			$res=null;
		}
		$creator->msg('phonegapbuild done',$rcode,0);
		
		
		
		//$creator->msg('pgb build id:'.$pgbApp['id']);	
		//$creator->msg('pgb build error:',print_r($pgbapi->error['0'],true));	
		//$creator->msg('pgb build cache:'.print_r($pgbapi->cache,true));	
			
		return $res;
		
	
	}
	
	/*function getBuildStatus($buildID,$user,$password){
		$pgbapi=new PhoneGapBuildAPI($user,$password);
		$pgbApp=$pgbapi->getApp($creator->appConfig['buildID']);
	}*/

}

?>