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
 * Controller for the MobileFactory object
 */
 class Tx_Mobileappfactory_Controller_MobileFactoryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * mobileFactoryRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_MobileFactoryRepository
	 */
	protected $mobileFactoryRepository;

	/**
	 * injectMobileFactoryRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_MobileFactoryRepository $mobileFactoryRepository
	 * @return void
	 */
	public function injectMobileFactoryRepository(Tx_Mobileappfactory_Domain_Repository_MobileFactoryRepository $mobileFactoryRepository) {
		$this->mobileFactoryRepository = $mobileFactoryRepository;
	}

	/**
	 * Displays all MobileFactories
	 *
	 * @return void
	 */
	public function listAction() {
		
		$mobileFactories = $this->mobileFactoryRepository->findAll();
		$this->view->assign('mobileFactories', $mobileFactories);
	}

	/**
	 * Displays a single MobileFactory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory the MobileFactory to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory) {
		$this->view->assign('mobileFactory', $mobileFactory);
	}

	/**
	 * Displays a form for creating a new  MobileFactory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $newMobileFactory a fresh MobileFactory object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newMobileFactory
	 */
	public function newAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $newMobileFactory = null) {
		$this->view->assign('newMobileFactory', $newMobileFactory);
	}

	/**
	 * Creates a new MobileFactory and forwards to the list action.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $newMobileFactory a fresh MobileFactory object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $newMobileFactory) {
		$this->mobileFactoryRepository->add($newMobileFactory);
		$this->flashMessageContainer->add('Your new MobileFactory was created.');
		
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing MobileFactory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory the MobileFactory to display
	 * @return string A form to edit a MobileFactory
	 */
	public function editAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory) {
		$this->view->assign('mobileFactory', $mobileFactory);
	}

	/**
	 * Updates an existing MobileFactory and forwards to the list action afterwards.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory the MobileFactory to display
	 * @return
	 */
	public function updateAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory) {
		$this->mobileFactoryRepository->update($mobileFactory);
		$this->flashMessageContainer->add('Your MobileFactory was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing MobileFactory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory the MobileFactory to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $mobileFactory) {
		$this->mobileFactoryRepository->remove($mobileFactory);
		$this->flashMessageContainer->add('Your MobileFactory was removed.');
		$this->redirect('list');
	}

}
?>