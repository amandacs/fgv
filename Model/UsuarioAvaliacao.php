<?php
App::uses('AppModel', 'Model');
/**
 * UsuarioAvaliacao Model
 *
 * @property Avaliado $Avaliado
 * @property Avaliador $Avaliador
 * @property FuncaoAvaliado $FuncaoAvaliado
 * @property ClasseAvaliado $ClasseAvaliado
 * @property Avaliacao $Avaliacao
 * @property UsuarioResposta $UsuarioResposta
 */
class UsuarioAvaliacao extends AppModel {

    public $actAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
    /*public $validate = array(
        'resposta_avaliado_id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Apenas números são permitidos.'
            ),
            'maxlength' => array(
                'rule' => array('maxLength', '1'),
                'message' => 'Este campo só recebe um único número.'
            ),
            'range' => array(
                'rule'    => array('range', 1, 4),
                'message' => 'Este campo só aceita valores entre 1 e 4.'
            ),
        ),
        'resposta_avaliador_id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'por favor, preencha este campo!',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Avaliado' => array(
			'className' => 'Usuario',
			'foreignKey' => 'avaliado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Avaliador' => array(
			'className' => 'Usuario',
			'foreignKey' => 'avaliador_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'FuncaoAvaliado' => array(
            'className' => 'Funcao',
            'foreignKey' => 'funcao_avaliado_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ClasseAvaliado' => array(
            'className' => 'Classe',
            'foreignKey' => 'classe_avaliado_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
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
		),
	);

}
