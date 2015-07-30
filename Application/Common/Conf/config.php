<?php
return array(
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '127.0.0.1',
	'DB_NAME' => 'jd',
	'DB_USER' => 'root',
	'DB_PWD' => '123',
	'DB_PREFIX' => 'jd_',
	'DEFAULT_FILTER' => 'trim,htmlspecialchars',  // I函数使用哪些函数来过滤
	'TMPL_ACTION_ERROR' => APP_PATH . 'Common/admin_info.html',
	'TMPL_ACTION_SUCCESS' => APP_PATH . 'Common/admin_info.html',
	'IMAGE_PREFIX' => 'http://admin.jdshop.com/Public/Uploads/',
	'IMAGE_SAVE_PATH' => './Public/Uploads/',
);