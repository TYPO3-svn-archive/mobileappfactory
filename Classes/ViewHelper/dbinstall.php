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
 * Install DB viewHelper
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @package MobileAppFactory
 * @subpackage ViewHelper
 */
 
class Tx_MobileAppFactory_ViewHelpers_InstallDbViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper implements Tx_Fluid_Core_ViewHelper_Facets_ChildNodeAccessInterface {

	public function __construct() {
		$this->registerArgument('db', 'mixed', 'uid of record beloning to Tx_Mobileappfactory_Domain_Repository_MobileDBRepository', FALSE);
		
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
	 * renders <appfactory:InstallDB> javascript required to install db in browser.
	 *
	 * 
	 * @return string the rendered string
	 */
	public function render() {
		
		$dbRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileDBRepository');
		$db=$dbRepository->findByUid($this->arguments['db']);
		
		$tables=$db->getTables();
		
		$sql="";
		foreach($tables as $table){
			$sql.='CREATE TABLE IF NOT EXISTS '.$table->getName().' (';
			$sql.='id INTEGER PRIMARY KEY AUTOINCREMENT';
			$json='{'.$table->getFields().'}';
			$json = str_replace(array("\n","\r"),"",$json);
			$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$json);
			$config=json_decode($json,true);
			foreach($config['fields'] as $name=>$field){
				if ($field['type']=='dbrel')
					$sql.=','.$name.' integer';
				else
					$sql.=','.$name.' '.$field['type'];
				
			}
			$sql.=");";
			
		}

		$options='{';
			$options.='name:"'.$db->getName().'",';
			$options.='version:"'.$db->getVersion().'",';
			$options.='create:{';
				$options.='sql:"'.$sql.'",';
				$options.='callbacks:{';
					$options.='start:function(){'.$this->renderChild('Start').'},';
					$options.='finish:function(){'.$this->renderChild('Finish').'},';
					$options.='error:function(){'.$this->renderChild('Error').'},';
				$options.='}';
			$options.='}';
		$options.='}';
		
		
		
		$output='localDB.start('.$options.')';
		
		return $output;
	}
	
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