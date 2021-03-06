<?php
/**
 * main.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:48 PM
 *
 * This file holds the configuration settings of your backend application.
 **/
$backendConfigDir = dirname(__FILE__);

$root = $backendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($backendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('projects', $root . DIRECTORY_SEPARATOR . 'projects');
/* uncomment if you need to use frontend folders */
/* Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend'); */


$mainLocalFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
	array(
		'name' => 'BW Social Intranet',
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
		'basePath' => 'projects',
		// set parameters
		'params' => $params,
		// preload components required before running applications
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
		'preload' => array('bootstrap', 'log'),
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
		'language' => 'en',
		'controllerMap'=>array('YiiFeedWidget'=>'application.extensions.yii-feed-widget.YiiFeedWidgetController'),
		// using bootstrap theme ? not needed with extension
//		'theme' => 'bootstrap',
		// setup import paths aliases
		// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
		'import' => array(
			'common.components.*',
			'common.extensions.*',
			'common.models.*',
		    'common.filters.*',
			'common.components.helpers.*',
			'common.extensions.widgets.*',
			'common.extensions.nestedset.*',
			'common.extensions.mail.YiiMailMessage',
			// uncomment if behaviors are required
			// you can also import a specific one
			/* 'common.extensions.behaviors.*', */
			// uncomment if validators on common folder are required
			/* 'common.extensions.validators.*', */
			'application.components.*',
			'application.extensions.*',
			'application.controllers.*',
			'application.models.*'
		),
		/* uncomment and set if required */
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
		'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'pass',
				'ipFilters'=>array('83.110.234.127','192.168.1.105','*'),
				'generatorPaths' => array(
					'bootstrap.gii'
				)
			),
			'appsettings'=>array(
					'class'=>'common.modules.appsettings.AppsettingsModule',
			),
		),
			
		'components' => array(
			'user' => array(
				'allowAutoLogin'=>true,
			),
			/* load bootstrap components */
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),
			'errorHandler' => array(
				// @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
				'errorAction'=>'site/error'
			),
			'db'=> array(
				'connectionString' => $params['db.connectionString'],
				'username' => $params['db.username'],
				'password' => $params['db.password'],
				'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
				'enableParamLogging' => YII_DEBUG,
				'charset' => 'utf8'
			),
			'authManager'=>array(
					'class'=>'common.extensions.customrbac.DbAuthManager',
					'connectionID'=>'db',
			),
				
			'mail' => array(
						'class' => 'common.extensions.mail.YiiMail',
						'transportType' => 'php',
						'viewPath' => 'application.views.mail',
						'logging' => true,
						'dryRun' => false
			),
				//X-editable config
				'editable' => array(
						'class'     => 'common.extensions.x-editable.EditableConfig',
						'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
						'mode'      => 'popup',            //mode: 'popup' or 'inline'
						'defaults'  => array(              //default settings for all editable elements
								'emptytext' => 'Click to edit'
						)
				),
												
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => false,
				'urlSuffix' => '/',
				'rules' => $params['url.rules']
			),
				'session' => array (					
						'class'=>'CHttpSession',
						//'useTransparentSessionID'   =>($_POST['PHPSESSID']) ? true : false,
						'autoStart' => 'true',
						'cookieMode' => 'only',
				),
				'twitter' => array(
						'class' => 'common.extensions.yiitwitteroauth.YiiTwitter',
						'consumer_key' => 'YOUR TWITEER KEY',
						'consumer_secret' => 'YOUR TWITTER SECRET',
						'callback' => 'YOUR CALLBACK URL',
				),
			/* make sure you have your cache set correctly before uncommenting */
			/* 'cache' => $params['cache.core'], */
			/* 'contentCache' => $params['cache.content'] */
		),		
	),
	CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);
