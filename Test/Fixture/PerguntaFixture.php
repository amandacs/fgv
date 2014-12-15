<?php
/**
 * PerguntaFixture
 *
 */
class PerguntaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'pergunta' => array('type' => 'text', 'null' => false, 'length' => 1073741824),
		'ordem' => array('type' => 'integer', 'null' => true),
		'grupo_id' => array('type' => 'biginteger', 'null' => false),
		'html_length' => array('type' => 'integer', 'null' => true),
		'html_type' => array('type' => 'string', 'null' => true, 'length' => 50),
		'count_respostas' => array('type' => 'integer', 'null' => true),
		'html_sugestion' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'html_default' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'observacao' => array('type' => 'text', 'null' => false, 'length' => 1073741824),
		'obrigatoria' => array('type' => 'boolean', 'null' => false),
		'classe_id' => array('type' => 'biginteger', 'null' => true),
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
			'pergunta' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'ordem' => 1,
			'grupo_id' => '',
			'html_length' => 1,
			'html_type' => 'Lorem ipsum dolor sit amet',
			'count_respostas' => 1,
			'html_sugestion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'html_default' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'observacao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'obrigatoria' => 1,
			'classe_id' => ''
		),
	);

}
