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
 * Controller for the MobileApp object
 */
 class Tx_Mobileappfactory_Controller_MobileAppController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * mobileAppRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_MobileAppRepository
	 */
	protected $mobileAppRepository;

	/**
	 * injectMobileAppRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_MobileAppRepository $mobileAppRepository
	 * @return void
	 */
	public function injectMobileAppRepository(Tx_Mobileappfactory_Domain_Repository_MobileAppRepository $mobileAppRepository) {
		$this->mobileAppRepository = $mobileAppRepository;
	}

	/**
	 * Displays all MobileApps
	 *
	 * @return void
	 */
	public function listAction() {
		$mobileApps = $this->mobileAppRepository->findAll();
		$this->view->assign('mobileApps', $mobileApps);
	}

	/**
	 * Displays a single MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp the MobileApp to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp) {
		$this->view->assign('mobileApp', $mobileApp);
	}

	/**
	 * Displays a form for creating a new  MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $newMobileApp a fresh MobileApp object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newMobileApp
	 */
	public function newAction(Tx_Mobileappfactory_Domain_Model_MobileApp $newMobileApp = null) {
		$this->view->assign('newMobileApp', $newMobileApp);
	}

	/**
	 * Creates a new MobileApp and forwards to the list action.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $newMobileApp a fresh MobileApp object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Mobileappfactory_Domain_Model_MobileApp $newMobileApp) {
		$this->mobileAppRepository->add($newMobileApp);
		$this->flashMessageContainer->add('Your new MobileApp was created.');
		
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp the MobileApp to display
	 * @return string A form to edit a MobileApp
	 */
	public function editAction(Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp) {
		$this->view->assign('mobileApp', $mobileApp);
	}

	/**
	 * Updates an existing MobileApp and forwards to the list action afterwards.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp the MobileApp to display
	 * @return
	 */
	public function updateAction(Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp) {
		$this->mobileAppRepository->update($mobileApp);
		$this->flashMessageContainer->add('Your MobileApp was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing MobileApp
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp the MobileApp to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Mobileappfactory_Domain_Model_MobileApp $mobileApp) {
		$this->mobileAppRepository->remove($mobileApp);
		$this->flashMessageContainer->add('Your MobileApp was removed.');
		$this->redirect('list');
	}

}
?>