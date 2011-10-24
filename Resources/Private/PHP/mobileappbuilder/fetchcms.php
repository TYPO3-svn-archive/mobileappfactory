<?php
/*******************************************************************************
Version: 1 
Website: 
Author: Tim Wentzlau
Contributions by:
Licensed under The MIT License
Redistributions of files must retain the above copyright notice.
*******************************************************************************/

include_once("simple_html_dom.php");

class FetchCMS{
	var $appDir="";
	var $files=array();
	var $docNames=array();
	
	var $followLinks=false;
	var $debug=false;
	var $observer;
	var $frameworkInfo=array('name'=>'phonegapbuild','permissions'=>array());
	
	
	function __construct($observer){
		//$this->debug=$debug;
		
		$this->observer=$observer;
	}
	
	function __destruct(){
	}
	
	
	
	function addPage($doc,$newDocName="unknown"){
		if (!in_array($doc,$this->files)){
			$this->msg("add page",$doc);
			$this->files[]=$doc;
			$this->docNames[$doc]=$newDocName;
		}
	}
	
	
	function msg($tag,$msg,$level=3){
		if ($this->observer)
			$this->observer->CMSToAppMsg($tag,$msg,$level);
	}
	
	function getFileExtension($filepath)
    {
        preg_match('/[^?]*/', $filepath, $matches);
        $string = $matches[0];
     
        $pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);

        # check if there is any extension
        if(count($pattern) == 1)
        {
            //echo 'No File Extension Present';
            exit;
        }
       
        if(count($pattern) > 1)
        {
            $filenamepart = $pattern[count($pattern)-1][0];
            preg_match('/[^?]*/', $filenamepart, $matches);
            return $matches[0];
        }
    }
   
    function getFileName($filepath)
    {
        preg_match('/[^?]*/', $filepath, $matches);
        $string = $matches[0];
        #split the string by the literal dot in the filename
        $pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
        #get the last dot position
        $lastdot = $pattern[count($pattern)-1][1];
        #now extract the filename using the basename function
        $filename = basename(substr($string, 0, $lastdot-1));
        #return the filename part
        return $filename;
    }
	
	function getBaseFromFile($file){
		$find = '/';
		$after_find = substr(strrchr($file, $find), 1);
		$strlen_str = strlen($after_find);
		$result = substr($file, 0, -$strlen_str);
		return $result;
	}
	
	function getDomain($url){
		$res=parse_url($url);
		
		return $res['scheme'].'://'.$res['host'];
	}
	
	function getFullUrl($url,$doc){
		if (substr($url,0,4)=='http')
			return $url;
		else if ($url[0]=='/')
			return $this->getDomain($doc).$url; 
		else
			return $this->getBaseFromFile($doc).$url;
	}
	
	function saveResource($src,$type){
		$dstDir=$this->appDir.'/'.$type;
		
		if (!file_exists($dstDir))
			mkdir($dstDir,0770,true);
		$fname=$this->getFileName($src).'.'.$this->getFileExtension($src);
		if ($fname=='phonegap.js')
			return $this->appDir.'/'.$fname;
		else{
		
			$fileName=$dstDir.'/'.$fname;
			
			if (!file_exists($fileName)){
				copy($src,$fileName);
				$this->msg('save',$src.'->'.$fileName);
			}
			return $fileName; 
		}	
	}
	
	function getRelativeUrl($file){
		return substr($file,strlen($this->appDir)+1);
	}
	
	function copyUrl($appDir,$followLinks){
		if ($this->debug)
			$this->msg('copyUrl:'.$appDir);
		$this->appDir=$appDir;
		$this->followLinks=$followLinks;
		if (!file_exists($appDir))
			mkdir($appDir,0777,true);
		while (!empty($this->files)){
			$doc=array_pop($this->files);
			$this->msg('process page',$doc);
			$dom = new simple_html_dom();
			$dom->load_file($doc);
			$this->fixHeader($dom,$doc);
			$this->fixCSS($dom,$doc);
			$this->fixJS($dom,$doc);
			$this->fixLinks($dom,$doc);
			$this->fixImages($dom,$doc);
			$this->fixObjects($dom,$doc);
			$dom->save($this->appDir.'/'.$this->docNames[$doc]);
		}
	}
	
	function fixHeader($dom,$src){
		if ($this->debug)
			$this->msg("fixHeader",'');
		
		foreach($dom->find('base') as $element){
			if ($element->href){
				$element->href="";
			}
		}
		
		foreach($dom->find('meta') as $element){
			if ($element->name=='mobile-platform'){
				if ($element->content)
					$this->frameworkInfo['platform']=$element->content;
			}
			if ($element->name=='mobile-access'){
				if ($this->debug)
					$this->msg('mobile-access',$element->content);
				if ($element->content)
					$this->frameworkInfo['permissions'][$element->content]='1';
			}
		}
	}
	
	function fixCSS($dom,$src){
		if ($this->debug)
			$this->msg("fixCSS",'');
		
		foreach($dom->find('link') as $element){
			if ($element->href){
				$srcPath=$this->getFullUrl($element->href,$src);
				$res=$this->saveResource($srcPath,'css');
				$element->href=$this->getRelativeUrl($res);
			}
		}
	}
	
	function fixJS($dom,$src){
		if ($this->debug)
			$this->msg("fixJS",'');
		
		foreach($dom->find('script') as $element){
			if ($element->src){
				$srcPath=$this->getFullUrl($element->src,$src);
				$res=$this->saveResource($srcPath,'js');
				$element->src=$this->getRelativeUrl($res);
			}
		}
	}
	
	function parseURLName($query){
		if (!empty($query['id']))
			return 'page_'.$query['id'].'.html';
		if (!empty($query['article']))
			return 'page_'.$query['article'].'.html';
		
		return '';
	}
	
	function getURLName($ref,$refInfo){
		$name='';
		
		if (!empty($refInfo['query'])){
			parse_str($refInfo['query'],$res);
			
			$name=$this->parseURLName($res);
		} else
			$name=$this->getFileName($refInfo[path]).'.'.$this->getFileExtension($refInfo[path]);
		
		return $name; 	
	}
	
	function addLink($href,$src){
		$res="";
		$ref=$this->getFullUrl($href,$src);
		if (!empty($this->docNames[$ref]))
			$res=$this->docNames[$ref];
		else {
			$hrefInfo=parse_url($ref);
			$srcInfo=parse_url($src);
			if (($hrefInfo['host']==$srcInfo['host'])){
				$res=$this->getUrlName($href,$hrefInfo);
				if ($this->followLinks){
					$allow=true;
					if ($this->observer)
						$allow=$this->observer->allowURL($hrefInfo);
					if ($allow)
						$this->addPage($ref,$res);
				}
				
			} else
				$res=$href;
			
		} 
		return $res;
	}
	
	function fixLinks($dom,$src){
		if ($this->debug)
			$this->msg("fixLinks",'');
		
		foreach($dom->find('a') as $element){
			if ($element->href){
				$ref=$this->addLink($element->href,$src);
				$element->href=$ref;
			}
		}
	}
	
	function fixImages($dom,$src){
		if ($this->debug);
			$this->msg("fixImages",'');
		
		foreach($dom->find('img') as $element){
			$srcPath=$this->getFullUrl($element->src,$src);
			$res=$this->saveResource($srcPath,'images');
			$element->src=$this->getRelativeUrl($res);
		}
			
			 
	}
	
	function fixObjects($dom,$src){
		if ($this->debug);
			$this->msg("fixObjects",'');
		
		foreach($dom->find('object') as $element){
			$srcPath=$this->getFullUrl($element->data,$src);
			$res=$this->saveResource($srcPath,'objects');
			$element->data=$this->getRelativeUrl($res);
		}
			
			 
	}

}



?>