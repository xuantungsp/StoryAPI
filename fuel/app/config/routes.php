<?php
return array(
	'_root_'  => 'welcome/index',  // The default route welcome/index
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);