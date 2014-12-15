<?php
App::uses('AppModel', 'Model');
/**
 * UsuarioResposta Model
 *
 * @property UsuarioAvaliacao $UsuarioAvaliacao
 * @property Pergunta $Pergunta
 * @property RespostaAvaliado $RespostaAvaliado
 * @property RespostaAvaliador $RespostaAvaliador
 */
class UsuarioResposta extends AppModel {

    public $actAs = array(
       'Containable'
    );
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
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
                'rule'    => array('range', 0, 5),
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
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UsuarioAvaliacao' => array(
			'className' => 'UsuarioAvaliacao',
			'foreignKey' => 'usuario_avaliacao_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'pergunta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/*'RespostaAvaliado' => array(
			'className' => 'Grau',
			'foreignKey' => 'resposta_avaliado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RespostaAvaliador' => array(
			'className' => 'Grau',
			'foreignKey' => 'resposta_avaliador_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);
}
