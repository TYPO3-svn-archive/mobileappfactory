<?php

class AppBuilder{

	function __construct(){
	
	}
	
	function createApp($platform=""){
		$this->initFramework($this->frameworkInfo[name]);
		foreach($this->framework->getPlatforms() as $platform){
			$this->platformModules[$platform]=$this->framework->loadPlatform($platform);
		}
		
		if (!$platform){
			foreach($this->platformModules as $key=>$module){
				$platformDir=$this->appDst.'/platforms/'.$key;
				if (!file_exists($platformDir))
					mkdir($platformDir,0777,true);
				$res=$module->createApp($this,$this->htmlSrc,$platformDir);
				if ($this->observer)
					$this->observer->appReady($res);
			}
		} else {
			$platformDir=$this->appDst.'/platforms/'.$platform;
			if (!file_exists($platformDir))
				mkdir($platformDir,0777,true);
			$res=$this->platformModules[$platform]->createApp($this,$this->htmlSrc,$platformDir);
			if ($this->observer)
				$this->observer->appReady($platform,$res);
		}
	}

}


?>