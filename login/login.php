<?php
require '../classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();

    if ($user->login($username, $password)) {
        echo "
            <script>
                sessionStorage.setItem('user', '" . addslashes($username) . "');
                alert('Login Realizado com sucesso')
                window.location.href = '/activity3/';
            </script>
        ";
    } else {
        echo "Nome de usuário ou senha inválidos.";
    }
}
?>
