<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

$paths = array(realpath(APPLICATION_PATH . '/../library'));
if (function_exists('zend_deployment_library_path') && zend_deployment_library_path('Zend Framework 1')) {
        $paths[] = zend_deployment_library_path('Zend Framework 1');
}
$paths[] = get_include_path();
set_include_path(implode(PATH_SEPARATOR, $paths));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap();

/** Cronjobs don't need all the extra's so we don't execute the bootstrap **/
if(!defined('_CRONJOB_') || _CRONJOB_ == false){
	
	/*TRADUCCION AL ESPA�OL*/
	require_once 'Zend/Loader/Autoloader.php';
	Zend_Loader_Autoloader::getInstance ();
	
	$translator = new Zend_Translate(
			'array',
			'../resources/languages',
			'es',
			array('scan' => Zend_Translate::LOCALE_DIRECTORY)
	);
	Zend_Validate_Abstract::setDefaultTranslator($translator);

	$application->bootstrap()->run();
}