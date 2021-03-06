<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

require_once( dirname(__FILE__) .  '/../components/helper.php');

return CMap::mergeArray(
        array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TERN DOI Service',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.giix-components.*', // giix components
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
                        'password'=>'password',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.214.167','::1'),
                        'generatorPaths' => array(
                            'ext.giix-core', // giix generators
                    ),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a Postgres database
		
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=tern-doi-dev',
			'emulatePrepare' => true,
			'username' => 'tern',
			'password' => '1ce1stern',
			'charset' => 'utf8',
		),
		'session' => array(
                        'autoStart' => true,
                ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ), 
	'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				'stdlog' => array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					'logPath'=>'/opt/tern-doi/log',
				),
                                'citelog' => array(
                                       'class'=>'CFileLogRoute',
                                        'levels'=>'error,warning,info',
					'logPath'=>'/opt/tern-doi/log',
                                        'logFile'=>'citeANDS.log',
                                        'categories' => 'system.components.CiteANDS',
                                ),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@tern.org.au',
	),
        //set theme to classic
        'theme'=>'classic',
   
      ),
          local_config()
);

// return an array of custom local configuration settings
function local_config()
{
  if (file_exists(dirname(__FILE__).'/local.php'))
  {
    return require_once(dirname(__FILE__).'/local.php');
  }

  return array();
};
