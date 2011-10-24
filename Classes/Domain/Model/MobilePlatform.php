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
 * MobilePlatform
 */
 class Tx_Mobileappfactory_Domain_Model_MobilePlatform extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Name of platform
	 *
	 * @var string $platform
	 */
	protected $platform;

	/**
	 * App icon
	 *
	 * @var string $icon
	 */
	protected $icon;

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
	 * @return string
	 */
	public function getPlatform() {
		return $this->platform;
	}

	/**
	 * Sets the platform
	 *
	 * @param string $platform
	 * @return void
	 */
	public function setPlatform($platform) {
		$this->platform = $platform;
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

}
?>