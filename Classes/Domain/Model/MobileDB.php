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
 * MobileDB
 */
 class Tx_Mobileappfactory_Domain_Model_MobileDB extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * name
	 *
	 * @var string $name
	 */
	protected $name;

	/**
	 * version
	 *
	 * @var string $version
	 */
	protected $version;

	/**
	 * tables
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileTable> $tables
	 */
	protected $tables;

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
		$this->tables = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Sets the tables
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileTable> $tables
	 * @return void
	 */
	public function setTables(Tx_Extbase_Persistence_ObjectStorage $tables) {
		$this->tables = $tables;
	}

	/**
	 * Returns the tables
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Mobileappfactory_Domain_Model_MobileTable>
	 */
	public function getTables() {
		return $this->tables;
	}

	/**
	 * Adds a MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable the MobileTable to be added
	 * @return void
	 */
	public function addTable(Tx_Mobileappfactory_Domain_Model_MobileTable $table) {
		$this->tables->attach($table);
	}

	/**
	 * Removes a MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable the MobileTable to be removed
	 * @return void
	 */
	public function removeTable(Tx_Mobileappfactory_Domain_Model_MobileTable $tableToRemove) {
		$this->tables->detach($tableToRemove);
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

}
?>