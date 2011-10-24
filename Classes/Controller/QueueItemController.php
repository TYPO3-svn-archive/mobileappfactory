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
 * Controller for the QueueItem object
 */
 class Tx_Mobileappfactory_Controller_QueueItemController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * queueItemRepository
	 *
	 * @var Tx_Mobileappfactory_Domain_Repository_QueueItemRepository
	 */
	protected $queueItemRepository;

	/**
	 * injectQueueItemRepository
	 *
	 * @param Tx_Mobileappfactory_Domain_Repository_QueueItemRepository $queueItemRepository
	 * @return void
	 */
	public function injectQueueItemRepository(Tx_Mobileappfactory_Domain_Repository_QueueItemRepository $queueItemRepository) {
		$this->queueItemRepository = $queueItemRepository;
	}

	/**
	 * Displays all QueueItems
	 *
	 * @return void
	 */
	public function listAction() {
		$queueItems = $this->queueItemRepository->findAll();
		$this->view->assign('queueItems', $queueItems);
	}

	/**
	 * Displays a single QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem the QueueItem to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem) {
		$this->view->assign('queueItem', $queueItem);
	}

	/**
	 * Displays a form for creating a new  QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $newQueueItem a fresh QueueItem object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newQueueItem
	 */
	public function newAction(Tx_Mobileappfactory_Domain_Model_QueueItem $newQueueItem = null) {
		$this->view->assign('newQueueItem', $newQueueItem);
	}

	/**
	 * Creates a new QueueItem and forwards to the list action.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $newQueueItem a fresh QueueItem object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Mobileappfactory_Domain_Model_QueueItem $newQueueItem) {
		$this->queueItemRepository->add($newQueueItem);
		$this->flashMessageContainer->add('Your new QueueItem was created.');
		
			
			if(!empty($_FILES)){
				$this->flashMessageContainer->add('File upload is not yet supported by the Persistence Manager. You have to implement it yourself.');
			}
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem the QueueItem to display
	 * @return string A form to edit a QueueItem
	 */
	public function editAction(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem) {
		$this->view->assign('queueItem', $queueItem);
	}

	/**
	 * Updates an existing QueueItem and forwards to the list action afterwards.
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem the QueueItem to display
	 * @return
	 */
	public function updateAction(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem) {
		$this->queueItemRepository->update($queueItem);
		$this->flashMessageContainer->add('Your QueueItem was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing QueueItem
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem the QueueItem to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Mobileappfactory_Domain_Model_QueueItem $queueItem) {
		$this->queueItemRepository->remove($queueItem);
		$this->flashMessageContainer->add('Your QueueItem was removed.');
		$this->redirect('list');
	}

}
?>