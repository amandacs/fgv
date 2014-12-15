<?php
App::uses('AppModel', 'Model');
/**
 * Classe Model
 *
 * @property Cargo $Cargo
 * @property UsuarioAvaliacao $UsuarioAvaliacao
 * @property Pergunta $Pergunta
 */
class Classe extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $displayField = 'nome';
    public $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Cargo' => array(
            'className' => 'Cargo',
            'foreignKey' => 'cargo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'classe_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
            'recursive' => 0
        )
    );
}
