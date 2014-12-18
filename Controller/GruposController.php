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
            'limit'=>100,
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
        $this->loadModel('Classe');
        $classes = $this->Classe->find('list',array('order' => array('Classe.id'=>'ASC'), 'fields' => array('Classe.id', 'Classe.nome')));
        $this->loadModel('Funcao');
        $funcoes = $this->Funcao->find('list',array('order' => array('Funcao.id'=>'ASC'), 'fields' => array('Funcao.id', 'Funcao.nome')));
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
            $this->request->data['Grupo']['classe_array'] = $this->arrayToDB(@$this->request->data['Grupo']['classe_array']);
            if($this->request->data['Grupo']['nova_competencia']==1){
                $this->request->data['Grupo']['nome'] = $this->convertem($this->request->data['Grupo']['nome']);
                $this->request->data['Grupo']['competencia_id'] = null;
                $this->request->data['Grupo']['classe_array'] = null;
                $this->request->data['Grupo']['funcao_id'] = null;
                if ($this->Grupo->save($this->request->data)){
                    $this->Session->setFlash(('O grupo foi adicionado com sucesso!'), 'alert', array('class'=>'alert-success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('O grupo não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                }
            }else{
                if(($this->request->data['Grupo']['nova_competencia']==0 && $this->request->data['Grupo']['competencia_id']==null)||($this->request->data['Grupo']['classe_array'] == null && $this->request->data['Grupo']['funcao_id'] == null)){
                    $this->Session->setFlash(__('O grupo não pôde ser salvo. Selecione uma competência e uma classe ou função existente ou defina este grupo como uma nova competência.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                }else{
                    $this->request->data['Grupo']['nome'] = $this->convertem($this->request->data['Grupo']['nome']);
                    if ($this->Grupo->save($this->request->data)){
                        $this->Session->setFlash(('O grupo foi adicionado com sucesso!'), 'alert', array('class'=>'alert-success'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('O grupo não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                    }
                }
            }
        }
        $competencias = $this->Grupo->find('list', array(
                'conditions' =>array('Grupo.competencia_id' => null),
            )
        );
        $this->set(compact('competencias', 'grupos', 'classes', 'funcoes'));

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->loadModel('Classe');
        $this->loadModel('Funcao');

        if (!$this->Grupo->exists($id)) {
            throw new NotFoundException(__('Grupo inválido.'));
        }
        $classes = $this->Classe->find('list' ,array('order' => array('Classe.id'=>'ASC'), 'fields' => array('Classe.id', 'Classe.nome')));
        $funcoes = $this->Funcao->find('list' ,array('order' => array('Funcao.id'=>'ASC'), 'fields' => array('Funcao.id', 'Funcao.nome')));
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Grupo']['classe_array'] = $this->arrayToDB(@$this->request->data['Grupo']['classe_array']);
            if($this->request->data['Grupo']['nova_competencia']==1){
                $this->request->data['Grupo']['nome'] = $this->convertem($this->request->data['Grupo']['nome']);
                $this->request->data['Grupo']['competencia_id'] = null;
                $this->request->data['Grupo']['classe_array'] = null;
                $this->request->data['Grupo']['funcao_id'] = null;
                if ($this->Grupo->save($this->request->data)){
                    $this->Session->setFlash(('O grupo foi adicionado com sucesso!'), 'alert', array('class'=>'alert-success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('O grupo não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                }
            }else{
                if(($this->request->data['Grupo']['nova_competencia']==0 && $this->request->data['Grupo']['competencia_id']==null)||($this->request->data['Grupo']['classe_array'] == null && $this->request->data['Grupo']['funcao_id'] == null)){
                    $this->Session->setFlash(__('O grupo não pôde ser alterado. Selecione uma competência e uma classe ou função existente ou defina este grupo como uma nova competência..'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                }else{
                    $this->request->data['Grupo']['nome'] = $this->convertem($this->request->data['Grupo']['nome']);
                    if ($this->Grupo->save($this->request->data)) {
                        $this->Session->setFlash(('Grupo alterado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                        return $this->redirect(array('action' => 'index'));
                    }else {
                        $this->Session->setFlash(__('O grupo não pôde ser alterado. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                    }
                }
            }
        }else {
            $options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
            $this->request->data = $this->Grupo->find('first', $options);
        }
        $competencias = $this->Grupo->find('list', array(
                'conditions' =>array('Grupo.competencia_id' => null),
            )
        );
        $this->set(compact('competencias', 'classes', 'funcoes'));
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
