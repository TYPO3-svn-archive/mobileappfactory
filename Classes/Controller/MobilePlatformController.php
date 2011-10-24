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
 * Controller for the MobilePlatform object
 */
 class Tx_Mobileappfactory_Controller_MobilePlatformController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * mobilePlatformRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_MobilePlatformRepository
	 */
	protected $mobilePlatformRepository;

	/**
	 * Displays a single MobilePlatform
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobilePlatform $mobilePlatform the MobilePlatform to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_MobilePlatform $mobilePlatform) {
		$this->view->assign('mobilePlatform', $mobilePlatform);
	}

	/**
	 * injectMobilePlatformRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_MobilePlatformRepository $MobilePlatformRepository
	 * @return void
	 */
	public function injectMobilePlatformRepository($mobilePlatformRepository) {
		$this->mobilePlatformRepository = t3lib_div::makeInstance(Tx_Mobileappfactory_Domain_Repository_MobilePlatformRepository);
	}

	/**
	 * action list
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {

	}

	/**
	 * action new
	 *
	 * @return string The rendered new action
	 */
	public function newAction() {

	}

	/**
	 * action create
	 *
	 * @return string The rendered create action
	 */
	public function createAction() {

	}

	/**
	 * action edit
	 *
	 * @return string The rendered edit action
	 */
	public function editAction() {

	}

	/**
	 * action update
	 *
	 * @return string The rendered update action
	 */
	public function updateAction() {

	}

	/**
	 * action delete
	 *
	 * @return string The rendered delete action
	 */
	public function deleteAction() {

	}

}
?>