<?php

$extensionClassesPath = t3lib_extMgm::extPath('mobileappfactory', 'Classes/');
$extensionPath = t3lib_extMgm::extPath('mobileappfactory');
$extbaseClassesPath = t3lib_extMgm::extPath('extbase', 'Classes/');
return array(
	'tx_mobileappfactory_controller_buildappscontroller' => $extensionClassesPath . 'Controller/BuildAppsModuleController.php',
	'tx_mobileappfactory_viewhelpers_dbformviewhelper' => $extensionClassesPath . 'ViewHelper/dbform.php',
	'tx_mobileappfactory_viewhelpers_dbformextraviewhelper' => $extensionClassesPath . 'ViewHelper/dbformextra.php',
	'tx_mobileappfactory_viewhelpers_dbformscriptviewhelper' => $extensionClassesPath . 'ViewHelper/dbformscript.php',
	'tx_mobileappfactory_viewhelpers_installdbviewhelper' => $extensionClassesPath . 'ViewHelper/dbinstall.php',
	'tx_mobileappfactory_viewhelpers_startviewhelper' => $extensionClassesPath . 'ViewHelper/start.php',
	'tx_mobileappfactory_viewhelpers_finishviewhelper' => $extensionClassesPath . 'ViewHelper/finish.php',
	'tx_mobileappfactory_viewhelpers_errorviewhelper' => $extensionClassesPath . 'ViewHelper/error.php',
	'tx_mobileappfactory_viewhelpers_getdbnameviewhelper' => $extensionClassesPath . 'ViewHelper/dbname.php',
	'tx_mobileappfactory_viewhelpers_gettablenameviewhelper' => $extensionClassesPath . 'ViewHelper/tablename.php',
)

?>