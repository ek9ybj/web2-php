<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

// Database
class Database {
	private function __construct() {}
	private static $conn;
	public static function connect(string $dsn, string $user, string $pwd) {
		self::$conn = new PDO($dsn, $user, $pwd);
		self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	public static function selectAll(string $sql, array $params = []) : array {
		$stmt = self::$conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function selectOne(string $sql, array $params = []) {
		$stmt = self::$conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public static function selectValue(string $sql, array $params = []) {
		$stmt = self::$conn->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchColumn();
	}
	public static function execute(string $sql, array $params = []) {
		$stmt = self::$conn->prepare($sql);
		$stmt->execute($params);
	}
}
Database::connect('mysql:dbname=wf2_ek9ybj;host=localhost', 'ek9ybj', 'ek9ybj');

// Check target
function get(string $target) {
	return isset($_GET[$target]);
}

// Redirect
function redirect(string $path) {
    header('Location: ' . $path);
    exit;
}

// Auth
function auth(bool $mode = null) {
	if($mode === null) return !empty($_SESSION['user']);
	if($mode) {
		if(!empty($_SESSION['user'])) {
			return true;
		} else {
			$_SESSION['messages'][] = array('type' => 'warning', 'message' => 'Please log in!');
			redirect('index.php?login');
		}
	} else {
		if(empty($_SESSION['user'])) {
			return true;
		} else {
			redirect(siteurl);
		}
	}
}