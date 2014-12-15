<?php
App::uses('AppController', 'Controller');
/**
 * UsuarioResposta Controller
 *
 * @property UsuarioResposta $UsuarioResposta
 * @property PaginatorComponent $Paginator
 */
class UsuarioRespostasController extends AppController {

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
        $this->UsuarioResposta->recursive = -1;
        $this->set('respostas', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        /*if (!$this->UsuarioResposta->exists($id)) {
            throw new NotFoundException(__('Invalid formulario'));
        }*/
        $resposta = $this->UsuarioResposta->find('first', array('conditions' => array('UsuarioResposta.' . $this->UsuarioResposta->primaryKey => $id)));
        $usuarioAvaliacoes = $this->UsuarioResposta->UsuarioAvaliacao->find('all', array('conditions' => array('avaliado_id' => $id)));
        $this->set('respostas', $resposta);
        $this->set('usuarioAvaliacoes', $usuarioAvaliacoes);
        $this->set('modal_title', 'Avaliação de desempenho profissional de '. '<b>'.$id.'</b>');
        $this->layout = 'modal';
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($usuario_id, $avaliacao_id) {

        if ($this->request->is('post')) {
            $this->UsuarioResposta->create();
            if ($this->UsuarioResposta->saveAll($this->request->data['UsuarioResposta'])) {
                $this->Session->setFlash(('As respostas foram adicionadas com sucesso!'), 'alert', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'usuarios', 'action' => 'view',$usuario_id));
            } else {
                $this->Session->setFlash(('As respostas não foram adicionadas! Por favor, tente novamente!'), 'alert', array('class' => 'alert-danger'));
            }
        }
        $usuarioAvaliacao = $this->UsuarioResposta->UsuarioAvaliacao->find('first', array(
            'recursive'=> -1,
            'conditions'=>array(
                'UsuarioAvaliacao.avaliado_id' => $usuario_id
            )
        ));
        $usuarioAvaliacao = $usuarioAvaliacao['UsuarioAvaliacao']['id'];
        $perguntas = $this->UsuarioResposta->Pergunta->find('all', array(
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
                'Pergunta.avaliacao_id' => $avaliacao_id,
                'Usuario.funcao_id = ANY(Pergunta.funcao_array)',
            )
        ));
        $respostaFuncionario = $this->UsuarioResposta->RespostaFuncionario->find('all');
        /*Debugger::dump($respostasFuncionario);*/
        $respostasChefe = $this->UsuarioResposta->RespostaChefe->find('list');

        $this->set(compact('perguntas', 'respostaFuncionario', 'respostasChefe', 'usuarioAvaliacao'));
}

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->UsuarioResposta->exists($id)) {
            throw new NotFoundException(__('UsuarioResposta inválidas'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UsuarioResposta->save($this->request->data)) {
                $this->Session->setFlash(__('As respostas foram bem salvas.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('As respostas não puderam ser salvas. Por favor, tente novamente.'));
            }
        } else {
            $options = array('conditions' => array('UsuarioResposta.' . $this->UsuarioResposta->primaryKey => $id));
            $this->request->data = $this->UsuarioResposta->find('first', $options);
        }
        /*$usuarioAvaliacoes = $this->UsuarioResposta->Avaliacao->find('list');*//*Como vai ficar aqui*/
        $usuarioAvaliacoes = $this->UsuarioResposta->UsuarioAvaliacao->find('list');/*LINHA ACIMA MODIFICADA*/
        $perguntas = $this->UsuarioResposta->Pergunta->find('list');
        $respostaFuncionarios = $this->UsuarioResposta->RespostaFuncionario->find('list');
        $respostaChefes = $this->UsuarioResposta->RespostaChefe->find('list');
        $this->set(compact('usuarioAvaliacoes', 'perguntas', 'respostaFuncionarios', 'respostaChefes'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->UsuarioResposta->id = $id;
        if (!$this->UsuarioResposta->exists()) {
            throw new NotFoundException(__('UsuarioResposta inválida'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UsuarioResposta->delete()) {
            $this->Session->setFlash(__('As respostas foram excluídas.'));
        } else {
            $this->Session->setFlash(__('As respostas não puderam ser excluídas. Por favor, tente novamente.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
