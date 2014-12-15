<?php
App::uses('AppModel', 'Model');
/**
 * Grau Model
 *
 * @property Pergunta $Pergunta
 */
class Grau extends AppModel {

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
        'grau_indicador' => array(
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
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'indicador_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    function grauListComp(){
        $alias = $this->tableToModel['graus'];
        /*$perg = $this->tableToModel['perguntas'];*/
        $graus = $this->find('all',array(
                'fields'=>array(
                    $alias.'.id',
                    $alias.'.nome',
                    $alias.'.grau_indicador',
                ),
                'order' => array(
                    'RespostaFuncionario.grau_indicador ASC',
                ),
            )
        );
        return Set::combine( $graus,'{n}.'.$alias.'.id',array('{0} - {1}','{n}.'.$alias.'.grau_indicador','{n}.'.$alias.'.nome'));
    }
    function grauListFatoresDeDesempenho(){
        $alias = $this->tableToModel['graus'];
        $graus = $this->find('all',array(
                'fields'=>array(
                    $alias.'.id',
                    $alias.'.nome',
                    $alias.'.grau_indicador'
                ),
                'order' => array(
                    'RespostaFuncionarioDes.grau_indicador ASC',
                ),
                'conditions' => array(
                    'RespostaFuncionarioDes.id >= 5'
                ),
            )
        );
        return Set::combine( $graus,'{n}.'.$alias.'.id',array('{0} - {1}','{n}.'.$alias.'.grau_indicador','{n}.'.$alias.'.nome'));
    }
}
