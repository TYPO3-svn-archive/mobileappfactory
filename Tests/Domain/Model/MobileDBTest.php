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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Testcase for class Tx_Mobileappfactory_Domain_Model_MobileDB.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Mobile App Factory
 *
 * @author Tim Wentzlau <tim.wentzlau@auxilior.com>
 */
class Tx_Mobileappfactory_Domain_Model_MobileDBTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_MobileDB
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Mobileappfactory_Domain_Model_MobileDB();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getVersionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setVersionForStringSetsVersion() { 
		$this->fixture->setVersion('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getVersion()
		);
	}
	
	/**
	 * @test
	 */
	public function getTablesReturnsInitialValueForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileTable() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getTables()
		);
	}

	/**
	 * @test
	 */
	public function setTablesForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileTableSetsTables() { 
		$table = new Tx_Mobileappfactory_Domain_Model_MobileTable();
		$objectStorageHoldingExactlyOneTables = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTables->attach($table);
		$this->fixture->setTables($objectStorageHoldingExactlyOneTables);

		$this->assertSame(
			$objectStorageHoldingExactlyOneTables,
			$this->fixture->getTables()
		);
	}
	
	/**
	 * @test
	 */
	public function addTableToObjectStorageHoldingTables() {
		$table = new Tx_Mobileappfactory_Domain_Model_MobileTable();
		$objectStorageHoldingExactlyOneTable = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTable->attach($table);
		$this->fixture->addTable($table);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneTable,
			$this->fixture->getTables()
		);
	}

	/**
	 * @test
	 */
	public function removeTableFromObjectStorageHoldingTables() {
		$table = new Tx_Mobileappfactory_Domain_Model_MobileTable();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($table);
		$localObjectStorage->detach($table);
		$this->fixture->addTable($table);
		$this->fixture->removeTable($table);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getTables()
		);
	}
	
}
?>