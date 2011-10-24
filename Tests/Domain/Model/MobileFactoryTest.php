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
 * Testcase for class Tx_Mobileappfactory_Domain_Model_MobileFactory.
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
class Tx_Mobileappfactory_Domain_Model_MobileFactoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_MobileFactory
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Mobileappfactory_Domain_Model_MobileFactory();
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
	public function getAuthorReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAuthorForStringSetsAuthor() { 
		$this->fixture->setAuthor('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAuthor()
		);
	}
	
	/**
	 * @test
	 */
	public function getCompanyReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCompanyForStringSetsCompany() { 
		$this->fixture->setCompany('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCompany()
		);
	}
	
	/**
	 * @test
	 */
	public function getWwwReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setWwwForStringSetsWww() { 
		$this->fixture->setWww('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getWww()
		);
	}
	
	/**
	 * @test
	 */
	public function getSupportReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSupportForStringSetsSupport() { 
		$this->fixture->setSupport('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSupport()
		);
	}
	
	/**
	 * @test
	 */
	public function getAppsReturnsInitialValueForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileApp() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getApps()
		);
	}

	/**
	 * @test
	 */
	public function setAppsForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileAppSetsApps() { 
		$app = new Tx_Mobileappfactory_Domain_Model_MobileApp();
		$objectStorageHoldingExactlyOneApps = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneApps->attach($app);
		$this->fixture->setApps($objectStorageHoldingExactlyOneApps);

		$this->assertSame(
			$objectStorageHoldingExactlyOneApps,
			$this->fixture->getApps()
		);
	}
	
	/**
	 * @test
	 */
	public function addAppToObjectStorageHoldingApps() {
		$app = new Tx_Mobileappfactory_Domain_Model_MobileApp();
		$objectStorageHoldingExactlyOneApp = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneApp->attach($app);
		$this->fixture->addApp($app);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneApp,
			$this->fixture->getApps()
		);
	}

	/**
	 * @test
	 */
	public function removeAppFromObjectStorageHoldingApps() {
		$app = new Tx_Mobileappfactory_Domain_Model_MobileApp();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($app);
		$localObjectStorage->detach($app);
		$this->fixture->addApp($app);
		$this->fixture->removeApp($app);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getApps()
		);
	}
	
}
?>