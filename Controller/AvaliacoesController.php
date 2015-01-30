<?php
App::uses('AppController', 'Controller');
/**
 * Avaliacoes Controller
 *
 * @property Avaliacao $Avaliacao
 * @property PaginatorComponent $Paginator
 */
class AvaliacoesController extends AppController {

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
        $this->paginate = array(
            'order'=>array(
                'Avaliacao.prazo_avaliador'=>'DESC'
            ),
        );
		$this->Avaliacao->recursive = 0;
		$this->set('avaliacoes', $this->Paginator->paginate());
        $this->set('title_for_layout', 'avaliações');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Avaliacao->exists($id)) {
			throw new NotFoundException(__('Avaliacão inválida.'));
		}
		$avaliacoes = $this->Avaliacao->find('first', array('conditions' => array('Avaliacao.' . $this->Avaliacao->primaryKey => $id)));
        $this->set('avaliacoes', $avaliacoes);
        $this->set('modal_title', __('AVALIAÇÃO - ').'<b>'.$avaliacoes['Avaliacao']['descricao'].'</b>');
        $this->layout = 'modal';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Avaliacao->create();
            $this->request->data['Avaliacao']['prazo'] = $this->dataBeforeSave($this->request->data['Avaliacao']['prazo']);
            $this->request->data['Avaliacao']['prazo_avaliador'] = $this->dataBeforeSave($this->request->data['Avaliacao']['prazo_avaliador']);
			if ($this->Avaliacao->save($this->request->data)) {
				$this->Session->setFlash(__('Avaliação salva com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A avaliação não pôde ser adicionada. Por favor, tente vovamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
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
		if (!$this->Avaliacao->exists($id)) {
			throw new NotFoundException(__('Avaliação inválida.'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Avaliacao']['prazo'] = $this->dataBeforeSave($this->request->data['Avaliacao']['prazo']);
            $this->request->data['Avaliacao']['prazo_avaliador'] = $this->dataBeforeSave($this->request->data['Avaliacao']['prazo_avaliador']);
			if ($this->Avaliacao->save($this->request->data)) {
				$this->Session->setFlash(__('Avaliação alterada com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A avaliação não pôde ser alterada. Por favor, tente vovamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
			}
		} else {
			$options = array('conditions' => array('Avaliacao.' . $this->Avaliacao->primaryKey => $id));
			$this->request->data = $this->Avaliacao->find('first', $options);
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
		$this->Avaliacao->id = $id;
		if (!$this->Avaliacao->exists()) {
			throw new NotFoundException(__('Avalição inválida.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Avaliacao->delete()) {
			$this->Session->setFlash(__('Avaliação excluída com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
		} else {
			$this->Session->setFlash(__('A avaliação não pôde ser excluída. Por favor, tente vovamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
