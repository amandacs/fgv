<?php
App::uses('AppModel', 'Model');
/**
 * Grupo Model
 *
 * @property Competencia $Competencia
 * @property Pergunta $Pergunta
 * @property Classe $Classe
 * @property Funcao $Funcao
 */
class Grupo extends AppModel {

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
			),
		),
        'ordem' => array(
            'numeric' => array(
                'rule' => array('numeric'),
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
		'Competencia' => array(
			'className' => 'Grupo',
			'foreignKey' => 'competencia_id',
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
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'grupo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


}
