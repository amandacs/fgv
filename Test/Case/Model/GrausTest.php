<?php
App::uses('Graus', 'Model');

/**
 * Graus Test Case
 *
 */
class GrausTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.graus',
		'app.indicador'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Graus = ClassRegistry::init('Graus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Graus);

		parent::tearDown();
	}

}
