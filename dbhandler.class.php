<?php
class DBHandler extends mysqli {

        function __construct() {
        	parent::__construct("localhost", "root", "", "bet");
        }

        function __destruct() {
        	$this->close();
        }

        function existsUser($nickname) {
        	$result = $this->query("SELECT * FROM user WHERE nickname = '$nickname';");
		return $result->num_rows > 0;
        }

        function loginUser($nickname, $password) {
        	$result = $this->query("SELECT * FROM user WHERE nickname = '$nickname' AND password = '" . md5($password) . "';");
		$row = $result->fetch_assoc();
		$result->free();
		return $row;
        }

        function createUser($nickname, $password, $email) {
        	$this->query("INSERT INTO user (nickname, password, email) VALUES ('$nickname', '" . md5($password) . "', '$email');");
        }

        function deleteUser($nickname) {
        	$this->query("DELETE FROM user WHERE nickname = '$nickname';");
        }

	function updatePoints($nickname, $points) {
		$this->query("UPDATE user SET points = $points WHERE nickname = '$nickname';");
	}

}
?>
