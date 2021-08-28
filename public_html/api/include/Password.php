<?php
	define('PASSWORD_SALT_A', '^t?uFZqn%tH6XqY5');
	define('PASSWORD_SALT_B', 'fyTZjt^*2w$9Jx?9');

	function createPassword($rawPassword) {
		return strlen($rawPassword) > 0 ? sha1(md5(PASSWORD_SALT_A . $rawPassword . PASSWORD_SALT_B)) : null;
	}
	function checkPassword($rawPassword, $encryptedPassword) {
		return createPassword($rawPassword) == $encryptedPassword;
	}

	function incrementalHash($len, $cs = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"){
		$charset = $cs;
		$base = strlen($charset);
		$result = '';

		$now = explode(' ', microtime())[1];
		while ($now >= $base) {
			$i = $now % $base;
			$result = $charset[$i] . $result;
			$now /= $base;
		}
		return substr($result, -5);
	}

	if(isset($_REQUEST["passwordEncode"])) {
		echo createPassword($_REQUEST["passwordEncode"]);
	}
?>