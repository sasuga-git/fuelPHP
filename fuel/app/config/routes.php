<?php

return array(
	'_root_' => 'welcome/index', // The default route
	'_404_' => 'welcome/404', // The main 404 route
	'welcom/404' => 'welcom/404',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	//正規表現によるルーティング
	'bbs/(:any)' => 'routingtest/entry/$1', //	(1)
	'(:segment)/about' => 'routingtest/about/$1', //	(2)
	'([0-9]{3})/detail' => 'routingtest/id/$1', //	(3)
	//名前付きパラメータによるルーティング
	'cal/:year/:month/:day/:any' => 'welcome/404', //	(4)
	'cal/:year/:month/:day' => 'routingtest/cal', //	(5)
	'cal/:year/:month' => 'routingtest/cal', //	(6)
	'cal/:year/:month' => 'routingtest/cal', //	(7)
	//HTTPメソッドの違いによるルーティング
	'api/(:any)' => array(
		array('GET', new Route('routingtest/get/$1')),
		array('POST', new Route('routingtest/post/$1'))
	), //(8)
	'admin/dashboard' => array('admin/index', 'name' => 'admin'), //(9)
);
