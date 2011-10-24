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
 * Controller for the MobileDB object
 */
 class Tx_Mobileappfactory_Controller_MobileDBController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * mobileDBRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_MobileDBRepository
	 */
	protected $mobileDBRepository;

	/**
	 * injectMobileDBRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_MobileDBRepository $mobileDBRepository
	 * @return void
	 */
	public function injectMobileDBRepository(Tx_Mobileappfactory_Domain_Repository_MobileDBRepository $mobileDBRepository) {
		$this->mobileDBRepository = $mobileDBRepository;
	}

	/**
	 * Displays all MobileDBs
	 *
	 * @return void
	 */
	public function listAction() {
		$mobileDBs = $this->mobileDBRepository->findAll();
		$this->view->assign('mobileDBs', $mobileDBs);
	}

	/**
	 * Displays a single MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB the MobileDB to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB) {
		$this->view->assign('mobileDB', $mobileDB);
	}

	/**
	 * Displays a form for creating a new  MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $newMobileDB a fresh MobileDB object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newMobileDB
	 */
	public function newAction(Tx_Mobileappfactory_Domain_Model_MobileDB $newMobileDB = null) {
		$this->view->assign('newMobileDB', $newMobileDB);
	}

	/**
	 * Creates a new MobileDB and forwards to the list action.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $newMobileDB a fresh MobileDB object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Mobileappfactory_Domain_Model_MobileDB $newMobileDB) {
		$this->mobileDBRepository->add($newMobileDB);
		$this->flashMessageContainer->add('Your new MobileDB was created.');
		
			
			if(!empty($_FILES)){
				$this->flashMessageContainer->add('File upload is not yet supported by the Persistence Manager. You have to implement it yourself.');
			}
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB the MobileDB to display
	 * @return string A form to edit a MobileDB
	 */
	public function editAction(Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB) {
		$this->view->assign('mobileDB', $mobileDB);
	}

	/**
	 * Updates an existing MobileDB and forwards to the list action afterwards.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB the MobileDB to display
	 * @return
	 */
	public function updateAction(Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB) {
		$this->mobileDBRepository->update($mobileDB);
		$this->flashMessageContainer->add('Your MobileDB was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing MobileDB
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB the MobileDB to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Mobileappfactory_Domain_Model_MobileDB $mobileDB) {
		$this->mobileDBRepository->remove($mobileDB);
		$this->flashMessageContainer->add('Your MobileDB was removed.');
		$this->redirect('list');
	}

}
?>