<?php

App::uses('AppController', 'Controller');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 */
class UsuariosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');
    public $helpers = array('Js');

    function beforeFilter() {
        /*$this->loadModel('Cargo');*/
        /*$this->loadModel('Classe');*/
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($org_id = null) {
        /*$this->passedArgs['param'] = '';
        $this->Session->write('search', false);*/
        $org_nome = null;
        $perfil = $this->Session->read('Auth.User.perfil_id');
        $this->loadModel('Organizacao');
        $org =$this->Session->read('Auth.User.organizacao_id');
        $this->Organizacao->displayField("id");
        $orgs = $this->Organizacao->find('list',array('fields'=>'Organizacao.id','conditions'=>array('Organizacao.parent_id'=>$org),'recursive'=>-1));
        if($perfil==1){
            $conditions = array();
        }else{
            if($org_id == null){
                //TODO O AVALIADOR VISUALIZA APENAS OS AVALIADOS RELACIONADOS A ELE
                $conditions = array('OR'=>array(array('Usuario.organizacao_id'=> $orgs, 'Usuario.perfil_id'=>2),array('Usuario.organizacao_id'=> $org, 'Usuario.perfil_id'=>3)), );
            }
            else{
                $conditions = array('Usuario.organizacao_id'=> $org_id);
                $org_nome = $this->Organizacao->find('first',array('fields'=>'Organizacao.nome','conditions'=>array('Organizacao.id'=>$org_id),'recursive'=>-1));

            }
        }
        $order = array('Usuario.matricula'=>'ASC');
        if(isset($_GET['q'])){
            if(is_numeric($_GET['q'])){
                $conditions = array(
                    "Usuario.matricula like '%" . $_GET['q']. "%'"
                );
            } else {
                $conditions = array(
                    "Usuario.nome ilike '%" . $_GET['q']. "%'"
                );
            }
        }

        $this->paginate = array(
            'limit'=>10,
            'recursive'=>0,
            'fields'=> array('Usuario.*','Cargo.*', 'UsuarioAvaliacao.*'),
            'conditions'=>$conditions,
            'order'=>$order,
            'joins' => array(
                array(
                    'table' => 'usuario_avaliacoes',
                    'alias' => 'UsuarioAvaliacao',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'UsuarioAvaliacao.avaliado_id = Usuario.id'
                    )
                ),
            )
        );
        $usuarioAvaliacoes = $this->Usuario->UsuarioAvaliacao->find('all', array(
            /*'conditions' => array(
                'UsuarioAvaliacao.avaliado_id' => $id
            ),*/
            'recursive' => -1
        ));
        $this->set('testes',$this->Organizacao->find('all'));
        $this->set('organizacoes', $this->Organizacao->find('all', array('fields' => array('id', 'nome', 'acronimo'),'recursive' => -1)));
        $this->set('perfil', $perfil);
        $this->set('org_nome', $org_nome);
        $this->set('usuarioAvaliacoes', $usuarioAvaliacoes);
        $this->set('usuarios', $this->paginate());
        $this->Session->write('search', true);
        $this->render('index');
        $this->set('title_for_layout', 'Usuários');
    }

    /*public function search() {
        if (isset($this->passedArgs['param'])) {
            $conditions = array(
                'OR' => array(
                    "UPPER(TRANSLATE(CAST(Usuario.nome AS TEXT), 'áÁàÀãÃâÂâäÄéÉêÊËëÈèíÍïÏÌìóÓôÔõÕöÖòÒúÚÙùúûüÜÛ', 'AAAAAAAAAAAEEEEEEEEIIIIIIOOOOOOOOOOUUUUUUUUU')) = ? " => strtoupper($this->removeAcentos($this->passedArgs['param'])),
                    "UPPER(TRANSLATE(CAST(Usuario.nome AS TEXT), 'áÁàÀãÃâÂâäÄéÉêÊËëÈèíÍïÏÌìóÓôÔõÕöÖòÒúÚÙùúûüÜÛ', 'AAAAAAAAAAAEEEEEEEEIIIIIIOOOOOOOOOOUUUUUUUUU')) LIKE " =>
                        '%' . strtoupper($this->removeAcentos($this->passedArgs['param'])) . '%',
                    'Usuario.matricula' => $this->passedArgs['param']
                )
            );
            $this->paginate = array(
                'conditions' => $conditions,
                'limit' => 20,
                'order' => array(
                    'Usuario.nome' => 'ASC'
                )
            );
        }
        $this->set('usuarios', $this->paginate('Usuario'));
        $this->render('index');
    }

    public function pesquisar() {
        $url['action'] = 'search';

        $this->redirect($url, null, true);
    }*/

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $options = array(
            'conditions' => array(
                'Usuario.' . $this->Usuario->primaryKey => $id
            ),
        );
        $usuario = $this->Usuario->find('first', $options);
        $this->Usuario->UsuarioAvaliacao->Avaliacao->unBindModel(array('hasMany'=>array('Pergunta', 'UsuarioResposta')));
        $avaliacao = $this->Usuario->UsuarioAvaliacao->Avaliacao->find('first', array(
            'fields'=>array('Avaliacao.*'),
        ));
        $this->loadModel('UsuarioAvaliacao');
        $ava =  $this->UsuarioAvaliacao->find ('first', array(
            'conditions' => array(
                'UsuarioAvaliacao.avaliado_id' => $id,
            )));
        $usuarioAvaliacoes = $this->Usuario->UsuarioAvaliacao->find('all', array(
            'conditions' => array(
                'UsuarioAvaliacao.avaliado_id' => $id
            ),
            'recursive' => -1
        ));
        $this->set('ava',$ava);
        $this->set(compact('avaliacao', 'usuarioAvaliacoes', 'usuario'));
        $this->set('title_for_layout', 'Usuário');
        $this->set('perfil_id', $usuario['Usuario']['perfil_id']);
    }
    /**
     * add methodUsuario
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Usuario']['password'] = Security::hash($this->data['Usuario']['password'], 'md5', false);
            $this->Usuario->create();

            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(('Usuário criado com sucesso!'), 'alert', array('class'=>'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O usuario não pode ser salvo. Por favor, tente novamente.'));
                /*// Se o usuário selecionou algum cargo, carregamos a lista de classes para a view
                if(!empty($this->data['Usuario']['classe_id'])){
                    $classes = $this->Usuario->Classe->find('list', array(
                            'conditions' => array(
                                'Classe.cargo_id' => $this->data['Usuario']['cargo_id']
                            ),
                            'fields' => array('id', 'nome'))
                    );
                    $classes = array('' => 'Selecione a classe', $classes);    // Adiciono o "Selecione a classe" na lista de classes
                    $this->set('classes', $classes);
            }*/
            }
        }
        $organizacoes = $this->Usuario->Organizacao->find('list', array('conditions' => array('Organizacao.id >= 2')));
        $cargos = $this->Usuario->Cargo->find('list');
        $classes = $this->Usuario->Classe->find('first', array('conditions'=>array('Classe.cargo_id'=>0)));
        $perfils = $this->Usuario->Perfil->find('list');
        $funcoes = $this->Usuario->Funcao->find('first', array('conditions' => array('Funcao.cargo_id'=>0)));
        $this->set(compact('organizacoes', 'cargos', 'perfils', 'funcoes', 'classes'));
        $this->set('title_for_layout', 'Usuários');
    }
    /**
     * listar_classes method
     *
     * @throws NotFoundException
     * @return void
     */
    public function listar_classes_json() {
        $this->layout = false;
        if ($this->RequestHandler->isAjax()) {
            $this->set('classes', $this->Usuario->Classe->find('list', array('conditions' =>
                    array('Classe.cargo_id' => $this->params['url']['cargoId']),
                    'recursive' => -1)
            ));
            $this->set('parametro', $this->params['url']['cargoId']);
        }
    }
    public function listar_funcoes_json() {
        $this->layout = false;
        if ($this->RequestHandler->isAjax()) {
            $this->set('funcoes', $this->Usuario->Funcao->find('list', array('conditions' =>
                    array('Funcao.cargo_id' => $this->params['url']['cargoId']),
                    'recursive' => -1)
            ));
            $this->set('parametro', $this->params['url']['cargoId']);
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
        $date = date('Y-m-d H:i:s');
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is(array('post', 'put'))) {

            $old_password = Security::hash($this->data['Usuario']['old_password'], 'md5', false);
            $user_password = $this->request->data['Usuario']['password'];


            $new_password = Security::hash($this->data['Usuario']['new_password'], 'md5', false);

            if($old_password != $user_password){
                $this->Session->setFlash(('Senha atual incorreta! Por favor, tente novamente! '), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                return $this->redirect(array('controller'  => 'usuarios', 'action' => 'edit', $id));
            }else{
                $this->request->data['Usuario']['password'] = $new_password;
                $this->request->data['Usuario']['data_atualizacao'] = $date;
                if ($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash(__('Usuário alterado com sucesso!'), 'alert', array('class'=>'alert-success'));
                    return $this->redirect(array('action' => 'login'));
                } else {
                    $this->Session->setFlash(__('O usuário não pôde ser salvo. Por favor, tente novamente.'), 'alert', array('class' => 'alert-danger'));
                }
            }
        }else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $usuario = $this->Usuario->find('first',array(
            'conditions' => array(
                'Usuario.' . $this->Usuario->primaryKey => $id
            ),
        ));
        $this->set(compact(/*'organizacoes', 'cargos', 'perfils', 'funcoes', 'classes',*/ 'usuario'));
        $this->set('title_for_layout', 'Usuários');
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('The usuario has been deleted.'));
        } else {
            $this->Session->setFlash(__('The usuario could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    public  function login(){
        if ($this->request->is('post')) {
            $user = $this->Usuario->find('first', array(
                    'fields' => array(
                        'Usuario.*',
                        //'Role.*',
                        'Organizacao.*'
                    ),
                    'conditions' => array(
                        'Usuario.username' => $this->data['Usuario']['username'],
                        'Usuario.password' => Security::hash($this->data['Usuario']['password'], 'md5', false),
                    )
                )
            );
            if($user != false){
                unset($user['Usuario']['password']);
                $login = array(
                    'id' => $user['Usuario']['id']
                );
                if($this->Usuario->save($login)){
                    // $user['Usuario']['Role'] = $user['Role'];
                    $user['Usuario']['Organizacao'] = $user['Organizacao'];
                    $this->Auth->login($user['Usuario']);
                    if($user['Usuario']['perfil_id']<=2)
                    {
                        $this->redirect($this->Auth->redirectUrl(array('action'=>'index')));
                    }
                    else{
                        $this->redirect($this->Auth->redirectUrl(array('action'=>'view',$user['Usuario']['id'])));
                    }
                }
            }else{
                $this->Session->setFlash(__('Invalid! username or password.'), 'alert', array('class'=>'alert-danger'));
            }
        }
        $this->layout = 'login';
    }

    public function logout(){
        $this->Session->delete('Usuario');
        $this->redirect($this->Auth->logout());
    }

    public function meusDados($id = null){
        $date = date('Y-m-d H:i:s');
        $user_id = $this->Session->read('Auth.Usuario.id');
        $user_password = $this->Session->read('Auth.Usuario.password');

        if ($this->request->is('post') || $this->request->is('put')) {
            if(empty($this->request->data['Usuario']['old_password']) && empty($this->request->data['Usuario']['new_password'])){
                $this->request->data['Usuario']['updated_at'] = $date;
                if ($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash(('Usuário atualizado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                    $this->redirect(array('action' => 'index', 'controller' => 'volumes'));
                } else {
                    $this->Session->setFlash(('O usuário não pôde ser atualizado!'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                }
            }else{
                $old_password = Security::hash($this->request->data['Usuario']['old_password'], 'md5', false);
                $new_password = Security::hash($this->request->data['Usuario']['new_password'], 'md5', false);

                if($user_password != $old_password){
                    $this->Session->setFlash(('Senha atual incorreta! Por favor, tente novamente! '), 'alert', array('class'=>'alert-danger'));
                    $this->redirect(array('action' => 'meusDados', $user_id));
                }else{
                    $this->request->data['Usuario']['password'] = $new_password;
                    $this->request->data['Usuario']['updated_at'] = $date;
                    if ($this->Usuario->saveAssociated($this->request->data, array('deep' => true))) {
                        $this->Session->setFlash(('Usuário atualizado com sucesso!'), 'alert', array('class'=>'alert-success', 'escape'=>false));
                        $this->redirect(array('action' => 'index', 'controller' => 'pessoas'));
                    } else {
                        $this->Session->setFlash(('O usuário não pôde ser atualizado!'), 'alert', array('class'=>'alert-danger', 'escape'=>false));
                    }
                }
            }
        }else{
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
    }
    /*public function beforeRender()
    {
        if ($this->request->is('atualizaClasses')) {
        $this->layout = 'atualizaClasses';
    }
    }*/
    /*function atualizaBox(){
        $this->set('classes', $this->Usuario->Classe->find('all', array('conditions'=>array('Classe.cargo_id'=>$this->data['Cargo']['nome']))));
    }*/
    /*public function ajax_cargos()
    {
        $retorno= $this->Usuario->Cargo->find('list', array('fields'=>array('Cargo.id', 'Cargo.nome')));
        $this->set(compact('retorno'));
        $this->render('ajax');
    }

    public function ajax_classes($id_cargo)
    {
        $retorno= $this->Usuario->Cargo->Classe->find('list', array(
            'fields'=>array('Cargo.id', 'Cargo.nome'),
            'conditions'=>array('Classe.cargo_id'=>$id_cargo)));
    $this->set(compact('retorno'));
    $this->render('ajax');
    }*/
}
