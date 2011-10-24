<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}




t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Mobile App Factory');


t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_mobileapp', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_mobileapp.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_mobileapp');
$TCA['tx_mobileappfactory_domain_model_mobileapp'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/MobileApp.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_mobileapp.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_mobileplatform', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_mobileplatform.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_mobileplatform');
$TCA['tx_mobileappfactory_domain_model_mobileplatform'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileplatform',
		'label' 			=> 'platform',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/MobilePlatform.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_mobileplatform.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_mobilefactory', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_mobilefactory.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_mobilefactory');
$TCA['tx_mobileappfactory_domain_model_mobilefactory'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/MobileFactory.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_mobilefactory.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_queueitem', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_queueitem.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_queueitem');
$TCA['tx_mobileappfactory_domain_model_queueitem'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem',
		'label' 			=> 'buildstart',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/QueueItem.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_queueitem.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_mobiledb', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_mobiledb.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_mobiledb');
$TCA['tx_mobileappfactory_domain_model_mobiledb'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobiledb',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/MobileDB.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_mobiledb.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_mobileappfactory_domain_model_mobiletable', 'EXT:mobileappfactory/Resources/Private/Language/locallang_csh_tx_mobileappfactory_domain_model_mobiletable.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_mobileappfactory_domain_model_mobiletable');
$TCA['tx_mobileappfactory_domain_model_mobiletable'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobiletable',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/MobileTable.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mobileappfactory_domain_model_mobiletable.gif'
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
//test
//http://mobile.auxilior.com/typo3temp/compressor/merged-9d3881ed47459cb262ac5d6786164470-dfb2860b31345577e72d4a3b098a3f93.css?1313796207
if (TYPO3_MODE == 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
    /**
    * Registers a Backend Module
    */
    Tx_Extbase_Utility_Extension::registerModule(
        $_EXTKEY,
        'web',    // Make module a submodule of 'web'
        'BuildApps',    // Submodule key
        'before:view', // Position
        array(
                // An array holding the controller-action-combinations that are accessible
            'BuildApps'        => 'list,single,newFactory,editFactory,updateFactory,createFactory,deleteFactory,newApp,editApp,updateApp,createApp,deleteApp,buildApp,queueApp',
			'Build'        => 'compile,status'
        ),
        array(
            'access' => 'user,group',
            'icon'   => 'EXT:'.$_EXTKEY.'/Resources/Public/Icons/phone.png',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml:moduleName',
            'navigationComponentId' => 'typo3-pagetree',
        )
    );
	
	$TCA['pages']['columns']['module']['config']['items'][] = array('Mobile App factory', 'mobilefact', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/application_cascade.png');
	$TCA['pages']['columns']['module']['config']['items'][] = array('Mobile App', 'mobileApp', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/application.png');
	$TCA['pages']['columns']['module']['config']['items'][] = array('Mobile App DB', 'mobileDB', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/database.png');
	$TCA['pages']['columns']['module']['config']['items'][] = array('Mobile App Views', 'mobileView', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/page_white_stack.png');
	
	 
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-mobilefact', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/application_cascade.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-mobileApp', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/application.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-mobileDB', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/database.png');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-mobileView', t3lib_extMgm::extRelPath($_EXTKEY).'Resources/Public/Icons/page_white_stack.png');
   
}
?>