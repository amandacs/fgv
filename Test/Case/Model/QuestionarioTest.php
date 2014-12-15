<?php
App::uses('Questionario', 'Model');

/**
 * Questionario Test Case
 *
 */
class QuestionarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.questionario',
		'app.avaliacao',
		'app.funcionario',
		'app.organizacao',
		'app.chefe',
		'app.cargo',
		'app.pergunta',
		'app.grupo',
		'app.competencia',
		'app.classe',
		'app.resposta',
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
		$this->Questionario = ClassRegistry::init('Questionario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Questionario);

		parent::tearDown();
	}

}
