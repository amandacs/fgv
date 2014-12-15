<?php
App::uses('UsuarioResposta', 'Model');

/**
 * UsuarioResposta Test Case
 *
 */
class RespostaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.resposta',
		'app.pergunta',
		'app.grupo',
		'app.competencia',
		'app.classe',
		'app.questionario',
		'app.avaliacao',
		'app.funcionario',
		'app.organizacao',
		'app.chefe',
		'app.cargo',
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
		$this->Resposta = ClassRegistry::init('UsuarioResposta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Resposta);

		parent::tearDown();
	}

}
