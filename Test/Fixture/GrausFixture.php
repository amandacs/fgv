<?php
/**
 * GrausFixture
 *
 */
class GrausFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'graus';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type' => 'text', 'null' => false, 'length' => 1073741824),
		'indicador_id' => array('type' => 'biginteger', 'null' => false),
		'html_select_option_mode' => array('type' => 'string', 'null' => true, 'length' => 300),
		'ordem' => array('type' => 'integer', 'null' => true),
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
			'nome' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'indicador_id' => '',
			'html_select_option_mode' => 'Lorem ipsum dolor sit amet',
			'ordem' => 1
		),
	);

}
