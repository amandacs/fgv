<?php
/**
 * GrupoFixture
 *
 */
class GrupoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'length' => 256),
		'ordem' => array('type' => 'integer', 'null' => true),
		'observacao' => array('type' => 'string', 'null' => false, 'length' => 256),
		'count' => array('type' => 'integer', 'null' => true),
		'competencia_id' => array('type' => 'biginteger', 'null' => true),
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
			'nome' => 'Lorem ipsum dolor sit amet',
			'ordem' => 1,
			'observacao' => 'Lorem ipsum dolor sit amet',
			'count' => 1,
			'competencia_id' => ''
		),
	);

}
