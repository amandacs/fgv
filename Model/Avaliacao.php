<?php
App::uses('AppModel', 'Model');
/**
 * Avaliacao Model
 *
 * @property Pergunta $Pergunta
 * @property UsuarioResposta $UsuarioResposta
 */
class Avaliacao extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'descricao';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descricao' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'prazo' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Digite uma data válida!',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'prazo_avaliador' => array(
            'datetime' => array(
                'rule' => array('datetime'),
                'message' => 'Digite uma data válida!',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'avaliacao_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UsuarioResposta' => array(
			'className' => 'UsuarioResposta',
			'foreignKey' => 'usuario_avaliacao_id',
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
