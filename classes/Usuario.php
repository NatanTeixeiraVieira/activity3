<?php

class User {
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct($username = null, $password = null, $email = null) {
        $this->generateId();
        $this->username = $username;
        $this->password = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function generateId() {
        $this->id = uniqid();
    }

    public function register() {
        $userData = [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email
        ];

        $users = file_exists('users.json') ? json_decode(file_get_contents('users.json'), true) : [];

        $users[] = $userData;

        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        return true;
    }

    public function login($username, $password) {
        $path = __DIR__ . '/../cadastro/users.json';

        if (!file_exists($path)) {
            echo "Arquivo users.json não encontrado.";
            return false; 
        }

        $users = json_decode(file_get_contents($path), true);

        if ($users === null) {
            echo "Erro ao ler o arquivo JSON.";
            return false;
        }

        foreach ($users as $user) {
            if ($user['username'] === $username) {
                if (password_verify($password, $user['password'])) {
                    return true; 
                }
            }
        }

        return false;
    }
}