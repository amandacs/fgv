<?php
App::uses('AppController', 'Controller');
/**
 * Organizacoes Controller
 *
 * @property Organizacao $Organizacao
 * @property PaginatorComponent $Paginator
 */
class OrganizacoesController extends AppController {

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
	public function index2() {
		$this->Organizacao->recursive = 0;
		$this->set('organizacoes', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Organizações');
	}

    public function index() {

            if(!isset($this->request->data['Organizacao']['orgao_id'])){
                $orgao_id = 1;
            }else{
                $orgao_id = $this->request->data['Organizacao']['orgao_id'];
            }
            $orgao = $this->Organizacao->find('first',
                array(
                    'conditions' => array(
                        'id' => $orgao_id
                    ),
                    'recursive' => -1
                )
            );
            $this->set('parent', $orgao);

            if($orgao_id == 1){
                $label_root = 'PMBV';
            }else{
                $label_root = $orgao['Organizacao']['acronimo'] != null ? $orgao['Organizacao']['acronimo']:$orgao['Organizacao']['nome'];
            }

            $this->request->data['Organizacao']['orgao_id'] = $orgao['Organizacao']['id'];
            $orgaos = $this->Organizacao->find('list',
                array(
                    'conditions' => array(
                        'OR' => array(
                            'id' => 1,
                            'parent_id' => 1
                        ),
                        //'enabled' => true
                    ),
                    'order' => array(
                        'nome'
                    ),
                    'recursive' => -1
                )
            );
            $this->set(compact('orgaos'));

            $findLevel1 = $this->Organizacao->find('all', array(
                'conditions' => array(
                    'Organizacao.parent_id' => $orgao_id
                ),
                'order' => array(
                    'Organizacao.nome' => 'ASC'
                ),
                'fields' => array('id', 'nome','acronimo', 'parent_id'),
                'recursive' => -1
            ));
            $this->set('primeiro_documento_do_dia', false);
            $arrayOrganizacao = $this->hierarquia($findLevel1);
            $this->set('arrayOrganizacaoDestino', json_encode($arrayOrganizacao));
            $this->set('label_root', '<i class="fa fa-sitemap"></i> <b>'.$label_root.'</b>');
            $this->set('id_root', $orgao_id);

    }

    function hierarquia($result = array()){
        $arrayL1 = array();
        foreach ($result as $row){
            $arrayL2 = array();
            $sigla = '';
            if(!empty($row['Organizacao']['acronimo'])){
                $sigla = ' - <strong>'.$row['Organizacao']['acronimo'].'</strong>';
            }

            $typeL1 = '<i class="fa fa-file-o"></i>';

            $findLevel2 = $this->Organizacao->find('all', array(
                'conditions' => array(
                    'Organizacao.parent_id' => $row['Organizacao']['id']
                ),
                'order' => array(
                    'Organizacao.nome' => 'ASC'
                ),
                'fields' => array('id', 'nome', 'acronimo', 'parent_id'),
                'recursive' => -1
            ));
            if(!empty($findLevel2)){
                $typeL1 = '<i class="fa fa-folder"></i>';
                $arrayL2 = $this->hierarquia($findLevel2);
            }
            array_push($arrayL1, array(
                'id' => $row['Organizacao']['id'],
                'label' => $typeL1.' '.$row['Organizacao']['nome'].$sigla,
                'children' => $arrayL2
            ));
        }
        return $arrayL1;
    }

    public function getOrganizacao($id = null, $id_root = null){
        $arrayOrgaos = array();
        $options = array(
            'conditions' => array('Organizacao.' . $this->Organizacao->primaryKey => $id),
            'fields' => array('Organizacao.id', 'Organizacao.nome', 'Organizacao.acronimo', 'Organizacao.secretaria_id', 'Organizacao.parent_array'),
            'order' => array(
                'Organizacao.nome' => 'ASC'
            ),
            'recursive' => -1
        );
        $organizacaoDestino = $this->Organizacao->find('first', $options);
        $subordinacao = $this->postgres_to_php_array($organizacaoDestino['Organizacao']['parent_array']);
        $breadcrumb = $this->breadcrumb($subordinacao, $id_root);

        if($id != 1){
            $usuariosDestinos = $this->Organizacao->Usuario->find('all', array(
                'conditions' => array('organizacao_id' => $id),
                'recursive' => -1
            ));

            $arrayUsuarios = array();
            foreach($usuariosDestinos as $usuario){
                array_push($arrayUsuarios,
                    array(
                        'nome' => $usuario['Usuario']['username']
                    )
                );
            }
            array_push($arrayOrgaos,
                array(
                    'id' => $organizacaoDestino['Organizacao']['id'],
                    'nome' => $organizacaoDestino['Organizacao']['nome'],
                    'sigla' => $organizacaoDestino['Organizacao']['acronimo'],
                    'secretaria_id' => $organizacaoDestino['Organizacao']['secretaria_id'],
                    'usuarios' => $arrayUsuarios,
                    'breadcrumb' => $breadcrumb
                )
            );
        }else{
            array_push($arrayOrgaos,
                array(
                    'id' => $organizacaoDestino['Organizacao']['id'],
                    'nome' => $organizacaoDestino['Organizacao']['nome'],
                    'sigla' => $organizacaoDestino['Organizacao']['acronimo'],
                    'secretaria_id' => null,
                    'usuarios' => array(),
                    'breadcrumb' => $breadcrumb
                )
            );
        }
        $json = json_encode($arrayOrgaos);
        echo $json;
        $this->layout = 'ajax';
        $this->render(false);
    }

    function breadcrumb($subordinacao_ids = array(), $id_root = 1){
        $arrayL1 = array();
        $options = array(
            'conditions' => array(
                'Organizacao.id' => $subordinacao_ids,
                'Organizacao.id >=' => $id_root
            ),
            'fields' => array('id', 'nome', 'acronimo', 'secretaria_id'),
            'order' => array(
                'id' => 'ASC'
            ),
            'recursive' => -1
        );
        $setores = $this->Organizacao->find('all', $options);
        foreach($setores as $orgao){
            array_push($arrayL1, array(
                'id' => $orgao['Organizacao']['id'],
                'label' => $orgao['Organizacao']['nome'],
                'sigla' => $orgao['Organizacao']['acronimo']
            ));
        }
        return $arrayL1;
    }

    protected function postgres_to_php_array($postgresArray){
        $postgresStr = trim($postgresArray,"{}");
        $elmts = explode(",",$postgresStr);
        return $elmts;
    }

    /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Organizacao->exists($id)) {
			throw new NotFoundException(__('Organização inválida.'));
		}
		$organização = $this->Organizacao->find ('first', array ('conditions' => array('Organizacao.' . $this->Organizacao->primaryKey => $id)));
		$this->set('organizacao', $organização);
        $this->set('modal_title', __('ORGANIZAÇÃO - ') . ' <b>'.$organização['Organizacao']['nome'].'</b>');
        $this->layout = 'modal';
	}

/**
 * add method
 *
 * @return void
 */
/*	public function add() {
		if ($this->request->is('post')) {
			$this->Organizacao->create();
			if ($this->Organizacao->save($this->request->data)) {
				$this->Session->setFlash(__('The organizacao has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizacao could not be saved. Please, try again.'));
			}
		}
		$parentOrganizacoes = $this->Organizacao->ParentOrganizacao->find('list');
		/*$chefes = $this->Organizacao->Chefe->find('list');
		$this->set(compact('parentOrganizacoes'/*, 'chefes'));
	}*/

    public function add($parent_id = null, $secretaria_id = null) {
        if (!$this->Organizacao->exists($parent_id)) {
            throw new NotFoundException(__('Organização inválida.'));
        }

        if ($this->request->is('post')) {
            $this->Organizacao->create();
            $this->request->data['Organizacao']['acronimo'] = strtoupper($this->request->data['Organizacao']['acronimo']);
            $this->request->data['Organizacao']['parent_id'] = $parent_id;
            $this->request->data['Organizacao']['secretaria_id'] = $secretaria_id;
            if ($this->Organizacao->save($this->request->data)) {
                $this->Session->setFlash(('Organização adicionada com sucesso!'), $this->ALERT_ELEMENT, array('class'=>'alert-success', 'escape'=>false));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A organização não pôde ser adicionada. Por favor, tente novamente.'), 'alert', array('alert-danger', 'escape'=>false));
            }
        }
        $options = array(
            'conditions' => array(
                'Organizacao.' . $this->Organizacao->primaryKey => $parent_id
            ),
            'fields' => array(
                'Organizacao.id', 'Organizacao.nome','Organizacao.acronimo', 'Organizacao.parent_array', 'Organizacao.parent_id'
            ),
            'recursive' => -1
        );
        $parent = $this->Organizacao->find('first', $options);
        $parent_array = $this->postgres_to_php_array($parent['Organizacao']['parent_array']);

        $this->set(compact('superiorImediatos'));
        $this->set('parent', $parent);
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Organizacao->exists($id)) {
            throw new NotFoundException(__('Organização inválida.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Organizacao->save($this->request->data)) {
                $this->Session->setFlash(('Organização editada com sucesso!'), $this->ALERT_ELEMENT, array('class'=>'alert-success', 'escape'=>false));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A organização não pôde ser editada. Por favor, tente novamente.'), 'alert', array('alert-danger', 'escape'=>false));
            }
        } else {
            $options = array(
                'conditions' => array(
                    'Organizacao.' . $this->Organizacao->primaryKey => $id
                ),
                'recursive' => -1
            );
            $this->request->data = $this->Organizacao->find('first', $options);
        }
        $parent = $this->Organizacao->ParentOrganizacao->find('list');
        $this->set(compact('parent'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Organizacao->id = $id;
		if (!$this->Organizacao->exists()) {
			throw new NotFoundException(__('Organização inválida.'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Organizacao->delete()) {
			$this->Session->setFlash(__('Organização excluída com sucesso!'), $this->ALERT_ELEMENT, array('class'=>'alert-success', 'escape'=>false));
		} else {
			$this->Session->setFlash(__('A organização não pôde ser excluída. Por favor, tente novamente.'), 'alert', array('alert-danger', 'escape'=>false));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
