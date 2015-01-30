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
        $order = array('Classe.id'=>'ASC');
        $conditions = array('Classe.parent_id != 0');
        $this->paginate = array(
            'limit'=>100,
            'recursive'=>0,
            'fields'=>array(
                'Classe.*',
                'Cargo.nome'
            ),
            'order'=>$order,
            'conditions'=>$conditions,
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
                'conditions' => array(
                    'Classe.parent_id =' => $this->request->data['Classe']['parent_id'],
                ),
                'fields' => 'COUNT(Classe.id) AS "Classe__count"',
                'recursive' => -1,
            ));
            if ($this->request->data['Classe']['parent_id'] != null) {
                $this->request->data['Classe']['sort'] = $classes['Classe']['count'] + 1;
            } else {
                $this->request->data['Classe']['sort'] = 1;
            }
            if ($this->request->data['Classe']['classe_pai'] == 1) {
                $this->request->data['Classe']['parent_id'] = null;
                $this->request->data['Classe']['cargo_id'] = null;
                $this->request->data['Classe']['sort'] = null;
                if ($this->Classe->save($this->request->data)) {
                    $this->Session->setFlash(__('Classe adicionada com sucesso!'), 'alert', array('class' => 'alert-success', 'escape' => false));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('A classe não pôde ser adicionada. Por favor, tente novamente'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                }
            } else {
                if (($this->request->data['Classe']['classe_pai'] == 0 && $this->request->data['Classe']['parent_id'] == null) || $this->request->data['Classe']['classe_pai'] == 0 && ($this->request->data['Classe']['parent_id'] != null && $this->request->data['Classe']['cargo_id'] == null)) {
                    $this->Session->setFlash(__('A classe não pôde ser adicionada. Selecione uma classe pai e um cargo existente ou defina esta como uma nova classe pai.'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                } else {
                    if ($this->Classe->save($this->request->data)) {
                        $this->Session->setFlash(('A classe foi adicionada com sucesso!'), 'alert', array('class' => 'alert-success'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('A classe não pôde ser adicionada. Por favor, tente novamente.'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                    }
                }
            }
        }
        $parents = $this->Classe->find('list', array(
            'conditions' => array('Classe.parent_id' => null),
        ));
        $cargos = $this->Classe->Cargo->find('list');
        $this->set(compact('cargos', 'parents'));
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
            if ($this->request->data['Classe']['classe_pai'] == 1) {
                $this->request->data['Classe']['parent_id'] = null;
                $this->request->data['Classe']['cargo_id'] = null;
                $this->request->data['Classe']['sort'] = null;
                if ($this->Classe->save($this->request->data)) {
                    $this->Session->setFlash(__('Classe alterada com sucesso!'), 'alert', array('class' => 'alert-success', 'escape' => false));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('A classe não pôde ser alterada. Por favor, tente novamente'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                }
            }else {
                if (($this->request->data['Classe']['classe_pai'] == 0 && $this->request->data['Classe']['parent_id'] == null) || $this->request->data['Classe']['classe_pai'] == 0 && ($this->request->data['Classe']['parent_id'] != null && $this->request->data['Classe']['cargo_id'] == null)) {
                    $this->Session->setFlash(__('A classe não pôde ser alterada. Selecione uma classe pai e um cargo existente ou defina esta como uma nova classe pai.'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                } else {
                    if ($this->Classe->save($this->request->data)) {
                        $this->Session->setFlash(('A classe foi alterada com sucesso!'), 'alert', array('class' => 'alert-success'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('A classe não pôde ser alterada. Por favor, tente novamente.'), 'alert', array('class' => 'alert-danger', 'escape' => false));
                    }
                }
            }
        } else {
            $options = array('conditions' => array('Classe.' . $this->Classe->primaryKey => $id));
            $this->request->data = $this->Classe->find('first', $options);
        }
        $parents = $this->Classe->find('list', array(
            'conditions' => array('Classe.parent_id' => null),
        ));
        $cargos = $this->Classe->Cargo->find('list');
        $this->set(compact('cargos', 'parents'));
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