<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class GalleriesController extends AppController {

	public $paginate = [
		'limit' => 20,
		'order' => 'created desc'
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->header('Access-Control-Allow-Origin: *');
	}

	public function index() {
		if(isset($this->request->params['named']['favorites'])) {
			$this->paginate['conditions']['is_favorite >='] = $this->request->params['named']['favorites'];
			unset($this->paginate['conditions']['gallery_id']);
			$this->paginate['order'] = 'Gallery.score desc';
		}

		$this->Crud->execute('index');
	}

	public function download($id) {
		$gallery = $this->Gallery->find('first', [
			'conditions' => [
				'id' => $id
			]
		]);

		if(!empty($gallery)) {
			foreach($gallery['Media'] as $media) {
				$this->Gallery->Media->download( $media['id']);
			}
		}
		die();
	}

}
