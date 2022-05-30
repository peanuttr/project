<?php
class db
{
	public function connect()
	{
		$servername = "192.168.1.104";
		$username = "root";
		$password = "12345678";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=assetsmanagement", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("set names UTF8");
			// echo "Connected successfully";
			return $conn;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}
	
	public function sqlQuery($sql){
		$stmt = $this->connect()->prepare($sql);
        return $stmt;
	}
}
