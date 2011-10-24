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
require_once (t3lib_extMgm::extPath('impexp').'class.tx_impexp.php');


/**
 * MobileApp
 */
 class Tx_Mobileappfactory_Domain_Model_MobileApp extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * mobileapp
	 *
	 * @var Tx_Mobileappfactory_Domain_Model_MobileFactory $mobilefactory
	 */
	protected $mobilefactory;

	/**
	 * Appfolder
	 *
	 * @var int $appfolder
	 */
	protected $appfolder;

	/**
	 * Datafolder
	 *
	 * @var int $datafolder
	 */
	protected $datafolder;

	/**
	 * views
	 *
	 * @var int $views
	 */
	protected $views;

	/**
	 * startview
	 *
	 * @var int $startview
	 */
	protected $startview;

	/**
	 * Name of application
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Version number for app
	 *
	 * @var string $version
	 */
	protected $version;

	/**
	 * Description of app
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * id from build system
	 *
	 * @var string $buildid
	 */
	protected $buildid;

	/**
	 * id from build system
	 *
	 * @var string $icon
	 */
	protected $icon;

	/**
	 * Time for last build
	 *
	 * @var DateTime $buildTime
	 */
	protected $buildTime;

	/**
	 * Does the app need a rebuild
	 *
	 * @var integer $isDirty
	 */
	protected $isDirty;

	/**
	 * template used for this app
	 *
	 * @var string $template
	 */
	protected $template;

	/**
	 * Platforms
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobilePlatform> $platforms
	 */
	protected $platforms;

	/**
	 * Items in build queue that belongs to this app
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_QueueItem> $queueItems
	 */
	protected $queueItems;

	/**
	 * Items in build queue that belongs to this app
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileDB> $mobiledb
	 */
	protected $mobiledb;

	/**
	 * Application splash image for this app
	 *
	 * @var string
	 */
	protected $splash;

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
	 * Returns the name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

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
		$this->platforms = new Tx_Extbase_Persistence_ObjectStorage();
		$this->queueItems = new Tx_Extbase_Persistence_ObjectStorage();
		$this->mobiledb = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a MobilePlatform
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobilePlatform $platform
	 * @return void
	 */
	public function addPlatform(Tx_Mobileappfactory_Domain_Model_MobilePlatform $platform) {
		$this->platforms->attach($platform);
	}

	/**
	 * Removes a MobilePlatform
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobilePlatform $platformToRemove The MobilePlatform to be removed
	 * @return void
	 */
	public function removePlatform(Tx_Mobileappfactory_Domain_Model_MobilePlatform $platformToRemove) {
		$this->platforms->detach($platformToRemove);
	}

	/**
	 * Returns the platforms
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobilePlatform> $platforms
	 */
	public function getPlatforms() {
		return $this->platforms;
	}

	/**
	 * Sets the platforms
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobilePlatform> $platforms
	 * @return void
	 */
	public function setPlatforms($platforms) {
		$this->platforms = $platforms;
	}

	/**
	 * Returns the version
	 *
	 * @return string $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Sets the version
	 *
	 * @param string $version
	 * @return void
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * Returns the data folder
	 *
	 * @return int $datafolder
	 */
	public function getDatafolder() {
		return $this->datafolder;
	}

	/**
	 * Sets the datafolder
	 *
	 * @param int $datafolder
	 * @return void
	 */
	public function setDatafolder($datafolder) {
		$this->datafolder = $datafolder;
	}

	/**
	 * Returns the view folder
	 *
	 * @return int $views
	 */
	public function getViews() {
		return $this->views;
	}

	/**
	 * Sets the view folder
	 *
	 * @param int $views
	 * @return void
	 */
	public function setViews($views) {
		$this->views = $views;
	}

	/**
	 * Returns the start view
	 *
	 * @return int $startview
	 */
	public function getStartview() {
		return $this->startview;
	}

	/**
	 * Sets the start view
	 *
	 * @param int $startview
	 * @return void
	 */
	public function setStartview($startview) {
		$this->startview = $startview;
	}

	/**
	 * Returns the app folder
	 *
	 * @return int $appfolder
	 */
	public function getAppfolder() {
		return $this->appFolder;
	}

	/**
	 * Sets the app folder
	 *
	 * @param int $appfolder
	 * @return void
	 */
	public function setAppfolder($appfolder) {
		$this->appfolder = $appfolder;
	}

	/**
	 * Returns the factory
	 *
	 * @return Tx_Mobileappfactory_Domain_Model_MobileFactory $mobilefactory
	 */
	public function getMobilefactory() {
		return $this->mobilefactory;
	}

	/**
	 * Sets the mobile factory
	 *
	 * @param int $mobilefactory
	 * @return void
	 */
	public function setMobilefactory($mobilefactory) {
		$this->mobilefactory = $mobilefactory;
	}

	/**
	 * Adds a QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItemItems $queueItemItems
	 * @return void
	 */
	public function addQueueItem(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem) {
		$this->queueItems->attach($queueItems);
	}

	/**
	 * Removes a QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItemItems $queueItemItemsToRemove The BuildQueueItems to be removed
	 * @return void
	 */
	public function removeQueueItem(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItemToRemove) {
		$this->queueItems->detach($queueItemToRemove);
	}

	/**
	 * Returns the queueItems
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_BuildQueueItems> $queueItemItems
	 */
	public function getQueueItems() {
		return $this->queueItems;
	}

	/**
	 * Sets the queueItems
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_QueueItemItems> $queueItemItems
	 * @return void
	 */
	public function setQueueItems($queueItems) {
		$this->queueItems = $queueItems;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the buildid
	 *
	 * @return string $buildid
	 */
	public function getBuildid() {
		return $this->buildid;
	}

	/**
	 * Sets the buildid
	 *
	 * @param string $buildid
	 * @return void
	 */
	public function setBuildid($buildid) {
		$this->buildid = $buildid;
	}

	/**
	 * Returns the icon
	 *
	 * @return string $icon
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Sets the icon
	 *
	 * @param string $icon
	 * @return void
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
	}

	/**
	 * Returns the buildTime
	 *
	 * @return DateTime $buildTime
	 */
	public function getBuildTime() {
		return $this->buildTime;
	}

	/**
	 * Sets the buildTime
	 *
	 * @param DateTime $buildTime
	 * @return void
	 */
	public function setBuildTime($buildTime) {
		$this->buildTime = $buildTime;
	}

	/**
	 * Returns the isDirty
	 *
	 * @return integer $isDirty
	 */
	public function getIsDirty() {
		return $this->isDirty;
	}

	/**
	 * Sets the isDirty
	 *
	 * @param integer $isDirty
	 * @return void
	 */
	public function setIsDirty($isDirty) {
		$this->isDirty = $isDirty;
	}

	/**
	 * createAppStructure
	 *
	 * @return void
	 */
	public function createAppStructure() {
		
			$appTemplatePath=t3lib_extMgm::extPath('mobileappfactory').'Resources/Private/AppTemplates/'.$this->getTemplate().'/';
			$config=include($appTemplatePath.'info.php');
			
			$factory=$this->getMobilefactory();
			
			$import = t3lib_div::makeInstance('tx_impexp');
			$import->init(0,'import');
			
			
			$inFile=$appTemplatePath.'app.t3d';
			if ($inFile && @is_file($inFile))	{
				$trow = array();
				if ($import->loadFile($inFile,1))	{
				}
				
				$import->importData($factory->getFactorypage());
			}
			
			print_r($import->import_mapId);
			
			$pageMap=$import->import_mapId['pages'];
			
			$this->setAppfolder($pageMap[$config['pages']['app']]);
			$this->setViews($pageMap[$config['pages']['views']]);
			$this->setDatafolder($pageMap[$config['pages']['db']]);
			$this->setStartview($pageMap[$config['pages']['start']]);
			
			
			$data = array();
			$data['pages'][$pageMap[$config['pages']['app']]]=array(
				'title' => $this->getName(),
			);
			
			
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			$tce->stripslashes_values = 0;
			$tce->start($data,array());
			$tce->process_datamap();
			
		return $pageMap[$config['pages']['app']];
	}

	/**
	 * Adds a MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledb
	 * @return void
	 */
	public function addMobiledb(Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledb) {
		$this->mobiledb->attach($mobiledb);
	}

	/**
	 * Removes a MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledbToRemove The MobileDB to be removed
	 * @return void
	 */
	public function removeMobiledb(Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledbToRemove) {
		$this->mobiledb->detach($mobiledbToRemove);
	}

	/**
	 * Returns the mobiledb
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileDB> $mobiledb
	 */
	public function getMobiledb() {
		return $this->mobiledb;
	}

	/**
	 * Sets the mobiledb
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileDB> $mobiledb
	 * @return void
	 */
	public function setMobiledb($mobiledb) {
		$this->mobiledb = $mobiledb;
	}

	/**
	 * Returns the template
	 *
	 * @return string $template
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * Sets the template
	 *
	 * @param string $template
	 * @return void
	 */
	public function setTemplate($template) {
		$this->template = $template;
	}

	/**
	 * Returns the splash
	 *
	 * @return string $splash
	 */
	public function getSplash() {
		return $this->splash;
	}

	/**
	 * Sets the splash
	 *
	 * @param string $splash
	 * @return void
	 */
	public function setSplash($splash) {
		$this->splash = $splash;
	}

}
?>