<?php
/* 
* @Author: sebb
* @Date:   2014-10-13 02:49:04
* @Last Modified by:   sebb
* @Last Modified time: 2014-10-13 23:23:54
*/
App::uses('AppModel', 'Model');

class MediaRating extends AppModel {

	public $belongsTo = [
		'MediaBetter' => [
			'className' => 'Demos.Media',
			'foreignKey' => 'media_better_id'
		],
		'MediaMediaWorse' => [
			'className' => 'Demos.Media',
			'foreignKey' => 'media_worse_id'
		]
	];

	public function afterSave($created, $options = []) {
		if($created) {
			$this->MediaBetter->id = $this->data[$this->alias]['media_better_id'];
			$this->MediaBetter->saveField('rate_better_count', (int)$this->MediaBetter->field('rate_better_count') + 1);

			$this->MediaBetter->id = $this->data[$this->alias]['media_worse_id'];
			$this->MediaBetter->saveField('media_worse_count', (int)$this->MediaBetter->field('rate_worse_count') + 1);
		}
	}

}