<?php
App::uses('AppController', 'Controller');

class MediaController extends AppController {

	public $paginate = [
		'limit' => 40,
		'order' => 'Media.created desc',
		'conditions' => [
			'gallery_id' => ''
		]
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->header('Access-Control-Allow-Origin: *');
	}

	public function index() {
		if(isset($this->request->params['named']['favorites'])) {
			$this->paginate['conditions']['Media.is_favorite >='] = $this->request->params['named']['favorites'];
			unset($this->paginate['conditions']['gallery_id']);
			$this->paginate['order'] = 'Media.score desc';
		}

		if( isset($this->request->params['named']['sort']) ) {
			$sort = $this->request->params['named']['sort'];
			switch($sort) {
				case 'group_origin':
					$this->paginate = [
						'limit' => 2,
						'group' => [
							'File.origin' 
						]
					];
					break;
				default;
					break;
			}
		}
		$this->Crud->execute('index');
	}



	public function fixTime() {
		$files = $this->Media->find('all', [
			'limit' => 1000,
			'conditions' => [
				'NOT' => [
					'modified LIKE' => "%2014-%"
				]
			]
		]);
		foreach($files as $index => $media) {
			$s = explode(' ', $media['Media']['modified']);
			$d = explode('-',  $s[0]);
			$y = substr($d[0], -2);

			if($y != "14") {
				$d = "2014-" . $d[1] . "-" . $y;

				$files[$index]['Media']['created'] = $d . " " . $s[1];

				$files[$index]['Media']['modified'] = $files[$index]['Media']['created'];

				debug( $this->Media->save($files[$index]['Media']) );
			}
		}

		//debug($files);
		//$this->Media->saveAll($files);

		die();
	}

	public function fixDouples() {
		$Files = $this->File->find('all');
		foreach($files as $File) {
			$doupes = $this->File->find('all', [
				'conditions' => [
					'File.asset_file' => $file['File']['asset_file'],
					'NOT' => [
						'File.id' => $file['File']['id']
					]
				]
			]);

			if($doupes) {
				foreach($doupes as $doupe) {
					$this->File->delete($doupe['File']['id']);
				}
			}

			$this->File->save($file);
		}

		die('Done');
	}

}
