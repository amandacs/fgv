<?php

App::uses('AppController', 'Controller');

/**
 * Grupos Controller
 *
 * @property Grupo $Grupo
 * @property PaginatorComponent $Paginator
 */
class GruposController extends AppController {

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
        $conditions = array('Grupo.competencia_id != 0');
        $order = array('Grupo.ordem'=>'ASC');
        $this->paginate = array(
            'limit'=>10,
            'recursive'=>0,
            'fields'=>array(
                'Grupo.*'
            ),
            'conditions'=>$conditions,
            'order'=>$order,
        );
        $this->set('grupos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Grupo->exists($id)) {
            throw new NotFoundException(__('Grupo Inválido.'));
        }
        $grupos = $this->Grupo->find('first', array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id)));
        $this->set('grupos', $grupos);
        /*Debugger::dump($grupos);
        $perguntas = $this->Grupo->Pergunta->find('all', array('order' => array('Pergunta.ordem'=>'ASC'),
            'conditions' => array('Pergunta.grupo_id' => $id)));
        $this->set(compact('perguntas', 'grupos'));*/
        $this->set('modal_title', __('Grupo - ') . ' <b>'.$grupos['Grupo']['nome'].'</b>');
        $this->layout = 'modal';
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Grupo->create();
            $grupos = $this->Grupo->find('first', array(
                'recursive'=>-1,
                'fields' => 'MAX(Grupo.ordem) AS "Grupo__ordem"',
                /*'conditions' => array('Grupo.competencia_id' => $this->request->data['Grupo']['competencia_id'])*/
            ));
            Debugger::dump($grupos);
            if ($grupos != null) {
                $this->request->data['Grupo']['ordem'] = $grupos['Grupo']['ordem'] + 1;
            } else {
                $this->request->data['Grupo']['ordem'] = 1;
            }
            if ($this->Grupo->save($this->request->data)) {
                $this->Session->setFlash(('Grupo salvo com sucesso!'), 'alert', array('class'=>'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O grupo não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
            }
        }
        $competencias = $this->Grupo->find('list', array(
                'conditions' =>array('Grupo.competencia_id' => null),
            )
        );
        $this->set(compact('competencias', 'grupos'));

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Grupo->exists($id)) {
            throw new NotFoundException(__('Grupo inválido.'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Grupo->save($this->request->data)) {
                $this->Session->setFlash(('Grupo alterado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O grupo não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
            }
        } else {
            $options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
            $this->request->data = $this->Grupo->find('first', $options);
        }
        $competencias = $this->Grupo->find('list', array(
                'conditions' =>array('Grupo.competencia_id' => null),
            )
        );
        $this->set(compact('competencias'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Grupo->id = $id;
        if (!$this->Grupo->exists()) {
            throw new NotFoundException(__('Grupo inválido.'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Grupo->delete()) {
            $this->Session->setFlash(__('Grupo excluído com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
        } else {
            $this->Session->setFlash(__('O grupo não pôde ser excluído. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
