<?php
App::uses('FuncionariosController', 'Controller');

/**
 * FuncionariosController Test Case
 *
 */
class FuncionariosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.funcionario',
		'app.organizacao',
		'app.chefe',
		'app.cargo',
		'app.avaliacao',
		'app.questionario',
		'app.pergunta',
		'app.grupo',
		'app.competencia',
		'app.classe',
		'app.resposta',
		'app.resposta_funcionario',
		'app.resposta_chefe'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('testIndex not implemented.');
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('testView not implemented.');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('testAdd not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

}
