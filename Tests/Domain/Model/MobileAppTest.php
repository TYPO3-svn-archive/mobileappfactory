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
 * Testcase for class Tx_Mobileappfactory_Domain_Model_MobileApp.
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
class Tx_Mobileappfactory_Domain_Model_MobileAppTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_MobileApp
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Mobileappfactory_Domain_Model_MobileApp();
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
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getBuildidReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setBuildidForStringSetsBuildid() { 
		$this->fixture->setBuildid('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getBuildid()
		);
	}
	
	/**
	 * @test
	 */
	public function getIconReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIconForStringSetsIcon() { 
		$this->fixture->setIcon('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIcon()
		);
	}
	
	/**
	 * @test
	 */
	public function getBuildTimeReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setBuildTimeForDateTimeSetsBuildTime() { }
	
	/**
	 * @test
	 */
	public function getIsDirtyReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getIsDirty()
		);
	}

	/**
	 * @test
	 */
	public function setIsDirtyForIntegerSetsIsDirty() { 
		$this->fixture->setIsDirty(12);

		$this->assertSame(
			12,
			$this->fixture->getIsDirty()
		);
	}
	
	/**
	 * @test
	 */
	public function getTemplateReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTemplateForStringSetsTemplate() { 
		$this->fixture->setTemplate('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTemplate()
		);
	}
	
	/**
	 * @test
	 */
	public function getSplashReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSplashForStringSetsSplash() { 
		$this->fixture->setSplash('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSplash()
		);
	}
	
	/**
	 * @test
	 */
	public function getPlatformsReturnsInitialValueForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobilePlatform() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getPlatforms()
		);
	}

	/**
	 * @test
	 */
	public function setPlatformsForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobilePlatformSetsPlatforms() { 
		$platform = new Tx_Mobileappfactory_Domain_Model_MobilePlatform();
		$objectStorageHoldingExactlyOnePlatforms = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOnePlatforms->attach($platform);
		$this->fixture->setPlatforms($objectStorageHoldingExactlyOnePlatforms);

		$this->assertSame(
			$objectStorageHoldingExactlyOnePlatforms,
			$this->fixture->getPlatforms()
		);
	}
	
	/**
	 * @test
	 */
	public function addPlatformToObjectStorageHoldingPlatforms() {
		$platform = new Tx_Mobileappfactory_Domain_Model_MobilePlatform();
		$objectStorageHoldingExactlyOnePlatform = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOnePlatform->attach($platform);
		$this->fixture->addPlatform($platform);

		$this->assertEquals(
			$objectStorageHoldingExactlyOnePlatform,
			$this->fixture->getPlatforms()
		);
	}

	/**
	 * @test
	 */
	public function removePlatformFromObjectStorageHoldingPlatforms() {
		$platform = new Tx_Mobileappfactory_Domain_Model_MobilePlatform();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($platform);
		$localObjectStorage->detach($platform);
		$this->fixture->addPlatform($platform);
		$this->fixture->removePlatform($platform);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getPlatforms()
		);
	}
	
	/**
	 * @test
	 */
	public function getQueueItemsReturnsInitialValueForObjectStorageContainingTx_Mobileappfactory_Domain_Model_QueueItem() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getQueueItems()
		);
	}

	/**
	 * @test
	 */
	public function setQueueItemsForObjectStorageContainingTx_Mobileappfactory_Domain_Model_QueueItemSetsQueueItems() { 
		$queueItem = new Tx_Mobileappfactory_Domain_Model_QueueItem();
		$objectStorageHoldingExactlyOneQueueItems = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQueueItems->attach($queueItem);
		$this->fixture->setQueueItems($objectStorageHoldingExactlyOneQueueItems);

		$this->assertSame(
			$objectStorageHoldingExactlyOneQueueItems,
			$this->fixture->getQueueItems()
		);
	}
	
	/**
	 * @test
	 */
	public function addQueueItemToObjectStorageHoldingQueueItems() {
		$queueItem = new Tx_Mobileappfactory_Domain_Model_QueueItem();
		$objectStorageHoldingExactlyOneQueueItem = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQueueItem->attach($queueItem);
		$this->fixture->addQueueItem($queueItem);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneQueueItem,
			$this->fixture->getQueueItems()
		);
	}

	/**
	 * @test
	 */
	public function removeQueueItemFromObjectStorageHoldingQueueItems() {
		$queueItem = new Tx_Mobileappfactory_Domain_Model_QueueItem();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($queueItem);
		$localObjectStorage->detach($queueItem);
		$this->fixture->addQueueItem($queueItem);
		$this->fixture->removeQueueItem($queueItem);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getQueueItems()
		);
	}
	
	/**
	 * @test
	 */
	public function getMobiledbReturnsInitialValueForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileDB() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getMobiledb()
		);
	}

	/**
	 * @test
	 */
	public function setMobiledbForObjectStorageContainingTx_Mobileappfactory_Domain_Model_MobileDBSetsMobiledb() { 
		$mobiledb = new Tx_Mobileappfactory_Domain_Model_MobileDB();
		$objectStorageHoldingExactlyOneMobiledb = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneMobiledb->attach($mobiledb);
		$this->fixture->setMobiledb($objectStorageHoldingExactlyOneMobiledb);

		$this->assertSame(
			$objectStorageHoldingExactlyOneMobiledb,
			$this->fixture->getMobiledb()
		);
	}
	
	/**
	 * @test
	 */
	public function addMobiledbToObjectStorageHoldingMobiledb() {
		$mobiledb = new Tx_Mobileappfactory_Domain_Model_MobileDB();
		$objectStorageHoldingExactlyOneMobiledb = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneMobiledb->attach($mobiledb);
		$this->fixture->addMobiledb($mobiledb);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneMobiledb,
			$this->fixture->getMobiledb()
		);
	}

	/**
	 * @test
	 */
	public function removeMobiledbFromObjectStorageHoldingMobiledb() {
		$mobiledb = new Tx_Mobileappfactory_Domain_Model_MobileDB();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($mobiledb);
		$localObjectStorage->detach($mobiledb);
		$this->fixture->addMobiledb($mobiledb);
		$this->fixture->removeMobiledb($mobiledb);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getMobiledb()
		);
	}
	
}
?>