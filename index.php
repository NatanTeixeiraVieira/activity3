<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="nav">
  <h1>Cadastro de alunos</h1>
  <ul class="menu-list">
    <li><a href="/activity3">Início</a></li>
    <li><a href="/activity3/login">Login</a></li>
    <li><a href="/activity3/cadastro">Cadastrar-se</a></li>
    <li><a href="/activity3/cadastroAluno">Cadastro de aluno</a></li>
  </ul>
</nav>

<h2>Listagem</h2>
  <?php
    require "./classes/CadastroAlunos.php";

    $registerStudents = new CadastroAlunos("./cadastroAluno/alunos.json");
    $registerStudents->listarAlunos();
    ?>
</nav>
</body>
</html>