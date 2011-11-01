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
 * Build Apps controller
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @package MobileAppFactory
 * @subpackage Controller
 */
require_once (PATH_t3lib."class.t3lib_tcemain.php");
class Tx_Mobileappfactory_Controller_BuildAppsController extends Tx_Extbase_MVC_Controller_ActionController {

   
    /**
     * @var string Key of the extension this controller belongs to
     */                         
    protected $extensionName = 'mobileappfactory';
	
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_Repository
	 */
	protected $factoryRepository;

    /**
     * @var t3lib_PageRenderer
     */
    protected $pageRenderer;

    /**
     * @var integer
     */
    protected $pageId;
	
	/**
     * @var integer
     */
    protected $pidAppFolder;
	
	
	/**
     * @var array
     */
    protected $config=array();
	
	/**
 * Retrieves the configuration (TS setup) of the page with the PID provided
 * as the parameter $pageId.
 *
 * Only the configuration for the current extension key will be retrieved.
 * For example, if the extension key is "foo", the TS setup for plugin.
 * tx_foo will be retrieved.
 *
 * @param integer page ID of the page for which the configuration
 *                should be retrieved, must be > 0
 *
 * @return array configuration array of the requested page for the
 *               current extension key
 */
protected function retrievePageConfig() {
	$template = t3lib_div::makeInstance('t3lib_TStemplate');
	// Disables the logging of time-performance information.
	$template->tt_track = 0;
	$template->init();

	$sys_page = t3lib_div::makeInstance('t3lib_pageSelect');

	// Gets the root line.
	// Finds the selected page in the BE exactly as in t3lib_SCbase::init().
	$rootline = $sys_page->getRootLine($this->pageId);
	// Generates the constants/config and hierarchy info for the template.
	$template->runThroughTemplates($rootline, 0);
	$template->generateConfig();

	if (isset($template->setup['plugin.']['tx_mobileappfactory.'])) {
		$result = $template->setup['plugin.']['tx_mobileappfactory.'];
	} else {
		$result = array();
	}

	$this->config=$result;
}

    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction() {
        $this->pageId = intval(t3lib_div::_GP('id'));
		$this->retrievePageConfig();
		$this->pidAppFolder=$this->config['factoryPid'];
		$this->factoryRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileFactoryRepository');
		$this->pageRenderer->addInlineLanguageLabelFile('EXT:workspaces/Resources/Private/Language/locallang.xml');
		
	}
   
	/**
     * Initializes the common view template markers.
     *
     * @return void
     */
   
	protected function initView(){
		$res=$this->factoryRepository->findAll();
		$this->view->assign('factories', $res);
		$this->view->assign('pidAppFolder',$this->pidAppFolder);
		$this->view->assign('pageId',$this->pageId);
		
		$this->view->assign('showWelcome',!$this->pageId);
		$installOK=true;
		if (!$this->pageId)
			$installOK=false;
			
		$this->view->assign('installOK',$installOK);
		
	}
   
   
   
   
   /**
     * Simple action to list some stuff
     */
    public function buildAppAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory,Tx_Mobileappfactory_Domain_Model_MobileApp  $app) {
		$this->initView();
		$this->view->assign('factory',$factory);
		$this->view->assign('app',$app);
    }
	
	/*public function queueAppAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory, Tx_Mobileappfactory_Domain_Model_MobileApp  $app) {
		
		$queueRepository  =  $this->objectManager->get('Tx_Mobileappfactory_Domain_Repository_QueueItemRepository');
		$queueItem = $this->objectManager->get('Tx_Mobileappfactory_Domain_Model_QueueItem');
		$queueItem->setPlatform($this->request->getArgument('platform'));
		$queueItem->setState(1);
		$queueItem->setMobileapp($app);
		
		$queueRepository->add($queueItem);
		$this->redirect('buildApp','BuildApps',Null,array('factory'=>$factory,'app'=>$app));
    }*/
   
    /**
     * Simple action to list some stuff
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $factory
	 * @param Tx_Mobileappfactory_Domain_Model_MobileApp $app
	 * @param boolean updateTree
	 
     */
    public function listAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory=null,Tx_Mobileappfactory_Domain_Model_MobileApp $app=null,$updateTree=null) {
		$this->initView();
		
		if ((!$factory)&&(!$app)&&($this->pageId!=$this->pidAppFolder)){
			$a=t3lib_BEfunc::getRecordRaw('tx_mobileappfactory_domain_model_mobileapp','appfolder='.$this->pageId);
			if (!empty($a)){
				$appRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileAppRepository');
				$app=$appRepository->findByUid($a['uid']);
				$factory=$app->getMobilefactory();
				
			} else{
				$f=t3lib_BEfunc::getRecordRaw('tx_mobileappfactory_domain_model_mobilefactory','factorypage in ('.$this->pageId.')');
				if (!empty($f)){
					$factory=$this->factoryRepository->findByUid($f['uid']);
				} else {
					$pageRecord = t3lib_BEfunc::getRecordWSOL ('pages', $this->pageId, 'pid,doktype');
					if ($pageRecord['doktype']==254)
						$this->redirectToUri(t3lib_div::getIndpEnv('TYPO3_SITE_URL').'typo3/mod.php?M=web_list&id='.$this->pageId);
					if ($pageRecord['doktype']==1)
						$this->redirectToUri(t3lib_div::getIndpEnv('TYPO3_SITE_URL').'typo3/sysext/cms/layout/db_layout.php?id='.$this->pageId.'&');
				}
			}
		}
		
		$this->view->assign('factory',$factory);
		$this->view->assign('app',$app);
		
		if ($updateTree)
			t3lib_BEfunc::setUpdateSignal('updatePageTree');
       
    }
	
	/**
	 * Creates a new factory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory  $newFactory A fresh Factory object which has not yet been added to the repository
	 * @return void
	 */
	public function newFactoryAction() {
		$this->initView();
		
	}
	
	/**
	 * Displays a form for editing an existing factory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $factoryx The factory to be edited. This might also be a clone of the original factory already containing modifications if the edit form has been submitted, contained errors and therefore ended up in this action again.
	 * @return void
	 * @dontvalidate $factory
	 */
	public function editFactoryAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory) {
		$this->initView();
		$this->view->assign('factory', $factory);
		
	}
	
	/**
	 * Creates a new factory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory  $newFactory A fresh Factory object which has not yet been added to the repository
	 * @return void
	 */
	public function createFactoryAction(Tx_Mobileappfactory_Domain_Model_MobileFactory  $newFactory) {
		//$this->createFactoryStructure($newFactory);
		$newFactory->createFactoryStructure($this->pidAppFolder);
		$factory=$this->factoryRepository->add($newFactory);
		$this->redirect('list','BuildApps',Null,array('factory'=>$factory,'updateTree'=>true));
	}
	
	
	
	/**
	 * Updates an existing factory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $blog A not yet persisted clone of the original blog containing the modifications
	 * @return void
	 */
	public function updateFactoryAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory) {
		//if (!$factory->getFactoryPage())
		//	$factory->createFactoryStructure($this->pidAppFolder);
		$this->factoryRepository->update($factory);
		$this->redirect('list','BuildApps',Null,array('factory'=>$factory,'updateTree'=>true));
	}
	
	
	/**
	 * Updates an existing factory
	 *
	 * @param Tx_Mobileappfactory_Domain_Model_MobileFactory $blog A not yet persisted clone of the original blog containing the modifications
	 * @return void
	 */
	public function newAppAction(Tx_Mobileappfactory_Domain_Model_MobileFactory $factoryx) {
		$this->initView();
		$this->view->assign('factory', $factoryx);
		
		$path=t3lib_extMgm::extPath('mobileappfactory').'Resources/Private/AppTemplates';
		
		$results = scandir($path);
		$templates=array();
		foreach ($results as $result) {
			if ($result === '.' or $result === '..') continue;

			if (is_dir($path . '/' . $result)) {
				$config=include($path . '/' . $result.'/info.php');
				if (is_array($config)){
					$templates[$result]=array('title'=>$config['name'],'description'=>$config['description']);
				}
			}
		}
		$this->view->assign('templates', $templates);
	}
	
	public function createAppAction(Tx_Mobileappfactory_Domain_Model_MobileApp  $app, Tx_Mobileappfactory_Domain_Model_MobileFactory $factoryx) {
		
		$app->setMobileFactory($factoryx);
		$app->setTemplate($this->request->getArgument('template'));
		$app->createAppStructure();
		if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']) {
			$basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');
	 		
			if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['icon']){
				$fileName = $basicFileFunctions->getUniqueName(	$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['icon'],t3lib_div::getFileAbsFileName('uploads/tx_mobileappfactory/'));
				t3lib_div::upload_copy_move(
					$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['tmp_name']['app']['icon'],
					$fileName
				);
				$app->setIcon(basename($fileName));
			}				
			
			if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['splash']){
				$fileName = $basicFileFunctions->getUniqueName(	$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['splash'],t3lib_div::getFileAbsFileName('uploads/tx_mobileappfactory/'));
				t3lib_div::upload_copy_move(
					$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['tmp_name']['app']['splash'],
					$fileName
				);
				$app->setSplash(basename($fileName));
			}
		}
		$appRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileAppRepository');
		
		$appx=$appRepository->add($app);
		$factoryx->addApp($app);
		$this->redirect('list','BuildApps',Null,array('factory'=>$factoryx,'app'=>$appx,'updateTree'=>true));
	}
	
	public function editAppAction(Tx_Mobileappfactory_Domain_Model_MobileApp $app) {
		$this->initView();
		$this->view->assign('app', $app);
		$this->view->assign('factory', $this->factoryRepository->findByUid( $this->request->getArgument('factory')));
		
	}
	
	public function updateAppAction(Tx_Mobileappfactory_Domain_Model_MobileApp $app, Tx_Mobileappfactory_Domain_Model_MobileFactory $factoryx) {
		$appRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileAppRepository');
		print_r($_FILES);
		if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']) {
			$basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');
	 
			if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['icon']){
				$fileName = $basicFileFunctions->getUniqueName(	$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['icon'],t3lib_div::getFileAbsFileName('uploads/tx_mobileappfactory/'));
				t3lib_div::upload_copy_move(
					$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['tmp_name']['app']['icon'],
					$fileName
				);
				$app->setIcon(basename($fileName));
			}
			
			if ($_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['splash']){
				$fileName = $basicFileFunctions->getUniqueName(	$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['name']['app']['splash'],t3lib_div::getFileAbsFileName('uploads/tx_mobileappfactory/'));
				t3lib_div::upload_copy_move(
					$_FILES['tx_mobileappfactory_web_mobileappfactorybuildapps']['tmp_name']['app']['splash'],
					$fileName
				);
				$app->setSplash(basename($fileName));
			}
		}
		
		$appRepository->update($app);
		
		
		
		
		$this->redirect('list','BuildApps',Null,array('factory'=>$factoryx,'app'=>$app));
	}
       

    /**
     * Processes a general request. The result can be returned by altering the given response.
     *
     * @param Tx_Extbase_MVC_RequestInterface $request The request object
     * @param Tx_Extbase_MVC_ResponseInterface $response The response, modified by this handler
     * @throws Tx_Extbase_MVC_Exception_UnsupportedRequestType if the controller doesn't support the current request type
     * @return void
     */
    public function processRequest(Tx_Extbase_MVC_RequestInterface $request, Tx_Extbase_MVC_ResponseInterface $response) {
        $this->template = t3lib_div::makeInstance('template');
        $this->pageRenderer = $this->template->getPageRenderer();

        $GLOBALS['SOBE'] = new stdClass();
        $GLOBALS['SOBE']->doc = $this->template;

        parent::processRequest($request, $response);

        $pageHeader = $this->template->startpage(
            $GLOBALS['LANG']->sL('LLL:EXT:workspaces/Resources/Private/Language/locallang.xml:module.title')
        );
        $pageEnd = $this->template->endPage();

        $response->setContent($pageHeader . $response->getContent() . $pageEnd);
    } 
	
	
	/**
	*
	*/
/*	public function handleUploadAction() {
		$newFile = $this->handleUpload('swfUpload', 
		'/uploads/rsmysherpasprojects/videos/', 'avi,mov,mpg,mpeg,flv,png,jpg', 
		1000 * 1024 * 1024);
		if ((string)intval($newFile) == (string)$newFile) {
			$this->throwStatus(400 + $newFile);
		} else {
			$video = t3lib_div::makeInstance('Tx_Rsmysherpasprojects_Service_Factory_VideoFactory')->createVideo(PATH_site 	. '/uploads/rsmysherpasprojects/videos/' . $newFile);
	
			if($video !== NULL) {

				t3lib_div::makeInstance('Tx_Rsmysherpasprojects_Domain_Repository_VideoRepository')->add($video);
				//$project->setVideo($video);
				Tx_Extbase_Dispatcher::getPersistenceManager()->persistAll();
				return $video->getUid();
			} else {
				$this->throwStatus(500);
			}
		}
		return 'ende';
	}
	
	
	protected function handleUpload($property, $uploadDir, $types = 'jpg,gif,png', $maxSize = '1000000') {
		$data = $_FILES['tx_' . 
		strtolower($this->request->getControllerExtensionName()) . '_' . 
		strtolower($this->request->getPluginName())];

		if(is_array($data) && count($data)>0) {
			$propertyPath = t3lib_div::trimExplode('.',$property);
			$namePath = $data['name'];
			$tmpPath = $data['tmp_name'];
			$sizePath = $data['size'];
			foreach($propertyPath as $segment) {
				$namePath = $namePath[$segment];
				$tmpPath = $tmpPath[$segment];
				$sizePath = $sizePath[$segment];
			}
			if($namePath !== NULL && $namePath !== '') {
				$fileArray = array(
					'name' => $namePath,
					'tmp' => $tmpPath,
					'size' => $sizePath,
				);
			} else {
				return 1;
			}
		} else {
			return 0;
		}
		if($fileArray['size'] > $maxSize) {
			return 2;
		}
		$fileInfo = pathinfo($fileArray['name']);
		if(!t3lib_div::inList($types, strtolower($fileInfo['extension']))) {
			return 3;
		}

		if(file_exists(PATH_site . $uploadDir . $fileArray['name'])) {
			$fileArray['name'] = $fileInfo['filename'] . '-' . time() . '.' . 
			$fileInfo['extension'];
		}
		if(t3lib_div::upload_copy_move($fileArray['tmp'], PATH_site . $uploadDir . $fileArray['name'])) {
			return $fileArray['name'];
		} else {
		return 4;
		}
*/

	/*private function createFactoryStructure(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory){
		if (!$factory->getFactoryPage()){ 
		
			$data = array(
				'pages' => array(
					'NEW_1' => array(
						'pid' => $this->pidAppFolder,
						'title' => $factory->getName(),
						'hidden'=>false,
						'doktype'=>254,
					)
				)
			);
			
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			$tce->stripslashes_values = 0;
			$tce->start($data,array());
			$tce->process_datamap();
			t3lib_BEfunc::getSetUpdateSignal('updatePageTree');
			$factory->setFactorypage($tce->substNEWwithIDs['NEW_1']);
		}
	}*/
	
	/*private function createAppStructure(Tx_Mobileappfactory_Domain_Model_MobileFactory $factory,Tx_Mobileappfactory_Domain_Model_MobileApp $app){
		//if (!$factory->getFactoryPage()){ 
		
			$data = array();
			$data['pages']['NEW_1']=array(
				'pid' => $factory->getFactorypage(),
				'title' => $app->getName(),
				'hidden'=>false,
				'doktype'=>254,
				
			);
			
			$data['pages']['NEW_2']=array(
				'pid' => 'NEW_1',
				'title' => 'views',
				'hidden'=>false,
				'doktype'=>254,
				'tx_fed_page_controller_action'=>'jqmfluidtemplates->Default',
				'tx_fed_page_controller_action_sub'=>'jqmfluidtemplates->Default',
				
			);
			
			$data['pages']['NEW_3']=array(
				'pid' => 'NEW_1',
				'title' => 'data',
				'hidden'=>false,
				'doktype'=>254,
				
			);
			
			$data['pages']['NEW_4']=array(
				'pid' => 'NEW_2',
				'title' => 'start',
				'hidden'=>false,
				'doktype'=>1,
				'layout'=>'255',
				'tx_fed_page_controller_action'=>'jqmfluidtemplates->Default',
				'tx_fed_page_controller_action_sub'=>'jqmfluidtemplates->Default',
				'tx_fed_page_flexform'=>'<?xml version="1.0" encoding="utf-8" standalone="yes" ?><T3FlexForms><data><sheet index="sDEF"><language index="lDEF"><field index="header.visible"><value index="vDEF">1</value></field></language></sheet></data></T3FlexForms>',
				
			);
			
			
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			$tce->stripslashes_values = 0;
			$tce->start($data,array());
			$tce->process_datamap();
			t3lib_BEfunc::getSetUpdateSignal('updatePageTree');
			$app->setAppfolder($tce->substNEWwithIDs['NEW_1']);
			$app->setViews($tce->substNEWwithIDs['NEW_2']);
			$app->setDatafolder($tce->substNEWwithIDs['NEW_3']);
			$app->setStartview($tce->substNEWwithIDs['NEW_4']);
		//}
	}*/
   
}