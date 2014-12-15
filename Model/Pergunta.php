<?php
App::uses('AppModel', 'Model');
/**
 * Pergunta Model
 *
 * @property Grupo $Grupo
 * @property Avaliacao $Avaliacao
 * @property Grau $Grau
 * @property Classe $Classe
 * @property Funcao $Funcao
 */
class Pergunta extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $displayField = 'descricao';
    /*public $displayField = 'pergunta';
    public $virtualFields = array(
        'pergunta' => "CONCAT(Pergunta.ordem,'-', Pergunta.descricao)"
    );*/
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
        /*'Classe' => array(
            'className' => 'Classe',
            'foreignKey' => 'classe_array',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Funcao' => array(
            'className' => 'Funcao',
            'foreignKey' => 'funcao_array',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),*/
	);
   /* public $hasMany = array(
        'Grau' => array(
            'className' => 'Grau',
            'foreignKey' => 'indicador_id',
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
    );*/
}
