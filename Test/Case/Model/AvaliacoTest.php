<?php
App::uses('Avaliaco', 'Model');

/**
 * Avaliaco Test Case
 *
 */
class AvaliacoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.avaliaco',
		'app.funcionario',
		'app.chefe'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Avaliaco = ClassRegistry::init('Avaliaco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Avaliaco);

		parent::tearDown();
	}

}
