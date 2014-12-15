<?php
App::uses('UsuarioResposta', 'Model');

/**
 * UsuarioResposta Test Case
 *
 */
class FormularioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formulario',
		'app.avaliacao',
		'app.avaliado',
		'app.avaliador',
		'app.classe',
		'app.cargo',
		'app.usuario',
		'app.pergunta',
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
		$this->Formulario = ClassRegistry::init('UsuarioResposta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formulario);

		parent::tearDown();
	}

}
