<?php
require '../classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($username, $password, $email);

    if ($user->register()) {
        echo "
            <script>
                alert('Usuário cadastrado com sucesso.');
                window.location.href='/activity3/login';
            </script>
        ";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
