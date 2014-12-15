<?php
App::uses('Organizacao', 'Model');

/**
 * Organizacao Test Case
 *
 */
class OrganizacaoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organizacao',
		'app.chefe',
		'app.usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organizacao = ClassRegistry::init('Organizacao');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organizacao);

		parent::tearDown();
	}

}
