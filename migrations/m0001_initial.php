<?php
/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:07 AM
 */

class m0001_initial
{
    public function up()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            firstname VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            lastname VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            password VARCHAR(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            status TINYINT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        $db->pdo->exec($SQL);

        // Inserting default user
        $defaultUserEmail = 'test@test.test';
        $defaultUserFirstname = 'test';
        $defaultUserLastname = 'test';
        $defaultUserPassword = password_hash('testtest', PASSWORD_DEFAULT); // Hashing the password

        $insertSQL = "INSERT INTO users (email, firstname, lastname, password, status) VALUES (:email, :firstname, :lastname, :password, :status)";
        $statement = $db->pdo->prepare($insertSQL);
        $statement->bindValue(':email', $defaultUserEmail);
        $statement->bindValue(':firstname', $defaultUserFirstname);
        $statement->bindValue(':lastname', $defaultUserLastname);
        $statement->bindValue(':password', $defaultUserPassword);
        $statement->bindValue(':status', 1); // Assuming 1 represents an active user

        $statement->execute();
    }

    public function down()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}