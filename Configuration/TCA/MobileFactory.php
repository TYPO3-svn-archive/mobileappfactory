<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_mobileappfactory_domain_model_mobilefactory'] = array(
	'ctrl' => $TCA['tx_mobileappfactory_domain_model_mobilefactory']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, author, company, www, support, apps',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, author, company, www, support, apps,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_mobileappfactory_domain_model_mobilefactory',
				'foreign_table_where' => 'AND tx_mobileappfactory_domain_model_mobilefactory.pid=###CURRENT_PID### AND tx_mobileappfactory_domain_model_mobilefactory.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'author' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.author',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'support' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.support',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'apps' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobilefactory.apps',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_mobileappfactory_domain_model_mobileapp',
				'MM' => 'tx_mobileappfactory_mobilefactory_mobileapp_mm',
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
							'table'=>'tx_mobileappfactory_domain_model_mobileapp',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$TCA['tx_mobileappfactory_domain_model_mobilefactory']['columns']['factorypage'] = array(
					
			"exclude" => 1,		
			"label" => "LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_mobileapp.startingpoint",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		
		);
$TCA['tx_mobileappfactory_domain_model_mobilefactory']['interface'] = array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, author, company,www,support,factorypage,apps',
	);
$TCA['tx_mobileappfactory_domain_model_mobilefactory']['types'] = array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, author, company,www,support,factorypage,apps,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	);
?>