<?php
App::uses('Classe', 'Model');

/**
 * Classe Test Case
 *
 */
class ClasseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.classe',
		'app.cargo',
		'app.usuario',
		'app.avaliacao',
		'app.avaliado',
		'app.avaliador',
		'app.formulario',
		'app.pergunta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Classe = ClassRegistry::init('Classe');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Classe);

		parent::tearDown();
	}

}
