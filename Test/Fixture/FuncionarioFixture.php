<?php
/**
 * FuncionarioFixture
 *
 */
class FuncionarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'cpf' => array('type' => 'string', 'null' => false, 'length' => 14),
		'matricula' => array('type' => 'string', 'null' => false, 'length' => 20),
		'nome' => array('type' => 'string', 'null' => false, 'length' => 256),
		'organizacao_id' => array('type' => 'biginteger', 'null' => false),
		'cargo_id' => array('type' => 'biginteger', 'null' => false),
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
			'matricula' => 'Lorem ipsum dolor ',
			'nome' => 'Lorem ipsum dolor sit amet',
			'organizacao_id' => '',
			'cargo_id' => ''
		),
	);

}
