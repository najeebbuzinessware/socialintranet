<?php
/**
 * params-local.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:59 PM
 *
 *
 * ANY CONFIGURATION OPTIONS HERE WILL REPLACE THOSE INCLUDED ON THE params-env.php file!!!
 * It holds your local configuration settings.
 *
 * Replace following tokens for your local correspondent configuration data
 *
 * {DATABASE-NAME} ->   database name
 * {DATABASE-HOST} -> database server host name or ip address
 * {DATABASE-USERNAME} -> user name access
 * {DATABASE-PASSWORD} -> user password
 *
 * {DATABASE-TEST-NAME} ->   Test database name
 * {DATABASE-TEST-HOST} -> Test database server host name or ip address
 * {DATABASE-USERNAME} -> Test user name access
 * {DATABASE-PASSWORD} -> Test user password
 */
return array(
	'env.code' => 'private',
	// DB connection configurations
	'db.name' => 'socialintranet',
	'db.connectionString' => 'mysql:host=localhost;dbname=socialintranet',
	'db.username' => 'socialintranet',
	'db.password' => 'S9xY3W7h',
	'page_size'=>25,
	'maxfilesize'=>'10*1024*1024',
	'allowedfiletype'=>array("jpg","jpeg","gif","png","doc","txt","xls","ppt","pdf","docx","xlsx","pptx"),
	'logofilepath' => '/home/appsdev/public_html/userData/uploads/',
	'filepath' => '/home/appsdev/public_html/userData/',
	'defaultavatarimage' => 'images/default-avatar.png',
	'defaultavatarimageurl' => '/images/default-avatar.png',
	'twitterappurl' => 'https://twitter.com/zamilindustrial',
	'twitterappname' => 'ZamilIndustrial',

);