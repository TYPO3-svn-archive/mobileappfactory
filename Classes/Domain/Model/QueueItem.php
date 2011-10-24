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
 * BuildQueue
 */
 class Tx_Mobileappfactory_Domain_Model_QueueItem extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * mobileapp
	 *
	 * @var Tx_Mobileappfactory_Domain_Model_MobileApp $mobileapp
	 */
	protected $mobileapp;

	/**
	 * buildstart
	 *
	 * @var DateTime $buildstart
	 */
	protected $buildstart;

	/**
	 * buildend
	 *
	 * @var DateTime $buildend
	 */
	protected $buildend;

	/**
	 * appfile
	 *
	 * @var string $appfile
	 */
	protected $appfile;

	/**
	 * state
	 *
	 * @var string $state
	 */
	protected $state;

	/**
	 * error
	 *
	 * @var string $error
	 */
	protected $error;

	/**
	 * errormessage
	 *
	 * @var string $errormessage
	 */
	protected $errormessage;

	/**
	 * output
	 *
	 * @var string $output
	 */
	protected $output;

	/**
	 * buildhandler
	 *
	 * @var string $buildhandler
	 */
	protected $buildhandler;

	/**
	 * platform
	 *
	 * @var integer $platform
	 */
	protected $platform;

	/**
	 * Sets the buildstart
	 *
	 * @param DateTime $buildstart
	 * @return void
	 */
	public function setBuildstart(DateTime $buildstart) {
		$this->buildstart = $buildstart;
	}

	/**
	 * Returns the buildstart
	 *
	 * @return DateTime
	 */
	public function getBuildstart() {
		return $this->buildstart;
	}

	/**
	 * Sets the buildend
	 *
	 * @param DateTime $buildend
	 * @return void
	 */
	public function setBuildend(DateTime $buildend) {
		$this->buildend = $buildend;
	}

	/**
	 * Returns the buildend
	 *
	 * @return DateTime
	 */
	public function getBuildend() {
		return $this->buildend;
	}

	/**
	 * Sets the appfile
	 *
	 * @param string $appfile
	 * @return void
	 */
	public function setAppfile($appfile) {
		$this->appfile = $appfile;
	}

	/**
	 * Returns the appfile
	 *
	 * @return string
	 */
	public function getAppfile() {
		return $this->appfile;
	}

	/**
	 * Sets the state
	 *
	 * @param string $state
	 * @return void
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * Returns the state
	 *
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Sets the error
	 *
	 * @param string $error
	 * @return void
	 */
	public function setError($error) {
		$this->error = $error;
	}

	/**
	 * Returns the error
	 *
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * Sets the errormessage
	 *
	 * @param string $errormessage
	 * @return void
	 */
	public function setErrormessage($errormessage) {
		$this->errormessage = $errormessage;
	}

	/**
	 * Returns the errormessage
	 *
	 * @return string
	 */
	public function getErrormessage() {
		return $this->errormessage;
	}

	/**
	 * Sets the output
	 *
	 * @param string $output
	 * @return void
	 */
	public function setOutput($output) {
		$this->output = $output;
	}

	/**
	 * Returns the output
	 *
	 * @return string
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Sets the buildhandler
	 *
	 * @param string $buildhandler
	 * @return void
	 */
	public function setBuildhandler($buildhandler) {
		$this->buildhandler = $buildhandler;
	}

	/**
	 * Returns the buildhandler
	 *
	 * @return string
	 */
	public function getBuildhandler() {
		return $this->buildhandler;
	}

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the platform
	 *
	 * @return integer $platform
	 */
	public function getPlatform() {
		return $this->platform;
	}

	/**
	 * Sets the platform
	 *
	 * @param integer $platform
	 * @return void
	 */
	public function setPlatform($platform) {
		$this->platform = $platform;
	}

	/**
	 * Returns the App for the item
	 *
	 * @return Tx_Mobileappfactory_Domain_Model_MobileApp $mobileapp
	 */
	public function getMobileapp() {
		return $this->mobileapp;
	}

	/**
	 * Sets the app
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $mobileapp
	 * @return void
	 */
	public function setMobileapp($mobileapp) {
		$this->mobileapp = $mobileapp;
	}

}
?>