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
 * MobileTable
 */
 class Tx_Mobileappfactory_Domain_Model_MobileTable extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * mobileapp
	 *
	 * @var Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledb
	 */
	protected $mobiledb;

	/**
	 * name
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * title
	 *
	 * @var string $title
	 */
	protected $title;

	/**
	 * fields
	 *
	 * @var string $fields
	 */
	protected $fields;

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
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the fields
	 *
	 * @param string $fields
	 * @return void
	 */
	public function setFields($fields) {
		$this->fields = $fields;
	}

	/**
	 * Returns the fields
	 *
	 * @return string
	 */
	public function getFields() {
		return $this->fields;
	}

	/**
	 * Sets the fields
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobiledb
	 * @return void
	 */
	public function setMobileDB($mobiledb) {
		$this->mobiledb = $mobiledb;
	}

	/**
	 * Returns the fields
	 *
	 * @return Tx_Mobileappfactory_Domain_Model_MobileDB
	 */
	public function getMobileDB() {
		return $this->mobiledb;
	}

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

}
?>