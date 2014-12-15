<?php
App::uses('AppModel', 'Model');
/**
 * Organizacao Model
 *
 * @property Organizacao $ParentOrganizacao
 * @property Organizacao $ChildOrganizacao
 * @property Usuario $Usuario
 */
class Organizacao extends AppModel {

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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentOrganizacao' => array(
			'className' => 'Organizacao',
			'foreignKey' => 'parent_id',
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
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'organizacao_id',
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
        'ChildOrganizacao' => array(
			'className' => 'Organizacao',
			'foreignKey' => 'parent_id',
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
    function getChildOrganization($parent_id = null) {
        $organizations = $this->find('all', array(
                'conditions' => array(
                    $parent_id.' = ANY(Organizacao.parent_array)',
                ),
                'order' => array('Organizacao.id'=>'ASC', 'Organizacao.nome'=>'ASC')
            )
        );
        $return = array();
        $i = 0;
        foreach ($organizations as $organization) {
            if($i == 0)
                $return[$organization['Organizacao']['nome']][$organization['Organizacao']['id']] = $organization['Organizacao']['nome'].' ';
            $i++;
            foreach ($organization['ChildOrganizacao'] as $child) {
                $acronym = ' ';
                if(trim($child['acronimo']) != ''){
                    $acronym = ' - '.$child['acronimo'];
                }
                $return[$organization['Organizacao']['nome']][$child['id']] = $child['nome'].$acronym;
            }
        }
        return $return;
    }
}
