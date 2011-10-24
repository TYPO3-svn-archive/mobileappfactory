<?php
require_once(dirname(__FILE__).'/appcreator.php');

class MobileAppBuilderAdaptor {

	var $app;
	var $builder;
	var $msgOutput=array();
	var $queueInfo=array();

	function __construct($appConfig,$config){
		$this->config=$config;
		$this->app=$appConfig;
		$pages=array();
	
		$this->builder=new AppCreator($appConfig,$config,$this);
		$this->followLinks=true;
		$this->builder->addPage($appConfig['startPage'],'index.html');
	
	
	}
	
	function allowURL($refinfo){
		return true;
	}
	
	
	function addPage($url){
		$this->builder->addPage($url);
	}
	
	function fetchPages(){
		$this->builder->fetchPages();
		
	}
	
	function queueApp(){
		return $this->builder->sendToBuildQueue();
	}
	
	function queueInfo($buildID){
		return $this->builder->queueInfo($buildID);
	}
	
	function getOutput(){
		return $this->msgOutput;
	}
	
	function appReady($info){
		$this->CMSToAppMsg('app ready', 'state='.$info['state'].' platform='.$info['platform']);
		
	}
	
	function CMSToAppMsg($tag,$msg,$level){
		$this->msgOutput[]=array('tag'=>$tag,'msg'=>$msg,'level'=>$level);
		
	}
	
	function CMSToAppProgress($progress){
		//$data=array('progress'=>progress);
		//$build=$this->buildModel->save(array('idApp'=>$this->currentBuild),$data);
	}
	
	 

}

?>