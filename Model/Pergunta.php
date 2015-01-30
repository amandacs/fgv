<?php
App::uses('AppModel', 'Model');
/**
 * Pergunta Model
 *
 * @property Grupo $Grupo
 * @property Avaliacao $Avaliacao
 */
class Pergunta extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $displayField = 'descricao';
    public $validate = array(
        'ordem' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
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
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Avaliacao' => array(
            'className' => 'Avaliacao',
            'foreignKey' => 'avaliacao_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
	);
}
