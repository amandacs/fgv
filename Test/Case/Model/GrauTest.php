<?php
App::uses('Grau', 'Model');

/**
 * Grau Test Case
 *
 */
class GrauTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.grau',
		'app.indicador'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Grau = ClassRegistry::init('Grau');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grau);

		parent::tearDown();
	}

}
