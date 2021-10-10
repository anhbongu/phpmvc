<?php 
	// require_once('libs/bootstrap.php');
	// require_once('libs/controller.php');
	// require_once('libs/view.php');
	// require_once('libs/model.php');

	require_once('define.php');
	spl_autoload_register(function($clasName) {  //hàm auto load các file

		require_once LIBRARY_PATH."{$clasName}.php";
	});
 	SESSION::init();


	$bootstrap = new Bootstrap();


 ?>