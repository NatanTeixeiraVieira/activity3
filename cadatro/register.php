<?php

require_once __DIR__ . "/../classes/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
      $name = trim($_POST["name"]);
      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);

      $user = new Register($name, $username, $password);

      $user->saveUser();

      echo "Usuário cadastrado com sucesso!";
  } catch (Exception $e) {
      echo "Erro: " . $e->getMessage();
  }
} else {
  echo "Método de requisição inválido.";
}
?>