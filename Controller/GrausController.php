<?php
App::uses('AppController', 'Controller');
/**
 * Graus Controller
 *
 * @property Grau $Grau
 * @property PaginatorComponent $Paginator
 */
class GrausController extends AppController {

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
        $order = array('Grau.id'=>'ASC');
        $this->paginate = array(
            'limit'=>10,
            'recursive'=>0,
            'fields'=>array(
                'Grau.*',
            ),
            'order'=>$order,
        );
		$this->set('graus', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grau->exists($id)) {
			throw new NotFoundException(__('Grau inválido.'));
		}
		$graus = $this->Grau->find('first', array('conditions' => array('Grau.' . $this->Grau->primaryKey => $id)));
        /*$indicador = $this->Grau->Pergunta->find('all', array('conditions' => array('Grau.pergunta_id' => $graus['Grau']['pergunta_id'])));*/
		$this->set('grau', $graus);
        /*$this->set('indicador', $indicador);*/
        $this->set('modal_title', __('GRAU - ').'<b>'.$graus['Grau']['ordem'].'</b>');
        $this->layout = 'modal';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Grau->create();

			if ($this->Grau->save($this->request->data)) {
                $this->Session->setFlash(('Grau adicionado com sucesso!'), 'alert', array('class'=>'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grau não pôde ser adicionado. Por favor, tente novamente.'), 'alert', array('class'=>'alert-success'));
			}
		}
		$perguntas = $this->Grau->Pergunta->find('list');
		$this->set(compact('perguntas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Grau->exists($id)) {
			throw new NotFoundException(__('Grau inválido.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Grau->save($this->request->data)) {
                $this->Session->setFlash(('Grau alterado com sucesso!'), 'alert', array('class'=>'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grau não pôde ser alterado. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Grau.' . $this->Grau->primaryKey => $id));
			$this->request->data = $this->Grau->find('first', $options);
		}
		$perguntas = $this->Grau->Pergunta->find('list');
		$this->set(compact('perguntas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Grau->id = $id;
		if (!$this->Grau->exists()) {
			throw new NotFoundException(__('Grau inválido.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Grau->delete()) {
			$this->Session->setFlash(__('Grau excluído com sucesso!'), 'alert', array('class'=>'alert-success'));
		} else {
			$this->Session->setFlash(__('O grau não pôde ser excluído. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
