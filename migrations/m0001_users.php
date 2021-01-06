<?php

class m0001_users {
	public function up() {
		$db = \app\core\App::$app->db;
		$SQL = "CREATE TABLE users (
		    id INT AUTO_INCREMENT PRIMARY KEY,
		    email VARCHAR(255) NOT NULL UNIQUE,
		    password VARCHAR(512) NOT NULL,
		    first_name VARCHAR(255) NOT NULL,
		    middle_name VARCHAR(255),
		    last_name VARCHAR(255) NOT NULL,
		    status TINYINT NOT NULL DEFAULT 0,
		    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) ENGINE = INNODB;";

		$db->pdo->exec($SQL);
	}

	public function down()
	{
		$db = \app\core\App::$app->db;
		$SQL = "DROP TABLE users;";

		$db->pdo->exec($SQL);
	}
}