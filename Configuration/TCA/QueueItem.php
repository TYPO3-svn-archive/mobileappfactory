<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_mobileappfactory_domain_model_queueitem'] = array(
	'ctrl' => $TCA['tx_mobileappfactory_domain_model_queueitem']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, buildstart, buildend, appfile, state, error, errormessage, output, buildhandler, platform',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, buildstart, buildend, appfile, state, error, errormessage, output, buildhandler, platform,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_mobileappfactory_domain_model_queueitem',
				'foreign_table_where' => 'AND tx_mobileappfactory_domain_model_queueitem.pid=###CURRENT_PID### AND tx_mobileappfactory_domain_model_queueitem.sys_language_uid IN (-1,0)',
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
		'buildstart' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.buildstart',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'buildend' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.buildend',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'appfile' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.appfile',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_mobileappfactory',
				'allowed' => '*',
				'disallowed' => 'php',
				'size' => 5,
			),
		),
		'state' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.state',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'error' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.error',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'errormessage' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.errormessage',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'output' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.output',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'buildhandler' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.buildhandler',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'platform' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:mobileappfactory/Resources/Private/Language/locallang_db.xml:tx_mobileappfactory_domain_model_queueitem.platform',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'mobileapp' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$TCA['tx_mobileappfactory_domain_model_queueitem']['columns']['state']['config']['items'] = array(
					array('Wating in queue', 1),
					array('Build in progress', 2),
					array('Build done', 3),
				);
$TCA['tx_mobileappfactory_domain_model_queueitem']['columns']['error']['config']['items']= array(
					array('No error', 0),
					array('No platform handler', 1),
					array('Build error', 2),
				);
?>