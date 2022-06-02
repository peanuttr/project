<?php
class db
{
	public function connect()
	{
		// $servername = "us-cdbr-east-05.cleardb.net";
		// $username = "b8fa7680aa3b4b";
		// $password = "97762e27";
		// $databasename = "heroku_2a53a8770fb06e2";
		$servername = "localhost";
		$username = "root";
		$password = "12345678";
		$databasename = "assetsmanagement";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
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
