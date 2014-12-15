<?php
/**
 * FormularioFixture
 *
 */
class FormularioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'avaliacao_id' => array('type' => 'biginteger', 'null' => true),
		'indicador_id' => array('type' => 'biginteger', 'null' => true),
		'resposta_funcionario_id' => array('type' => 'biginteger', 'null' => true),
		'resposta_chefe_id' => array('type' => 'biginteger', 'null' => true),
		'justificativa_funcionario' => array('type' => 'string', 'null' => true),
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
			'avaliacao_id' => '',
			'indicador_id' => '',
			'resposta_funcionario_id' => '',
			'resposta_chefe_id' => '',
			'justificativa_funcionario' => 'Lorem ipsum dolor sit amet'
		),
	);

}
