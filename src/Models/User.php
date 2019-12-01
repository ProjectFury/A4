<?php


namespace Rentit\Models;


use Rentit\Model;

final class User extends Model
{
    /**
     * Find user with username
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        $sql = 'SELECT id,username FROM users WHERE username = :username';

        $this->query($sql);
        $this->bind(":username", $username);
        $this->execute();

        $result = $this->resultSet();

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    public function login(string $username, string $password): bool
    {
        $sql = 'SELECT * FROM users WHERE username = :username';

        $this->query($sql);
        $this->bind(":username", $username);
        $this->execute();

        $result = $this->resultSet();

        if (count($result) == 0) {
            return false;
        }

        if (!password_verify($password, $result[0]["password"])) {
            return false;
        }

        return true;
    }

    public function register(string $username, string $password): bool
    {
        $sql = 'SELECT * FROM user WHERE username = :username';

        $this->query($sql);
        $this->bind(":username", $username);
        $this->execute();

        $result = $this->resultSet();

        if (count($result) != 0) {
            return false;
        }

        $sql = 'INSERT INTO users (username,password) VALUES (:username, :passwd)';
        $this->query($sql);
        $this->bind(":username", $username);
        $passwd = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $this->bind(":passwd", $passwd);

        return $this->execute();
    }
}