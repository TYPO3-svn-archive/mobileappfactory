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
 * Testcase for class Tx_Mobileappfactory_Domain_Model_MobilePlatform.
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
class Tx_Mobileappfactory_Domain_Model_MobilePlatformTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_MobilePlatform
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Mobileappfactory_Domain_Model_MobilePlatform();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getPlatformReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPlatformForStringSetsPlatform() { 
		$this->fixture->setPlatform('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPlatform()
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
	
}
?>