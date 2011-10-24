<?php

class PhoneGapBuildAPI{
	var $pgbService="https://build.phonegap.com/api/v1/";
	var $userName;
	var $password;
	var $cache=array('general'=>array(),'apps'=>array());
	var $error=array();
	var $response=array();
	var $responseError='';
	
	
	function __construct($user,$pass,$fillApps=true){
		$this->userName=$user;
		$this->password=$pass;
		$this->cache['general']=$this->sendRequest('me');
		if ($fillApps)
			$this->getApps();
	}
	
	function sendRequest($function,$arguments=array(),$post=array(),$file='',$operation="",$debug=false){
		$postData=array();
		$p='';
		foreach($post as $key=>$value){
			if ($p)
				$p.=',';
			$p.='"'.$key.'": "'.$value.'"';
		}
		
		if ($p)
			$postData['data']='{'.$p.'}';
			
		if (($file)&&(!$usePut))
			$postData['file']='@'.$file;
		
			
		
		$a='';
		foreach($arguments  as $value){
			if ($a)
				$a.='/';
			$a.=$value;
		
		}
		
		if ($a)
			$a='/'.$a;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->pgbService.$function.$a);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 		
		curl_setopt($ch, CURLOPT_USERPWD, $this->userName.':'.$this->password);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		if ($operation=='put'){
			 curl_setopt($ch, CURLOPT_PUT, 1);
			 $f = fopen($file, "rb");
			 curl_setopt($ch, CURLOPT_INFILE, $f);
			 curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));
			 
		} else if ($operation=='delete'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		} else if (!empty($postData)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			
		}			
		$jdata = curl_exec($ch); 
		$this->response=curl_getinfo ($ch);
		$this->responseError= curl_error($ch);
		$ifo=curl_getinfo ($ch,CURLINFO_HTTP_CODE);
		//var_dump(curl_getinfo($ch,CURLINFO_HEADER_OUT));
		//print_r($ifo);
		
		$data=json_decode($jdata,true);
		if ($function=='apps'&& $debug){
			print_r('<pre style="color:#0000ff">');
			var_dump(curl_getinfo($ch));
			var_dump(curl_error($ch));
			
		print_r($ifo);
			print_r($postData);
		print_r('data');	
			print_r($data);
			print_r('<pre>');
			//xyz();
		}
		curl_close($ch);
		if ((!empty($data['error']))||$ifo=="500"){
			$this->error[]=array('http_code'=>$ifo,'msg'=>$data['error'],'function'=>$this->pgbService.$function.$a,'postData'=>$postData,'p'=>$post);
			
			//print_r($this->error);
			//xyz();
			if ($ifo!="201")
				return array();
		} else {
			$this->error[]=array('http_code'=>$ifo,'msg'=>$data['error'],'function'=>$this->pgbService.$function.$a,'postData'=>$postData,'p'=>$post);
		}
			
		
		return $data;
		
	}
	
	function getApps($useCache=true){
		if (empty($this->cache['apps'])||!$useCache){
			$data=$this->sendRequest('apps');
			$apps=array();
			//print_r($data);
			//$this->iuh();
			foreach($data['apps'] as $app){
				$apps[$app['id']]=$app;
			}
			$this->cache['apps']=$apps;
		}
		return $this->cache['apps'];
	}
	
	function getApp($id,$useCache=true){
		if (!$id)
			return null;
		if (empty($this->cache['apps'])||empty($this->cache['apps'][$id])||!$useCache){
			$data=$this->sendRequest('apps',array($id));
			
			$this->cache['apps'][$data['id']]=$data;
		}
		return $this->cache['apps'][$id];
	}
	
	function getAppByName($appName){
		$this->getApps();
		foreach($this->cache['apps'] as $app){
			if ($app['name']==$appName)
				return $app;
		}
		return null;
	}
	
	function createAppWithZip($appName,$package,$version,$zipFile){
		$post=array();
		$post['title']=$appName;
		$post['package']=$package;
		$post['version']=$version;
		$post['create_method']='file';
		//$post['file']=$zipFile;
		
		
		$data=$this->sendRequest('apps',array(),$post,$zipFile,false,false);
		
		$this->cache['apps'][$data['id']]=$data;
		return $data;
	}
	
	function updateAppWithZip($appID,$appName,$package,$version,$zipFile){
		$post=array();
		//$post['title']=$appName;
		//$post['package']=$package;
		//$post['version']=$version;
		//$post['create_method']='file';
		//$post['file']='@'.$zipFile;
		
		$data=$this->sendRequest('apps',array($appID),$post,$zipFile,"put");
		$this->cache['apps'][$data['id']]=$data;
	}
	
	function deleteApp($appID){
		$data=$this->sendRequest('apps',array($appID),array(),"","delete");
		unset($this->cache['apps'][$appID]);
	}
	
	function getIcon($appID,$icon=''){
		$a=array();
		$a[]=$appID;
		$a[]='icon';
		//if ($icon)
		//	$a[]=$icon;
		$data=$this->sendRequest('apps',$a);
		//print_r($data);
		//xyz();
		return $data['location'];	
	}

	function downloadApp($appID,$platform){
		$a=array();
		$a[]=$appID;
		$a[]=$platform;
		$data=$this->sendRequest('apps',$a);
		return $data['location'];	
	}
	
}

?>