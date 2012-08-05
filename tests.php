<?php 
require_once('simpletest/autorun.php');
require_once('user.class.php');
require_once('dbhandler.class.php');

$nickname;

class TestUser extends UnitTestCase {

	function setUp() {
		global $nickname;
		$db = new DBHandler();
		while (1) {
			$nickname = "u" . rand();
			if (!$db->existsUser($nickname)) break;
		}
		$db->createUser($nickname, "123456", "a@a.a");
	}

	function tearDown() {
		global $nickname;
		$db = new DBHandler();
		$db->deleteUser($nickname);
	}

	function testConstruct() {
		$user = new User();
		$this->assertEqual($user->getId_user(), -2);
	}

	function testGettersAndLogin() {
		global $nickname;
		$user = new User();
		$user->login($nickname, "123456");
		$this->assertEqual($user->getNickname(), $nickname);
		$this->assertEqual($user->getEmail(), "a@a.a");
		$this->assertEqual($user->getPoints(), 10);
	}

	function testIncorrectLogin() {
		global $nickname;
		$user = new User();
		$user->login($nickname, "incorrect");
		$this->assertEqual($user->getId_user(), -1);
		$this->assertFalse($user->isLogged());
	}

	function testIsLogged() {
		global $nickname;
		$user = new User();
		$this->assertFalse($user->isLogged());
		$user->login($nickname, "123456");
		$this->assertTrue($user->isLogged());
		$user->logout();
		$this->assertFalse($user->isLogged());
	}

	function testChangePoints() {
		global $nickname;
		$user = new User();
		$user->login($nickname, "123456");
		$user->addPoints(2);
		$this->assertEqual($user->getPoints(), 12);
		$user->addPoints(-5);
		$this->assertEqual($user->getPoints(), 7);
		$user = new User();
		$user->login($nickname, "123456");
		$this->assertEqual($user->getPoints(), 7);
	}

}
?>
