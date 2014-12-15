<?php
App::uses('Pergunta', 'Model');

/**
 * Pergunta Test Case
 *
 */
class IndicadoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pergunta',
		'app.grupo',
		'app.competencia',
		'app.classe',
		'app.cargo',
		'app.usuario',
		'app.avaliacao',
		'app.avaliado',
		'app.avaliador',
		'app.formulario',
		'app.indicador',
		'app.resposta_funcionario',
		'app.resposta_chefe'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Indicadore = ClassRegistry::init('Pergunta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Indicadore);

		parent::tearDown();
	}

}
