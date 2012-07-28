<?php 
require_once('simpletest/autorun.php');
require_once('user.class.php');

class TestUser extends UnitTestCase {
	function setUp() {
	}

	function testConstruct() {
		$user = new User();
		$this->assertEqual($user->getId_user(), -2);
	}

	function testGetters() {
		$user = new User(1, "alberto", "a@a.com", 999);
		$this->assertEqual($user->getId_user(), 1);
		$this->assertEqual($user->getNickname(), "alberto");
		$this->assertEqual($user->getEmail(), "a@a.com");
		$this->assertEqual($user->getPoints(), 999);
	}

	function testChangePoints() {
		$user = new User(1, "alberto", "a@a.com", 999);
		$user->addPoints(2);
		$this->assertEqual($user->getPoints(), 1001);
		$user->addPoints(-1000);
		$this->assertEqual($user->getPoints(), 1);
	}

	function testIsLogged() {
		$user = new User();
		$this->assertFalse($user->isLogged());
		$user = new User(1, "alberto", "a@a.com", 999);
		$this->assertTrue($user->isLogged());
		$user->logout();
		$this->assertFalse($user->isLogged());
	}
}
?>
