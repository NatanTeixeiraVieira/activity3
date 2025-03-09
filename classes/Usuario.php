<?php

class User {
    private $id;
    private $username;
    private $password;
    private $email;

    // Construtor
    public function __construct($username = null, $password = null, $email = null) {
        $this->generateId();
        $this->username = $username;
        $this->password = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        $this->email = $email;
    }

    // Getters e Setters
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

    // Método para gerar ID único
    public function generateId() {
        $this->id = uniqid();
    }

    // Método para cadastro de usuário
    public function register() {
        // Criar um array com os dados do usuário
        $userData = [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email
        ];

        // Carregar o arquivo JSON existente, ou criar um array vazio
        $users = file_exists('users.json') ? json_decode(file_get_contents('users.json'), true) : [];

        // Adicionar novo usuário ao array
        $users[] = $userData;

        // Salvar o array atualizado no arquivo JSON
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        return true;
    }

    // Método de login
    public function login($username, $password) {
        // Caminho para o arquivo users.json
        $path = __DIR__ . '/../cadatro/users.json';

        // Verifica se o arquivo existe
        if (!file_exists($path)) {
            echo "Arquivo users.json não encontrado.";
            return false; // Se o arquivo não existir, não há usuários
        }

        // Carrega os usuários armazenados
        $users = json_decode(file_get_contents($path), true);

        // Verifica se houve erro ao carregar o JSON
        if ($users === null) {
            echo "Erro ao ler o arquivo JSON.";
            return false;
        }

        // Procura pelo usuário e verifica a senha
        foreach ($users as $user) {
            // Verifica se o username corresponde
            if ($user['username'] === $username) {
                // Verifica se a senha fornecida corresponde à senha armazenada
                if (password_verify($password, $user['password'])) {
                    return true; // Sucesso no login
                }
            }
        }

        // Se o username ou senha estiver incorreto
        return false;
    }
}