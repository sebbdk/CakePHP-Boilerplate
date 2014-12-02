<?php
/* 
* @Author: sebb
* @Date:   2014-06-17 00:09:12
* @Last Modified by:   sebb
* @Last Modified time: 2014-10-13 22:55:00
*/

Configure::write('menu.media_index', array(
	'name' => 'All Media',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'media',
		'action' => 'index'
	),
	'sort' => 100
));

Configure::write('menu.galleries', array(
	'name' => 'Galleries',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'galleries',
		'action' => 'index'
	),
	'sort' => 100
));

Configure::write('menu.urlscores', array(
	'name' => 'Url scores',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'UrlScores',
		'action' => 'index'
	),
	'sort' => 200
));

Configure::write('menu.better', array(
	'name' => 'Rate media',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'media_ratings',
		'action' => 'add'
	),
	'sort' => 200
));