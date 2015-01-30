<?php
App::uses('AppController', 'Controller');
/**
 * Funcoes Controller
 *
 * @property Funcao $Funcao
 * @property PaginatorComponent $Paginator
 */
class FuncoesController extends AppController {

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
        $order = array('Funcao.id'=>'ASC');
        $this->paginate = array(
            'limit'=>500,
            'recursive'=>0,
            'fields'=>array(
                'Funcao.*',
                'Cargo.*'
            ),
            'order'=>$order,
        );
		$this->set('funcoes', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Funções');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Funcao->exists($id)) {
			throw new NotFoundException(__('Função inválida.'));
		}
		$funcoes = $this->Funcao->find('first', array('conditions' => array('Funcao.' . $this->Funcao->primaryKey => $id)));
        $this->set(compact('funcoes', $funcoes));
        $this->set('modal_title', __('FUNÇÃO - ').'<b>'.$funcoes['Funcao']['nome'].'</b>');
        $this->layout = 'modal';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Funcao->create();
			if ($this->Funcao->save($this->request->data)) {
				$this->Session->setFlash(__('Função adicionada com sucesso!'), 'alert', array('class'=>'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A função não pôde ser adicionada. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
			}
		}
		$cargos = $this->Funcao->Cargo->find('list', array( 'order' => array('Cargo.id' => 'ASC')));
		$this->set(compact('cargos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Funcao->exists($id)) {
			throw new NotFoundException(__('Função inválida.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Funcao->save($this->request->data)) {
				$this->Session->setFlash(__('Função alterada com sucesso!'), 'alert', array('class'=>'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A função não pôde ser alterada. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Funcao.' . $this->Funcao->primaryKey => $id));
			$this->request->data = $this->Funcao->find('first', $options);
		}
		$cargos = $this->Funcao->Cargo->find('list', array( 'order' => array('Cargo.id' => 'ASC')));
		$this->set(compact('cargos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Funcao->id = $id;
		if (!$this->Funcao->exists()) {
			throw new NotFoundException(__('Função inválida.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Funcao->delete()) {
			$this->Session->setFlash(__('Função excluída com sucesso!'), 'alert', array('class'=>'alert-success'));
		} else {
			$this->Session->setFlash(__('A função não pôde ser excluída. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
