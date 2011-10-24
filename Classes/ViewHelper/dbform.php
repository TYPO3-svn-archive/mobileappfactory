<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Tim Wentzlau <tim.wentzlau@auxilior.com>, Auxilior Technology PF
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * DB form viewHelper
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @package MobileAppFactory
 * @subpackage ViewHelper
 */
class Tx_MobileAppFactory_ViewHelpers_DBFormViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper implements Tx_Fluid_Core_ViewHelper_Facets_ChildNodeAccessInterface {

	public function __construct() {
		$this->registerArgument('table', 'mixed', 'table that should be used in the form', FALSE);
		$this->registerArgument('fields', 'mixed', 'Fields that should be shown on the form', FALSE);
		$this->registerArgument('name', 'mixed', 'Form name/id', FALSE);
		$this->registerArgument('attr', 'mixed', 'Additional attributes that should be applied to the form tag', FALSE);
	}
	
	/**
	 * An array of Tx_Fluid_Core_Parser_SyntaxTree_AbstractNode
	 * @var array
	 */
	private $childNodes = array();

	/**
	 * Setter for ChildNodes - as defined in ChildNodeAccessInterface
	 *
	 * @param array $childNodes Child nodes of this syntax tree node
	 * @return void
	 
	 */
	public function setChildNodes(array $childNodes) {
		$this->childNodes = $childNodes;
	}
	
	
	/**
	 * renders <appfactory:DBForm>  
	 *
	 * 
	 * @return string the rendered string
	 
	 */
	public function render() {
		
		$tableRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileTableRepository');
		$table=$tableRepository->findByUid($this->arguments['table']);
		
		$attr=$this->arguments['attr'];
		$attrStr="";
		foreach($attr as $key=>$value){
			$attrStr.=$key.'="'.$value.'" ';
		}
		
		$json='{'.$table->getFields().'}';
		$json = str_replace(array("\n","\r"),"",$json);
		$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$json);
		//$json="{".$table->getFields()."}";
		
		$tableFields=json_decode($json,true);
		$output="<form id='".$this->arguments['name']."'  ".$attrStr.">\n";
		$output.='<input type="hidden" name="id" id="id" value="0">';

		$json='{'.$this->arguments['fields'].'}';
		$json = str_replace(array("\n","\r"),"",$json);
		$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$json);
		$formOptions=json_decode($json,true);
		$browseFields=array();
		foreach($formOptions['fields'] as $formField=>$fieldOptions){
			
			$tableField=$tableFields['fields'][$formField];
			$tableFlags="";
			if (!empty($tableField['flags']))
				$tableFlags=implode(" ",$tableField['flags']);
			$type=$tableField['type'];
			
			if (is_array($fieldOptions['flags'])&&in_array('hidden',$fieldOptions['flags']))
				$type=hidden;
				
			if (is_array($fieldOptions['flags'])&&in_array('useBrowseVal',$fieldOptions['flags']))
				$browseFields[$formField]=$tableFields['fields'][$formField]['table'];


			
			
			$title=$formField;
			if (!empty($tableField['title']))
				$title=$tableField['title'];
			if ($type=='hidden')	
				$output.='<input type="hidden" name="'.$formField.'" id="'.$formField.'" class="'.$tableFlags.'" value=""  />';
			else if ($type=='string')	
				$output.='<label for="'.$formField.'">'.$title.':</label><input type="text" name="'.$formField.'" id="'.$formField.'" class="'.$tableFlags.'" value=""  />';
			else if ($type=='text')	
				$output.='<label for="'.$formField.'">'.$title.':</label><textarea type="text" name="'.$formField.'" id="'.$formField.'" class="'.$tableFlags.'" value=""  ></textarea>';
		}
		//$output.='<input type="submit" name="submit" value="Submit">';
		
		$this->templateVariableContainer->add('browseFields',$browseFields); 
		$output.='</form>';
		$output.=$this->renderChild('DBFormExtra');
		$output.="\n<script>\n";
		
		$output.=$this->renderChild('DBFormScript');
		
		$output.="\n</script>\n";
		
		return $output;
	}
	
	/**
	 * renders a child viewhelper  
	 *
	 *  @param child Name of child viewhelper 
	 * @return string the rendered string
	 
	 */
	protected function renderChild($child) {
		if ($this->arguments->hasArgument($child)) {
			return $this->arguments[$child];
		}

		foreach ($this->childNodes as $childNode) {

			
			if ($childNode instanceof Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode
				&& $childNode->getViewHelperClassName() === 'Tx_MobileAppFactory_ViewHelpers_'.$child.'ViewHelper') {
				$data = $childNode->evaluate($this->getRenderingContext());
				return $data;
			}
		}
		
	}
	
}
?>
