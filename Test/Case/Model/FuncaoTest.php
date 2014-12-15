<?php
App::uses('Funcao', 'Model');

/**
 * Funcao Test Case
 *
 */
class FuncaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.funcao',
		'app.classe',
		'app.cargo',
		'app.usuario',
		'app.organizacao',
		'app.perfi',
		'app.usuario_avaliacao',
		'app.usuario_resposta',
		'app.pergunta',
		'app.grupo',
		'app.grau'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Funcao = ClassRegistry::init('Funcao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Funcao);

		parent::tearDown();
	}

}
