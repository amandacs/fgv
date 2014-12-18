<?php
App::uses('AppController', 'Controller');
/**
 * Classes Controller
 *
 * @property Classe $Classe
 * @property PaginatorComponent $Paginator
 */
class ClassesController extends AppController {

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
        $order = array('Classe.sort'=>'ASC');
        $this->paginate = array(
            'limit'=>15,
            'recursive'=>0,
            'fields'=>array(
                'Classe.*',
                'Cargo.nome'
            ),
            'order'=>$order,
        );
        $this->set('classes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Classe->exists($id)) {
            throw new NotFoundException(__('Classe inválida'));
        }
        $classes = $this->Classe->find('first', array('conditions' => array('Classe.' . $this->Classe->primaryKey => $id)));
        $this->set('classes', $classes);
        /*Debugger::dump($classes);*/
        $this->set('modal_title', __('CLASSE - ') .'<b>'.$classes['Classe']['nome'].'</b>');
        $this->layout = 'modal';
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Classe->create();
            $classes = $this->Classe->find('first', array(
                'fields' => 'MAX(Classe.sort) AS "Classe__sort"',
                'recursive'=>-1,
                /*'conditions' => array('Classe.grupo_id' => $this->request->data['Pergunta']['grupo_id'])*/
            ));
            if ($classes != null) {
                $this->request->data['Classe']['sort'] = $classes['Classe']['sort'] + 1;
            } else {
                $this->request->data['Classe']['sort'] = 1;
            }
            $this->request->data['Classe']['nome'] = $this->convertem($this->request->data['Classe']['nome']);
            Debugger::dump($classes);
            if ($this->Classe->save($this->request->data)) {
                $this->Session->setFlash(__('Classe adicionada com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A classe não pôde ser adicionada. Por favor, tente novamente'), 'alert', array('class' => 'alert-danger', 'escape'=>false));
            }
        }
        $cargos = $this->Classe->Cargo->find('list');
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
        if (!$this->Classe->exists($id)) {
            throw new NotFoundException(__('Classe inválida'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Classe']['nome'] = $this->convertem($this->request->data['Classe']['nome']);
            if ($this->Classe->save($this->request->data)) {
                $this->Session->setFlash(__('Classe alterada com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A classe não pôde ser alterada. Por favor, tente novamente'), 'alert', array('class' => 'alert-danger', 'escape'=>false));
            }
        } else {
            $options = array('conditions' => array('Classe.' . $this->Classe->primaryKey => $id));
            $this->request->data = $this->Classe->find('first', $options);
        }
        $cargos = $this->Classe->Cargo->find('list');
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
        $this->Classe->id = $id;
        if (!$this->Classe->exists()) {
            throw new NotFoundException(__('Classe inválida'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Classe->delete()) {
            $this->Session->setFlash(__('Classe excluída com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
        } else {
            $this->Session->setFlash(__('A classe não pôde ser excluída. Por favor, tente novamente'), 'alert', array('class' => 'alert-danger', 'escape'=>false));
        }
        return $this->redirect(array('action' => 'index'));
    }
}