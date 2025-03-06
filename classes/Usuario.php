<?php

class Register {
    private $id;
    private $name;
    private $username;
    private $password;

    public function __construct($name, $username, $password) {
        $this->setName($name);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    // Setter e Getter para Name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (!empty($name) && is_string($name) && strlen($name) > 2) {
            $this->name = $name;
        } else {
            throw new Exception("Nome inválido. Deve ter pelo menos 3 caracteres.");
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        if (!empty($username) && preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $this->username = $username;
        } else {
            throw new Exception("Nome de usuário inválido. Apenas letras, números e underscore são permitidos.");
        }
    }

    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }
    }

    private function generateId() {
        $file = "users.txt";

        if (!file_exists($file)) {
            return 1;
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($lines)) {
            return 1;
        }

        $lastLine = end($lines);
        $data = explode(";", $lastLine);
        return (int)$data[0] + 1;
    }

    public function saveUser() {
        $file = "users.txt";
        $this->id = $this->generateId();

        $data = "{$this->id};{$this->name};{$this->username};{$this->password}\n";
        file_put_contents($file, $data, FILE_APPEND); // Adiciona os dados ao arquivo

        echo "Usuário salvo com sucesso! ID: {$this->id}\n";
    }
}
