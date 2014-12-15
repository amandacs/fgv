<?php
App::uses('UsuarioAvaliacao', 'Model');

/**
 * UsuarioAvaliacao Test Case
 *
 */
class AvaliacaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.avaliacao',
		'app.avaliado',
		'app.avaliador',
		'app.classe',
		'app.formulario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Avaliacao = ClassRegistry::init('UsuarioAvaliacao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Avaliacao);

		parent::tearDown();
	}

}
