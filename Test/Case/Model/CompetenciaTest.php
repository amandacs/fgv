<?php
App::uses('Competencia', 'Model');

/**
 * Competencia Test Case
 *
 */
class CompetenciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.competencia',
		'app.grupo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Competencia = ClassRegistry::init('Competencia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Competencia);

		parent::tearDown();
	}

}
