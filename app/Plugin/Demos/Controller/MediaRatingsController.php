<?php
/* 
* @Author: sebb
* @Date:   2014-10-13 02:47:27
* @Last Modified by:   sebb
* @Last Modified time: 2014-10-13 23:35:04
*/
App::uses('AppController', 'Controller');

class MediaRatingsController extends AppController {

	public $uses = [
		'Demos.MediaRating',
		'Demos.Media',
	];

	public $paginate = [
		'limit' => 2,
		'order' => 'rand()'
	];

	public function beforeFilter() {
		parent::beforeFilter();


		$this->Crud->on('afterSave', function(CakeEvent $evt) {
			$evt->subject->controller->redirect('add');
		});
	}

	public function add() {
		$media = $this->paginate('Media');
		$this->set('medias', $media);
		$this->Crud->execute('add');
	}

}