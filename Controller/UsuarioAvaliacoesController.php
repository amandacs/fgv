<?php
App::uses('AppController', 'Controller');
/**
 * UsuarioAvaliacoes Controller
 *
 * @property UsuarioAvaliacao $UsuarioAvaliacao
 * @property PaginatorComponent $Paginator
 */
class UsuarioAvaliacoesController extends AppController {

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
        $this->UsuarioAvaliacao->recursive = 0;
        $this->set('avaliacoes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UsuarioAvaliacao->exists($id)) {
            throw new NotFoundException(__('Invalid avaliacao'));
        }
        $avaliacao = $this->UsuarioAvaliacao->find ('first', array(
            'conditions' => array(
                'UsuarioAvaliacao.' . $this->UsuarioAvaliacao->primaryKey => $id,
            )));

        $this->set('avaliacao', $avaliacao);
        $this->set('modal_title', __('Avaliação - '). '<b>'.$avaliacao['UsuarioAvaliacao']['id'].'</b>');
        $this->layout = 'modal';
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($usuario_id, $avaliacao_id, $funcao_avaliado_id, $classe_avaliado_id) {
        $this->loadModel('Grupo');
        $gruponome = $this->Grupo->find('list',array( 'fields' => array('Grupo.id', 'Grupo.nome')));
        $date = date('d-m-Y H:i:s');
        if ($this->request->is('post')) {
            $this->UsuarioAvaliacao->create();
            $this->request->data['UsuarioAvaliacao']['data_avaliacao'] = $date;
            $this->request->data['UsuarioAvaliacao']['avaliacao_id'] = $avaliacao_id;
            $this->request->data['UsuarioAvaliacao']['avaliado_id'] = $usuario_id;
            $this->request->data['UsuarioAvaliacao']['funcao_avaliado_id'] = $funcao_avaliado_id;
            $this->request->data['UsuarioAvaliacao']['classe_avaliado_id'] = $classe_avaliado_id;
            $this->UsuarioAvaliacao->set( $this->data); // Seta os campos do form
            if ($this->UsuarioAvaliacao->saveAll($this->request->data)) {
                $this->Session->setFlash(('A avaliação foi adicionada com sucesso!'), 'alert', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'usuarios', 'action' => 'view',$usuario_id));
            } else {
                $this->Session->setFlash(('A avaliação não foi adicionada! Por favor, tente novamente!'), 'alert', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'usuarioAvaliacoes', 'action' => 'add',$usuario_id, $avaliacao_id));
            }
        }

        $usuarios = $this->UsuarioAvaliacao->Avaliado->find('all', array('conditions' => array('Avaliado.id' => $usuario_id)));
        $perguntas = $this->UsuarioAvaliacao->UsuarioResposta->Pergunta->find('all', array(
            'order'=>array(
                'Grupo.ordem' => 'ASC',
                'Pergunta.ordem' => 'ASC',
            ),
            'joins' => array(
                array(
                    'table' => 'usuarios',
                    'alias' => 'Usuario',
                    'type' => 'LEFT',
                    'conditions' => array('Usuario.id' => $usuario_id),
                    'fields' => 'id'
                )
            ),
            'conditions'=>array(
                'OR'=>array('Usuario.classe_id = ANY(Grupo.classe_array)' ,
                'Usuario.funcao_id = Grupo.funcao_id')
               // 'Usuario.classe_id = ANY(Pergunta.classe_array)',
                //'Usuario.funcao_id = Pergunta.funcao_id'
            )
        ));
        $this->set(compact('gruponome', 'perguntas', 'usuarios'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->loadModel('Grupo');
        $gruponome = $this->Grupo->find('list',array( 'fields' => array('Grupo.id', 'Grupo.nome')));

        if(!$this->UsuarioAvaliacao->exists($id)){
            throw new NotFoundException(__('Avaliação Inválida'));
        }
        if ($this->request->is(array('post', 'put'))) {

            $date = date('d-m-Y H:i:s');
            $this->request->data['UsuarioAvaliacao']['data_avaliador'] = $date;
            $this->request->data['UsuarioAvaliacao']['avaliador_id'] = $this->Session->read('Auth.User.id');
            if ($this->UsuarioAvaliacao->saveAll($this->request->data)) {
                $this->Session->setFlash(('A avaliação foi adicionada com sucesso!'), 'alert', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'usuarios', 'action' => 'index'));
            } else {
                $this->Session->setFlash(('A avaliação não foi adicionada! Por favor, tente novamente!'), 'alert', array('class' => 'alert-danger'));
            }
        }else{
            $options = array('conditions' => array('UsuarioAvaliacao.' . $this->UsuarioAvaliacao->primaryKey => $id));
            $this->request->data = $this->UsuarioAvaliacao->find('first', $options);
        }
        $perguntas = $this->UsuarioAvaliacao->UsuarioResposta->Pergunta->find('all', array(
            'order'=>array(
                'Grupo.ordem' => 'ASC',
                'Pergunta.ordem' => 'ASC',
            ),
            'joins' => array(
                array(
                    'table' => 'usuarios',
                    'alias' => 'Usuario',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Usuario.id' => $this->request->data['UsuarioAvaliacao']['avaliado_id'],
                    ),
                    'fields' => 'id',
                )
            ),
            'conditions'=>array(
                'Usuario.classe_id = ANY(Pergunta.classe_array)',
            )
        ));
        $this->set(compact('gruponome'));
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
        $this->UsuarioAvaliacao->id = $id;
        if (!$this->UsuarioAvaliacao->exists()) {
            throw new NotFoundException(__('Invalid avaliacao'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UsuarioAvaliacao->delete()) {
            $this->Session->setFlash(__('A Avaliação foi excluída com sucesso!'), 'alert', array('class'=>'alert-success'));
        } else {
            $this->Session->setFlash(__('A Avaliação não pôde ser excluída. Por favor, tente novamente.'), 'alert', array('class'=>'alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
