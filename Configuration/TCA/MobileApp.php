<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_mobileappfactory_domain_model_mobileapp'] = array(
	'ctrl' => $TCA['tx_mobileappfactory_domain_model_mobileapp']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, version, description, buildid, icon, build_time, is_dirty, template, splash, platforms, queue_items, mobiledb',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, version, description, buildid, icon, build_time, is_dirty, template, splash, platforms, queue_items, mobiledb,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_mobileappfactory_domain_model_mobileapp',
				'foreign_table_where' => 'AND tx_mobileappfactory_domain_model_mobileapp.pid=###CURRENT_PID### AND tx_mobileappfactory_domain_model_mobileapp.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' =>'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
			'type' => 'input',
			'size' => 30,
			'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'version' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.version',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'buildid' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.buildid',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'icon' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.icon',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_mobileappfactory',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai',
				'disallowed' => '',
			),
		),
		'build_time' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.build_time',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'is_dirty' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.is_dirty',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'template' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.template',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'splash' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.splash',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_mobileappfactory',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai',
				'disallowed' => '',
			),
		),
		'platforms' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.platforms',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_mobileappfactory_domain_model_mobileplatform',
				'foreign_field' => 'mobileapp',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'queue_items' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.queue_items',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_mobileappfactory_domain_model_queueitem',
				'foreign_field' => 'mobileapp',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'mobiledb' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.mobiledb',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_mobileappfactory_domain_model_mobiledb',
				'MM' => 'tx_mobileappfactory_mobileapp_mobiledb_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_mobileappfactory_domain_model_mobiledb',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'mobilefactory' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$TCA['tx_mobileappfactory_domain_model_mobileapp']['columns']['views'] = array(
					
			"exclude" => 1,		
			"label" => "LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.views",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 5,	
				"minitems" => 0,
				"maxitems" => 20,
			)
		
		);
		
$TCA['tx_mobileappfactory_domain_model_mobileapp']['columns']['datafolder'] = array(
					
			"exclude" => 1,		
			"label" => "LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.startFolder",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		
		);		
		
$TCA['tx_mobileappfactory_domain_model_mobileapp']['columns']['appfolder'] = array(
					
			"exclude" => 1,		
			"label" => "LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.appFolder",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		
		);		

$TCA['tx_mobileappfactory_domain_model_mobileapp']['columns']['startview'] = array(
					
			"exclude" => 1,		
			"label" => "LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.startview",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		
		);
		
$TCA['tx_mobileappfactory_domain_model_mobileapp'] ['interface'] = array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, version, appfolder,views,datafolder,startview,platforms,queue_items,icon,splash,mobiledb,template',
	);
$TCA['tx_mobileappfactory_domain_model_mobileapp']['types'] = array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, version, appfolder,views,datafolder,startview,platforms,queue_items,icon,splash,mobiledb,template,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	);
?>