<?php
App::uses('AppController', 'Controller');
/**
 * Cargos Controller
 *
 * @property Cargo $Cargo
 * @property PaginatorComponent $Paginator
 */
class CargosController extends AppController {

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
        $order = array('Cargo.id'=>'ASC');
        $this->paginate = array(
            /*'limit'=>10,*/
            'recursive'=>0,
            'fields'=>array(
                'Cargo.*',
            ),
            'order'=>$order,
        );
		$this->set('cargos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cargo->exists($id)) {
			throw new NotFoundException(__('Cargo inválido.'));
		}
		$cargos = $this->Cargo->find('first', array('conditions' => array('Cargo.' . $this->Cargo->primaryKey => $id)));
        $this->set('cargos', $cargos);
        $this->set('modal_title', __('CARGO - ') . '<b>'.$cargos['Cargo']['nome'].'</b>');
        $this->layout = 'modal';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cargo->create();
			if ($this->Cargo->save($this->request->data)) {
				$this->Session->setFlash(__('Cargo adicionado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O cargo não pôde ser adicionado. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
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
		if (!$this->Cargo->exists($id)) {
			throw new NotFoundException(__('Cargo inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cargo->save($this->request->data)) {
				$this->Session->setFlash(__('Cargo alterado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O cargo não pôde ser alterado. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
			}
		} else {
			$options = array('conditions' => array('Cargo.' . $this->Cargo->primaryKey => $id));
			$this->request->data = $this->Cargo->find('first', $options);
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
		$this->Cargo->id = $id;
		if (!$this->Cargo->exists()) {
			throw new NotFoundException(__('Cargo inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cargo->delete()) {
			$this->Session->setFlash(__('Cargo excluído com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
		} else {
			$this->Session->setFlash(__('O cargo não pôde ser excluído. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
