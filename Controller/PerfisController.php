<?php
App::uses('AppController', 'Controller');
/**
 * Perfis Controller
 *
 * @property Perfi $Perfi
 * @property PaginatorComponent $Paginator
 */
class PerfisController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Perfi->recursive = 0;
		$this->set('perfis', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Perfi->exists($id)) {
			throw new NotFoundException(__('Invalid perfi'));
		}
		$options = array('conditions' => array('Perfi.' . $this->Perfi->primaryKey => $id));
		$this->set('perfi', $this->Perfi->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Perfi->create();
			if ($this->Perfi->save($this->request->data)) {
				$this->Session->setFlash(__('The perfi has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The perfi could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Perfi->exists($id)) {
			throw new NotFoundException(__('Invalid perfi'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Perfi->save($this->request->data)) {
				$this->Session->setFlash(__('The perfi has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The perfi could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Perfi.' . $this->Perfi->primaryKey => $id));
			$this->request->data = $this->Perfi->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Perfi->id = $id;
		if (!$this->Perfi->exists()) {
			throw new NotFoundException(__('Invalid perfi'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Perfi->delete()) {
			$this->Session->setFlash(__('The perfi has been deleted.'));
		} else {
			$this->Session->setFlash(__('The perfi could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
