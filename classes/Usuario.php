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
            if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/', $name)) {
                throw new Exception("Nome inválido. Apenas letras e espaços são permitidos.");
            }
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
            throw new Exception("Username de usuário inválido. Apenas letras, números e underscore são permitidos.");
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

    public function login($username, $password) {
        $file =  __DIR__."/../cadastro/users.txt";

        if(!file_exists($file)){
            throw new Exception("Arquivo não encontrado");
        }

        // Lê o conteúdo do arquivo e retorna um array onde cada linha é um elemento.
        // FILE_IGNORE_NEW_LINES → Remove quebras de linha (\n)
        // FILE_SKIP_EMPTY_LINES → Ignora linhas vazias.
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line) {
            list($id, $name, $storedUsername, $hashPassword) = explode(';', $line);

          // verifica se o username é o mesmo
          if($storedUsername == $username){
            //verifica se a senha corresponde a senha armazenada
            if(password_verify($password, $hashPassword)){
                echo "Login bem sucedido!";
                return true;
            } else {
                throw new Exception("Senha incorreta.");
            }
          }  
        }
        thro new Exception("Usuário não encontrado")
    }
}
