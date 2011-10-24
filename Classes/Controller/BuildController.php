<?php
require_once (PATH_t3lib."class.t3lib_tcemain.php");
require_once (PATH_t3lib."class.t3lib_extmgm.php");
require_once (t3lib_extMgm::extPath('mobileappfactory','Resources/Private/PHP/mobileappbuilder/cmsadaptor.php'));
class Tx_Mobileappfactory_Controller_BuildController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
     * @var string Key of the extension this controller belongs to
     */
    protected $extensionName = 'mobileappfactory';
	
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_Repository
	 */
	protected $factoryRepository;

	/**
	 * @var Tx_Mobileappfactory_Domain_Model_Repository
	 */
	protected $appRepository;
	
	/**
	 * @var Tx_Mobileappfactory_Domain_Model_Repository
	 */
	protected $queueRepository;


	
    /**
     * @var t3lib_PageRenderer
     */
    protected $pageRenderer;
	
	/**
	 *@var array
	*/
	protected $config;
	 
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
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction() {
        $this->pageId = intval(t3lib_div::_GP('id'));
		$this->retrievePageConfig();
		$pageRecord = t3lib_BEfunc::getRecordWSOL ('pages', $this->pageId, 'pid,doktype');
		
		$this->pidAppFolder=$this->config['factoryPid'];
		$this->factoryRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileFactoryRepository');
		$this->appRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_MobileAppRepository');
		$this->queueRepository  =  t3lib_div::makeInstance('Tx_Mobileappfactory_Domain_Repository_QueueItemRepository');
		$this->pageRenderer->addInlineLanguageLabelFile('EXT:workspaces/Resources/Private/Language/locallang.xml');
		
		
   }
   
	protected function initView(){
		
	}
	
	protected function getImage($file,$height,$width) {
		if ($file=='')
			return $file;


		$theImgCode = array();
		
		$lConf=array();

		$lConf['image.']['file.']['maxW']= $width;
		$lConf['image.']['file.']['maxH']= $height;



		$imgObj = t3lib_div::makeInstance('t3lib_stdGraphic'); // instantiate object for image manipulation
		$imgObj->init();
		$imgObj->mayScaleUp = 1;
		$imgObj->absPrefix = PATH_site;
		$uploadfolder=PATH_site.'/uploads/tx_mobileappfactory/'.$file;

        if (!@is_file($uploadfolder))        die('Error: '.$uploadfolder.' was not a file');
		$imgObj->dontCheckForExistingTempFile=true;
		$imgInfo = $imgObj->imageMagickConvert($uploadfolder,'png',$width.' m',$height.' m','','',1);

		
		

		//$theImgCode .= $this->local_cObj->IMAGE($lConf['image.']);
		$theImgCode['location']=$imgInfo[3];
		$theImgCode['width']=$imgInfo[0];
		$theImgCode['height']=$imgInfo[0];



		return $theImgCode;
	}
	
	protected function fetchPages($app){
		$domain=$this->config['domain'];
		/*if (!domain){
			$rootline = $sys_page->getRootLine($this->pageId);
			$drec=t3lib_BEfunc.firstDomainRecord($rootLine);
			print_r($drec);
			if ($drec)
				$domain=$drec['domain'];
		}*/
		
		if (!$domain)
			$domain=$_SERVER["SERVER_NAME"];
			
		$revDomain=implode('.',array_reverse(explode('.',$domain)));
		
		
		
		
		$platforms=array('1'=>'android');
		$appConfig=array();
		
		$appConfig['name']=$app->getName();
		$appConfig['description']=$app->getDescription();
		$appConfig['id']=$revDomain.'.app'.$app->getUid();
		$appConfig['buildID']=$app->getBuildid();
		
		$appConfig['company']=$app->getMobilefactory()->getCompany();
		$appConfig['author']=$app->getMobilefactory()->getAuthor();
		$appConfig['support']=$app->getMobilefactory()->getSupport();
		$appConfig['www']=$app->getMobilefactory()->getWww();
		$appConfig['splash']=PATH_site.'/uploads/tx_mobileappfactory/'.$app->getSplash();
		$appConfig['icons']=array();
		if ($app->getIcon()){
			$appConfig['icons'][]=$this->getImage($app->getIcon(),36,36);//android
			$appConfig['icons'][]=$this->getImage($app->getIcon(),48,48);//ipad, android
			$appConfig['icons'][]=$this->getImage($app->getIcon(),57,57);//iphone
			$appConfig['icons'][]=$this->getImage($app->getIcon(),58,58);//iphone 4
			$appConfig['icons'][]=$this->getImage($app->getIcon(),72,72);//ipad,android
		}	
		//$appConfig['iconPath']=PATH_site.'uploads/tx_mobileappfactory/';
		//$appConfig['iconFile']=$app->getIcon();
		$version=$app->getVersion();
		if (!$version)
			$version='1.0.0.0';
		$verInfo=explode('.',$version);
		$verInfo[3]=$verInfo[3]+1;
		$version=implode('.',$verInfo);
		$appConfig['version']=$version;
		$app->setVersion($version);
		$appConfig['icon']='';
		$appConfig['startPage']=t3lib_div::getIndpEnv('TYPO3_SITE_URL').'/?id='.$app->getStartview();
		
		
		$path=$app->getMobilefactory()->getName().'/'.$app->getName();
		$path=str_replace(' ','_',$path);
		$outputFolder=$this->config['outputFolder'];
		if (!$outputFolder)
			$outputFolder=PATH_site.'fileadmin/mobileappbuilder';
		
		$appConfig['output']=$outputFolder.'/'.$path;
		
		
		$config=array();
		$config['phonegapBuild']['user']=$this->config['phonegapBuild.']['user'];
		$config['phonegapBuild']['password']=$this->config['phonegapBuild.']['password'];
		
		$builder=new MobileAppBuilderAdaptor($appConfig,$config);
		$builder->fetchPages();
		$buildID=$builder->queueApp();
		if ($buildID){
			$app->setBuildid($buildID);
			$app->setIsDirty(0);
			$app->setBuildTime(new DateTime());
			$this->appRepository->update($app);
			$this->view->assign('buildOK',true);
		} else
			$this->view->assign('buildOK',false);
		$this->view->assign('builderApp',$appConfig);
		$this->view->assign('builderConfig',$config);
		$this->view->assign('builderOutput',$builder->getOutput());
		
		
		
	}
	
	/**
     * Simple action to list some stuff
     */
    public function compileAction(Tx_Mobileappfactory_Domain_Model_MobileApp  $app) {
		$this->initView();
		$this->fetchPages($app);
		//$this->redirect('status','Build',Null,array('app'=>$app));
    }
	
	/**
     * Simple action to list some stuff
     */
    public function statusAction(Tx_Mobileappfactory_Domain_Model_MobileApp  $app) {
		$this->initView();
		$appConfig=array();
		$config=array();
		$config['phonegapBuild']['user']=$this->config['phonegapBuild.']['user'];
		$config['phonegapBuild']['password']=$this->config['phonegapBuild.']['password'];
		
		if ($app->getBuildid()){
			$builder=new MobileAppBuilderAdaptor($appConfig,$config);
			$buildInfo=$builder->queueInfo($app->getBuildid());
		}
		$this->view->assign('buildInfo',$buildInfo);
		$this->view->assign('app',$app);
		$this->view->assign('factory',$app->getMobilefactory());
    }

}

?>