<?php
App::uses('Perfi', 'Model');

/**
 * Perfi Test Case
 *
 */
class PerfiTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.perfi'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Perfi = ClassRegistry::init('Perfi');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Perfi);

		parent::tearDown();
	}

}
