<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<?php echo $this->_title; ?>
	<?php echo $this->_metaHTTP; ?>
	<?php echo $this->_metaName; ?>
	<?php echo $this->_js; ?>
	<?php echo $this->_css; ?>
</head>
<body>
<div id="border-top" class="h_blue">
	<span class="title"><a href="#">Administration</a></span>
</div>
	<?php 
		require_once(MODULE_PATH.$this->moduleName.DS.'views'.DS.$this->_fileView.'.php');
		

	 ?>
	<div id="footer">
		<p class="copyright">
			<a href="#">GNU General Public License</a>.	
		</p>
	</div>
</body>
</html>