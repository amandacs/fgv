<?php
/**
 * UsuarioFixture
 *
 */
class UsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'cpf' => array('type' => 'string', 'null' => false, 'length' => 14),
		'nome' => array('type' => 'string', 'null' => false, 'length' => 256),
		'email' => array('type' => 'string', 'null' => false, 'length' => 120),
		'matricula' => array('type' => 'string', 'null' => false, 'length' => 20),
		'organizacao_id' => array('type' => 'biginteger', 'null' => false),
		'cargo_id' => array('type' => 'biginteger', 'null' => false),
		'username' => array('type' => 'string', 'null' => false, 'length' => 100),
		'password' => array('type' => 'string', 'null' => false, 'length' => 256),
		'perfil_id' => array('type' => 'biginteger', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'cpf' => 'Lorem ipsum ',
			'nome' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'matricula' => 'Lorem ipsum dolor ',
			'organizacao_id' => '',
			'cargo_id' => '',
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'perfil_id' => ''
		),
	);

}
