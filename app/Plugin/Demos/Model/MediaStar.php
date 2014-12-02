<?php
/* 
* @Author: sebb
* @Date:   2014-10-15 00:22:50
* @Last Modified by:   sebb
* @Last Modified time: 2014-10-15 00:23:52
*/
App::uses('AppModel', 'Model');

class MediaStar extends AppModel {

	public $belongsTo = [
		'Media'
	];

}