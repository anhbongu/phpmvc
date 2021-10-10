<?php 
	//========================PATHS===========================
	define ('DS'				, DIRECTORY_SEPARATOR);					// DẤU \
	define('ROOT_PATH'			, dirname(__FILE__));					//đường dẫn đến thư mục gốc
	define('LIBRARY_PATH'		, ROOT_PATH.DS.'libs'.DS);				//đường dẫn đến thư mục THƯ VIỆN
	define('EXTENDS_PATH'		, LIBRARY_PATH.'extends'.DS);				//đường dẫn đến thư mục extends


	define('PUBLIC_PATH'		, ROOT_PATH.DS.'public'.DS);				//đường dẫn đến thư mục PUBLIC
	define('APPLICATION_PATH'	, ROOT_PATH.DS.'application'.DS);				//đường dẫn đến thư mục APPLICATION
	define('MODULE_PATH'		, APPLICATION_PATH.'module'.DS);				//đường dẫn đến thư mục MODULE
	define('TEMPLATE_PATH'		, PUBLIC_PATH.'template'.DS);				//đường dẫn đến thư mục template
	define('FILES_PATH'			, PUBLIC_PATH.'files'.DS);				//đường dẫn đến thư mục file
	define('BLOCK_PATH'			, APPLICATION_PATH.'block'.DS);

	define('DEFAULT_MODULE'		, 'default');
	define('DEFAULT_CONTROLLER'	, 'user');
	define('DEFAULT_ACTION'		, 'index');



	//đường dẫn tương đối
	define('ROOT_URL'			, DS.'bookstore');
	define('APPLICATION_URL'	, ROOT_URL.DS.'application'.DS);
	define('MODULE_URL'			, APPLICATION_URL.'module'.DS);
	define('PUBLIC_URL'			, ROOT_URL.DS.'public'.DS);
	define('FILES_URL'			, PUBLIC_URL.'files'.DS);
	define('TEMPLATE_URL'		, PUBLIC_URL.'template'.DS);


	//========================DATABASE===========================
	define('DB_HOST'			,'localhost');
	define('DB_USER'			,'root');
	define('DB_PASS'			,'');
	define('DB_NAME'			,'bookstore');
	define('DB_TABLE'			,'group');
 ?>