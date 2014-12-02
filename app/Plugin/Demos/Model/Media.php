<?php
/* 
* @Author: sebb
* @Date:   2014-06-27 23:05:48
* @Last Modified by:   sebb
* @Last Modified time: 2014-10-15 00:23:39
*/
App::uses('AppModel', 'Model');

class Media extends AppModel {

	private $rowsToUpdate = null;
	
	public $useTable = "media";
	public $displayField = 'name';
	public $actsAs = [
		'Assets.AssetFile'
	];

	public $belongsTo = [
		'Gallery'
	];

	

	public $validate = [
		'asset_file' => array(
			'rule' => 'isUnique',
			'required' => 'create'
		)
	];

	public function beforeSave($options = []) {
		if(isset($this->data[$this->alias]['origin'])) {
			$others = $this->find('all', [
				'conditions' => [
					'Media.origin' => $this->data[$this->alias]['origin'],
					'NOT' => [
						'Media.id' => isset($this->data[$this->alias]['id']) ? $this->data[$this->alias]['id']:'' 
					]
				]
			]);

			$gallery = $this->Gallery->find('first', [
				'conditions' => [
					'Gallery.origin' => $this->data[$this->alias]['origin']
				]
			]);

			if(!$gallery && !empty($others)) {
				$name = isset($this->data[$this->alias]['galley_name']) ? $this->data[$this->alias]['galley_name']:$others[0][$this->alias]['name'];
				$this->Gallery->create();
				$this->Gallery->save([
					'name' => $name,
					'origin' => $others[0][$this->alias]['origin'],
					'asset_preview' => $others[0][$this->alias]['asset_file'],
				]);

				foreach($others as $index => $otherFile) {
					$others[$index][$this->alias]['gallery_id'] = $this->Gallery->id;
				}
				$this->rowsToUpdate = $others;

				$this->data[$this->alias]['gallery_id'] = $this->Gallery->id;
			} else if(!empty($gallery)){
				$this->data[$this->alias]['gallery_id'] = $gallery['Gallery']['id'];
			}
		}

		return true;
	}

	public function afterSave($created, $options = []) { 
		if($this->rowsToUpdate) {
			$rows = $this->rowsToUpdate;
			$this->rowsToUpdate = null;
			$this->saveAll($rows);
		}

		if(isset($this->data[$this->alias]['gallery_id'])) {
			$gallery = $this->Gallery->find('first', [
				'conditions' => [
					'id' => $this->data[$this->alias]['gallery_id']
				]
			]);

			if(!empty($gallery)) {
				$scores = $this->find('all', [
					'conditions' => [
						'Media.gallery_id' => $this->data[$this->alias]['gallery_id']
					]
				]);

				$scoreSum = 0;
				foreach($scores as $score) {
					$scoreSum += $score[$this->alias]['score'];
				}

				$gallery['Gallery']['score'] = $scoreSum;
				$this->Gallery->save($gallery);
			}
		}
	}
}
