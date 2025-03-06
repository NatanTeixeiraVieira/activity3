<?php

require_once __DIR__ . "/../classes/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
      // Captura os dados do formulário
      $name = trim($_POST["name"]);
      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);

      // Cria um novo usuário
      $user = new Register($name, $username, $password);

      // Salva o usuário no arquivo
      $user->saveUser();

      echo "Usuário cadastrado com sucesso!";
  } catch (Exception $e) {
      echo "Erro: " . $e->getMessage();
  }
} else {
  echo "Método de requisição inválido.";
}
?>