<?php
require '../classes/Alunos.php';
require '../classes/CadastroAlunos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $registration = $_POST['registration'];
    $course = $_POST['course'];

    $studentRegister = new CadastroAlunos();
    $student = new Aluno($name, $registration, $course);

    $studentRegister->cadastrarAluno($student);
}
?>
