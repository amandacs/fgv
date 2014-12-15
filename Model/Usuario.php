<?php
App::uses('AppModel', 'Model');
App::uses('BrValidation', 'Localized.Validation');
/**
 * Usuario Model
 *
 * @property Organizacao $Organizacao
 * @property Cargo $Cargo
 * @property Perfi $Perfil
 * @property Funcao $Funcao
 * @property Classe $Classe
 * @property UsuarioAvaliacao $UsuarioAvaliacao
 */
class Usuario extends AppModel {

    public $actAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
    public $displayField = 'nome';

	public $validate = array(
		'cpf' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'valid' => array(
                'rule' =>array('ssn', null, 'br'),
                'message' => 'Digite um CPF válido!'
            ),
        ),
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
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Digite um email válido.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'matricula' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
                'message' => 'Digite a senha!',
			),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'A senha deve ser definida com no mínimo 6 caracteres!',
            ),
            /*'maxLength' => array(
                'rule' => array('maxLength', 12),
                'message' => 'A senha deve ser definida com no máximo 12 caracteres!',
            ),*/
            'password' => array(
                'rule' => array( 'confirmPassword', 'password' ),
                'message' => 'As senhas não são iguais!',
            ),
		),
        /*BEGIN RULES TO NEW_PASSWORDS*/
        'new_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Digite a senha!',
            ),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'A senha deve ser definida com no mínimo 6 caracteres.',
            ),
            'new_password' => array(
                'rule' => array( 'confirmNewPassword'/*, 'new_password' */),
                'message' => 'As senhas não são iguais!',
            ),
        ),
        /*END RULES TO NEW_PASSWORDS*/
        'confirm_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Digite a confirmação da senha!',
            ),
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'A confirmacão da senha deve ser definida com no mínimo 6 caracteres!',
            ),
            /*'maxLength' => array(
                'rule' => array('maxLength', 12),
                'message' => 'A confirmação da senha deve ser definida com no máximo 12 caracteres!',
            ),*/
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

	public $belongsTo = array(
		'Organizacao' => array(
			'className' => 'Organizacao',
			'foreignKey' => 'organizacao_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cargo' => array(
			'className' => 'Cargo',
			'foreignKey' => 'cargo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Perfil' => array(
			'className' => 'Perfi',
			'foreignKey' => 'perfil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Funcao' => array(
            'className' => 'Funcao',
            'foreignKey' => 'funcao_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
       'Classe' => array(
            'className' => 'Classe',
            'foreignKey' => 'classe_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);
    public $hasMany = array(
        'UsuarioAvaliacao' => array(
            'className' => 'UsuarioAvaliacao',
            'foreignKey' => 'avaliado_id',
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
    public function confirmPassword ($data) {
        $valid = FALSE;

        $confirm_pass = $this->data['Usuario']['confirm_password'];
        if( !empty($confirm_pass) ) {
            if ( $data['password'] === Security::hash($confirm_pass, 'md5', false) ) {
                $valid = TRUE; // senhas batem
            }
            return $valid;
        }
    }

    public function confirmNewPassword ($data = null) {
        $valid = FALSE;
        $new_pass = $this->data['Usuario']['new_password'];
        $confirm_pass = $this->data['Usuario']['confirm_password'];
        if(!empty($confirm_pass) ) {
            if ($new_pass === $confirm_pass){
                $valid = TRUE; // senhas batem
                $this->data['Usuario']['password'] = Security::hash($new_pass, 'md5', false);
            }
            return $valid;
        }
    }
}
