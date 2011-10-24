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
 * Controller for the MobileTable object
 */
 class Tx_Mobileappfactory_Controller_MobileTableController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * mobileTableRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_MobileTableRepository
	 */
	protected $mobileTableRepository;

	/**
	 * injectMobileTableRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_MobileTableRepository $mobileTableRepository
	 * @return void
	 */
	public function injectMobileTableRepository(Tx_Mobileappfactory_Domain_Repository_MobileTableRepository $mobileTableRepository) {
		$this->mobileTableRepository = $mobileTableRepository;
	}

	/**
	 * Displays all MobileTables
	 *
	 * @return void
	 */
	public function listAction() {
		$mobileTables = $this->mobileTableRepository->findAll();
		$this->view->assign('mobileTables', $mobileTables);
	}

	/**
	 * Displays a single MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable the MobileTable to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable) {
		$this->view->assign('mobileTable', $mobileTable);
	}

	/**
	 * Displays a form for creating a new  MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $newMobileTable a fresh MobileTable object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newMobileTable
	 */
	public function newAction(Tx_Mobileappfactory_Domain_Model_MobileTable $newMobileTable = null) {
		$this->view->assign('newMobileTable', $newMobileTable);
	}

	/**
	 * Creates a new MobileTable and forwards to the list action.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $newMobileTable a fresh MobileTable object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Mobileappfactory_Domain_Model_MobileTable $newMobileTable) {
		$this->mobileTableRepository->add($newMobileTable);
		$this->flashMessageContainer->add('Your new MobileTable was created.');
		
			
			if(!empty($_FILES)){
				$this->flashMessageContainer->add('File upload is not yet supported by the Persistence Manager. You have to implement it yourself.');
			}
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable the MobileTable to display
	 * @return string A form to edit a MobileTable
	 */
	public function editAction(Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable) {
		$this->view->assign('mobileTable', $mobileTable);
	}

	/**
	 * Updates an existing MobileTable and forwards to the list action afterwards.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable the MobileTable to display
	 * @return
	 */
	public function updateAction(Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable) {
		$this->mobileTableRepository->update($mobileTable);
		$this->flashMessageContainer->add('Your MobileTable was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing MobileTable
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable the MobileTable to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Mobileappfactory_Domain_Model_MobileTable $mobileTable) {
		$this->mobileTableRepository->remove($mobileTable);
		$this->flashMessageContainer->add('Your MobileTable was removed.');
		$this->redirect('list');
	}

}
?>