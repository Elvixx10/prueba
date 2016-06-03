<?php
define("_CRONJOB_",true);
require_once (realpath(dirname(__FILE__).'/../../public/index.php'));
require_once (APPLICATION_PATH . '/modules/empresas/models/DbTable/ActividadEventoPeriodico.php');

$date = new DateTime();
$hoy = $date->format('Y-m-d');
$date->modify('+1 day');

$actividadEventoPeriodico = new Empresas_Model_DbTable_ActividadEventoPeriodico();
$result = $actividadEventoPeriodico->getCronJob($hoy);
$resultSelect = $actividadEventoPeriodico->getCronJobSelect();

if( !empty($resultSelect) ) {
	foreach ($resultSelect as $value) {

		if($hoy > $value['fechaProgramada']) {
			$actividadEventoPeriodico->update(array(
			'status' => "Vencida", 
			'edited' => date('Y-m-d H:i:s')
		), 'actividadEventoPeriodicoId = '. $value['actividadEventoPeriodicoId']);
			echo $value['actividadEventoPeriodicoId']."\n";
		}
	}
}

if( !empty($result) ) {
	foreach ($result as $value) {
		
		$actividadEventoPeriodico->update(array(
			'statusView' => 1, 
			'edited' => date('Y-m-d H:i:s')
		), 'actividadEventoPeriodicoId = '. $value['actividadEventoPeriodicoId']);
	}
}
?>