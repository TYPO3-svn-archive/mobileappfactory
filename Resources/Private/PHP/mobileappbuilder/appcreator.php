<?php


include_once(dirname(__FILE__)."/fetchcms.php");
include_once(dirname(__FILE__)."/appmodule.php");


class AppCreator extends FetchCMS{
	var $platformModules=array();
	var $url;
	var $appDst="";
	var $htmlSrc="";
	var $permissions=array();
	var $frameWork="";
	var $config;
	var $appConfig;
	
		
	function __construct($appConfig,$config,$observer){
		parent::__construct($observer);
		$this->appConfig=$appConfig;
		$this->appDst=$appConfig['output'];
		$this->htmlSrc=$appConfig['output'].'/zip/www';
		$this->config=$config;
		
		$this->appName=$appName;
		$this->shortName=str_replace(' ','_',$appName);
		//$this->appDst=$appDst;
		//$this->frameWork=$frameWork;
		
		
		//$this->addDocument($url,'index.html');
		//$this->initFramework($frameWork);
		
	}
	
	function initFramework($framework){
		$this->framework=$this->loadFramework($framework);
		
		
	}
	
	
	function loadFramework($framework){
		include_once(dirname(__FILE__).'/frameworks/'.strtolower($framework).'/'.strtolower($framework).'.php');
		return new $framework;
		
	}
	
	function fetchPages(){
		if ($this->debug)
			$this->msg('AppCreator:',$url.'->'.$this->appDst);
		$this->deleteDirectory($this->appDst);
		if (!file_exists($this->appDst))
			mkdir($this->appDst,0777,true);
		$this->copyUrl($this->htmlSrc,true);
		$iconFile=$this->htmlSrc.'/'.$this->appConfig['iconFile'];
		if (file_exists($this->appConfig['iconPath'].$this->appConfig['iconFile']))
			copy($this->appConfig['iconPath'].$this->appConfig['iconFile'],$iconFile);
		//mkdir($this->appDst.'/config',0777,true);
		/*$fp = fopen($this->appDst.'/config/platformConfig.json', 'w');
		fwrite($fp, json_encode($this->frameworkInfo));
		fclose($fp);*/

	}
	
	function sendToBuildQueue(){
		$this->initFramework($this->frameworkInfo[name]);
		return $this->framework->sendToBuildQueue($this,$this->appDst,$platformDir);
	}
	
	function queueInfo($buildID){
		$this->initFramework('phonegapbuild');
		return $this->framework->queueInfo($this,$buildID);
	}
	
	
	function deleteDirectory($dir) {
		if (!file_exists($dir)) 
			return true;
		if (!is_dir($dir) || is_link($dir)) 
			return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') 
				continue;
            if (!$this->deleteDirectory($dir . "/" . $item)) {
                //chmod($dir . "/" . $item, 0777);
                if (!$this->deleteDirectory($dir . "/" . $item)) return false;
            }
        }
        return rmdir($dir);
    }
}
?>