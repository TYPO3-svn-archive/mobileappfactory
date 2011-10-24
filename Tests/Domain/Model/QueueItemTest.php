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
 * Testcase for class Tx_Mobileappfactory_Domain_Model_QueueItem.
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
class Tx_Mobileappfactory_Domain_Model_QueueItemTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_QueueItem
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Mobileappfactory_Domain_Model_QueueItem();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getBuildstartReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setBuildstartForDateTimeSetsBuildstart() { }
	
	/**
	 * @test
	 */
	public function getBuildendReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setBuildendForDateTimeSetsBuildend() { }
	
	/**
	 * @test
	 */
	public function getAppfileReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAppfileForStringSetsAppfile() { 
		$this->fixture->setAppfile('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAppfile()
		);
	}
	
	/**
	 * @test
	 */
	public function getStateReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStateForStringSetsState() { 
		$this->fixture->setState('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getState()
		);
	}
	
	/**
	 * @test
	 */
	public function getErrorReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setErrorForStringSetsError() { 
		$this->fixture->setError('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getError()
		);
	}
	
	/**
	 * @test
	 */
	public function getErrormessageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setErrormessageForStringSetsErrormessage() { 
		$this->fixture->setErrormessage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getErrormessage()
		);
	}
	
	/**
	 * @test
	 */
	public function getOutputReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setOutputForStringSetsOutput() { 
		$this->fixture->setOutput('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getOutput()
		);
	}
	
	/**
	 * @test
	 */
	public function getBuildhandlerReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setBuildhandlerForStringSetsBuildhandler() { 
		$this->fixture->setBuildhandler('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getBuildhandler()
		);
	}
	
	/**
	 * @test
	 */
	public function getPlatformReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPlatform()
		);
	}

	/**
	 * @test
	 */
	public function setPlatformForIntegerSetsPlatform() { 
		$this->fixture->setPlatform(12);

		$this->assertSame(
			12,
			$this->fixture->getPlatform()
		);
	}
	
}
?>