<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 
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
 * MobileFactory
 */
 class Tx_Mobileappfactory_Domain_Model_MobileFactory extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * id of page contaning the apps for the factory
	 *
	 * @var int $factorypage
	 */
	protected $factorypage;

	/**
	 * name
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Name of author
	 *
	 * @var string $author
	 */
	protected $author;

	/**
	 * Name of company
	 *
	 * @var string $company
	 */
	protected $company;

	/**
	 * Apps belonging to this factory
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileApp> $apps
	 */
	protected $apps;

	/**
	 * URL to company pange
	 *
	 * @var string
	 */
	protected $www;

	/**
	 * Support email
	 *
	 * @var string
	 */
	protected $support;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the author
	 *
	 * @return string $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param string $author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * Returns the company
	 *
	 * @return string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * Returns the factory page
	 *
	 * @return int $factorypage
	 */
	public function getFactorypage() {
		return $this->factorypage;
	}

	/**
	 * Sets the factoryPage
	 *
	 * @param int $factorypage
	 * @return void
	 */
	public function setFactorypage($factorypage) {
		$this->factorypage = $factorypage;
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the extension builder
		* You may modify the constructor of this class instead
		*/
		$this->apps = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $app
	 * @return void
	 */
	public function addApp(Tx_Mobileappfactory_Domain_Model_MobileApp $app) {
		$this->apps->attach($app);
	}

	/**
	 * Removes a MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $appToRemove The MobileApp to be removed
	 * @return void
	 */
	public function removeApp(Tx_Mobileappfactory_Domain_Model_MobileApp $appToRemove) {
		$this->apps->detach($appToRemove);
	}

	/**
	 * Returns the apps
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileApp> $apps
	 */
	public function getApps() {
		return $this->apps;
	}

	/**
	 * Sets the apps
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileApp> $apps
	 * @return void
	 */
	public function setApps($apps) {
		$this->apps = $apps;
	}

	/**
	 * createFactoryStructure
	 *
	 * @return void
	 * @param $pidAppFolder
	 */
	public function createFactoryStructure($pidAppFolder) {
		
		$data = array(
			'pages' => array(
				'NEW_1' => array(
					'pid' => $pidAppFolder,
					'title' => $this->getName(),
					'hidden'=>false,
					'doktype'=>254,
					'module'=>'mobilefact'
				)
			)
		);
		
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		$tce->stripslashes_values = 0;
		$tce->start($data,array());
		$tce->process_datamap();
		$this->setFactorypage($tce->substNEWwithIDs['NEW_1']);
	}

	/**
	 * Returns the www
	 *
	 * @return string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the www
	 *
	 * @param string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}

	/**
	 * Returns the support
	 *
	 * @return string $support
	 */
	public function getSupport() {
		return $this->support;
	}

	/**
	 * Sets the support
	 *
	 * @param string $support
	 * @return void
	 */
	public function setSupport($support) {
		$this->support = $support;
	}

}
?>