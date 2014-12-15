<?php
App::uses('AppController', 'Controller');
/**
 * Pergunta Controller
 *
 * @property Pergunta $Pergunta
 * @property PaginatorComponent $Paginator
 */
class PerguntasController extends AppController {

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
            'order' => array(
                'Grupo.ordem' => 'ASC',
                'Pergunta.ordem' => 'ASC',
            ),
            'limit'=>500,
            'conditions'=> array(
                'Grupo.ordem >= 16'
            ),
        );
        $this->Paginator->settings = $this->paginate;
        $this->set('perguntas', $this->Paginator->paginate('Pergunta'));
        $this->set('title_for_layout', 'Indicadores');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Pergunta->exists($id)) {
            throw new NotFoundException(__('Indicador inválido.'));
        }
        $perguntas = $this->Pergunta->find('first', array('conditions' => array('Pergunta.' . $this->Pergunta->primaryKey => $id)));
        $this->set('pergunta', $perguntas);
        $this->set('modal_title', __('INDICADOR - ') . ' <b>'.$perguntas['Pergunta']['id'].'</b>');
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
            $this->Pergunta->create();
            $perguntas = $this->Pergunta->find('first', array(
                'fields' => 'MAX(Pergunta.ordem) AS "Pergunta__ordem"',
                'conditions' => array('Pergunta.grupo_id' => $this->request->data['Pergunta']['grupo_id'])
            ));
            if ($perguntas != null) {
                $this->request->data['Pergunta']['ordem'] = $perguntas['Pergunta']['ordem'] + 1;
            } else {
                $this->request->data['Pergunta']['ordem'] = 1;
            }
            if ($this->Pergunta->save($this->request->data)) {
                $this->Session->setFlash(('Indicador adicionado com sucesso!'), 'alert', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(('O Indicador não pôde ser adicionado. Por favor, tente novamente!'), 'alert', array('class' => 'alert-danger'));
            }
        }
        $avaliacoes = $this->Pergunta->Avaliacao->find('list', array(
                'order' => array('Avaliacao.id'=>'ASC'),
            )
        );
        $grupos = $this->Pergunta->Grupo->find('list', array(
                'order' => array('Grupo.ordem'=>'ASC'),
        ));
        $this->set(compact('grupos', 'avaliacoes', 'classes', 'funcoes'));
        $this->set('title_for_layout', 'Indicadores');
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Pergunta->exists($id)) {
            throw new NotFoundException(__('Indicador inválido.'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['Pergunta']['classe_array'] = $this->arrayToDB(@$this->request->data['Pergunta']['classe_array']);
            if ($this->Pergunta->save($this->request->data)) {
                $this->Session->setFlash(('Indicador alterado com sucesso!'), 'alert', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(('O Indicador não pôde ser alterado. Por favor, tente novamente!'), 'alert', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Pergunta.' . $this->Pergunta->primaryKey => $id));
            $this->request->data = $this->Pergunta->find('first', $options);
        }
        $avaliacoes = $this->Pergunta->Avaliacao->find('list');
        $grupos = $this->Pergunta->Grupo->find('list');
        $this->set(compact('grupos', 'avaliacoes', 'classes', 'funcoes'));
        $this->set('title_for_layout', 'Indicadores');
    }
    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Pergunta->id = $id;
        if (!$this->Pergunta->exists()) {
            throw new NotFoundException(__('Indicador inválido.'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pergunta->delete()) {
            $this->Session->setFlash(__('O Indicador foi excluído com sucesso!'), 'alert', array('class' => 'alert-success'));
        } else {
            $this->Session->setFlash(__('O Indicador não pôde ser excluído. Por favor, tente novamente.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}