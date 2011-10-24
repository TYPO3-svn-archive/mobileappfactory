<?php

class tx_mobileappfactory_tcemainprocdm {
    function processDatamap_postProcessFieldArray ($status, $table, $id, &$fieldArray, &$reference) {
    // $table is the current table being processed
    // $id is the record's id (uid field)
    // $fieldArray has all the fields that have BEEN CHANGED, so not all the fields, just those that have been updated
    // $reference is a reference to the currently calling object, the object that calls this hook
   // In our case, let's write a simple example that checks for our table, and outputs the changed data to the screen, what you do from here on, it depends on the desired functionality...

    $pid=0;
	if ($table=='pages')
       $pid=$id;
	else if ($fieldArray['pid'])
			$pid=$fieldArray['pid'];
	else{
		$record=t3lib_BEfunc::getRecord($table,$id);
		$pid=$record['pid'];
			
	}
	
	if ($pid){ 	
       $rootLine=t3lib_BEfunc::BEgetRootLine($pid);
		$pidList="";
		foreach ($rootLine as $pageInfo){
			if ($pageInfo['uid']){
				if ($pidList)
					$pidList.=',';
				$pidList.=$pageInfo['uid'];
			}		
		}
		$app=t3lib_BEfunc::getRecordRaw('tx_mobileappfactory_domain_model_mobileapp','appfolder in ('.$pidList.')');
		if (!empty($app)){
		
		
			$data['tx_mobileappfactory_domain_model_mobileapp'][$app['uid']]=array(
				'is_dirty' => '1',
			);
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			$tce->stripslashes_values = 0;
			$tce->start($data,array());
			$tce->process_datamap();
		}
		
	   
    }
	//xyz();
    
  }
}
?> 