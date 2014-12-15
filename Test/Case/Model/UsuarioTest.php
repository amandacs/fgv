<?php
App::uses('Usuario', 'Model');

/**
 * Usuario Test Case
 *
 */
class UsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.organizacao',
		'app.chefe',
		'app.cargo',
		'app.classe',
		'app.avaliacao',
		'app.avaliado',
		'app.avaliador',
		'app.formulario',
		'app.indicador',
		'app.resposta_funcionario',
		'app.resposta_chefe',
		'app.pergunta',
		'app.grupo',
		'app.competencia',
		'app.perfil'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usuario = ClassRegistry::init('Usuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuario);

		parent::tearDown();
	}

}
