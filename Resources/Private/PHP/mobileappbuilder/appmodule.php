<?php


class AppModule{
	
	var $config;
	var $htmlSubFolder='';
	
	function createApp($creator,$htmlSrc,$dst){
		$this->config=SimpleConfig::getInstance();
		$htmlFolder=$dst.'/'.$this->htmlSubFolder;
		if (!file_exists($htmlFolder))
			mkdir($htmlFolder,0777,true);
		
		$this->recurseCopy($htmlSrc,$htmlFolder);
		return $this->appExecute($creator,$dst);
		
	
	}
	
	function recurseCopy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$this->recurseCopy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	} 
	
	
}

?>